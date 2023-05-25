<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="{{asset('./img/logo.png')}}" class="navbar-brand-img h-100 ms-5" alt="main_logo">
            <span class="ms-1 fw-bold text-uppercase fs-6">siorseven</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
{{-- <<<<<<< HEAD
    <div class="navbar-collapse  w-auto " id="sidenav-collapse-main" style="height:100vh;">
======= --}}
    <div class="navbar w-auto shadow-none" id="sidenav-collapse-main">
{{-- >>>>>>> FitureProfile --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
{{-- <<<<<<< HEAD --}}
           
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'order') == true ? 'active' : '' }}" href="{{ route('order') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i> --}}
                        <i class="fa fa-shopping-cart text-dark text-sm opacity-10 text-warning"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="{{ route('history') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-history text-dark text-sm opacity-10 text-success"></i>
                        {{-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> --}}
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">history</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="{{ route('virtual-reality') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">profile</span>
                </a>
            </li> --}}
            
            @if (auth()->user()->cekLevel == 'admin')    
            <li class="nav-item mt-3 d-flex align-items-center">
               <div class="ps-4">
                   {{-- <i class="fab fa-laravel" style="color: #f4645f;"></i> --}}
                   <i class="fa fa-database text-sm opacity-10 text-warning"></i>

               </div>
               <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Master</h6>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ Route::currentRouteName() == 'barang' ? 'active' : '' }}" href="{{ route('barang') }}">
                   <div
                       class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cube text-dark text-sm opacity-10"></i>
                   </div>
                   <span class="nav-link-text ms-1 text-capitalize">Barang</span>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ str_contains(request()->url(), 'user') == true ? 'active' : '' }}" href="{{ route('user.index') }}">
                   <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-users text-dark text-sm opacity-10"></i>
                   </div>
                   <span class="nav-link-text ms-1 text-capitalize">User Management</span>
               </a>
           </li>
            @endif
        </ul>
    </div>
    {{-- <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="{{asset('/img/illustrations/icon-documentation-warning.svg')}}"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div>
        <a href="/siorseven/public/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100"
            href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank" type="button">Upgrade to PRO</a>
    </div> --}}
{{-- =======
            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">PAGES</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'order' ? 'active' : '' }}" href="{{ route('order') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-shopping-cart text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'history' ? 'active' : '' }}" href="{{ route('history') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-history text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-o text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="icons align-item-center">
                    <i class="fa fa-database text-danger text-sm opacity-10"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Master Data</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'create-barang' ? 'active' : '' }}" href="{{ route('store.barang') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cube text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pengguna</span>
                </a>
            </li>   
        </ul>
    </div>     
>>>>>>> FitureProfile --}}
</aside>

