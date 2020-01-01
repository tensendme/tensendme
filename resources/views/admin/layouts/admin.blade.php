<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    @include('admin.layouts.parts.head')
</head>
<body class="h-100">
    @include('admin.layouts.parts.header')
                @yield('content')
        <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                @include('admin.layouts.parts.footer')
            </footer>
        </main>
    </div>
</div>
@include('admin.layouts.parts.javascript')
</body>
</html>
