<aside class="d-flex flex-column bg-white shadow position-fixed" style="width: 220px; height: 100vh;">
    <!-- Header -->
    <div class="p-3 fs-5 fw-bold border-bottom text-dark">
        📦 Warehouse
    </div>

    <!-- Navigation -->
    <nav class="flex-grow-1 overflow-auto p-3">
        <ul class="list-unstyled">

            <!-- Sản phẩm với collapse -->
            <li class="mb-2">
                <button class="btn w-100 d-flex justify-content-between align-items-center text-dark"
                    data-bs-toggle="collapse" data-bs-target="#submenuProducts" aria-expanded="false">
                    Sản phẩm
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="collapse ps-3 mt-2 border-start" id="submenuProducts">
                    <li>
                        <a href="{{ route('products.index') }}" class="d-block py-2 text-decoration-none text-dark">
                            Tất cả sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="d-block py-2 text-decoration-none text-dark">
                            Loại sản phẩm
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Các menu khác -->
            <li class="mb-2"><a href="#" class="d-block p-2 text-decoration-none text-dark">Đơn hàng</a></li>
            <li class="mb-2"><a href="#" class="d-block p-2 text-decoration-none text-dark">Tồn kho</a></li>
            <li class="mb-2"><a href="#" class="d-block p-2 text-decoration-none text-dark">Thống kê</a></li>
            <li class="mb-2"><a href="{{ route('manufacturers.index') }}" class="d-block p-2 text-decoration-none text-dark">Nhà sản xuất</a></li>
            <li class="mb-2"><a href="#" class="d-block p-2 text-decoration-none text-dark">Người dùng</a></li>

        </ul>
    </nav>

    <!-- Logout đáy -->
    <div class="p-3 border-top mt-auto">
        <form method="POST" action="#">
            @csrf
            <button class="btn btn-danger w-100">Đăng xuất</button>
        </form>
    </div>
</aside>