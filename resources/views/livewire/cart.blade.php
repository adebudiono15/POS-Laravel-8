@push('css')
<style>
    .printing{
        display: none;
    }

    @media print {
    #printing {
        display: contents;
    }
}
</style>
@endpush

<div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><b>DAFTAR PRODUK</b></h5>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm float-right shadow mt-0 mb-0" wire:model="search" placeholder="Cari Produk Disini">
                        </div>
                    </div>
                    <hr/>

                    {{--  Daftar Produk  --}}
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" class="text-center">Stok</th>
                                    <th scope="col" class="text-center">Modal</th>
                                    <th scope="col" class="text-center">Harga</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $e => $item )
                            <tr>
                                <th scope="row">{{ $e+1 }}</th>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->stock }} ({{ $item->satuan_id }})</td>
                                <td class="text-right">{{ $item->harga_beli == 0 ? number_format($item->hb1,0) : number_format($item->harga_beli,0) }} /{{ $item->satuan_id }}</td>
                                <td class="text-right">{{ $item->harga_jual == 0 ? number_format($item->hj1,0) : number_format($item->harga_jual,0) }} /{{ $item->satuan_id }}</td>
                                <td style="width:300px" class="text-center">
                                <button type="button" wire:click="selecttedItem({{ $item->id }},'editharga')" class="btn btn-sm btn-pink mt-2">
                                <b>Masukan Keranjang</b>
                                </button>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="4">Ups... Produk Yang Kamu Cari Engga Ada.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- last daftar --}}
                    <div class="row mt-5 text-center justify-content-center">
                        <div class="row">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  Keranjang  --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5><b>KERANJANG</b></h5>
                    <hr/>
                    <div class="overflow-auto cart">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                                <th scope="col" class="text-center">#</th>
                              </tr>
                            </thead>
                            <tbody>
                            @forelse ($carts as $index=>$item)
                              <tr>
                                <th scope="row">{{ $index+1}}</th>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ number_format($item['price'],0) }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td> {{ $item['satuankategori'] }}/{{ $item['satuan'] }} </td>
                                <td>
                                    <button class="btn float-right mr-2 btn-danger btn-sm" wire:click="removeItem('{{ $item['rowId'] }}')"><i class='bx bx-trash'></i></button>
                                </td>
                              </tr>
                              @empty
                              <td colspan="6">
                                  <p class="text-center"><b>Keranjang Masih Kosong</b></p>
                                </td>
                              @endforelse
                            </tbody>
                          </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                             {{--  Customer  --}}
                             <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select id="my-select" wire:model="customerPos" class="form-control form-control-sm shadow">
                                            <option selected>Pilih Customer</option>
                                            @foreach ($customer as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col">
                                <span class="">Diskon :</span>
                                <span class="float-right"><b>{{  $diskonCstPos == '' ? '' : number_format($diskonCstPos) }} %</b></span>
                               </div>
                           </div>
                            {{-- Last Customer  --}}
                           <div class="row">
                               <div class="col">
                                <span class="">Total :</span>
                                <span class="float-right"><b>Rp. {{ number_format($summary['total'] - (($summary['total']*($diskonCstPos == '' ? 0 : $diskonCstPos))/100),0) }}</b></span>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <span>Di Bayar :</span>
                            <div class="float-right" wire:model="paymentTextAtas" wire:ignore id="paymentTextAtas">Rp. -</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <span>Kembalian :</span>
                            <span class="float-right" wire:model="kembalianText" wire:ignore id="kembalianText">Rp. -</span>
                        </div>
                    </div>

                    {{--  Kategori pembayaran  --}}
                   <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="date" wire:model="tanggal" placeholder="Default Tanggal Hari Ini" class="form-control form-control-sm shadow">
                        </div>
                    </div>
               </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="my-select" wire:model="kategoriPembayaran" class="form-control form-control-sm shadow">
                                    <option selected>Pilih Metode Pembayaran</option>
                                    <option value="Langsung">Langsung</option>
                                    <option value="Kredit">Kredit</option>
                                </select>
                            </div>
                        </div>
                   </div>

                    <div {{ $viewlangsung }}>
                    {{--  Payment  --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <input type="number" wire:model="payment" placeholder="Masukan Pembayaran Klien" class="form-control form-control-sm shadow" id="payment">
                            <input type="hidden" id="total" value="{{ $summary['total'] - (($summary['total']*($diskonCstPos == '' ? 0 : $diskonCstPos))/100) }}">
                            <input type="hidden" wire:model="grand_total" value="{{ $summary['total'] - (($summary['total']*($diskonCstPos == '' ? 0 : $diskonCstPos))/100) }}">
                        </div>
                    </div>

                    {{--  Metode Pembayaran  --}}
                    <div class="row mt-4">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <select id="my-select"  wire:model="metodePembayaran"  class="form-control form-control-sm shadow">
                                     <option value="Cash" selected>Default Metode Pembayaran Cash</option>
                                     @foreach ($metode as $item)
                                     <option value="{{ $item["metode"] }}">{{ $item["metode"] }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                    </div>

                    {{--  Bank  --}}
                    <div class="row mt-4" {{ $viewbank }}>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="my-select" wire:ignore wire:model="Bank"  class="form-control form-control-sm shadow">
                                    <option  selected>Pilih Bank</option>
                                    @foreach ($listbank as $item)
                                        <option value="{{ $item["nama"] }}">{{ $item["nama"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
                    <form wire:submit.prevent="handleSubmit" id="myForm">
                    <div class="row  mt-3 mb-3">
                        <div class="col-md-12">
                            <h6 class="text-left float-right" hidden wire:model="paymentText" wire:ignore id="paymentText">Rp. -</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" onclick="resetForm();"  wire:ignore id="saveButton" class="btn btn-pink btn-sm shadow float-right ml-2 sendButton">Selesai Belanja</button>
                        </form>
                            <button type="button"  onclick="printJS('hello', 'html')" wire:ignore style="background-color: #4F58A7;color#ffffff !important;" class="btn btn-dark btn-sm shadow float-right ml-2">Print</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header btn-pink">
                    <h5 class="modal-title text-center" id="myModalLabel"><b>{{ $barang }}</b></h5>
                    <button type="button" class="close btn-pink" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                                <div class="col-md-6">
                                    <input wire:model.defer="harga" placeholder="Masukan Harga Jual Di Sini" class="form-control shadow" id="rupiah" type="text">
                                </div>
                                <div class="col-md-6">
                                    <input wire:model.defer="qtybarang" placeholder="Masukan Qty Jual Di Sini" class="form-control shadow" id="qtybarang" type="text">
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" wire:click="submitEditHarga({{ $selecttedItem }}, 'submitButtonHarga')" class="btn btn-pink">Masukan Keranjang</button>
                    </div>
                </div>
                </div>
            </div>
    </div>
    <div>
        <div class="modal fade" id="ModalQtyrefil" tabindex="-1" aria-labelledby="ModalQtyLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header btn-pink">
                <h5 class="modal-title text-center" id="ModalQtyLabel"><b>{{ $barang }}</b></h5>
                <button type="button" class="close btn-pink" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <input wire:model.defer="qtybarang" placeholder="Masukan Qty Jual Di Sini" class="form-control shadow" id="qtybaranglangsung" type="text">
                        </div>
                        <div class="col-md-12 mt-3">
                                <select id="my-select"  wire:model.defer="hargajualrefil"  class="form-control form-control-sm shadow">
                                   <option></option>
                                   <option value="{{ $satuml }}">1 Ml</option>
                                   <option value="{{ $duaratuslimapuluhml }}">250 Ml</option>
                                   <option value="{{ $limaratusml }}">500 Ml</option>
                                   <option value="{{ $satuliterml }}">1 L</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="submitEditHargaLangsung({{ $selecttedItemLangsung }}, 'submitButtonHargaLangsung')" class="btn btn-pink">Masukan Keranjang</button>
                    </div>
            </div>
            </div>
        </div>
    </div>


    {{--  print  --}}
 <div id="hello" class="printing">
        <div class="row justify-content-center text-center mt-5">
            <div   style="font-family: 'Arial';">
                    <div class="ticket" style="align-content: center; width: 185px;max-width: 185px;font-size: 12px;">
                        <p class="centered" style="text-align: center;align-content: center;font-size: 12px;margin-bottom:0px;"><b>Marhaban Perfumes</b>
                        </p>
                        <p style="text-align: center;align-content: center;font-size: 10px;margin-top:0px;">
                            <br>Jl. Pahlawan No.12,Empang Bogor
                            <br>0857-1653-3530
                            <br>parfum.dobha.com
                            <br><small><b>{{ $kode }}</b></small>
                        </p>
                    <table class="mt-3" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 170px;max-width: 170px;">
                            <thead>
                                <tr style="border-top: 1px solid black;border-bottom: 1px solid black;border-collapse: collapse;font-size: 11px;">
                                    <th class="description" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 75px;max-width: 75px;text-align: left;">Produk(Qty)</th>
                                    <th class="price" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 40px;max-width: 40px;word-break: break-all;font-size: 11px;text-align: right;">Sub</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $index=>$item)
                                <tr style="border-collapse: collapse;font-size: 11px;">
                                    <td class="description" style="border-collapse: collapse;font-size: 10px;width: 70px;max-width: 70px;">{{ $item['name'] }} ({{ $item['qty'] }})</td>
                                    <td class="price" style="border-collapse: collapse;font-size: 11px;width: 40px;max-width: 40px;word-break: break-all;font-size: 10px;text-align: right;">{{ number_format($item['price'],0) }}</td>
                                </tr>
                                @empty
                                <p class="centered" style="text-align: center;align-content: center;font-size: 10px;">TES PRINT?
                                    @endforelse
                                    {{-- total --}}
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;"><b>Total </b></td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;"><b>Rp. {{ number_format($summary['total'],0) }}</b></td>
                                    </tr>
                                    {{-- dibayar --}}
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;"><b>Bayar</b></td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;"  wire:ignore id="paymentTextBawah"></td>
                                    </tr>
                                    {{-- kembali --}}
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;">Kembali</td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;" wire:ignore id="kembalianTextBawah"><b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="centered" style="text-align: center;align-content: center;font-size: 10px;">===========================</p>
                        <p class="centered" style="text-align: center;align-content: center;font-size: 10px;">----------TERIMA KASIH------------
                            <br>SELAMAT BELANJA KEMBALI
                            <br>#dobharaisethepassion</p>
                    </div>
                </div>
        </div>
</div>
</div>
    
@push('js')
    <script>
        payment.oninput = () => {
            const paymentAmount = document.getElementById("payment").value
            const totalAmount = document.getElementById("total").value

            const kembalian = paymentAmount - totalAmount

            // console.log({paymentAmount,totalAmount,kembalian});
            document.getElementById("kembalianText").innerHTML = `Rp. ${rupiah(kembalian)}`
            document.getElementById("kembalianTextBawah").innerHTML = `Rp. ${rupiah(kembalian)}`
            document.getElementById("paymentText").innerHTML = `Rp. ${rupiah(paymentAmount)}`
            document.getElementById("paymentTextAtas").innerHTML = `Rp. ${rupiah(paymentAmount)}`
            document.getElementById("paymentTextBawah").innerHTML = `Rp. ${rupiah(paymentAmount)}`

            const saveButton = document.getElementById("saveButton")
            if(kembalian < 0){
                saveButton.disabled = true
            }else{
                saveButton.disabled = false
            }
        }

        const rupiah = (angka) =>{
            const numberString = angka.toString()
            const split = numberString.split(',')
            const sisa = split[0].length % 3
            let rupiah = split[0].substr(0, sisa)
            const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)
            if(ribuan){
                const separator = sisa ? '.' : ''
                rupiah += separator + ribuan.join('.')
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        }
    </script>

{{--  Reset Form  --}}
    <script>
        function resetForm() {
            document.getElementById("kembalianText").innerHTML = `Rp. -`
            document.getElementById("kembalianTextBawah").innerHTML = `Rp. -`
            document.getElementById("paymentText").innerHTML = `Rp. -`
            document.getElementById("paymentTextAtas").innerHTML = `Rp. -`
            document.getElementById("paymentTextBawah").innerHTML = `Rp. -`
        }
    </script>

{{--  Curenncy  --}}
    <script type="text/javascript">
        var uang = document.getElementById('rupiah');
        uang.addEventListener('keyup', function(e){
           
            uang.value = formatRupiah(this.value, 'Rp. ');
        });
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            uang             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);
    
            if(ribuan){
                separator = sisa ? '.' : '';
                uang += separator + ribuan.join('.');
            }
    
            uang = split[1] != undefined ? uang + ',' + split[1] : uang;
            return prefix == undefined ? uang : (uang ? '' + uang : '');
        }
    </script>
    <script type="text/javascript">
        var qtybarang = document.getElementById('qtybarang');
        qtybarang.addEventListener('keyup', function(e){
           
            qtybarang.value = formatRupiah(this.value, 'Rp. ');
        });
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            uang             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);
    
            if(ribuan){
                separator = sisa ? '.' : '';
                uang += separator + ribuan.join('.');
            }
    
            uang = split[1] != undefined ? uang + ',' + split[1] : uang;
            return prefix == undefined ? uang : (uang ? '' + uang : '');
        }
    </script>
    <script type="text/javascript">
        var qtybaranglangsung = document.getElementById('qtybaranglangsung');
        qtybaranglangsung.addEventListener('keyup', function(e){
        
            qtybaranglangsung.value = formatRupiah(this.value, 'Rp. ');
        });
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            uang             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

            if(ribuan){
                separator = sisa ? '.' : '';
                uang += separator + ribuan.join('.');
            }

            uang = split[1] != undefined ? uang + ',' + split[1] : uang;
            return prefix == undefined ? uang : (uang ? '' + uang : '');
        }
    </script>
    <script type="text/javascript">
        var qtyrefil = document.getElementById('qtyrefil');
        qtyrefil.addEventListener('keyup', function(e){
        
            qtyrefil.value = formatRupiah(this.value, 'Rp. ');
        });
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            uang             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

            if(ribuan){
                separator = sisa ? '.' : '';
                uang += separator + ribuan.join('.');
            }

            uang = split[1] != undefined ? uang + ',' + split[1] : uang;
            return prefix == undefined ? uang : (uang ? '' + uang : '');
        }
    </script>
@endpush