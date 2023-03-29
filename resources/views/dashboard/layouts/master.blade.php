<!DOCTYPE html>
<html lang="en">
@include('dashboard.layouts.particials.head')
<body>
<!-- Page Loader -->
@include('dashboard.layouts.particials.page-loader')

<div id="main-wrapper">

@include('dashboard.layouts.particials.nav-header')
@include('dashboard.layouts.particials.right-sidebar')

@include('dashboard.layouts.particials.left-sidebar')

@include('dashboard.layouts.particials.header')
@include('dashboard.layouts.particials.navbar')
    @yield('content')

    @include('dashboard.layouts.particials.footer')

</div>


<!-- Plugins Js -->
@stack('scripts')

</body></html>
