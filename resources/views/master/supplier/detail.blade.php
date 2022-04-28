    <input type="hidden" name="id" value="{{ $supplier->id }}" id="id_data" />
    <div class="row mt-1">
        <div class="col-md-4 mt-3">
            <h6><b>KODE SUPPLIER</b></h6>
            <h6>{{ $supplier->kode_supplier }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>NAMA SUPPLIER</b></h6>
            <h6>{{ $supplier->nama }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>TELEPON</b></h6>
            <h6>{{ $supplier->telepon }}</h6>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4 mt-3">
            <h6><b>E-MAIL</b></h6>
            <h6>{{ $supplier->email }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>CONTACT PERSON</b></h6>
            <h6>{{ $supplier->contact_person }}</h6>
        </div>
        <div class="col-md-4 mt-3">
            <h6><b>ALAMAT</b></h6>
            <h6>{{ $supplier->alamat }}</h6>
        </div>
    </div>

   