@extends ('layouts.admin_layout.right_side')

@section('admin_content')

    <?php $block = $blocks['repair_statistic'] ?>
    @include('admin.custom_blocks.repair_statistics')
    <?php $block = $blocks['users'] ?>
    <div class="row">
        <div class="col-md-6">
            <div class="dashboard__admins">
                @include('admin.custom_blocks.admins')
            </div>
        </div>
    </div>

@stop