<div class="wrapper">
    <div class="sidebar">

        <div class="logo">
            <a href="{{ route(Auth::user()->role . '.dashboard') }}">📦 Warehouse</a>
        </div>

        <nav class="navbar navber-expand-lg" color-on-scroll="500">
            <ul class="navbar-nav ml-auto">

                @notrole('viewer', 'warehouser')
                <li class="nav-item dropdown">
                    <button class="btn w-100 d-flex justify-content-between align-items-center "
                        data-bs-toggle="collapse" data-bs-target="#submenuProducts">
                        Sản phẩm
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" id="submenuProducts">
                        <li>
                            <a href="{{ role_route('products.index') }}" class="dropdown-item">
                                Tất cả sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{ role_route('categories.index') }}" class="dropdown-item">
                                Loại sản phẩm
                            </a>
                        </li>
                    </ul>
                </li>

                @endnotrole
                <li class="mb-2"><a href="{{ role_route('transactions.index') }}" class="nav-link">Đơn hàng</a></li>
                <li class="mb-2"><a href="{{ route('inventory.index') }}" class="nav-link">Tồn kho</a></li>
                @role(['admin', 'manager'])
                <li class="nav-item">
                    <a href="{{ route('statistics.index') }}" class="nav-link">
                        Thống kê
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="mb-2"><a href="{{ role_route('manufacturers.index') }}" class="nav-link">Nhà sản xuất</a>
                </li>
                @endrole
                <li class="mb-2"><a href="#" class="nav-link">Người dùng</a></li>

            </ul>
        </nav>

        <div class="p-3 border-top mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100">Đăng xuất</button>
            </form>
        </div>
    </div>
</div>