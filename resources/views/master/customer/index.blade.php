@extends('layouts.master')

@section('title', 'Customer')

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
                                            <th>No</th>
                                            <th hidden>Kode Cusomer</th>
                                            <th>Nama</th>
                                            <th>Contact Person</th>
                                            <th>Telp/WA</th>
                                            <th hidden>Alamat</th>
                                            <th  class="text-center">Aksi</th>
                                            <th hidden>No</th>
                                            <th hidden>Kode Cusomer</th>
                                            <th hidden>Nama</th>
                                            <th hidden>Contact Person</th>
                                            <th hidden>Telp/WA</th>
                                            <th hidden>Alamat</th>
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
                    <h5 class="modal-title text-white">TAMBAH DATA CUSTOMER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form class="form form-vertical" id="form" onSubmit="return false;" action="javascript:void(0);">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input id="namacustomer" type="text" class="form-control form-control-sm shadow" placeholder="Type Name" style="height: 28px;">
                                </div>
                            </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Telp/WA</label>
                                        <input type="number" id="teleponcustomer" class="form-control form-control-sm shadow"  placeholder="62838xxxx" style="height: 28px;">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" id="emailcustomer" class="form-control form-control-sm shadow" placeholder="Type Email" style="height: 28px;">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Contact Person</label>
                                    <input id="contactpersoncustomer" placeholder="Type Name Contact Person" type="text" class="form-control form-control-sm shadow" style="height: 28px;">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" id="alamatcustomer" class="form-control form-control-sm shadow" placeholder="Type Address" style="height: 28px;">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select id="kategori"  class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($kategoriCustomer as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info" onclick="simpan()">Simpan</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- last Insert --}}

    {{-- Edit --}}
    <div id="edit" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">EDIT DATA CUSTOMER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form class="form form-vertical" id="formedit">
                    <div class="modal-body">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info btn-shadow" onclick="update()">Update</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- last Edit --}}

    {{-- Detail --}}
    <div id="detail" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">DETAIL DATA CUSTOMER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                    <div class="modal-body">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Tutup</button>
                    </div>
            </div>
        </div>
    </div>
    {{-- last Detail --}}
@endsection

@push('js')
<script>
    var url = '/listcustomer';
    $.ajax({
    type:'get',
    dataType: 'json',
    url:url,
    success : function(data){   
    function limit (string = '', limit = 0) {  
        return string.substring(0, limit)
    }
    var table =  $('#example').DataTable( {
            "ajax": url,
            "processing": true,
            "serverSide": false,
            "responsive": true,
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100],
            "dom": '<"top"B><"bottom"l>frtip',
            "buttons": 
            [
                {
                extend: 'excel',
                    exportOptions: {
                    columns: [7,8,9,10,11,12]
                    }   
                },
                {
                extend: 'print',
                    exportOptions: {
                    columns: [7,8,9,10,11,12]
                    }   
                }
            ],
            "columnDefs": [
                        {
                            "targets": [ 1,5,7,8,9,10,11,12 ],
                            "visible": false,
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
                    data: data,
                    render: function (data, type, row, meta) {
                    return `${limit(data.kode_customer,10)}...`
                    }  
                },
                { 
                    data: 'nama'
                },
                { 
                    data:'contact_person'
                },
                { 
                    data: 'telepon',
                },
                { 
                    data: data,
                    render: function (data, type, row, meta) {
                    return `${limit(data.alamat,10)}...`
                    }  
                },
                { 
                    data: data,
                    render: function(data, type, full, meta){
                    return `
                    <div class="text-center">
                    <button class="btn btn-sm btn-secondary shadow" type="button" id="${data.id}" onClick="detail(this.id)"> <i class="far fa-user mr-2"></i>DETAIL</button>
                    <button class="btn btn-sm btn-success shadow" type="button" id="${data.id}" onClick="edit(this.id)"> <i class="far fa-edit mr-2"></i>EDIT</button>
                    <button class="btn btn-sm btn-danger shadow" type="button" id="${data.id}" onClick="hapus(this.id)"><i class="far fa-trash-alt mr-2"></i> HAPUS</button>
                    </div>
                    `;
                    },
                },
                { 
                    "data": null,"sortable": false, 
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {
                    data: 'kode_customer',
                },
                {
                    data: 'nama',
                },
                {
                    data: 'contact_person',
                },
                {
                    data: 'telepon',
                },
                {
                    data: 'alamat',
                },
            ]
        } );
        }
    })
</script>
<script>
      $("#kategori").select2({
            placeholder: "Pilih Kategori",
            allowClear: true
        });
</script>
<script>
    // simpan
    $('input').keyup(function(e){
    if(e.keyCode == 13){
        simpan();
    }
});
  function simpan() {
        $.ajax({
            url: "save-customer",
            type: "POST",
            data: {
                nama: $("#namacustomer").val(),
                email: $("#emailcustomer").val(),
                telepon: $("#teleponcustomer").val(),
                contact_person: $("#contactpersoncustomer").val(),
                alamat: $("#alamatcustomer").val(),
                kategori: $("#kategori").val(),
                _token: "{{ csrf_token() }}"
            },
            success: function (data)
            {
                if (data.success) {
                    $('#example').DataTable().ajax.reload(null, false);
                    $('#form')[0].reset();
                    tampilPesan('SUCCESS','Berhasil Menambah Data Customer','success','center')
                    $('#insert').modal('hide');
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
            url: `/${id}/edit-customer`,
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
            url: '/customer/update/' + id,
            type: "PATCH",
            data: {
                id: id,
                nama: $("#namacustomeredit").val(),
                email: $("#emailcustomeredit").val(),
                telepon: $("#teleponcustomeredit").val(),
                contact_person: $("#contactpersoncustomeredit").val(),
                alamat: $("#alamatcustomeredit").val(),
                kategori: $("#kategoricustomeredit").val(),
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.success == 200) {
                $('#example').DataTable().ajax.reload(null, false);
                $('#edit').modal('hide');
                tampilPesan('SUCCESS','Berhasil Update Customer','success','center')
                }
                $('#edit').modal('show');
                tampilPesan('FAILED',data.error[0],'warning','center')
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(errorThrown);
            }
        });
    }
    // detail
    function detail(id){
            $.ajax({
            url: `/${id}/detail-customer`,
            method: "GET",
            success: function(data) {
                // console.log(data)
                $('#detail').find('.modal-body').html(data)
                $('#detail').modal('show')
            },
            error: function(error) {
                console.log(error)
            }
        })
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
            url: `/delete-customer/${id}`,
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