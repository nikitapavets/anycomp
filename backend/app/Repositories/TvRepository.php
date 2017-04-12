<?php

namespace App\Repositories;

use App\Classes\Front\Section;
use App\Classes\Front\SectionCheckerItem;
use App\Classes\Front\SectionItem;
use App\Classes\Table\TableCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TablePopupCell;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;
use App\Classes\Table\TableRow;
use App\Collections\Front\SectionItemsCollection;
use App\Collections\Front\SectionsCollection;
use App\Collections\TableCellsCollection;
use App\Collections\TablePopupItemCollection;
use App\Collections\TableRowsCollection;
use App\Models\Catalog\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TvRepository
{
    /**
     * @param [] $params
     * @return Tv[]
     */
    public static function getTvsByParams($params)
    {
        return Tv::where('model', 'like', '%'.$params['text'].'%')
            ->orWhereHas(
                'brand',
                function ($query) use ($params) {
                    $query->where('name', 'like', '%'.$params['text'].'%');
                }
            )
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param Tv[] $tvs
     * @return Tv[]
     */
    public static function transformTvsForFront($tvs)
    {
        $resultTvs = [];
        foreach ($tvs as $tv) {
            $resultTvs[] = [
                'id' => $tv->getId(),
                'title' => $tv->getName(),
                'description' => $tv->getDescription(),
                'link' => $tv->getLink(),
                'price' => $tv->getPrice(),
                'image' => $tv->getSmallImage(),
                'imageBig' => $tv->getBigImage(),
            ];
        }

        return $resultTvs;
    }

    /**
     * @return Tv[]
     */
    public static function getTvs()
    {
        return Tv::orderBy('id', 'desc')->get();
    }

    /**
     * @param $brand
     * @param $model
     * @return Tv
     */
    public static function getTvsByBrandAndModel($brand, $model)
    {
        $model = str_replace(
            ['-', '~'],
            [' ', '-'],
            str_replace(
                'chr47',
                '/',
                strtolower($model)
            )
        );

        return Tv::where('model', '=', $model)
            ->whereHas(
                'brand',
                function ($query) use ($brand) {
                    $query->where('name', '=', $brand);
                }
            )
            ->first();
    }

    /**
     * @param Tv $tv
     * @return array
     */
    public static function transformTvToFront($tv)
    {
        $sections = new SectionsCollection();

        $section = new Section('Общая информация');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Дата выхода на рынок', $tv->getYear()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Основное характеристики');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Тип экрана', $tv->getScreenType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Диагональ экрана', $tv->getScreenDiagonal()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Разрешение экрана', $tv->getScreenResolution()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Соотношение сторон', $tv->getScreenAspectRatio()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Изогнутый экран');
        $sectionItem->setCheckerValue($tv->isScreenCurved());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Поддержка 3D');
        $sectionItem->setCheckerValue($tv->is3dSupport());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Индекс качества динамичных сцен', $tv->getDynamicScenesQualityIndex());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Smart TV');
        $sectionItem->setCheckerValue($tv->isSmartTv());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Цвет корпуса', $tv->getColorBody()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Цвет рамки', $tv->getColorBorder()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Цвет подставки', $tv->getColorStand()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Подставка', $tv->getStandType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Технические характеристики');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Тип матрицы', $tv->getMatrixType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Локальное затемнение');
        $sectionItem->setCheckerValue($tv->isLocalDimming());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Ковровая LED-подсветка');
        $sectionItem->setCheckerValue($tv->isLedBacklight());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Расширенный дин. диапазон');
        $sectionItem->setCheckerValue($tv->isHdr());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Ядра процессора', $tv->getProcessorCore()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Частота обновления экрана', $tv->getScreenRefreshRate(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Макс. потребляемая мощность', $tv->getMaxPowerConsumption(true));
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Функции');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Беспроводная передача видео');
        $sectionItem->setCheckerValue($tv->isWirelessVideoTransmission());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Видеокамера');
        $sectionItem->setCheckerValue($tv->isVideoCamera());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Фоновая подсветка');
        $sectionItem->setCheckerValue($tv->isBacklight());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Управление голосом');
        $sectionItem->setCheckerValue($tv->isVoiceControl());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Прием сигнала');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('TV-тюнер', $tv->getTvTunersLikeString());
        $sectionItem->setCheckerValue($tv->getTvTunersLikeString());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Два тюнера');
        $sectionItem->setCheckerValue($tv->isTwoTuners());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Аудиосистема');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Сабвуфер');
        $sectionItem->setCheckerValue($tv->isSubwoofer());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Мощность динамиков', $tv->getBuildInSpeakersPower(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Колличество динамиков', $tv->getBuildInSpeakersCount());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Поддержка кодека DTS');
        $sectionItem->setCheckerValue($tv->isDts());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Интерфейсы');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Bluetooth');
        $sectionItem->setCheckerValue($tv->isBluetooth());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Wi-Fi');
        $sectionItem->setCheckerValue($tv->isWiFi());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Wi-Fi Direct');
        $sectionItem->setCheckerValue($tv->isWiFiDirect());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('DisplayPort', $tv->getInputDisplayPort());
        $sectionItem->setCheckerValue($tv->getInputDisplayPort());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Аудиовход', $tv->getInputAudio());
        $sectionItem->setCheckerValue($tv->getInputAudio());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('MHL', $tv->getInputMhl());
        $sectionItem->setCheckerValue($tv->getInputMhl());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Компонентный вход', $tv->getInputComponent());
        $sectionItem->setCheckerValue($tv->getInputComponent());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Композитный вход', $tv->getInputComposite());
        $sectionItem->setCheckerValue($tv->getInputComposite());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('SCART', $tv->getInputScart());
        $sectionItem->setCheckerValue($tv->getInputScart());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('VGA', $tv->getInputVga());
        $sectionItem->setCheckerValue($tv->getInputVga());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('HDMI', $tv->getInputHdmi());
        $sectionItem->setCheckerValue($tv->getInputHdmi());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Цифровой выход S/PDIF', $tv->getInputSpdif());
        $sectionItem->setCheckerValue($tv->getInputSpdif());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Выход на наушники', $tv->getInputHeadphones());
        $sectionItem->setCheckerValue($tv->getInputHeadphones());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 2.0', $tv->getInputUsb20());
        $sectionItem->setCheckerValue($tv->getInputUsb20());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 3.0', $tv->getInputUsb30());
        $sectionItem->setCheckerValue($tv->getInputUsb30());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Ethernet', $tv->getInputEthernet());
        $sectionItem->setCheckerValue($tv->getInputEthernet());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Выносной блок интерфейсов');
        $sectionItem->setCheckerValue($tv->isRemoteInterfaceUnit());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Комплектация');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('3D-очки');
        $sectionItem->setCheckerValue($tv->isGlasses3d());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Smart-пульт');
        $sectionItem->setCheckerValue($tv->isSmartConsole());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Настенное крепление');
        $sectionItem->setCheckerValue($tv->isWallMount());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Размеры и вес');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Крепление VESA', $tv->getVesaWallMount()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Ширина', $tv->getWidth(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Высота с учетом подставки', $tv->getHeightWithStand(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Глубина с учетом подставки', $tv->getDepthWithStand(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Толщина панели', $tv->getThickness(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Вес с подставкой', $tv->getWeight(true));
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $sectionArray = $sections->toArray();

        return [
            'id' => $tv->getId(),
            'title' => $tv->getFullName(),
            'images' => $tv->getBigImages(),
            'image' => $tv->getSmallImage(),
            'imageBig' => $tv->getBigImage(),
            'description' => $tv->getDescription(),
            'quantity' => $tv->getQuantity(),
            'price' => $tv->getPrice(),
            'link' => $tv->getLink(),
            'sections' => $sectionArray,
        ];
    }

    /**
     * @return Tv[]
     */
    public static function getTvsForFront()
    {
        $tvs = Tv::orderBy('id', 'desc')->take(10)->get();

        return self::transformTvsForFront($tvs);
    }

    /**
     * @return Tv[]
     */
    public static function getPopularTvs()
    {
        return Tv::where('is_popular', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
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
                $tv->setIsPopular($request->general_is_popular);
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

                $tv->setImages($request->general_images);
                $tv->setImages($request->general_general_images, true);
                $tv->setTvTuners($request->signal_tuners);
            }
        );
    }
}
