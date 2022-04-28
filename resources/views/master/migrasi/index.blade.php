@extends('layouts.master')

@section('title', 'Migrasi')

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
                                <h4 class="card-title">Menu Migrasi</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills nav-danger  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                                   {{-- Migrasi harian --}}
                                    <li class="nav-item submenu">
                                        <a class="nav-link active show" id="pills-home-tab-icon" data-toggle="pill" href="#migrasiharian" role="tab" aria-controls="migrasiharian" aria-selected="true">
                                            <i class="flaticon-presentation"></i>
                                            Laporan Migrasi/Hari
                                        </a>
                                    </li>
                                    {{-- Migrasi Masuk --}}
                                    @if (!$responsemigrasimasuk)
                                    <li class="nav-item submenu">
                                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#migrasimasuk" role="tab" aria-controls="migrasimasuk" aria-selected="false">
                                            <i class="flaticon-inbox"></i>
                                            Migrasi Masuk
                                        </a>
                                    </li>
                                    @else
                                    <li class="nav-item submenu">
                                        <a class="nav-link" style="background:#BD1616; color:#fff;" id="pills-profile-tab-icon" data-toggle="pill" href="#migrasimasuk" role="tab" aria-controls="migrasimasuk" aria-selected="false">
                                            <i class="flaticon-inbox"></i>
                                            Migrasi Masuk
                                        </a>
                                    </li>
                                    @endif
                                    {{-- Migrasi Keluar --}}
                                    <li class="nav-item submenu">
                                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#migrasikeluar" role="tab" aria-controls="migrasikeluar" aria-selected="false">
                                            <i class="flaticon-archive"></i>
                                            Migrasi Keluar
                                        </a>
                                    </li>
                                </ul>


                                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                    {{-- Migrasi Harian --}}
                                    <div class="tab-pane fade active show" id="migrasiharian" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables-migrasi-harian" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Permohonan Ke Divisi</th>
                                                        <th>Barang</th>
                                                        <th>Qty</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($response as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td>{{ $item->ke }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                       @if ($item->status === 0)
                                                         <td>Pending</td>
                                                         @endif
                                                         @if($item->status === 1)
                                                         <td>Disetujui</td>
                                                         @endif
                                                         @if($item->status === 2)
                                                         <td>Tidak Disetujui</td>
                                                         @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--  Migrasi masuk  --}}
                                    <div class="tab-pane fade" id="migrasimasuk" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables-migrasi-masuk" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Tanggal</th>
                                                        <th>Permohonan Dari Divisi</th>
                                                        <th>Barang</th>
                                                        <th>Qty</th>
                                                        <th style="width: 300px" class="text-center">AKSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($responsemigrasimasuk as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td>{{ date('d F Y', strtotime ($item->created_at)) }}</td>
                                                        <td>{{ $item->dari }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        @if ($item->status === 0)
                                                        <td class="text-center" style="width: 300px">
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-success btn-shadow mt-2 mb-2 swal-confirm">
                                                                <form action="{{ route('updatesetuju', $item->id) }}"
                                                                    id="put{{ $item->id }}" method="POST">
                                                                    @csrf
                                                                    
                                                                    @method('put')
                                                                    <i data-id="{{ $item->id }}" class="fas fa-check"></i>
                                                                    <span data-id="{{ $item->id }}" class="align-middle">SETUJU
                                                                </form>
                                                            </a>
                                                            {{-- Tolak --}}
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger btn-shadow mt-2 mb-2 swal-confirm">
                                                                <form action="{{ route('updatesetuju', $item->id) }}"
                                                                    id="put{{ $item->id }}" method="POST">
                                                                    @csrf
                                                                    
                                                                    @method('put')
                                                                    <i data-id="{{ $item->id }}" class="fas fa-times"></i>
                                                                    <span data-id="{{ $item->id }}" class="align-middle">TOLAK
                                                                </form>
                                                            </a>
                                                        </td>
                                                        @endif
                                                        @if ($item->status === 1)
                                                         <td>Belum Disetujui</td>
                                                         @endif
                                                         @if($item->status === 2)
                                                         <td>Telah Disetujui</td>
                                                         @endif
                                                         @if($item->status === 3)
                                                         <td>Tidak Disetujui</td>
                                                         @endif
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        </p>
                                    </div>

                                    {{-- Migrasi Keluar --}}
                                    <div class="tab-pane fade" id="migrasikeluar" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                                        <div class="table-responsive">
                                            <table id="basic-datatables-migrasi-keluar" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Tanggal</th>
                                                        <th>Permohonan Dari Divisi</th>
                                                        <th>Barang</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($responsemigrasikeluar as $e=>$item)
                                                    <tr>
                                                        <td>{{ $e+1 }}</td>
                                                        <td>{{ date('d F Y', strtotime ($item->created_at)) }}</td>
                                                        <td>{{ $item->dari }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->qty }}</td>
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

    <div class="custom-template">
        <div class="custom-toggle" href="#insert" data-toggle="modal">
            <i class="fas fa-plus-circle"></i>
        </div>
</div>

{{-- Insert langsung --}}
<div id="insert" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">TAMBAH DATA MIGRASI</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <input type="hidden" name="grand_total" value="0">
            <form class="form form-vertical" method="post" enctype="multipart/form-data"
                action="{{ route('save-migrasi') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="divisi" @error('divisi') class="text-danger" @enderror>DIVISI @error('divisi')
                                    | {{ $message }}
                                    @enderror</label>
                                    <select id="divisi" name="divisi" class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($divisi as $item)
                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
               
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><b>NAMA</b></th>
                                            <th class="text-left"><b>QTY</b></th>
                                            <th><b>AKSI</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="produk">
        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="barang" @error('barang') class="text-danger" @enderror>Pilih Item Untuk Tambah Barang @error('barang')
                                            | {{ $message }}
                                            @enderror</label>
                                        <select id="barang" class="js-states form-control" style="width: 100%" name="barang">
                                        <option value=""></option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-info btn-shadow">Simpan</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- last Insert --}}

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
@endsection

@push('js')
<script >
   $(document).ready(function() {
			$('#basic-datatables-migrasi-harian').DataTable({
			});
		});
</script>
<script >
   $(document).ready(function() {
			$('#basic-datatables-migrasi-masuk').DataTable({
			});
		});
</script>
<script >
   $(document).ready(function() {
			$('#basic-datatables-migrasi-keluar').DataTable({
			});
		});
</script>
<script>
       $("#divisi").select2({
        placeholder: "Pilih Divisi",
        allowClear: true
    });
</script>
<script>
//    migrasi
$('#barang').select2();
   $("input[name='grand_total']").val(0);
   $('#barang').on('select2:select', function (e) { 
       console.log('select event');
               var id = $(this).val();
               var nama_customer = $(this).val();
               var url = "{{ url('barang/ajax') }}"+'/'+id;
               var _this= $(this);
               $.ajax({
                   type:'get',
                   dataType: 'json',
                   url:url,
                   success : function(data){
                       console.log(data);
                       _this.val('');
                       var nilai = '';
                       nilai +='<tr>';

                       nilai +='<td style="width:300px;height:40px;">';
                       nilai +=data.data.nama_barang;
                       nilai +='<input type="hidden" class="form-control form-control-sm" name="nama[]" value="'+data.data.nama_barang+'"></input>';
                       nilai +='</td>';

                       nilai +='<td style="height:40px;">';
                       nilai +='<input type="number" class="form-control form-control-sm" name="qty[]" value="1" style="width: auto;margin-top:5px;margin-bottom:5px;"></input>';
                       nilai +='</td>';

                       nilai +='<td style="height:40px;">';
                       nilai +='<button class="btn btn-sm btn-danger hapus">Hapus</button>';
                       nilai +='</td>';

                       nilai +='</tr>';
                       $('.produk').append(nilai);
                   }
               })            
   });
   $('body').on('click', '.hapus', function(e){
       e.preventDefault();
       $(this).closest('tr').remove();
   })
    $("button[type='submit']").click(function(e){
      
       var grand_total = parseInt($("input[name='grand_total']").val());
   })
   $("#barang").select2({
       placeholder: "Cari Barang",
       allowClear: true
   });
</script>
<script>
    // Detail 
     $('.btn-detail-migrasi').on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-migrasi`,
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
<script>
     $(".swal-confirm").click(function(e) {
            id = e.target.dataset.id;
            Swal.fire({
                    title: 'YAKIN MAU SETUJI MIGRASI?',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'YA, HAPUS!'
                    })
                .then((result) => {
                    if (result.isConfirmed) {
                        $(`#put${id}`).submit();
                    } else {
                        // swal("Data ini batal dihapus!");
                    }
                });
        });
</script>
@endpush