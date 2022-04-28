    <input type="hidden" name="id" value="{{ $supplier->id }}" id="id_data" />
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Kode Supplier</label>
                <input type="text" class="form-control form-control-sm shadow" value="{{ $supplier->kode_supplier }}" style="height: 28px;" readonly>
            </div>
        </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input id="namasupplieredit" type="text" class="form-control form-control-sm shadow" value="{{ $supplier->nama }}" style="height: 28px;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Telp/WA</label>
                    <input id="teleponsupplieredit" type="number" class="form-control form-control-sm shadow" value="{{ $supplier->telepon }}" style="height: 28px;">
                </div>
            </div>
</div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input id="emailsupplieredit" type="email" class="form-control form-control-sm shadow" value="{{ $supplier->email }}" style="height: 28px;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                   <label for="">Contact Person</label>
                    <input id="contactpersonsupplieredit" type="text" class="form-control form-control-sm shadow" value="{{ $supplier->contact_person }}" style="height: 28px;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input id="alamatsupplieredit" type="text" class="form-control form-control-sm shadow" value="{{ $supplier->alamat }}" style="height: 28px;">
                </div>
            </div>
        </div>
    </div>