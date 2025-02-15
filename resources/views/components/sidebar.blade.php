<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="icon-home"></i><span>Dashboard</span></a></li>
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Menu</div> <i class="icon-menu"></i>
                </li>
                <li class="nav-item"><a href="{{url('/user')}}" class="nav-link"><i class="icon-user"></i><span>Master User</span></a></li>
                <li class="nav-item"><a href="{{url('/peserta')}}" class="nav-link"><i class="icon-user"></i><span>Master Peserta</span></a></li>
                <li class="nav-item"><a href="{{url('/instruktur')}}" class="nav-link"><i class="icon-user"></i><span>Master Instruktur</span></a></li>
                <li class="nav-item"><a href="{{url('/diklat')}}" class="nav-link"><i class="icon-task"></i><span>Master Diklat</span></a></li>
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Lainnya</div> <i class="icon-menu"></i>
                </li>

                <li class="nav-item"><a href="{{ route('pendaftaran') }}" class="nav-link"><i class="icon-task"></i><span>Pendaftaran</span></a></li>
                <li class="nav-item"><a href="{{url('/penjadwalan')}}" class="nav-link"><i class="icon-task"></i><span>Penjadwalan</span></a></li>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navigation -->

</div>
<!-- /main sidebar -->