<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="category">
                <i class="mdi mdi-archive menu-icon"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="orders">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders') }}">Захиалга хянах </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/all-orders') }}"> Бүх захиалгууд </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
                <i class="mdi mdi-view-list menu-icon"></i>
                <span class="menu-title">Ангилал</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">Ангилал Нэмэх</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category') }}"> Бүх Ангилал </a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#gender" aria-expanded="false" aria-controls="category">
                <i class="mdi mdi-view-list menu-icon"></i>
                <span class="menu-title">Gender</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="gender">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/gender/create') }}">Add Gender</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/gender') }}"> All Gender</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
                <i class="mdi mdi-sale menu-icon"></i>
                <span class="menu-title">Бараа</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/product/create') }}"> Бүтээгдэхүүн нэмэх </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/product') }}"> Бүх Бүтээгдэхүүн </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/brands') }}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title"> Brands </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/colors') }}">
                <i class="mdi mdi-color-helper menu-icon"></i>
                <span class="menu-title">Colors</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/sizes') }}">
                <i class="mdi mdi-format-size menu-icon"></i>
                <span class="menu-title">Sizes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#chart" aria-expanded="false" aria-controls="product">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Chart</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="chart">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/charts/create') }}"> Chart нэмэх </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/charts') }}"> Бүх Chart </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/user/create') }}"> Хэрэглэгч нэмэх </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}"> Бүх Хэрэглэгч  </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/slider') }}">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Home Slider</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/client/d03a7f43-f1e3-47b0-8a61-21e79df08c7f') }}">
                <i class="mdi mdi-settings-box menu-icon"></i>
                <span class="menu-title">Site Setting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/banner/6a847aa8-b157-4bb7-81aa-b8d7e58d0382') }}">
                <i class="mdi mdi-microphone menu-icon"></i>
                <span class="menu-title">Banner</span>
            </a>
        </li>

    </ul>
</nav>
