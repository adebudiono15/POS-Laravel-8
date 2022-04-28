<input type="text" hidden value="{{ $pembelian_kredit->id }}">
<div class="row">
    <div class="col-md-4">
     <label><b>No Invoice</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_kredit->no_struk }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Tanggal</b></label>
        <input class="form-control form-control-sm shadow" value="{{ date('d F Y', strtotime ($pembelian_kredit->created_at)) }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Nama Supplier</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_kredit->supplier->nama }}" readonly>
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
                    @foreach ($pembelian_kredit->lines as $e=> $item)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ $item->namas->nama_barang }}</td>
                        <td>{{ number_format($item->harga_beli,0) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="float-right"><small>Grand Total : </small><b>Rp. {{ number_format($pembelian_kredit->grand_total,0) }}</b></p>
    </div>
</div>

{{--  Hutang  --}}
    {{-- last detail --}}
    @if ($pembelian_kredit->sisa < $pembelian_kredit->grand_total )
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
                        @foreach ($pembelian_kredit->riwayat as $e=> $item)
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
 @if ($pembelian_kredit->sisa > 1)

 <form id="updateform">
            <div class="row justify-content-center">
                <div class="col-md-5 text-center" style="width: 250px;">
                        <span class="stamp stamp-lg bg-danger mr-3 mb-4">
                            <small><b>SISA Rp. {{ number_format($pembelian_kredit->sisa,0) }}</b></small>
                        </span>
                        <input type="hidden" id="id_hutang" value="{{ $pembelian_kredit->id }}">
                        <input type="hidden" id="supplier" value="{{ $pembelian_kredit->supplier_id }}">
                        <input type="hidden" id="totalsisa" value="{{ $pembelian_kredit->sisa }}">
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
                    <select id="bank" class="form-control" style="width:100%;" disabled name="bank">
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
    var id = $('#id_hutang').val();
        $.ajax({
            url: '/newposmp1/update-hutang/' + id,
            type: "PATCH",
            data: {
                id: id,
                supplier: $('#supplier').val(),
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