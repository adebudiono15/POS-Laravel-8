    <input type="hidden" name="id" value="{{ $pengeluaranbank->id }}" id="id_data" />
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Kode Transaksi</b></h6>
            <h6>{{ $pengeluaranbank->kode_pengeluaran_bank }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Tanggal</b></h6>
            <h6>{{ date('d F Y', strtotime ($pengeluaranbank->tanggal)) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Atas Nama</b></h6>
            <h6>{{ $supplier->nama }}</h6>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Jenis Pendapatan</b></h6>
            <h6>{{ $pengeluaranbank->jenis_pengeluaran }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Jumlah Pendapatan</b></h6>
            <h6>{{ number_format($pengeluaranbank->jumlah_pengeluaran,0) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Bank</b></h6>
            <h6>{{ $pengeluaranbank->bank }}</h6>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Keterangan</b></h6>
            <h6>{{ $pengeluaranbank->keterangan }}</h6>
        </div>
    </div>
