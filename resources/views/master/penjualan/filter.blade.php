@extends('layouts.master')

@section('title', 'Filter Penjualan')

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
                                <p>Filter Penjualan Dari <span class="badge badge-primary">{{ date('d-m-Y', strtotime($awal)) }}</span> Sampai <span class="badge badge-primary">{{ date('d-m-Y', strtotime($akhir)) }}</span></p>
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
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($penjualan_langsung as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td hidden>{{ $item->no_struk }}</td>
                                                        <td>{{ $item->nama_customer }}</td>
                                                        <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
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
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-right" colspan="2">Grand Total : </th>
                                                        <td class="text-right"><b>Rp. {{ number_format($total_penjualan_langsung,0) }}</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- Bank --}}
                                    <div class="tab-pane fade" id="pills-bank-icon" role="tabpanel" aria-labelledby="pills-bank-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables-kredit" class="display table table-striped table-hover" style="width:100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th hidden>Kode Transaksi</th>
                                                        <th>Nama</th>
                                                        <th>Total</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($penjualan_bank as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td hidden>{{ $item->no_struk }}</td>
                                                        <td>{{ $item->nama_customer }}</td>
                                                        <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
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
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-right" colspan="2">Grand Total : </th>
                                                        <td class="text-right"><b>Rp. {{ number_format($total_penjualan_kredit,0) }}</b></td>
                                                    </tr>
                                                </tfoot>
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
<script>
    $(document).ready(function() {
        $('#basic-datatables-kredit').DataTable({
        });
    });
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });
    });
         //Detail penjualan langsung 
         $('.btn-detail-penjualan-langsung').on('click', function() {
        let id = $(this).data('id')
        $.ajax({
            url: `/newposmp1/${id}/detail-penjualan-langsung`,
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
</script>
@endpush