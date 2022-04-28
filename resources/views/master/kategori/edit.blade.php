    <input type="hidden" name="id" value="{{ $kategori->id }}" id="id_data" />
    <input type="hidden" value="{{ $kategori->nama }}" id="old" />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" id="namakategoriedit" class="form-control form-control-sm shadow" value="{{ $kategori->nama }}" style="height: 28px;">
            </div>
        </div>
    </div>