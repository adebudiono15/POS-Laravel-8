<input type="text" hidden value="{{ $pembelian_langsung->id }}">
<div class="row">
    <div class="col-md-4">
     <label><b>No Invoice</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_langsung->no_struk }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Kode Supplier</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_langsung->supplier->kode_supplier }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Nama Supplier</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_langsung->supplier->nama }}" readonly>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4">
     <label><b>Metode Pembayaran</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_langsung->metode_pembayaran }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Bank</b></label>
        <input class="form-control form-control-sm shadow" value="{{ $pembelian_langsung->bank }}" readonly>
    </div>
    <div class="col-md-4">
        <label><b>Tanggal</b></label>
        <input class="form-control form-control-sm shadow" value="{{ date('d F Y', strtotime ($pembelian_langsung->created_at)) }}" readonly>
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
                    @foreach ($pembelian_langsung->lines as $e=> $item)
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
        <p class="float-right"><small>Grand Total : </small><b>Rp. {{ number_format($pembelian_langsung->grand_total,0) }}</b></p>
    </div>
</div>