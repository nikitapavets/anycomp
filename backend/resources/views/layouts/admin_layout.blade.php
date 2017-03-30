@extends ('layouts.general')

@section('content')

    <div class="admin-panel">
        @include('layouts.admin_layout.left_side')
        @yield('admin_right-side')
        @include('layouts.admin_layout.popup')
    </div>

@stop

