<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TablePopupCell;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TablePopupItemCollection;
use App\Collections\TableRowsCollection;
use App\Models\Catalog\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TvRepository
{
    /**
     * @return Tv[]
     */
    public static function getTvs()
    {
        return Tv::orderBy('id', 'desc')->get();
    }

    /**
     * @return Tv[]
     */
    public static function getTvsForFront()
    {
        /**
         * @var $tvs Tv[]
         */
        $tvs = Tv::orderBy('id', 'desc')->take(10)->get();
        $resultTvs = [];
        foreach ($tvs as $tv) {
            $resultTvs[] = [
                'id' => $tv->getId(),
                'title' => $tv->getName(),
                'description' => $tv->getDescription(),
                'link' => $tv->getLink(),
                'price' => $tv->getPrice(),
                'image' => $tv->getSmallImage(),
            ];
        }

        return $resultTvs;
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeTvs($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Tv::destroy($arrayIds);
    }

    /**
     * @param int $id
     * @return Tv
     */
    public static function getTvById($id)
    {
        return Tv::find($id);
    }

    /**
     * @param Tv[] $tvs
     * @return TableRowsCollection
     */
    public static function tvsToRows($tvs)
    {
        $tableRows = new TableRowsCollection();
        $index = 1;
        foreach ($tvs as $tv) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($tv->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($index++);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($tv->getName());
            $tableCell->setLinkHref($tv->getLink());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($tv->getPrice());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($tv->getQuantity());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($tv->getLookups());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($tv->getUpdatedAt());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref('/admin/catalog/tv/'.$tv->getId().'/update');
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    /**
     * @param Request $request
     */
    public static function saveTv(Request $request)
    {
        DB::transaction(
            function () use ($request) {
                /**
                 * @var Tv $tv
                 */
                $tv = Tv::firstOrNew(['id' => $request->tv_id ?? 0]);

                $tv->setBrand($request->general_brand_id, $request->general_brand_new);
                $tv->setModel($request->general_model);
                $tv->setImages($request->general_images);
                $tv->setYear($request->general_year_id, $request->general_year_new);
                $tv->setScreenType($request->general_screen_type_id, $request->general_screen_type_new);
                $tv->setScreenDiagonal($request->general_screen_diagonal_id, $request->general_screen_diagonal_new);
                $tv->setScreenResolution(
                    $request->general_screen_resolution_id,
                    $request->general_screen_resolution_new
                );
                $tv->setScreenAspectRation(
                    $request->general_screen_aspect_ratio_id,
                    $request->general_screen_aspect_ratio_new
                );
                $tv->setScreenCurved($request->general_screen_curved);
                $tv->set3dSupport($request->general_3d_support);
                $tv->setDynamicScenesQualityIndex($request->general_dynamic_scenes_quality_index);
                $tv->setSmartTv($request->general_smart_tv);
                $tv->setColorBody($request->general_color_body_id, $request->general_color_body_new);
                $tv->setColorBorder($request->general_color_border_id, $request->general_color_border_new);
                $tv->setColorStand($request->general_color_stand_id, $request->general_color_stand_new);
                $tv->setStandType($request->general_stand_type_id, $request->general_stand_type_new);
                $tv->setQuantity($request->general_quantity);
                $tv->setPrice($request->general_price);
                $tv->setMatrixType($request->config_matrix_type_id, $request->config_matrix_type_new);
                $tv->setLocalDimming($request->config_local_dimming);
                $tv->setLedBacklight($request->config_led_backlight);
                $tv->setHdr($request->config_hdr);
                $tv->setHdr($request->config_hdr);
                $tv->setProcessorCore($request->config_processor_core_id, $request->config_processor_core_new);
                $tv->setScreenRefreshRate($request->config_screen_refresh_rate);
                $tv->setMaxPowerConsumption($request->config_max_power_consumption);
                $tv->setWirelessVideoTransmission($request->function_wireless_video_transmission);
                $tv->setVideoCamera($request->function_video_camera);
                $tv->setBacklight($request->function_backlight);
                $tv->setVoiceControl($request->function_voice_control);
                $tv->setScreenRefreshRate($request->config_screen_refresh_rate);
                $tv->setTwoTuners($request->signal_two_tuners);
                $tv->setSubwoofer($request->audio_subwoofer);
                $tv->setBuildInSpeakersPower($request->audio_build_in_speakers_power);
                $tv->setBuildInSpeakersCount($request->audio_build_in_speakers_count);
                $tv->setDts($request->audio_dts);
                $tv->setBluetooth($request->interface_bluetooth);
                $tv->setWiFi($request->interface_wi_fi);
                $tv->setWiFiDirect($request->interface_wi_fi_direct);
                $tv->setInputDisplayPort($request->interface_input_display_port);
                $tv->setInputAudio($request->interface_input_audio);
                $tv->setInputMhl($request->interface_input_mhl);
                $tv->setInputComponent($request->interface_input_component);
                $tv->setInputComposite($request->interface_input_composite);
                $tv->setInputScart($request->interface_input_scart);
                $tv->setInputVga($request->interface_input_vga);
                $tv->setInputHdmi($request->interface_input_hdmi);
                $tv->setInputSpdif($request->interface_input_spdif);
                $tv->setInputHeadphones($request->interface_input_headphones);
                $tv->setInputUsb20($request->interface_input_usb20);
                $tv->setInputUsb30($request->interface_input_usb30);
                $tv->setInputEthernet($request->interface_input_ethernet);
                $tv->setRemoteInterfaceUnit($request->interface_remote_interface_unit);
                $tv->setGlasses3d($request->complect_glasses_3d);
                $tv->setSmartConsole($request->complect_smart_console);
                $tv->setWallMount($request->complect_wall_mount);
                $tv->setVesaWallMount($request->sizes_vesa_id, $request->sizes_vesa_new);
                $tv->setWidth($request->sizes_width);
                $tv->setHeightWithStand($request->sizes_height_with_stand);
                $tv->setDepthWithStand($request->sizes_depth_with_stand);
                $tv->setThickness($request->sizes_thickness);
                $tv->setWeight($request->sizes_weight);

                $tv->save();

                $tv->setTvTuners($request->signal_tuners);
            }
        );
    }
}
