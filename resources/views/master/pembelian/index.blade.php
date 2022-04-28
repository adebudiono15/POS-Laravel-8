@extends('layouts.master')

@section('title', 'Pembelian')

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
                                <h4 class="card-title">History Pembelian</h4>
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
                                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                                            <i class="flaticon-credit-card"></i>
                                            Bank
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                     {{--  Pembelian Langsung  --}}
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
                                                    @foreach ($pembelian_langsung as $e=>$item)
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
                            
                                                            <a href="#" data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger btn-shadow mt-2 mb-2 swal-confirm">
                                                                <form action="{{ route('delete-pembelian-langsung', $item->id) }}"
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
                                    <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                                        {{--  Pembelian bank  --}}
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
                                                    @foreach ($pembelian_kredit as $e=>$item)
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

{{-- Insert --}}
<div id="insert" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">TAMBAH DATA PEMBELIAN</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <div class="row mt-5 mb-5 justify-content-center text-center">
                <div class="col-lg-6">
                    <div class="btn btn-sm btn-success shadow" href="#insertlangsung" data-toggle="modal">Pembelian Langsung</div>
                </div>
                <div class="col-lg-6">
                    <div class="btn btn-sm btn-danger shadow"  href="#insertkredit" data-toggle="modal">Pembelian Kredit</div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- last Insert --}}

{{-- Insert langsung --}}
<div id="insertlangsung" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">TAMBAH DATA PEMBELIAN</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <input type="hidden" name="grand_total" value="0">
            <form class="form form-vertical" method="post" enctype="multipart/form-data"
                action="{{ route('save-pembelianlangsung') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="my-input">NO INVOICE</label>
                                <input class="form-control form-control-sm" type="text" name="inv_pembelian">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama_supplier_id" @error('nama_supplier_id') class="text-danger" @enderror>SUPPLIER @error('nama_supplier_id')
                                    | {{ $message }}
                                    @enderror</label>
                                    <select id="supplier_id" name="supplier_id" class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select id="metode" name="metode" class="form-control" style="width:100%;" onchange="changeMethod()">
                                        <option value=""></option>
                                        <option value="Cash">Cash</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <select id="bank" class="form-control" style="width:100%;" disabled name="bank" >
                                        <option></option>   
                                        @foreach ($bank as $i)
                                        <option value="{{ $i->nama_bank }}">{{ $i->nama_bank }}</option>
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
                                            <th><b>HARGA</b></th>
                                            <th><b>QTY</b></th>
                                            <th><b>AKSI</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="produk-ajax">
        
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

{{-- Insert kredit --}}
<div id="insertkredit" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">TAMBAH DATA PEMBELIAN</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <input type="hidden" name="grand_total" value="0">
            <form class="form form-vertical" method="post" enctype="multipart/form-data"
                action="{{ route('save-pembeliankredit') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="my-input">NO INVOICE</label>
                                <input class="form-control form-control-sm" type="text" name="inv_pembelian">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama_supplier_id" @error('nama_supplier_id') class="text-danger" @enderror>SUPPLIER @error('nama_supplier_id')
                                    | {{ $message }}
                                    @enderror</label>
                                    <select id="supplier_idkredit" name="supplier_id" class="js-states form-control" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
                                            <th><b>HARGA</b></th>
                                            <th><b>QTY</b></th>
                                            <th><b>AKSI</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="produk-ajaxkredit">
        
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="barang" @error('barang') class="text-danger" @enderror>Pilih Item Untuk Tambah Barang @error('barang')
                                            | {{ $message }}
                                            @enderror</label>
                                        <select id="barangkredit" class="js-states form-control" style="width: 100%" name="barang">
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
{{--  Pembelian Langsung  --}}
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
{{--  Pembelian Kredit  --}}
<div id="detailpembeliankredit" class="modal fade" style="display: none;" aria-hidden="true">
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
<script>
    $("#supplier_id").select2({
        placeholder: "Pilih Supplier",
        allowClear: true
    });
    $("#supplier_idkredit").select2({
        placeholder: "Pilih Supplier",
        allowClear: true
    });
    $("#kategori_pembelian").select2({
        placeholder: "Pilih Kategori Pembelian",
        allowClear: true
    });
    $("#metode").select2({
        placeholder: "Pilih Metode Pembayaran",
        allowClear: true
    });
    $("#bank").select2({
        placeholder: "Pilih Metode Pembayaran",
        allowClear: true
    });
   
</script>
<script>
// method
function changeMethod(){
    var metode = $('#metode').val();
    document.getElementById("bank").setAttribute("disabled", "disabled");
    if (metode != 'Cash' ) {
        document.getElementById("bank").removeAttribute("disabled");
    }
    if (metode == 'Cash' ) {
        $('#bank').val('').trigger("change");
    }
}
</script>
<script>
    // Pembelian langsung
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
                           
                       nilai +='<td style="width:300px;" style="height:40px;">';
                       nilai +=data.data.nama_barang;
                       nilai +='<input type="hidden" class="form-control form-control-sm" name="nama[]" value="'+data.data.id+'"></input>';
                       nilai +='</td>';
                       nilai +='<td class="harga" style="height:40px;">';
                       nilai +='<input type="number" class="form-control form-control-sm" name="harga[]" value="'+data.data.harga+'" style="width: auto;"></input>';
                       nilai +='</td>';
                       nilai +='<td style="height:40px;">';
                       nilai +='<input type="number" class="form-control form-control-sm" name="qty[]" value="1" style="width: 70px;"></input>';
                       nilai +='</td>';
                       nilai +='<td style="height:40px;">';
                       nilai +='<button class="btn btn-sm btn-danger hapus">Hapus</button>';
                       nilai +='</td>';
                      
                       nilai +='</tr>';
                       var total = parseInt($("input[name='grand_total']").val());
                       total += data.data.harga;

                       $("input[name='grand_total']").val(total);
                       $('.produk-ajax').append(nilai);
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

//    Pembelian Kredit
$('#barangkredit').select2();
   $("input[name='grand_total']").val(0);
   $('#barangkredit').on('select2:select', function (e) { 
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
                           
                       nilai +='<td style="width:300px;" style="height:40px;">';
                       nilai +=data.data.nama_barang;
                       nilai +='<input type="hidden" class="form-control form-control-sm" name="nama[]" value="'+data.data.id+'"></input>';
                       nilai +='</td>';
                       nilai +='<td class="harga" style="height:40px;">';
                       nilai +='<input type="number" class="form-control form-control-sm" name="harga[]" value="'+data.data.harga+'" style="width: auto;"></input>';
                       nilai +='</td>';
                       nilai +='<td style="height:40px;">';
                       nilai +='<input type="number" class="form-control form-control-sm" name="qty[]" value="1" style="width: 70px;"></input>';
                       nilai +='</td>';
                       nilai +='<td style="height:40px;">';
                       nilai +='<button class="btn btn-sm btn-danger hapus">Hapus</button>';
                       nilai +='</td>';
                      
                       nilai +='</tr>';
                       var total = parseInt($("input[name='grand_total']").val());
                       total += data.data.harga;

                       $("input[name='grand_total']").val(total);
                       $('.produk-ajaxkredit').append(nilai);
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
   $("#barangkredit").select2({
       placeholder: "Cari Barang",
       allowClear: true
   });
</script>
<script >
   $(document).ready(function() {
			$('#basic-datatables-kredit').DataTable({
			});
		});
</script>
<script>
    // Detail pembelian langsung
     $('.btn-detail-pembelian-langsung').on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-pembelian-langsung`,
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

        // Detail Pembelian kredit
        $('.btn-detail-pembelian-kredit').on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/newposmp1/${id}/detail-pembelian-kredit`,
                method: "GET",
                success: function(data) {
                    // console.log(data)
                    $('#detailpembeliankredit').find('.modal-body').html(data)
                    $('#detailpembeliankredit').modal('show')
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