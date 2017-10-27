@extends ('layouts.admin_layout.right_side')

@section('admin_content')

    <div class="row">
        <div class="col-lg-6">
            <?php $block = $blocks['repair_statistic'] ?>
            @include('admin.custom_blocks.repair_statistics')
        </div>
        <div class="col-lg-6">
            <div class="dashboard__employees">
                <?php $block = $blocks['users'] ?>
                @include('admin.custom_blocks.employees')
            </div>
            <div class="dashboard__workers">
                <?php $block = $blocks['workers'] ?>
                @include('admin.custom_blocks.workers')
            </div>
        </div>
    </div>

@stop