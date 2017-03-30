<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTvs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tvs', function ($table) {
            $table->integer('year_id')->unsigned();
            $table->integer('screen_aspect_ratio_id')->unsigned();
            $table->tinyInteger('screen_curved')->default(0);
            $table->tinyInteger('support_3d')->default(0);
            $table->tinyInteger('smart_tv')->default(0);
            $table->integer('color_body_id')->unsigned();
            $table->integer('color_border_id')->unsigned();
            $table->integer('color_stand_id')->unsigned();
            $table->integer('stand_type_id')->unsigned();
            $table->integer('matrix_type_id')->unsigned();
            $table->tinyInteger('local_dimming')->default(0);
            $table->tinyInteger('led_backlight')->default(0);
            $table->tinyInteger('hdr')->default(0);
            $table->integer('screen_refresh_rate')->default(0);
            $table->integer('max_power_consumption')->default(0);
            $table->tinyInteger('wireless_video_transmission')->default(0);
            $table->tinyInteger('video_camera')->default(0);
            $table->tinyInteger('backligh')->default(0);
            $table->tinyInteger('voice_control')->default(0);
            $table->tinyInteger('subwoofer')->default(0);
            $table->integer('build_in_speakers_power')->default(0);
            $table->integer('build_in_speakers_count')->default(0);
            $table->tinyInteger('dts')->default(0);
            $table->tinyInteger('bluetooth')->default(0);
            $table->tinyInteger('wi_fi')->default(0);
            $table->tinyInteger('wi_fi_direct')->default(0);
            $table->integer('input_display_port')->default(0);
            $table->integer('input_audio')->default(0);
            $table->integer('input_mhl')->default(0);
            $table->integer('input_component')->default(0);
            $table->integer('input_composite')->default(0);
            $table->integer('input_scart')->default(0);
            $table->integer('input_vga')->default(0);
            $table->integer('input_hdmi')->default(0);
            $table->integer('input_spdif')->default(0);
            $table->integer('input_headphones')->default(0);
            $table->integer('input_usb20')->default(0);
            $table->integer('input_usb30')->default(0);
            $table->integer('input_ethernet')->default(0);
            $table->tinyInteger('remote_interface_unit')->default(0);
            $table->tinyInteger('glasses_3d')->default(0);
            $table->tinyInteger('smart_console')->default(0);
            $table->tinyInteger('wall_mount')->default(0);
            $table->integer('vesa_wall_mount_id')->unsigned();
            $table->integer('width')->default(0);
            $table->integer('height_with_stand')->default(0);
            $table->integer('height_without_stand')->default(0);
            $table->integer('depth')->default(0);
            $table->integer('weight')->default(0);
        });

        Schema::table('tvs', function($table) {
            $table->foreign('year_id')->references('id')->on('years')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('screen_aspect_ratio_id')->references('id')->on('screen_aspect_ratios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('stand_type_id')->references('id')->on('stand_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('matrix_type_id')->references('id')->on('matrix_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('vesa_wall_mount_id')->references('id')->on('vesa_wall_mounts')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tvs', function ($table) {
            $table->dropColumn('year_id');
            $table->dropColumn('screen_aspect_ratio_id');
            $table->dropColumn('screen_curved');
            $table->dropColumn('support_3d');
            $table->dropColumn('smart_tv');
            $table->dropColumn('color_body_id');
            $table->dropColumn('color_stand_id');
            $table->dropColumn('color_border_id');
            $table->dropColumn('stand_type_id');
            $table->dropColumn('matrix_type_id');
            $table->dropColumn('local_dimming');
            $table->dropColumn('led_backlight');
            $table->dropColumn('hdr');
            $table->dropColumn('screen_refresh_rate');
            $table->dropColumn('max_power_consumption');
            $table->dropColumn('wireless_video_transmission');
            $table->dropColumn('video_camera');
            $table->dropColumn('backligh');
            $table->dropColumn('voice_control');
            $table->dropColumn('subwoofer');
            $table->dropColumn('build_in_speakers_power');
            $table->dropColumn('build_in_speakers_count');
            $table->dropColumn('dts');
            $table->dropColumn('bluetooth');
            $table->dropColumn('wi_fi');
            $table->dropColumn('wi_fi_direct');
            $table->dropColumn('input_display_port');
            $table->dropColumn('input_audio');
            $table->dropColumn('input_mhl');
            $table->dropColumn('input_component');
            $table->dropColumn('input_composite');
            $table->dropColumn('input_scart');
            $table->dropColumn('input_vga');
            $table->dropColumn('input_hdmi');
            $table->dropColumn('input_spdif');
            $table->dropColumn('input_headphones');
            $table->dropColumn('input_usb20');
            $table->dropColumn('input_usb30');
            $table->dropColumn('input_ethernet');
            $table->dropColumn('remote_interface_unit');
            $table->dropColumn('glasses_3d');
            $table->dropColumn('smart_console');
            $table->dropColumn('wall_mount');
            $table->dropColumn('vesa_wall_mount_id');
            $table->dropColumn('width');
            $table->dropColumn('height_with_stand');
            $table->dropColumn('height_without_stand');
	        $table->dropColumn('depth');
            $table->dropColumn('weight');
        });
    }
}
