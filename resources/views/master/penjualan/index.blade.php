@extends('layouts.master')

@section('title', 'Penjualan')

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
                            <div class="">
                                <form class="form form-vertical" method="get" enctype="multipart/form-data"
                                action="{{ url('penjualan-langsung/filter') }}">
                                @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="date" class="form-control form-control-sm"
                                                    name="awal" autocomplete="off"  id=""  style="height: 28px;" value="{{ $awal }}">
                                            </div>
                                        </div>
                                        <span style="margin-top: 17px;">Sampai</span>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                    <input type="date" class="form-control form-control-sm"
                                                    name="akhir" autocomplete="off"  id=""  style="height: 28px;" value="{{ $akhir }}">
                                            </div>
                                        </div>
                                         <div class="col-md">
                                             <button type="submit" class="btn btn-sm btn-primary btn-shadow" style="margin-top:12px;">Filter</button>
                                         </div>
                                    </div>
                            </form>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">History Penjualan</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills nav-danger  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                                    <li class="nav-item submenu">
                                        <a class="nav-link active show" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                            <i class="flaticon-coins"></i>
                                            Langsung/Tunai
                                        </a>
                                    </li>
                                    <li class="nav-item submenu">
                                        <a class="nav-link" id="pills-bank-tab-icon" data-toggle="pill" href="#pills-bank-icon" role="tab" aria-controls="pills-bank-icon" aria-selected="false">
                                            <i class="flaticon-credit-card"></i>
                                            Bank
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                    {{--  Penjualan Langsung  --}}
                                    <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th hidden>Kode Transaksi</th>
                                                        <th>Nama</th>
                                                        <th>Total</th>
                                                        <th>Diskon</th>
                                                        <th>Grand Total</th>
                                                        {{--  --}}
                                                        <th hidden>Total</th>
                                                        <th hidden>Diskon</th>
                                                        <th hidden>Grand Total</th>
                                                        <th hidden>Tanggal Transaksi</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($penjualan_langsung as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td hidden>{{ $item->no_struk }}</td>
                                                        <td>{{ $item->nama_customer }}</td>
                                                        <td>{{ number_format($item->total,0) }}</td>
                                                        <td>{{ number_format($item->diskon,0) }}</td>
                                                        <td>{{ number_format($item->grand_total,0) }}</td>
                                                        {{--  --}}
                                                        <td hidden>{{ $item->total }}</td>
                                                        <td hidden>{{ $item->diskon }}</td>
                                                        <td hidden>{{ $item->grand_total }}</td>
                                                        <td hidden>{{ date('d F Y', strtotime ($item->created_at)) }}</td>
                                                        <td class="text-center" style="width: 300px">
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-dark btn-shadow mr-2 mt-2 mb-2 btn-detail-penjualan-langsung">
                                                                <i class="fas fa-user-alt"></i>
                                                                <span class="align-middle">DETAIL</span>
                                                            </a>
                            
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger btn-shadow mt-2 mb-2 swal-confirm">
                                                                <form action="{{ route('delete-penjualan-langsung', $item->id) }}"
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
                                    {{-- Bank --}}
                                    <div class="tab-pane fade" id="pills-bank-icon" role="tabpanel" aria-labelledby="pills-bank-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables-bank" class="display table table-striped table-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th hidden>Kode Transaksi</th>
                                                        <th>Nama</th>
                                                        <th>Total</th>
                                                        <th>Diskon</th>
                                                        <th>Grand Total</th>
                                                        {{--  --}}
                                                        <th hidden>Total</th>
                                                        <th hidden>Diskon</th>
                                                        <th hidden>Grand Total</th>
                                                        <th>Bank</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($penjualan_bank as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td hidden>{{ $item->no_struk }}</td>
                                                        <td>{{ $item->nama_customer }}</td>
                                                        <td>{{ number_format($item->total,0) }}</td>
                                                        <td>{{ number_format($item->diskon,0) }}</td>
                                                        <td>{{ number_format($item->grand_total,0) }}</td>
                                                        {{--  --}}
                                                        <td hidden>{{ $item->total }}</td>
                                                        <td hidden>{{ $item->diskon }}</td>
                                                        <td hidden>{{ $item->grand_total }}</td>
                                                        <td>{{ $item->bank }}</td>
                                                        <td class="text-center" style="width: 300px">
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-dark btn-shadow mr-2 mt-2 mb-2 btn-detail-penjualan-langsung">
                                                                <i class="fas fa-user-alt"></i>
                                                                <span class="align-middle">DETAIL</span>
                                                            </a>
                            
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger btn-shadow mt-2 mb-2 swal-confirm">
                                                                <form action="{{ route('delete-penjualan-langsung', $item->id) }}"
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
                                    {{-- last Bank --}}
                                </div>
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
                 dom: 'Bfrtip',
                 buttons: [
                     {
                         extend: 'excel',
                         exportOptions: {
                         columns: [ 0,1,6,7,8,9]
                     }   
                     }
                 ]
             });
         });
 </script>
<script >
   $(document).ready(function() {
             $('#basic-datatables-bank').DataTable({
                 dom: 'Bfrtip',
                 buttons: [
                     {
                         extend: 'excel',
                         exportOptions: {
                         columns: [ 0,1,2,6,7,8,9]
                     }   
                     }
                 ]
             });
         });
</script>
<script>
        //Detail penjualan langsung 
        $('.btn-detail-penjualan-langsung').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/${id}/detail-penjualan-langsung`,
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

        // Detail penjualan kredit
        $('.btn-detail-penjualan-kredit').on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/${id}/detail-penjualan-kredit`,
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
                
                        $(`#delete${id}`).submit();
                    } else {
                        // swal("Data ini batal dihapus!");
                    }
                });
        });
</script>
@endpush