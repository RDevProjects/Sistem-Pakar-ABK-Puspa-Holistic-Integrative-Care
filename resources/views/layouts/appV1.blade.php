<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.meta')
    @stack('styles-css')
</head>

<body>
    <div class="wrapper">
        @include('include.sidebar')

        <div class="main">
            @include('include.navbar')

            <main class="content">
                <div class="p-0 container-fluid">

                    @yield('title')

                    <div class="row">
                        @yield('content')
                    </div>

                    <div class="row">
                        @yield('content2')
                    </div>

                    <div class="row">
                        @yield('content3')
                    </div>

                </div>
            </main>

            <footer class="footer">
                @include('include.footer')
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')

</body>

</html>
