<input type="hidden" name="id" value="{{ $customer->id }}" id="id_data" />
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Kode Customer</label>
            <input type="text" class="form-control form-control-sm shadow" value="{{ $customer->kode_customer }}" style="height: 28px;" readonly>
        </div>
    </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" id="namacustomeredit" class="form-control form-control-sm shadow" value="{{ $customer->nama }}" style="height: 28px;">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
              <label for="">Telp/WA</label>
                <input type="number" id="teleponcustomeredit" class="form-control form-control-sm shadow" value="{{ $customer->telepon }}" style="height: 28px;">
            </div>
        </div>
</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
              <label for="">Email</label>
                <input id="emailcustomeredit" type="email" class="form-control form-control-sm shadow" value="{{ $customer->email }}" style="height: 28px;" placeholder="{{ $customer->email != null ? $customer->email : 'Email Kosong' }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Contact Person</label>
                <input id="contactpersoncustomeredit" type="text" class="form-control form-control-sm shadow" value="{{ $customer->contact_person }}" style="height: 28px;">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Alamat</label>
                <input id="alamatcustomeredit" type="text" class="form-control form-control-sm shadow" value="{{ $customer->alamat }}" style="height: 28px;">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Kategori</label>
                <select id="kategoricustomeredit" class="js-states form-control" value="{{ $customer->kategori }}" style="width: 100%">
                    @foreach ($kategoriCustomer as $i)
                        <option value="{{ $i->id }}" {{ ($i->nama == $customer->kategori ? 'selected' : '') }}>{{ $i->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<script>
      $("#kategoricustomeredit").select2({
            placeholder: "Pilih Satuan",
            allowClear: true
        });
</script>