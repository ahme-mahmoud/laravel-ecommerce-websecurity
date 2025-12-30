<!DOCTYPE html>
<html>
...
@include('admin.navbar')
@include('admin.sidebar')

<div class="main-panel">
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>
</body>
</html>

]