@include('layouts.header')

    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                @include('layouts.navbar')

                <div class="container-fluid">
                    <section>@yield('content')</section>
                    <section>@yield('modal')</section>
                </div>

            </div>
            <!-- End of Main Content -->

            @include('layouts.footer')

        </div>
    </div>
    
@include('layouts.js')


