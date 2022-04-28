@extends('layouts.master')

@section('title', 'Pengeluaran')

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
                            <div class="card-header">
                                <h4 class="card-title">History Pengeluaran</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills nav-danger  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                                    <li class="nav-item submenu">
                                        <a class="nav-link active show" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                            <i class="flaticon-coins"></i>
                                            Pembelian
                                        </a>
                                    </li>
                                    <li class="nav-item submenu">
                                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                                            <i class="flaticon-credit-card"></i>
                                            Hutang
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                     {{--  Pembelian --}}
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Nama</th>
                                                        <th>Total</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pembelian as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td>{{ $item->no_struk }}</td>
                                                        <td>{{ Str::limit($item->supplier->nama,10) }}</td>
                                                        <td>{{ number_format($item->grand_total,0) }}</td>
                                                        <td class="text-center" style="width: 300px">
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-dark btn-shadow mr-2 mt-2 mb-2 btn-detail-pembelian-langsung">
                                                                <i class="fas fa-user-alt"></i>
                                                                <span class="align-middle">DETAIL</span>
                                                            </a>
                                                        </td>
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                                        {{--  Hutang  --}}
                                        <div class="table-responsive">
                                            <table id="basic-datatables-kredit" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Nama</th>
                                                        <th>Total</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengeluaranbank as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td>{{ Str::limit($item->kode_pengeluaran_bank,10) }}</td>
                                                        <td>{{ Str::limit($item->supplier->nama,10) }}</td>
                                                        <td>{{ number_format($item->jumlah_pengeluaran,0) }}</td>
                                                        <td class="text-center" style="width: 300px">
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-dark btn-shadow mr-2 mt-2 mb-2 btn-detail-pengeluaran-bank">
                                                                <i class="fas fa-user-alt"></i>
                                                                <span class="align-middle">DETAIL</span>
                                                            </a>
                                                        </td>
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Detail pengelauaran langsung --}}
    <div id="detailpengeluaranlangsung" class="modal fade" style="display: none;" aria-hidden="true">
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

    {{-- Detail pengeluaran bank --}}
    <div id="detailpengeluaranbank" class="modal fade" style="display: none;" aria-hidden="true">
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
    // Detail pengeluaran pembelian
     $('.btn-detail-pembelian-langsung').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-pembelian-langsung`,
                method: "GET",
                success: function(data) {
                    $('#detailpengeluaranlangsung').find('.modal-body').html(data)
                    $('#detailpengeluaranlangsung').modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })

        //Detail pengeluaran Hutang 
        $('.btn-detail-pengeluaran-bank').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-pengeluaran-bank`,
                method: "GET",
                success: function(data) {
                    // console.log(data)
                    $('#detailpengeluaranbank').find('.modal-body').html(data)
                    $('#detailpengeluaranbank').modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })

</script>
@endpush