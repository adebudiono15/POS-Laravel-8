<input type="hidden" name="id" value="{{ $customer->id }}" id="id_data" />
<div class="row mt-1">
    <div class="col-md-4 mt-3">
        <h6><b>KODE CUSTOMER</b></h6>
        <h6>{{ $customer->kode_customer }}</h6>
    </div>
    <div class="col-md-4 mt-3">
        <h6><b>NAMA CUSTOMER</b></h6>
        <h6>{{ $customer->nama }}</h6>
    </div>
    <div class="col-md-4 mt-3">
        <h6><b>TELEPON</b></h6>
        <h6>{{ $customer->telepon }}</h6>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4 mt-3">
        <h6><b>E-MAIL</b></h6>
        <h6>{{ $customer->email }}</h6>
    </div>
    <div class="col-md-4 mt-3">
        <h6><b>CONTACT PERSON</b></h6>
        <h6>{{ $customer->contact_person }}</h6>
    </div>
    <div class="col-md-4 mt-3">
        <h6><b>ALAMAT</b></h6>
        <h6>{{ $customer->alamat }}</h6>
    </div>
    <div class="col-md-4 mt-3">
        <h6><b>Kategori</b></h6>
        <h6>{{ $customer->kategori }}</h6>
    </div>
</div>

