<div class="wrapper">
    <div class="sidebar">
        <!-- Header -->
        <div class="logo">
            <a href="{{ route('dashboard') }}">📦 Warehouse</a>
        </div>

        <!-- Navigation -->
        <nav class="navbar navber-expand-lg" color-on-scroll="500">
            <ul class="navbar-nav ml-auto">

                <!-- Sản phẩm với collapse -->
                <li class="nav-item dropdown">
                    <button class="btn w-100 d-flex justify-content-between align-items-center "
                        data-bs-toggle="collapse" data-bs-target="#submenuProducts">
                        Sản phẩm
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" id="submenuProducts">
                        <li>
                            <a href="{{ route('products.index') }}" class="dropdown-item">
                                Tất cả sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}" class="dropdown-item">
                                Loại sản phẩm
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Các menu khác -->
                <li class="mb-2"><a href="{{ route('transactions.index') }}" class="nav-link">Đơn hàng</a></li>
                <li class="mb-2"><a href="#" class="nav-link">Tồn kho</a></li>
                <li class="mb-2"><a href="#" class="nav-link">Thống kê</a></li>
                <li class="mb-2"><a href="{{ route('manufacturers.index') }}" class="nav-link">Nhà sản xuất</a></li>
                <li class="mb-2"><a href="#" class="nav-link">Người dùng</a></li>

            </ul>
        </nav>

        <!-- Logout đáy -->
        <div class="p-3 border-top mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100">Đăng xuất</button>
            </form>
        </div>
    </div>
</div>