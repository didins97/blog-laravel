@include('template_frontend.header')
@yield('header')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @yield('isi')
            </div>
            @include('template_frontend.widget')
        </div>
    </div>
</div>
@include('template_frontend.footer')
