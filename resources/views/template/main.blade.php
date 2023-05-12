<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.includes.head')
</head>

<body class="light theme-white dark-sidebar">
    <div class="loader"></div>
    
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            
            @include('template.includes.navbar')

            <div class="main-sidebar sidebar-style-2">
                @include('template.includes.main-sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">

                <section class="section-">
                    @yield('title')
                    @include('template.includes.alert')
                    @yield('content')
                </section>
                
                <div class="settingSidebar">
                    @include('template.includes.right-sidebar')
                </div>

            </div>

            <footer class="main-footer">
                @include('template.includes.footer')
            </footer>

        </div>
    </div>

    @include('template.includes.scripts')

    @yield('body')
    
</body>

</html>