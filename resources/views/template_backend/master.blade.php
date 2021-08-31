@include('template_backend.header')

    <div id="wrapper">
        @include('template_backend.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                @include('template_backend.navbar')

                <div class="container-fluid">
                    <section>@yield('content')</section>
                    <section>@yield('modal')</section>
                </div>

            </div>
            <!-- End of Main Content -->

            @include('template_backend.footer')

        </div>
    </div>
    
@include('template_backend.js')


