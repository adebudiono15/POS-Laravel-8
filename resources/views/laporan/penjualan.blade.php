@extends('layouts.master')

@section('title', 'Laporan Penjualan')

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
                            <table id="basic-datatables" class="display table table-hover" >
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Barang</th>
                                        <th>Satuan</th>
                                        <th>Modal</th>
                                        <th>Jual</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan_langsung as $e=> $item)
                                    <tr>
                                        <td>{{ $e+1 }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->namas->nama_barang }}</td>
                                        <td>{{ $item->satuan_id }}</td>
                                        <td>{{ number_format($item->harga_beli,0) }}</td>
                                        <td>{{ number_format($item->harga_jual,0) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->grand_total,0) }}</td>
                                        <td>{{ $item->harga_jual - $item->harga_beli }}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                         columns: [ 0,1,2,3,4,5,6,7,8]
                     }   
                     }
                 ]
             });
         });
 </script>
@endpush