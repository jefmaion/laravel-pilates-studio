<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.includes.head')
</head>

<body >
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row align-items-center vh-100">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
    @include('template.includes.scripts')
    @yield('auth.scripts')
</body>

</html>