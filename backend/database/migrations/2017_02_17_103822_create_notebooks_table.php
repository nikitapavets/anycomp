<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'notebooks',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('brand_id')->unsigned();
                $table->string('model');
                $table->integer('year_id')->unsigned();
                $table->integer('computer_type_id')->unsigned();
                $table->tinyInteger('transformer')->default(0);
                $table->integer('processor_stage_id')->unsigned();
                $table->integer('processor_id')->unsigned();
                $table->string('processor_model');
                $table->integer('processor_core_id')->unsigned();
                $table->integer('processor_clock_frequency')->default(0);
                $table->integer('processor_turbo_clock_frequency')->default(0);
                $table->integer('processor_tdp')->default(0);
                $table->integer('color_body_id')->unsigned();
                $table->integer('color_roof_id')->unsigned();
                $table->integer('material_body_id')->unsigned();
                $table->integer('material_roof_id')->unsigned();
                $table->tinyInteger('body_backlight')->default(0);
                $table->tinyInteger('shockproof')->default(0);
                $table->integer('width')->default(0);
                $table->integer('depth')->default(0);
                $table->integer('thickness')->default(0);
                $table->integer('weight')->default(0);
                $table->integer('screen_type_id')->unsigned();
                $table->integer('screen_resolution_id')->unsigned();
                $table->integer('screen_diagonal_id')->unsigned();
                $table->integer('screen_surface_id')->unsigned();
                $table->tinyInteger('touch_screen')->default(0);
                $table->tinyInteger('pen_input_support')->default(0);
                $table->tinyInteger('screen_3d')->default(0);
                $table->integer('ram_type_id')->unsigned();
                $table->integer('ram_size')->default(0);
                $table->integer('ram_max_size')->default(0);
                $table->integer('hdd_type')->unsigned();
                $table->integer('hdd_size')->unsigned();
                $table->integer('hdd_rotational_speed')->default(0);
                $table->tinyInteger('ood')->default(0);
                $table->integer('graphic_card_id')->unsigned();
                $table->integer('graphic_card_type_id')->unsigned();
                $table->integer('build_in_camera')->default(0);
                $table->integer('build_in_camera_pixels')->default(0);
                $table->integer('build_in_microphone')->default(0);
                $table->integer('build_in_speakers')->default(0);
                $table->tinyInteger('numpad')->default(0);
                $table->tinyInteger('keyboard_backlight')->default(0);
                $table->integer('cursor_control_type_id')->unsigned();
                $table->tinyInteger('fingerprint_scanner')->default(0);
                $table->tinyInteger('eyes_control')->default(0);
                $table->tinyInteger('keyboard_kirill')->default(0);
                $table->tinyInteger('multi_touch_panel')->default(0);
                $table->tinyInteger('nfc')->default(0);
                $table->tinyInteger('bluetooth')->default(0);
                $table->tinyInteger('lan')->default(0);
                $table->tinyInteger('wi_fi')->default(0);
                $table->tinyInteger('mobile_connect')->default(0);
                $table->integer('input_usb20')->default(0);
                $table->integer('input_usb30')->default(0);
                $table->integer('input_vga')->default(0);
                $table->integer('input_hdmi')->default(0);
                $table->integer('input_display_port')->default(0);
                $table->integer('input_thunderbolt')->default(0);
                $table->integer('input_audio')->default(0);
                $table->integer('battery_cells')->default(0);
                $table->integer('energy_reserve')->default(0);
                $table->integer('working_hours')->default(0);
                $table->tinyInteger('second_battery')->default(0);
                $table->tinyInteger('mouse')->default(0);
                $table->tinyInteger('bag')->default(0);
                $table->decimal('price', 15, 2)->default(0.00);
                $table->integer('quantity')->default(0);
                $table->softDeletes();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notebooks');
    }
}
