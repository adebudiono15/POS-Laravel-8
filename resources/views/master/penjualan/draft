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
                        <td>{{ number_format($item->harga,0) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="float-right"><small>Grand Total : </small><b>Rp. {{ number_format($penjualan_kredit->grand_total,0) }}</b></p>
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
@endif

 {{-- last riwayat --}}
 <hr>
 <hr>
 {{-- bayar --}}
 @if ($penjualan_kredit->sisa > 1)

 <form action="{{ url('/update-piutang/'.$penjualan_kredit->id) }}" method="post">
    @csrf
    {{ method_field('PUT') }}
            <div class="row justify-content-center">
                <div class="col-md-5 text-center" style="width: 250px;">
                        <span class="stamp stamp-lg bg-danger mr-3 mb-4">
                            <small><b>SISA Rp. {{ number_format($penjualan_kredit->sisa,0) }}</b></small>
                        </span>
                        <input type="hidden" name="id_piutang" value="{{ $penjualan_kredit->id }}">
                        <input type="hidden" name="customer" value="{{ $penjualan_kredit->customer_id }}">
                        <input type="hidden" name="total_sisa" value="{{ $penjualan_kredit->sisa }}">

                        <label for="bayar" @error('bayar') class="text-danger" @enderror>@error('bayar')
                            | {{ $message }}
                            @enderror</label>
                        <input type="text" class="form-control form-control-sm" id="rupiah" name="bayar">
                        <div class="form-group mt-3">
                            <label for="metode" @error('metode') class="text-danger" @enderror>@error('metode')
                                | {{ $message }}
                                @enderror</label>
                            <select id="metode" class="metode form-control" style="width: 100%" name="metode">
                            <option value="" selected></option>
                             <option value="Cash">Cash</option>
                             <option value="Giro">Giro</option>
                             <option value="Pot. Nota">Pot. Nota</option>
                             <option value="Transfer">Transfer</option>
                             </select>
                         </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-4 text-center" style="width: 250px;">
                    <div class="Giro box">
                        <select id="girobank" class="girobank form-control" style="width: 100%" name="girobank">
                            <option value=""></option>
                            @foreach ($bank as $item)
                                <option value="{{ $item->nama_bank }}">{{ $item->nama_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-md-4 text-center" style="width: 250px;">
                    <div class="Transfer box">
                        <select id="transferbank" class="transferbank form-control" style="width: 100%" name="transferbank">
                            <option value=""></option>
                            @foreach ($bank as $item)
                                <option value="{{ $item->nama_bank }}">{{ $item->nama_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-0">
                <div class="col-md-4 text-center">
                    <button type="submit" class="btn btn-sm btn-info mt-4 shadow"  style="height:28px">
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
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>

<script>
    $("#metode").select2({
        placeholder: "Pilih Metode Pembayaran",
        allowClear: true
    });
    $("#girobank").select2({
        placeholder: "Pilih Bank",
        allowClear: true
    });
    $("#transferbank").select2({
        placeholder: "Pilih Bank",
        allowClear: true
    });
</script>