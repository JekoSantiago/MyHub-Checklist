@if(is_null(Session::get('EmpNo')))
<script>
        window.location.href = '{{ url('/403') }}';
</script>
@endif
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>ATP-Checklist | {{ $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    @include('layouts.components.css')

</head>

<body class="preload @yield('layout_class') @yield('category_nav_toggle_class')">
    <nav id="sidebar">
        @include('layouts.components.sidebar')
    </nav>
    <header class="fixed-top">
        <div id="topbar">
            @include('layouts.components.navbar')
        </div>
    </header>

    <div class="content-wrapper">
        <main role="main" class="default-wrapper">
            <div class="category-nav-backdrop"></div>
            @yield('main')
        </main>
        <footer>
            <div class="footer bg-white py-3 text-muted">
                <div class="container">
                    <span>&copy; Alfamart Philippines. All Rights Reserved.</span>
                </div>
            </div>
        </footer>
    </div>

    @include('layouts.components.javascript')
</body>

</html>