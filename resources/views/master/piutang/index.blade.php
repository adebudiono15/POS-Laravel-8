@extends('layouts.master')

@section('title', 'Piutang')

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
                                <table id="basic-datatables-kredit" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama</th>
                                            <th>Total</th>
                                            <th>Sisa</th>
                                            <th style="width: 300px" class="text-center">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($piutang as $e=>$item)
                                        <tr>
                                            <td>{{ $e+1 }}</td>
                                            <td>{{ $item->no_struk }}</td>
                                            <td>{{ Str::limit($item->nama_customer,10) }}</td>
                                            <td>{{ number_format($item->grand_total,0) }}</td>
                                            <td>
                                                {{ $item->sisa == 0 ? 'LUNAS' : number_format($item->sisa,0) }}
                                            </td>
                                            <td class="text-center" style="width: 300px">
                                                <a href="https://dpsalim.com/newposmp1/printpenjualan/{{ $item->id }}" target="_blank" id="{{ $item->id }}"  onclick="print(this.id)">
                                                    <Button class="btn btn-primary btn-sm mr-2 shadow" ><i class="fas fa-print mr-1"></i>PDF</Button>
                                                </a>
                                                <a href="#" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-dark btn-shadow mr-2 mt-2 mb-2 btn-detail-penjualan-kredit">
                                                    <i class="fas fa-user-alt"></i>
                                                    <span class="align-middle">DETAIL</span>
                                                </a>
                
                                                <a href="#" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-danger btn-shadow mt-2 mb-2 swal-confirm">
                                                    <form action="{{ route('delete-penjualan-kredit', $item->id) }}"
                                                        id="delete{{ $item->id }}" method="POST">
                                                        @csrf
                                                        
                                                        @method('delete')
                                                        <i data-id="{{ $item->id }}" class="fas fa-trash-alt"></i>
                                                        <span data-id="{{ $item->id }}" class="align-middle">HAPUS
                                                    </form>
                                                </a>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="custom-template" href="{{ route('transaksi-penjualan') }}">
                    <div class="custom-toggle btn">
                        <i class="fas fa-plus-circle"></i>
                    </div>
            </a>
        </div>
    </div>
    
    {{-- Edit --}}
    <div id="edit" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">EDIT DATA SUPPLIER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form class="form form-vertical" method="post" id="form-edit" enctype="multipart/form-data"
                    action="{{ route('save-supplier') }}">
                    @csrf
                    <div class="modal-body">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info btn-shadow btn-update">Update</button>
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
                    <h5 class="modal-title text-white">DETAIL DATA TRANSAKSI</h5>
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
<script >
   $(document).ready(function() {
			$('#basic-datatables').DataTable({
			});
		});
</script>
<script >
$(document).ready(function() {
        $('#basic-datatables-kredit').DataTable({
        });
    });
</script>
<script>
        // Detail penjualan kredit
        $('.btn-detail-penjualan-kredit').on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-penjualan-kredit`,
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
        })

        @if ($errors->any()) {
            $('#insert').modal('show')
        }
        @endif

        $(".swal-confirm").click(function(e) {
            id = e.target.dataset.id;
            Swal.fire({
                    title: 'YAKIN MAU HAPUS DATA?',
                    text: "Data Akan Dihapus Permanen",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'YA, HAPUS!'
                    })
                .then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire({
                        // position: 'center',
                        // icon: 'success',
                        // title: 'Data Berhasil Dihapus',
                        // showConfirmButton: false,
                        // timer: 1800
                        // })
                        $(`#delete${id}`).submit();
                    } else {
                        // swal("Data ini batal dihapus!");
                    }
                });
        });

// print
function print(id){
    $.ajax({
            url: '/newposmp1/printpenjualan/' + id,
            method: "GET",
            success: function(data) {
            },
            error: function(error) {
                console.log(error)
            }
        })
}
</script>
@endpush