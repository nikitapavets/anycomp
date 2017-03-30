@extends('layouts.admin_layout')

@section('admin_right-side')

<div class="admin-panel__right-side">

    @include('layouts.admin_layout.right_side.top_menu')

    <div class="admin-panel__right-side--content">

        <div class="content-title">
            <div class="content-title__main-title">{{ $page['sub_title'] }}</div>
            <div class="content-title__sub-title">{{ $page['sub_descr'] }}</div>
        </div>

        <div class="admin-panel__content-sep"></div>

        <div class="content-inner">
            @yield('admin_content')
        </div>

    </div>

</div>

@stop