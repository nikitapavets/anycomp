@extends ('layouts.admin_layout.right_side')

@section('admin_content')

    <div class="admin-panel__widget">
        <div class="title">
            <div class="text">
                {{ $widget['title'] }}
            </div>
        </div>
        <div class="widget-row">
            <a href="/admin/repair/statistics/print">Распечатать</a>
        </div>
    </div>

@stop