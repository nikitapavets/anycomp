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
use Illuminate\Http\Request;
use App\Models\Catalog\Notebook;
use Illuminate\Support\Facades\DB;

class NotebookRepository
{
    /**
     * @return Notebook[]
     */
    public static function getNotebooks()
    {
        return Notebook::orderBy('id', 'desc')->get();
    }

    /**
     * @return Notebook[]
     */
    public static function getNotebooksForFront()
    {
        /**
         * @var $notebooks Notebook[]
         */
        $notebooks = Notebook::orderBy('id', 'desc')->take(10)->get();
        $resultNotebooks = [];
        foreach ($notebooks as $notebook) {
            $resultNotebooks[] = [
              'id' => $notebook->getId(),
              'title' => $notebook->getName(),
              'description' => $notebook->getDescription(),
              'link' => $notebook->getLink(),
              'price' => $notebook->getPrice(),
              'image' => $notebook->getSmallImage(),
            ];
        }

        return $resultNotebooks;
    }

    /**
     * @return Notebook[]
     */
    public static function getPopularNotebooks()
    {
        return Notebook::where('is_popular', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param Notebook[] $notebooks
     * @return TableRowsCollection
     */
    public static function notebooksToRows($notebooks)
    {
        $tableRows = new TableRowsCollection();
        $index = 1;
        foreach ($notebooks as $notebook) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($notebook->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($index++);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($notebook->getName());
            $tableCell->setLinkHref($notebook->getLink());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($notebook->getPrice());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($notebook->getQuantity());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($notebook->getLookups());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($notebook->getUpdatedAt());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref('/admin/catalog/notebook/'.$notebook->getId().'/update');
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeNotebooks($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Notebook::destroy($arrayIds);
    }

    /**
     * @param int $id
     * @return Notebook
     */
    public static function getNotebookById($id)
    {
        return Notebook::find($id);
    }

    /**
     * @param Request $request
     */
    public static function saveNotebook(Request $request)
    {
        DB::transaction(
            function () use ($request) {
                /**
                 * @var Notebook $notebook
                 */
                $notebook = Notebook::firstOrNew(['id' => $request->notebook_id ?? 0]);
                $notebook->setBrand($request->general_brand_id, $request->general_brand_new);
                $notebook->setModel($request->general_model);
                $notebook->setConfig($request->general_config);
                $notebook->setComputerType($request->general_computer_type_id, $request->general_computer_type_new);
                $notebook->setTransformer($request->general_transformer);
                $notebook->setYear($request->general_year_id, $request->general_year_new);
                $notebook->setQuantity($request->general_quantity);
                $notebook->setPrice($request->general_price);
                $notebook->setIsPopular($request->general_is_popular);
                $notebook->setProcessorStage($request->processor_stage_id, $request->processor_stage_new);
                $notebook->setProcessor($request->processor_id, $request->processor_new);
                $notebook->setProcessorModel($request->processor_model);
                $notebook->setProcessorCore($request->processor_core_id, $request->processor_core_new);
                $notebook->setProcessorCore($request->processor_core_id, $request->processor_core_new);
                $notebook->setProcessorClockFrequency($request->processor_clock_frequency);
                $notebook->setProcessorTurboClockFrequency($request->processor_turbo_clock_frequency);
                $notebook->setProcessorTdp($request->processor_tdp);
                $notebook->setColorBody($request->color_body_id, $request->color_body_new);
                $notebook->setColorRoof($request->color_roof_id, $request->color_roof_new);
                $notebook->setMaterialBody($request->material_body_id, $request->material_body_new);
                $notebook->setMaterialRoof($request->material_roof_id, $request->material_roof_new);
                $notebook->setBodyBacklight($request->body_backlight);
                $notebook->setShockproof($request->shockproof);
                $notebook->setWidth($request->width);
                $notebook->setDepth($request->depth);
                $notebook->setThickness($request->thickness);
                $notebook->setWeight($request->weight);
                $notebook->setScreenDiagonal($request->screen_diagonal_id, $request->screen_diagonal_new);
                $notebook->setScreenResolution($request->screen_resolution_id, $request->screen_resolution_new);
                $notebook->setScreenType($request->screen_type_id, $request->screen_type_new);
                $notebook->setScreenSurface($request->screen_surface_id, $request->screen_surface_new);
                $notebook->setTouchScreen($request->touch_screen);
                $notebook->setPenInputSupport($request->pen_input_support);
                $notebook->setScreen3d($request->screen_3d);
                $notebook->setRamType($request->ram_type_id, $request->ram_type_new);
                $notebook->setRamSize($request->ram_size_id, $request->ram_size_new);
                $notebook->setRamMaxSize($request->ram_max_size_id, $request->ram_max_size_new);
                $notebook->setHddSize($request->hdd_size_id, $request->hdd_size_new);
                $notebook->setHddRotationalSpeed($request->hdd_rotational_speed);
                $notebook->setGraphicCard($request->graphic_card_id, $request->graphic_card_new);
                $notebook->setGraphicCardType($request->graphic_card_type_id, $request->graphic_card_type_new);
                $notebook->setGraphicMemorySize($request->graphic_memory_size_id, $request->graphic_memory_size_new);
                $notebook->setGraphicCardModel($request->graphic_card_model);
                $notebook->setBuildInCamera($request->build_in_camera);
                $notebook->setBuildInCameraPixels($request->build_in_camera_pixels);
                $notebook->setBuildInMicrophone($request->build_in_microphone);
                $notebook->setBuildInSpeakers($request->build_in_speakers);
                $notebook->setNumpad($request->numpad);
                $notebook->setKeyboardBacklight($request->keyboard_backlight);
                $notebook->setKeyboardKirill($request->keyboard_kirill);
                $notebook->setMultiTouchPanel($request->multi_touch_panel);
                $notebook->setCursorControlType($request->cursor_control_type_id, $request->cursor_control_type_new);
                $notebook->setFingerprintScanner($request->fingerprint_scanner);
                $notebook->setEyesControl($request->eyes_control);
                $notebook->setOod($request->ood);
                $notebook->setMemoryCards($request->is_memory_cards);
                $notebook->setNfc($request->nfc);
                $notebook->setBluetooth($request->bluetooth);
                $notebook->setLan($request->lan);
                $notebook->setWiFi($request->wi_fi);
                $notebook->setMobileConnect($request->mobile_connect);
                $notebook->setBluetooth($request->mobile_connect);
                $notebook->setInputUsb20($request->input_usb20);
                $notebook->setInputUsb30($request->input_usb30);
                $notebook->setInputUsb31A($request->input_usb31a);
                $notebook->setInputUsb31B($request->input_usb31b);
                $notebook->setInputUsb31C($request->input_usb31c);
                $notebook->setInputVga($request->input_vga);
                $notebook->setInputHdmi($request->input_hdmi);
                $notebook->setInputDisplayPort($request->input_display_port);
                $notebook->setInputThunderbolt($request->input_thunderbolt);
                $notebook->setInputAudio($request->input_audio);
                $notebook->setBatteryCells($request->battery_cells);
                $notebook->setEnergyReserve($request->energy_reserve);
                $notebook->setWorkingHours($request->working_hours);
                $notebook->setSecondBattery($request->second_battery);
                $notebook->setMouse($request->mouse);
                $notebook->setBag($request->bag);
                $notebook->setTouchForce($request->touch_force);
                $notebook->setSsdSize($request->ssd_size_id, $request->ssd_size_new);

                $notebook->save();

                $notebook->setImages($request->general_images);
                $notebook->setHddTypes($request->hdd_types);
                $notebook->setMemoryCards($request->memory_cards);
                $notebook->setTvTuners($request->tv_tuner);
                $notebook->setComplects($request->set);
            }
        );
    }
}
