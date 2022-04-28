    <div class="col-md-12">
    <input type="hidden" name="id" value="{{ $barang->id }}" id="id_data" />
    <input type="hidden" name="kategori_id" value="{{ $barang->kategori_id }}" />
    <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" id="namabarangedit" class="form-control form-control-sm shadow" value="{{ $barang->nama_barang  }}" style="height: 28px;">
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <select id="satuanedit" class="js-states form-control" value="{{ $barang->satuan_id }}" style="width: 100%">
                @foreach ($satuan as $i)
                    <option  value="{{ $i->nama }}" {{ ($i->nama == $barang->satuan_id ? 'selected' : '') }}>{{ $i->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Supplier</label>
            <select id="supplieredit" class="js-states form-control" value="{{ $barang->supplier_id }}" style="width: 100%">
                @foreach ($supplier as $i)
                    <option value="{{ $i->nama }}" {{ ($i->nama == $barang->supplier_id ? 'selected' : '') }}>{{ $i->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Harga Beli</label>
            <input type="text" id="hargabeliedit" class="form-control form-control-sm shadow" value="{{ $barang->harga_beli == 0 ?  $barang->hb1 : $barang->harga_beli }}" style="height: 28px;">
           <small style="font-size:10px;" class="text-danger">Ini harga /{{ $barang->satuan_id }}</small>
        </div>
        <div class="form-group">
            <label>Harga Jual</label>
            <input type="text" id="hargajualedit" class="form-control form-control-sm shadow" value="{{ $barang->harga_jual == 0  ?  $barang->hj1 : $barang->harga_jual }}" style="height: 28px;">
           <small style="font-size:10px;" class="text-danger">Ini harga /{{ $barang->satuan_id }}</small>
        </div>
        <div class="form-group">
            <label>Stok / {{ $barang->satuan_id }}</label>
            <input type="text" id="stockedit" class="form-control form-control-sm shadow" value="{{ $barang->stock }}" style="height: 28px;">
        </div>
</div>


<script type="text/javascript">
    var hargajualedit = document.getElementById('hargajualedit');
    hargajualedit.addEventListener('keyup', function(e) {

        hargajualedit.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

</script>
    <script type="text/javascript">
    var hargabeliedit = document.getElementById('hargabeliedit');
    hargabeliedit.addEventListener('keyup', function(e) {

        hargabeliedit.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
</script>
<script>
    $("#satuanedit").select2({
            placeholder: "Pilih Satuan",
            allowClear: true
        });
    $("#supplieredit").select2({
            placeholder: "Pilih Satuan",
            allowClear: true
        });
</script>