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
<input type="text" hidden value="{{ $penjualan_kredit->id }}">
<div class="row">
    <div class="col-md-4">
     <label><b>No Invoice</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $penjualan_kredit->no_struk }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Tanggal</b></label>
        <input class="form-control form-control-sm shadow" value="{{ date('d F Y', strtotime ($penjualan_kredit->created_at)) }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Nama Customer</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $penjualan_kredit->nama_customer }}" readonly>
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-12 mt-3">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-hover" >
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan_kredit->lines as $e=> $item)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ $item->namas->nama_barang }}</td>
                        <td>{{ number_format($item->harga_jual,0) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
                    </tr> 
                    @endforeach
                    <tr  class="text-right" >
                        <td colspan="4"><b>Grand Total:</b></td>
                        <td colspan="1">Rp. {{ number_format($penjualan_kredit->grand_total,0) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{--  Piutang  --}}
    {{-- last detail --}}
    @if ($penjualan_kredit->sisa < $penjualan_kredit->grand_total )
    <hr>
    <hr>
    {{-- riwayat --}}
    <div class="row mt-5">
        <div class="col-md-12  text-center">
            <h5><b>RIWAYAT TRANSAKSI PEMBAYARAN</b></h5> 
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>No</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan_kredit->riwayat as $e=> $item)
                        <tr>
                            <td>
                               {{ $e+1 }}
                            </td>
                            <td>
                               Rp. {{ number_format($item->total_pembayaran,0) }}
                            </td>
                            <td>
                                {{ date('d F Y ', strtotime ($item->created_at)) }}
                            </td>
                            <td>
                                {{ $item->metode }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right">
            <Button class="btn btn-primary btn-sm mr-2 shadow" onclick="printJS('hello', 'html')"><i class="fas fa-print mr-1"></i>PRINT</Button>
        </div>
    </div>

    {{-- Print --}}
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
                            <br><small><b>{{ $penjualan_kredit->no_struk }}</b></small>
                        </p>
                    <table class="mt-3" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 170px;max-width: 170px;">
                            <thead>
                                <tr style="border-top: 1px solid black;border-bottom: 1px solid black;border-collapse: collapse;font-size: 11px;">
                                    <th class="description" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 75px;max-width: 75px;text-align: left;">Produk(Qty)</th>
                                    <th class="price" style="border-top: 1px solid black;border-collapse: collapse;font-size: 11px;width: 40px;max-width: 40px;word-break: break-all;font-size: 11px;text-align: right;">Sub</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($penjualan_kredit->lines as $e=> $item)
                                        <tr style="border-collapse: collapse;font-size: 11px;">
                                            <td class="description" style="border-collapse: collapse;font-size: 10px;width: 70px;max-width: 70px;">{{ $item->namas->nama_barang }} ({{ $item->qty }})</td>
                                            <td class="price" style="border-collapse: collapse;font-size: 11px;width: 40px;max-width: 40px;word-break: break-all;font-size: 10px;text-align: right;">{{ number_format($item->harga,0) }}</td>
                                        </tr>
                                    @endforeach
                                    {{-- total --}}
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;"><b>Total </b></td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;"><b>{{ number_format($penjualan_kredit->grand_total,0) }} </b></td>
                                    </tr>
                                    {{-- riwayat ambyar --}}
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;"><b>Riwayat Bayar :</b></td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;"></td>
                                    </tr>
                                    @foreach ($penjualan_kredit->riwayat as $e=> $item)
                                    <tr style="border-collapse: collapse;font-size: 11px;">
                                        <td class="description" style="border-collapse: collapse;font-size: 10px;width: 70px;max-width: 70px;">{{ number_format($item->total_pembayaran,0) }} ({{ date('d/m/y ', strtotime ($item->created_at)) }})</td>
                                        <td class="price" style="border-collapse: collapse;font-size: 11px;width: 40px;max-width: 40px;word-break: break-all;font-size: 10px;text-align: right;">{{ $item->metode }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="1" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:left;"><b>Tersisa : </b></td>
                                        <td colspan="2" style="border-top: 1px solid black;border-collapse:  collapse;font-size: 10px;text-align:right;"><b>{{ number_format($penjualan_kredit->sisa,0) }}</b></td>
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
    {{-- Last Print --}}
@endif

 {{-- last riwayat --}}
 <hr>
 <hr>
 {{-- bayar --}}
 @if ($penjualan_kredit->sisa > 1)
 <form id="formupdate">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center" style="width: 250px;">
                <span class="stamp stamp-lg bg-danger mr-3 mb-4">
                    <small><b>SISA Rp. {{ number_format($penjualan_kredit->sisa,0) }}</b></small>
                </span>
                <input type="hidden" id="id_piutang" value="{{ $penjualan_kredit->id }}">
                <input type="hidden" id="customer" value="{{ $penjualan_kredit->customer_id }}">
                <input type="hidden" id="total_sisa" value="{{ $penjualan_kredit->sisa }}">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <input type="text" placeholder="Masukan Pembayaran" class="form-control form-control-sm bayar" id="rupiah">
        </div>
        <div class="col-lg-4">
            <select id="metode" class="form-control" style="width:100%;" onchange="changeMethod()">
                <option value=""></option>
                <option value="Cash">Cash</option>
                <option value="Debit">Debit</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>
        <div class="col-lg-4">
            <select id="bank" class="form-control" style="width:100%;"disabled >
                <option></option>
                @foreach ($bank as $i)
                <option value="{{ $i->nama_bank }}">{{ $i->nama_bank }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row justify-content-center mb-0">
        <div class="col-md-4 text-center">
            <button type="button" class="btn btn-sm btn-info mt-4 shadow"  style="height:28px" onclick="update()">
                <i class="far fa-edit"></i> Update Data Sisa
            </button>
        </div>
    </div>
</form>
 @endif


 <script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
    
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa             = split[0].length % 3,
        rupiah             = split[0].substr(0, sisa),
        ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
</script>
<script>
    $("#metode").select2({
        placeholder: "Pilih Metode Pembayaran",
        allowClear: true
    });
    $("#bank").select2({
        placeholder: "Pilih Bank",
        allowClear: true
    });
</script>
<script>
    // method
    function changeMethod(){
        var metode = $('#metode').val();
        document.getElementById("bank").setAttribute("disabled", "disabled");
        if (metode != 'Cash' ) {
            document.getElementById("bank").removeAttribute("disabled");
        }
        if (metode == 'Cash' ) {
            $('#bank').val('').trigger("change");
        }
    }
    // update
    function update(){
        var id = $('#id_piutang').val();
        $.ajax({
            url: '/newposmp1/update-piutang/' + id,
            type: "PATCH",
            data: {
                id: id,
                customer: $('#customer').val(),
                bayar: $('.bayar').val(),
                metode: $('#metode').val(),
                bank: $('#bank').val(),
                total_sisa: $('#totalsisa').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.success == 200) {
                    $('#detail').modal('hide');
                    location.reload();
                }else{
                tampilPesan('FAILED',data.status,'warning','center')
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(errorThrown);
            }
        });
    }
</script>

