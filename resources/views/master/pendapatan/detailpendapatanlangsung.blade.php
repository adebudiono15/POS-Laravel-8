    <input type="hidden" name="id" value="{{ $pendapatanlangsung->id }}" id="id_data" />
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Kode Transaksi</b></h6>
            <h6>{{ $pendapatanlangsung->kode_pendapatan_tunai }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Tanggal</b></h6>
            <h6>{{ date('d F Y', strtotime ($pendapatanlangsung->tanggal)) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Atas Nama</b></h6>
            <h6>{{ $customer->nama }}</h6>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>Jenis Pendapatan</b></h6>
            <h6>{{ $pendapatanlangsung->jenis_pendapatan }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Jumlah Pendapatan</b></h6>
            <h6>{{ number_format($pendapatanlangsung->jumlah_pendapatan,0) }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>Keterangan</b></h6>
            <h6>{{ $pendapatanlangsung->keterangan }}</h6>
        </div>
    </div>
