<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\PendapatanLangsung;
use App\Models\Penjualan;
use App\Models\PenjualanKredit;
use App\Models\PenjualanKreditLine;
use App\Models\PenjualanLine;
use Carbon\Carbon;
use Livewire\Component;
use Session;
use Livewire\WithPagination;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Ramsey\Uuid\Uuid;

class Cart extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tax = "0%";
    public $search;

    // Pembayaran
    public $metodePembayaran;
    public $Bank;
    public $tanggal;
    public $kategoriPembayaran;
    public $payment = '';
    public $grand_total = 0;

    // Edit harga
    public $qtybarang,$barang,$status;

    // Harga
    public $hargajualrefil, $satuml,$duaratuslimapuluhml,$limaratusml,$satuliterml,$idbarang;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $selecttedItem;
    public $selecttedItemLangsung;
    public $langsungbeli;
    public $tesprint = 'hidden';
    public $viewbank = "hidden";
    public $viewlangsung = "hidden";


    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public $harga = '';
    public $customerPos;
    public $diskonCstPos;


    public function render()
    {
        $products = Barang::where('nama_barang', 'like', '%' . $this->search . '%')->orderBy('created_at', 'ASC')->paginate('9');
        $cst = Customer::find($this->customerPos);
        $this->diskonCstPos = $cst == '' ? '' : $cst->jumlah_diskon;
        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
            'order' => 1
        ]);
        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'satuan' => $item->attributes->satuan,
                    'satuankategori' => $item->attributes->qty,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();
        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);

        $summary = [
            'sub_total' => $sub_total,
            'pajak' => $pajak,
            'total' => $total
        ];

        // kode
        $firstInvoiceID = Penjualan::whereDay('created_at', date('d'))->count('id');
        $secondInvoiceID = $firstInvoiceID + 1;
        $nomor = sprintf("%03d", $secondInvoiceID);
        $tanggal = date('Ymd');
        $kode = "MP/INV/PNJ-T/$tanggal/$nomor";
        // 

        // customer
        $customer = Customer::get();

        // Metode Pembayaran
        $metode = [
            ["metode" => "Cash"],
            ["metode" => "Debit"],
            ["metode" => "Transfer"],
        ];
        // List Bank
        $listbank = [
            ["nama" => "BRI"],
            ["nama" => "BNI"],
            ["nama" => "BCA"],
            ["nama" => "Mandiri"],
            ["nama" => "Panin"],
            ["nama" => "Lainnya"],
        ];

        if ($this->metodePembayaran == ("Transfer" && "Debit")) {
            $this->viewbank = "show";
        }
        if ($this->metodePembayaran == "Cash") {
            $this->viewbank = "hidden";
        }

        if ($this->kategoriPembayaran == "Langsung") {
            $this->viewlangsung = "show";
        }
        if ($this->kategoriPembayaran == "Kredit") {
            $this->viewlangsung = "hidden";
        }


        return view('livewire.cart', [
            'products' => $products,
            'carts' => $cartData,
            'summary' => $summary,
            'kode' => $kode,
            'customer' => $customer,
            'metode' => $metode,
            'listbank' => $listbank,
        ]);
    }


    public function selecttedItemLangsung($itemId, $action)
    {
        $this->selecttedItemLangsung = $itemId;
        $barang = Barang::find($itemId);
        $this->status = $barang->status;
        if ($action == 'langsungbeli') {
            $this->status = $barang->status;
            $this->barang = $barang->nama_barang;
            $this->satuml = $barang->hj1;
            $this->duaratuslimapuluhml = $barang->hj250;
            $this->limaratusml = $barang->hj500;
            $this->satuliterml = $barang->hj1l;
            if ($barang->status == 1) {
                $this->dispatchBrowserEvent('openModalQtyrefil');
            } else {
                $this->dispatchBrowserEvent('openModalQty');
            }
        }
    }

    public function submitEditHargaLangsung($itemId, $action)
    {
        $id = $this->selecttedItemLangsung = $itemId;
        $barang = Barang::find($itemId);
        $harga_jual = $barang->harga_jual;
        $status = $barang->status;
        $satuml = $this->satuml;
        $duaratuslimapuluhml= $this->duaratuslimapuluhml;
        $limaratusml = $this->limaratusml;
        $satuliterml = $this->satuliterml;
        if ($this->hargajualrefil == $satuml){
            $qtynow = 1;
        }
        if ($this->hargajualrefil == $duaratuslimapuluhml){
            $qtynow = 250;
        }
        if ($this->hargajualrefil == $limaratusml){
            $qtynow = 500;
        }
        if ($this->hargajualrefil == $satuliterml){
            $qtynow = 1000;
        }
        $harga_jualref = array(
            'qty' => $qtynow,
            'harga' => $this->hargajualrefil
        );
        $qtybarang_sem = $this->qtybarang;
        $qtybarang = str_replace([".", "Rp", " "], '', $qtybarang_sem);
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $id);
        if ($action == 'submitButtonHargaLangsung') {
            if ($status === 1) {
                    $qty = $qtybarang *  $harga_jualref['qty'];
                    $product = Barang::findOrFail($id);
                    $product->stock = $product->stock - $qty;
                    $product->save();
                    \Cart::session(Auth()->id())->add([
                        'id' => Uuid::uuid4()->toString(),
                        'name' => $product->nama_barang,
                        'price' => $harga_jualref['harga'],
                        'quantity' =>  $qtybarang,
                        'attributes' => [
                            'id' => $product->id,
                            'satuan' => $product->satuan_id,
                            'harga' => $harga_jualref['harga'],
                            'qty' => $harga_jualref['qty'],
                            'added_at' => Carbon::now()
                        ],
                    ]);
            }else{
                $product = Barang::findOrFail($id);
                $product->stock = $product->stock - $qtybarang;
                $product->save();
                \Cart::session(Auth()->id())->add([
                    'id' => Uuid::uuid4()->toString(),
                    'name' => $product->nama_barang,
                    'price' => $harga_jual,
                    'quantity' => $qtybarang,
                    'attributes' => [
                        'id' => $product->id,
                        'satuan' => $product->satuan_id,
                        'harga' => $harga_jual,
                        'added_at' => Carbon::now()
                    ],
                ]);
            }
            if ($status == 1) {
                $this->dispatchBrowserEvent('closeModalQtyrefil');
            } else {
                $this->dispatchBrowserEvent('closeModalQty');
            }
                $this->dispatchBrowserEvent('swal', [
                    'text' => 'Sukses Masuk Keranjang',
                    'timer' => 1500,
                    'icon' => false,
                    'showConfirmButton' => false,
                    'position' => 'center'
                ]);
                $this->hapusBayar();
        }
    }

    public function submitEditHarga($itemId, $action)
    {
        $id = $this->selecttedItem = $itemId;
        $edit_harga_sem = $this->harga;
        $qtybarang_sem = $this->qtybarang;
        $editharga = str_replace([".", "Rp", " "], '', $edit_harga_sem);
        $qtybarang = str_replace([".", "Rp", " "], '', $qtybarang_sem);
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $id);
        if ($action == 'submitButtonHarga') {
            if (!$editharga) {
                $this->dispatchBrowserEvent('swal', [
                    'text' => 'Masukin Harganya Dulu...',
                    'timer' => 2000,
                    'icon' => false,
                    'showConfirmButton' => false,
                    'position' => 'center'
                ]);
            } else {
                $product = Barang::findOrFail($id);
                $product->stock = $product->stock - $qtybarang;
                $product->save();
                \Cart::session(Auth()->id())->add([
                    'id' => Uuid::uuid4()->toString(),
                    'name' => $product->nama_barang,
                    'price' => $editharga,
                    'quantity' => $qtybarang,
                    'attributes' => [
                        'id' => $product->id,
                        'satuan' => $product->satuan_id,
                        'harga' => $editharga,
                        'harga_beli' => $product->harga_beli,
                        'added_at' => Carbon::now()
                    ],
                ]);
            }
            $this->dispatchBrowserEvent('swal', [
                'text' => 'Sukses Masuk Keranjang',
                'timer' => 1500,
                'icon' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);
            $this->hapusBayar();
            $this->dispatchBrowserEvent('closeModal');
        }
    }

    public function cancelEditLangsung($itemId, $action)
    {
        $barang = Barang::find($itemId);
        $status = $barang->status;

        if ($action == 'cancelButtonHargaLangsung') {
            
            if ($status == 1) {
                $this->dispatchBrowserEvent('swal', [
                  // 'title' => 'ðŸ˜«',
                    'text' => 'Ko Ga Jadi?',
                    'timer' => 1500,
                    'icon' => false,
                    'showConfirmButton' => false,
                    'position' => 'center'
                ]);
                $this->hapusBayar();
                $this->dispatchBrowserEvent('closeModalQtyrefil');
            } else {
                $this->dispatchBrowserEvent('swal', [
                 // 'title' => 'ðŸ˜«',
                    'text' => 'Ko Ga Jadi?',
                    'timer' => 1500,
                    'icon' => false,
                    'showConfirmButton' => false,
                    'position' => 'center'
                ]);
                $this->hapusBayar();
                $this->dispatchBrowserEvent('closeModalQty');
            }
           
        }
    }

    public function selecttedItem($itemId, $action)
    {
        $this->selecttedItem = $itemId;
        $barang = Barang::find($itemId);
        if ($action == 'editharga') {
            $this->barang = $barang->nama_barang;
            $this->dispatchBrowserEvent('openModal');
        }
    }
    public function removeItem($rowId)
    {
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id', $rowId);
        $product = Barang::find($checkItem[$rowId]->attributes->id);
        if($checkItem[$rowId]->attributes->qty > 0) {
            $qtynow = $checkItem[$rowId]->attributes->qty *$checkItem[$rowId]->quantity;
            $updateqty = $product->stock + $qtynow;
        }else{
            $updateqty = $product->stock + $checkItem[$rowId]->quantity;
        };
        $product->stock = $updateqty;
        $product->save();
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function handleSubmit()
    {
        if(!$this->customerPos || !$this->kategoriPembayaran){
            $this->dispatchBrowserEvent('swal', [
                'title' => '⚠',
                'text' => 'Customer Dan Metode Pembayaran Wajib Diisi!',
                'timer' => 2000,
                'icon' => false,
                'showConfirmButton' => false,
                'position' => 'center'
            ]);
        }else{
            $firstInvoiceID = Penjualan::whereDay('created_at', date('d'))->count('id');
            $secondInvoiceID = $firstInvoiceID + 1;
            $nomor = sprintf("%03d", $secondInvoiceID);
            $tanggal = date('Ymd');
            $kode = "MP1/INV/PNJ-T/$tanggal/$nomor";
    
            $firstInvoiceIDk = PenjualanKredit::whereDay('created_at', date('d'))->count('id');
            $secondInvoiceIDk = $firstInvoiceIDk + 1;
            $nomork = sprintf("%03d", $secondInvoiceIDk);
            $kodekredit = "MP1/INV/PNJ-K/$tanggal/$nomork";
            // last inv
            $cartTotal = \Cart::session(Auth()->id())->getTotal();
            $bayar = $this->payment;
            $kembalian = (int) $bayar - (int) $cartTotal;
                DB::beginTransaction();
                try {
                    $allCart = \Cart::session(Auth()->id())->getContent();
                    $filterCart = $allCart->map(function ($item) {
                        return [
                            'id' =>  $item->attributes['id'],
                            'quantity' => $item->quantity,
                            'satuan' => $item->attributes['satuan'],
                            'harga' => $item->attributes['harga'],
                            'harga_beli' => $item->attributes['harga_beli']
                        ];
                    });
                    foreach ($filterCart as $cart) {
                        $product = Barang::find($cart['id']);
                        if ($product->stock === 0) {
                        }
                    }
                    if (!$this->metodePembayaran) {
                        $this->metodePembayaran = "Cash";
                    }
                    // Kasir
                    $user = Auth::user();
                    // CUstomer
                    $customer = Customer::find($this->customerPos);
                    $diskon =  (($cartTotal*$this->diskonCstPos)/100);
                    $total = $cartTotal - $diskon;
                    if ($this->kategoriPembayaran == "Langsung") {
                        // Inset penjualan
                        $header = Penjualan::insertGetId([
                            'no_struk' => $kode,
                            'kasir' => $user->name,
                            'nama_customer' => $customer->nama,
                            'alamat' => $customer->alamat,
                            'telepon' => $customer->telepon,
                            'customer_id' => $customer->id,
                            'metode_pembayaran' => $this->metodePembayaran,
                            'bank' => $this->Bank,
                            'total' => $cartTotal,
                            'diskon'=> $diskon,
                            'grand_total' => (int)$total,
                            'created_at' => $this->tanggal == '' ? now() :  $this->tanggal,
                            'updated_at' => now()
                        ]);
                        foreach ($filterCart as $cart) {
                            PenjualanLine::create([
                                'penjualan' => $header,
                                'nama' => $cart['id'],
                                'harga_beli' => $cart['harga_beli'],
                                'harga_jual' => $cart['harga'],
                                'qty' => $cart['quantity'],
                                'satuan_id' => $cart['satuan'],
                                'grand_total' => $cart['quantity'] * $cart['harga'],
                                'keterangan' => $kode,
                            ]);
                        }
                        // insert pendapatan langsung
                        PendapatanLangsung::insertGetId([
                            'kode_pendapatan_tunai' => $kode,
                            'customer_id' => $customer->id,
                            'jumlah_pendapatan' => (int)$total,
                            'jenis_pendapatan' => 'Penjualan Dari Toko/Barang',
                            'keterangan' => $this->metodePembayaran.' '.$this->Bank.' dari '.$customer->nama,  
                            'tanggal' => $this->tanggal == '' ? now() :  $this->tanggal,
                            'created_at' => $this->tanggal == '' ? now() :  $this->tanggal,
                            'updated_at' => now()
                        ]);
                    } else{
                        $header = PenjualanKredit::insertGetId([
                            'no_struk' => $kodekredit,
                            'kasir' => $user->name,
                            'nama_customer' => $customer->nama,
                            'alamat' => $customer->alamat,
                            'telepon' => $customer->telepon,
                            'customer_id' => $customer->id,
                            'status' => 1,
                            'sisa' =>(int)$total,
                            'total' => $cartTotal,
                            'diskon'=> $diskon,
                            'grand_total' => (int)$total,
                            'created_at' => $this->tanggal == '' ? now() :  $this->tanggal,
                            'updated_at' => now()
                        ]);
        
                        foreach ($filterCart as $cart) {
                            PenjualanKreditLine::create([
                                'penjualan_kredit' => $header,
                                'nama' => $cart['id'],
                                'harga_jual' => $cart['harga'],
                                'harga_beli' => $cart['harga_beli'],
                                'qty' => $cart['quantity'],
                                'satuan_id' => $cart['satuan'],
                                'sisa' => $cart['quantity'] * $cart['harga'],
                                'grand_total' => $cart['quantity'] * $cart['harga'],
                                'keterangan' => $kodekredit,
                            ]);
                        }
                    }
                    \Cart::clear();
                    \Cart::session(Auth()->id())->clear();
                    $this->hapusBayar();
                    $this->dispatchBrowserEvent('swal', [
                        'text' => 'Yeay... Berhasil Melakukan Transaksi...',
                        'timer' => 2000,
                        'icon' => false,
                        'showConfirmButton' => false,
                        'position' => 'center'
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                }
        }
       
    }

    private function hapusBayar()
    {
        $this->payment = null;
        $this->paymenText = null;
        $this->kembalianText = null;
        $this->editHarga = null;
        $this->qtybarang = null;
        $this->harga = null;
        $this->customerPos = null;
        $this->metodePembayaran = null;
        $this->Bank = null;
        $this->tanggal = null;
        $this->hargajualrefil = null;
        $this->kategoriPembayaran = null;
        $this->viewlangsung = null;
        $this->viewbank = "hidden";
    }
}
