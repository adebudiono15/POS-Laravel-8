@extends('layouts.master')

@section('title', 'Barang')

@section('content')
    <div class="content">
        <div class="panel-header bg-danger-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2 justify-content-center">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th >Harga Beli</th>
                                            <th style="width: 200px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-template">
        <div class="custom-toggle" href="#insert" data-toggle="modal">
            <i class="fas fa-plus-circle"></i>
        </div>
</div>

    {{-- Insert --}}
    <div id="insert" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">TAMBAH DATA BARANG</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form id="form" action="javascript:void(0);">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control form-control-sm shadow" id="namabarang" placeholder="Nama Barang"
                                        style="height: 28px;">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select id="satuan" class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($satuan as $item)
                                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select id="kategori" class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select id="supplier"  class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">HARGA BELI</label>
                                  <input type="text" id="hargabeli" class="form-control form-control-sm shadow" placeholder="-" >
                                  <small style="font-size:10px;" class="text-danger">Masukan harga /1 ml jika kategori Refil Parfum</small>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">HARGA JUAL</label>
                                    <input type="text" id="hargajual" class="form-control form-control-sm shadow" placeholder="-" >
                                    <small style="font-size:10px;" class="text-danger">Masukan harga /1 ml jika kategori Refil Parfum</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label for="">Stok</label>
                                  <input type="text" id="stok" class="form-control form-control-sm shadow" placeholder="-" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info btn-shadow" onclick="simpan()">Simpan</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    {{-- last Insert --}}

    {{-- Edit --}}
    <div id="edit" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">EDIT DATA BARANG</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info btn-shadow" onclick="update()">Update</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
            </div>
        </div>
    </div>
    {{-- last Edit --}}
@endsection

@push('js')
    <script type="text/javascript">
        var hargabeli = document.getElementById('hargabeli');
        hargabeli.addEventListener('keyup', function(e) {

            hargabeli.value = formatRupiah(this.value, 'Rp. ');
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
        var hargajual = document.getElementById('hargajual');
        hargajual.addEventListener('keyup', function(e) {

            hargajual.value = formatRupiah(this.value, 'Rp. ');
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
        var stock = document.getElementById('stock');
        stock.addEventListener('keyup', function(e) {

            stock.value = formatRupiah(this.value, 'Rp. ');
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
        $("#supplier").select2({
            placeholder: "Pilih Supplier",
            allowClear: true
        });
        $("#satuan").select2({
            placeholder: "Pilih Satuan",
            allowClear: true
        });
        $("#kategori").select2({
            placeholder: "Pilih Kategori",
            allowClear: true
        });

    </script>
    <script>
        var url = '/listbarang';
        $.ajax({
        type:'get',
        dataType: 'json',
        url:url,
        success : function(data){   
        var table =  $('#example').DataTable( {
                "ajax": url,
                "processing": true,
                "serverSide": false,
                "responsive": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                // "dom": 'Bflrtip',
                "dom": '<"top"B><"bottom"l>frtip',
                "buttons": 
                [
                    {
                    extend: 'excel',
                        exportOptions: {
                        columns: [0,1,2,3,4,5]
                        }   
                    },
                    {
                    extend: 'print',
                        exportOptions: {
                        columns: [0,1,2,3,4]
                        }   
                    }
                ],
                "columns": [
                    { 
                        "data": null,"sortable": false, 
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { 
                        data: 'nama_barang',
                        },
                    { 
                        data: 'kategori_id',
                        },
                    { 
                        data: 'stock',
                    },
                    { 
                        data: 'satuan_id',
                    },
                    { 
                        data: data,
                        render: function(data, type, full, meta){
                        return `
                        ${data.hb1 === 0 ? data.harga_beli : data.hb1}
                        `;
                        },
                        },
                    { 
                        data: data,
                        render: function(data, type, full, meta){
                        return `
                        <button class="btn btn-sm btn-success mt-2 shadow" type="button" id="${data.id}" onClick="edit(this.id)"> <i class="far fa-edit mr-2"></i>EDIT</button>
                        <button class="btn btn-sm btn-danger mt-2 shadow" type="button" id="${data.id}" onClick="hapus(this.id)"><i class="far fa-trash-alt mr-2"></i> HAPUS</button>
                        `;
                        },
                        },
                ]
            } );
            }
        })
    </script>
<script>
    // method save data
    $('input').keyup(function(e){
    if(e.keyCode == 13){
        simpan();
    }
});
    function simpan() {
        $.ajax({
            url: "save-barang",
            type: "POST",
            data: {
                nama: $("#namabarang").val(),
                satuan: $("#satuan").val(),
                kategori: $("#kategori").val(),
                supplier: $("#supplier").val(),
                harga_beli: $("#hargabeli").val(),
                harga_jual: $("#hargajual").val(),
                stock: $("#stok").val(),
                _token: "{{ csrf_token() }}"
            },
            success: function (data)
            {
                if (data.success) {
                    $('#example').DataTable().ajax.reload(null, false);
                    tampilPesan('SUCCESS','Berhasil Menambah Data Barang','success','center')
                    $('#insert').modal('hide');
                    $('#form')[0].reset();
                    $('#satuan').val('').trigger("change");
                    $('#kategori').val('').trigger("change");
                    $('#supplier').val('').trigger("change");
                } else {
                    tampilPesan('FAILED',data.error[0],'error','center')
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(errorThrown);
            }
        });
    }
    // edit
    function edit(id){
        $.ajax({
            url: `/${id}/edit-barang`,
            method: "GET",
            success: function(data) {
                $('#edit').find('.modal-body').html(data)
                $('#edit').modal('show')
            },
            error: function(error) {
                console.log(error)
            }
        })
    }
    // update
    function update(){
    var id = $('#id_data').val();
    $.ajax({
            url: '/barang/update/' + id,
            type: "PATCH",
            data: {
                id: id,
                nama_barang: $("#namabarangedit").val(),
                harga_jual: $("#hargajualedit").val(),
                harga_beli: $("#hargabeliedit").val(),
                stock: $("#stockedit").val(),
                satuan: $("#satuanedit").val(),
                supplier: $("#supplieredit").val(),
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                $('#example').DataTable().ajax.reload(null, false);
                $('#edit').modal('hide');
                tampilPesan('SUCCESS','Berhasil Update Data Barang','success','center')
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(errorThrown);
            }
        });
    }
    // hapus
    function hapus(id){
    Swal.fire({
        title: 'Apa Kamu Yakin?',
        text: "Data akan dihapus permanent!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, hapus data ini!',
        cancelButtonText: 'Batal',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: `/delete-barang/${id}`,
            method: "DELETE",
            data: {
            "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.success == 200) {
                $('#example').DataTable().ajax.reload(null, false);
                }
                tampilPesan('FAILED',data.error[0],'warning','center')
            },
            error: function(error) {
                console.log(error)
            }
        })
            Swal.fire(
            'Terhapus!',
            'Data berhasil dihapus.',
            'success'
            )
        }
        })
}
</script>
@endpush
