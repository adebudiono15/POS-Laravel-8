    <input type="hidden" name="id" value="{{ $kategoriCustomer->id }}" id="id_data" />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" id="namakategoricustomeredit" class="form-control form-control-sm shadow" value="{{ $kategoriCustomer->nama }}" style="height: 28px;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="number" id="diskonkategoricustomeredit" class="form-control form-control-sm shadow" value="{{ $kategoriCustomer->diskon }}" style="height: 28px;">
            </div>
        </div>
    </div>