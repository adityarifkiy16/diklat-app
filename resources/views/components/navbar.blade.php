<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-light">
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="index.html" class="d-inline-block">
                <img src="assets/images/logo_light.png" alt="">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="index.html" class="d-inline-block">
                <img src="assets/images/logo_icon_light.png" alt="">
            </a>
        </div>
    </div>

    <!-- Mobile button -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="index.html" class="d-inline-block">
                <img src="assets/images/logo_dark.png" alt="">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-hide d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-md-auto">
            <li class="nav-item dropdown">
                <a href="other_changelog.html" class="navbar-nav-link">
                    <i class="icon-user mr-2"></i>
                    <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->