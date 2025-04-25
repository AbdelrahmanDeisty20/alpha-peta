@include('web.layouts.header')
    <!-- BEGIN: Content-->

        @include('web.layouts.nav')

        @yield('content')

        <!-- END: Content-->

@include('web.layouts.footer')
