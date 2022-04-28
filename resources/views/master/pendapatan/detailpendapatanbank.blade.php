    <input type="hidden" name="id" value="{{ $pendapatanbank->id }}" id="id_data" />
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Kode Transaksi</b></h6>
            <h6>{{ $pendapatanbank->kode_pendapatan_bank }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Tanggal</b></h6>
            <h6>{{ date('d F Y', strtotime ($pendapatanbank->tanggal)) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Atas Nama</b></h6>
            <h6>{{ $customer->nama }}</h6>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Jenis Pendapatan</b></h6>
            <h6>{{ $pendapatanbank->jenis_pendapatan }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Jumlah Pendapatan</b></h6>
            <h6>{{ number_format($pendapatanbank->jumlah_pendapatan,0) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Bank</b></h6>
            <h6>{{ $pendapatanbank->bank }}</h6>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Keterangan</b></h6>
            <h6>{{ $pendapatanbank->keterangan }}</h6>
        </div>
    </div>
