<!DOCTYPE html>
<html>
<head>
    <title>{{ $inv }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        background:#ffff;
    }
</style>    
<body>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                {{ $penjualan_kredit->no_struk }}
            </div>
            <div class="row">
                {{ date('d F Y', strtotime ($penjualan_kredit->created_at)) }}
            </div>
        </div>
        <div class="col-md-4 text-right">
            {{ $penjualan_kredit->nama_customer }}
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-hover" >
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan_kredit->lines as $e=> $item)
                        <tr>
                            <td>{{ $e+1 }}</td>
                            <td>{{ $item->namas->nama_barang }}</td>
                            <td>{{ number_format($item->harga,0) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td class="text-right">{{ number_format($item->grand_total,0) }}</td>
                        </tr> 
                        @endforeach
                        <tr  class="text-right" >
                            <td colspan="4"><b>Grand Total:</b></td>
                            <td colspan="1">Rp. {{ number_format($penjualan_kredit->grand_total,0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  Piutang  --}}
    {{-- last detail --}}
    @if ($penjualan_kredit->sisa < $penjualan_kredit->grand_total )
    <hr>
    <hr>
    {{-- riwayat --}}
    <div class="row mt-5">
        <div class="col-md-12  text-center">
            <h5><b>RIWAYAT TRANSAKSI PEMBAYARAN</b></h5> 
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>No</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan_kredit->riwayat as $e=> $item)
                        <tr>
                            <td>
                               {{ $e+1 }}
                            </td>
                            <td>
                               Rp. {{ number_format($item->total_pembayaran,0) }}
                            </td>
                            <td>
                                {{ date('d F Y ', strtotime ($item->created_at)) }}
                            </td>
                            <td>
                                {{ $item->metode }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>