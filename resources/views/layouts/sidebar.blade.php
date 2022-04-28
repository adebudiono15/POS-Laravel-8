<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" style="fill: #EA4D56;transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }} 
                            <span class="user-level">
                                Role User
                                {{-- {{ Auth::user()->nip }} --}}
                            </span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#password" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="link-collapse">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-danger">
                {{-- Dashboard --}}
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{--  Transaksi  --}}
                <li class="nav-item {{ Request::is('dashboard-penjualan','dashboard-pembelian') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#transaksi">
                        <i class="fas fa-layer-group"></i>
                        <p>Transaksi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('dashboard-penjualan','dashboard-pembelian') ? 'show' : '' }}" id="transaksi">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('dashboard-penjualan') ? 'active' : '' }}">
                                <a href="{{ route('dashboard-penjualan') }}">
                                    <span class="sub-item">Penjualan</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('dashboard-pembelian') ? 'active' : '' }}">
                                <a href="{{ url('dashboard-pembelian') }}">
                                    <span class="sub-item">Pembelian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--  Piutang  --}}
                <li class="nav-item {{ Request::is('hutangpiutang') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#hutangpiutang">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Keuangan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('pendapatan','pengeluaran','piutang','hutang') ? 'show' : '' }}" id="hutangpiutang">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('piutang') ? 'active' : '' }}">
                                <a href="{{ route('piutang') }}">
                                    <span class="sub-item">Piutang</span>
                                </a>
                            </li>
                            {{--  Hutang  --}}
                            <li class="{{ Request::is('hutang') ? 'active' : '' }}">
                                <a href="{{ route('hutang') }}">
                                    <span class="sub-item">Hutang</span>
                                </a>
                            </li>

                            {{--  Pendapatan  --}}
                            <li class="{{ Request::is('pendapatan') ? 'active' : '' }}">
                                <a href="{{ route('pendapatan') }}">
                                    <span class="sub-item">Pendapatan</span>
                                </a>
                            </li>
                            {{-- Pengeluaran  --}}
                            <li class="{{ Request::is('pengeluaran') ? 'active' : '' }}">
                                <a href="{{ route('pengeluaran') }}">
                                    <span class="sub-item">Pengeluaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--  Master  --}}
                <li class="nav-item {{ Request::is('barang','satuan','kategori','supplier','customer') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#master">
                        <i class="fas fa-warehouse"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('barang','satuan','kategori','supplier','customer','kategori-customer') ? 'show' : '' }}" id="master">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('barang') ? 'active' : '' }}">
                                <a href="{{ url('barang') }}">
                                    <span class="sub-item">Barang</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('customer') ? 'active' : '' }}">
                                <a href="{{ url('customer') }}">
                                    <span class="sub-item">Customer</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('kategori-customer') ? 'active' : '' }}">
                                <a href="{{ url('kategori-customer') }}">
                                    <span class="sub-item">Kategori Customer</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('satuan') ? 'active' : '' }}">
                                <a href="{{ url('satuan') }}">
                                    <span class="sub-item">Satuan</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('supplier') ? 'active' : '' }}">
                                <a href="{{ url('supplier') }}">
                                    <span class="sub-item">Supplier</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('kategori') ? 'active' : '' }}">
                                <a href="{{ url('kategori') }}">
                                    <span class="sub-item">Kategori</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Laporan --}}
                <li class="nav-item {{ Request::is('laporan-penjualan','laporan-pembelian') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#laporan">
                        <i class="fas fa-book"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('laporan-penjualan','laporan-pembelian') ? 'show' : '' }}" id="laporan">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('laporan-penjualan') ? 'active' : '' }}">
                                <a href="{{ url('laporan-penjualan') }}">
                                    <span class="sub-item">Penjualan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- change password --}}
<div id="password" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">CHANGE PASSWORD</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <form method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="mt-2">Old Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="old_password" class="form-control shadow" name="old_password">
                            @error('old_password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="mt-2">New Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" class="form-control shadow" name="password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="mt-2">Confirm Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password_confirmation" class="form-control shadow" name="password_confirmation">
                            @error('password_confirmation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-info btn-shadow">Update</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Sidebar -->