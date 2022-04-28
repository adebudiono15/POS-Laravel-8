@extends('layouts.master')

@section('title', 'Kategori')

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
                                            <th>Nama</th>
                                            <th  class="text-center">Aksi</th>
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
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">TAMBAH DATA KATEGORI</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form class="form form-vertical" id="form" onSubmit="return false;">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input id="namakategori" type="text" class="form-control form-control-sm shadow" placeholder="Nama" style="height: 28px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info btn-shadow" onclick="simpan()">Simpan</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- last Insert --}}

{{-- Edit --}}
<div id="edit" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">EDIT DATA KATEGORI</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <form class="form form-vertical" id="formedit">
                <div class="modal-body">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info btn-shadow btn-update" onclick="update()">Update</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- last Edit --}}
@endsection

@push('js')
<script>
    var url = '/newposmp1/listkategori';
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
             "dom": '<"top"B><"bottom"l>frtip',
             "buttons": 
             [
                 {
                 extend: 'excel',
                     exportOptions: {
                     columns: [0,1]
                     }   
                 },
                 {
                 extend: 'print',
                     exportOptions: {
                     columns: [0,1]
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
                     data: 'nama',
                 },
                 { 
                     data: data,
                     render: function(data, type, full, meta){
                     return `
                     <div class="text-center">
                     <button class="btn btn-sm btn-success shadow" type="button" id="${data.id}" onClick="edit(this.id)"> <i class="far fa-edit mr-2"></i>EDIT</button>
                     <button class="btn btn-sm btn-danger shadow" type="button" id="${data.id}" onClick="hapus(this.id)"><i class="far fa-trash-alt mr-2"></i> HAPUS</button>
                     </div>
                     `;
                     },
                 },
             ]
         } );
         }
     })
 </script>
 <script>

$('input').keyup(function(e){
    if(e.keyCode == 13){
        simpan();
    }
});
// simpan
function simpan(){
    $.ajax({
    url: "save-kategori",
    type: "POST",
    data: {
    nama: $("#namakategori").val(),
    _token: "{{ csrf_token() }}"
    },
    success: function (data)
    {
    if (data.success) {
        $('#example').DataTable().ajax.reload(null, false);
        $('#form')[0].reset();
        tampilPesan('SUCCESS','Berhasil Menambah Data Kategori','success','center')
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
            url: `/newposmp1/${id}/edit-kategori`,
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
        url: '/newposmp1/kategori/update/' + id,
        type: "PATCH",
        data: {
            id: id,
            old: $("#old").val(),
            nama: $("#namakategoriedit").val(),
            _token: "{{ csrf_token() }}"
        },
        success: function (data) {
            if (data.success == 200) {
            $('#example').DataTable().ajax.reload(null, false);
            $('#edit').modal('hide');
            tampilPesan('SUCCESS','Berhasil Update Kategori','success','center')
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
            url: `/newposmp1/delete-kategori/${id}`,
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