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
use Illuminate\Http\Request;
use App\Models\Catalog\Notebook;
use Illuminate\Support\Facades\DB;

class NotebookRepository
{
    /**
     * @param [] $params
     * @return Notebook[]
     */
    public static function getNotebooksByParams($params)
    {
        return Notebook::where('model', 'like', '%'.$params['text'].'%')
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
     * @param $brand
     * @param $model
     * @param $config
     * @return Notebook
     */
    public static function getNotebooksByBrandAndModel($brand, $model, $config)
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
        $config = str_replace(
            ['-', '~'],
            [' ', '-'],
            str_replace(
                'chr47',
                '/',
                strtolower($config)
            )
        );

        return Notebook::where('model', '=', $model)
            ->whereIn('config', ['', $config])
            ->whereHas(
                'brand',
                function ($query) use ($brand) {
                    $query->where('name', '=', $brand);
                }
            )
            ->first();
    }

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
        $notebooks = Notebook::orderBy('id', 'desc')->take(10)->get();

        return self::transformNotebooksToFront($notebooks);
    }

    /**
     * @param Notebook[] $notebooks
     * @return Notebook[]
     */
    public static function transformNotebooksToFront($notebooks)
    {
        $resultNotebooks = [];
        foreach ($notebooks as $notebook) {
            $resultNotebooks[] = [
                'id' => $notebook->getId(),
                'title' => $notebook->getName(),
                'description' => $notebook->getDescription(),
                'link' => $notebook->getLink(),
                'price' => $notebook->getPrice(),
                'image' => $notebook->getSmallImage(),
                'imageBig' => $notebook->getBigImage(),
                'orderType' => Notebook::ORDER_TYPE,
            ];
        }

        return $resultNotebooks;
    }

    /**
     * @param Notebook $notebook
     * @return array
     */
    public static function transformNotebookToFront($notebook)
    {
        $sections = new SectionsCollection();

        $section = new Section('Общая информация');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Дата выхода на рынок', $notebook->getYear()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Тип', $notebook->getComputerType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Трансформер');
        $sectionItem->setCheckerValue($notebook->isTransformer());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Процессор');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Платформа', $notebook->getProcessorStage()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Процессор', $notebook->getProcessor()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Модель процессора', $notebook->getProcessorModel());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Количество ядер', $notebook->getProcessorCore()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Тактовая частота', $notebook->getProcessorClockFrequency(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Turbo-частота ', $notebook->getProcessorTurboClockFrequency(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Энергопотребление процессора  ', $notebook->getProcessorTdp(true));
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Конструкция');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Цвет корпуса', $notebook->getColorBody()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Цвет крышки', $notebook->getColorRoof()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Материал корпуса', $notebook->getMaterialBody()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Материал крышки', $notebook->getMaterialRoof()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Подсветка корпуса');
        $sectionItem->setCheckerValue($notebook->isBodyBacklight());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Пыле-, влаго-, ударопрочность');
        $sectionItem->setCheckerValue($notebook->isShockproof());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Размеры и вес');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Ширина', $notebook->getWidth(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Глубина', $notebook->getDepth(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Толщина', $notebook->getThickness(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Вес', $notebook->getWeight(true));
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Экран');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Диагональ экрана', $notebook->getScreenDiagonal()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Разрешение экрана', $notebook->getScreenResolution()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Технология экрана', $notebook->getScreenType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Поверхность экрана', $notebook->getScreenSurface()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Сенсорный экран');
        $sectionItem->setCheckerValue($notebook->isTouchScreen());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Поддержка ввода пером');
        $sectionItem->setCheckerValue($notebook->isPenInputSupport());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('3D-экран');
        $sectionItem->setCheckerValue($notebook->isScreen3d());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Оперативная память');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Тип оперативной памяти', $notebook->getRamType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Объём памяти', $notebook->getRamSize()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Максимальный объём памяти', $notebook->getRamMaxSize()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Функции');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Регистрация силы нажатий');
        $sectionItem->setCheckerValue($notebook->isTouchForce());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Хранение данных');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Тип жесткого диска (дисков)', $notebook->getHddTypesLikeString());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Ёмкость жесткого диска', $notebook->getHddSize()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Скорость вращения', $notebook->getHddRotationalSpeed(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Оптический привод');
        $sectionItem->setCheckerValue($notebook->isOod());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Карты памяти', $notebook->getMemoryCardsLikeString());
        $sectionItem->setCheckerValue($notebook->isMemoryCards());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Графика');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem(
            'Графический адаптер',
            $notebook->getGraphicCard()->getName().$notebook->getGraphicCardModel()
        );
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Тип графического адаптера', $notebook->getGraphicCardType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Локальная видеопамять', $notebook->getGraphicMemorySize()->getNameWithDetails());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Камера и звук');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Встроенная камера', $notebook->getBuildInCamera());
        $sectionItem->setCheckerValue($notebook->getBuildInCamera());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Количество пикселей камеры', $notebook->getBuildInCameraPixels());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Встроенный микрофон', $notebook->getBuildInMicrophone());
        $sectionItem->setCheckerValue($notebook->getBuildInMicrophone());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Встроенные динамики', $notebook->getBuildInSpeakers());
        $sectionItem->setCheckerValue($notebook->getBuildInSpeakers());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Клавиатура и тачпад');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Цифровое поле (Numpad)');
        $sectionItem->setCheckerValue($notebook->isNumpad());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Подсветка клавиатуры');
        $sectionItem->setCheckerValue($notebook->isKeyboardBacklight());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Заводская «кириллица» на клавишах');
        $sectionItem->setCheckerValue($notebook->isKeyboardKirill());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Мультимедийная сенсорная панель');
        $sectionItem->setCheckerValue($notebook->isMultiTouchPanel());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Управление курсором', $notebook->getCursorControlType()->getName());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Функциональность');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('Сканер отпечатков пальцев');
        $sectionItem->setCheckerValue($notebook->isFingerprintScanner());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Система управления взглядом');
        $sectionItem->setCheckerValue($notebook->isEyesControl());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('TV-тюнер', $notebook->getTvTunersLikeString());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Интерфейсы');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionCheckerItem('NFC');
        $sectionItem->setCheckerValue($notebook->isNfc());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Bluetooth');
        $sectionItem->setCheckerValue($notebook->isBluetooth());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('LAN', $notebook->getLan());
        $sectionItem->setCheckerValue($notebook->getLan());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Wi-Fi');
        $sectionItem->setCheckerValue($notebook->isWiFi());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Сотовая связь');
        $sectionItem->setCheckerValue($notebook->isMobileConnect());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 2.0', $notebook->getInputUsb20());
        $sectionItem->setCheckerValue($notebook->getInputUsb20());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 3.0', $notebook->getInputUsb30());
        $sectionItem->setCheckerValue($notebook->getInputUsb30());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 3.1A', $notebook->getInputUsb31A());
        $sectionItem->setCheckerValue($notebook->getInputUsb31A());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 3.1B', $notebook->getInputUsb31B());
        $sectionItem->setCheckerValue($notebook->getInputUsb31B());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('USB 3.1C', $notebook->getInputUsb31C());
        $sectionItem->setCheckerValue($notebook->getInputUsb31C());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('VGA (RGB)', $notebook->getInputVga());
        $sectionItem->setCheckerValue($notebook->getInputVga());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('HDMI', $notebook->getInputHdmi());
        $sectionItem->setCheckerValue($notebook->getInputHdmi());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('DisplayPort', $notebook->getInputDisplayPort());
        $sectionItem->setCheckerValue($notebook->getInputDisplayPort());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Thunderbolt', $notebook->getInputThunderbolt());
        $sectionItem->setCheckerValue($notebook->getInputThunderbolt());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Аудио выходы', $notebook->getInputAudio());
        $sectionItem->setCheckerValue($notebook->getInputAudio());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Аккумулятор');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Количество ячеек аккумулятора', $notebook->getBatteryCells());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Запас энергии', $notebook->getEnergyReserve(true));
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionItem('Время работы', $notebook->getWorkingHours(true));
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $section = new Section('Комплектация');
        $sectionItems = new SectionItemsCollection();

        $sectionItem = new SectionItem('Комплект поставки', $notebook->getComplectsLikeString());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Вторая батарея');
        $sectionItem->setCheckerValue($notebook->isSecondBattery());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Мышь');
        $sectionItem->setCheckerValue($notebook->isMouse());
        $sectionItems->pushSectionItem($sectionItem);

        $sectionItem = new SectionCheckerItem('Сумка или чехол');
        $sectionItem->setCheckerValue($notebook->isBag());
        $sectionItems->pushSectionItem($sectionItem);

        $section->setItems($sectionItems);
        $sections->pushSection($section);

        $sectionArray = $sections->toArray();

        return [
            'id' => $notebook->getId(),
            'title' => $notebook->getFullName(),
            'images' => $notebook->getBigImages(),
            'image' => $notebook->getSmallImage(),
            'imageBig' => $notebook->getBigImage(),
            'description' => $notebook->getDescription(),
            'quantity' => $notebook->getQuantity(),
            'price' => $notebook->getPrice(),
            'link' => $notebook->getLink(),
            'sections' => $sectionArray
        ];
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
                $notebook->setIsMemoryCards($request->is_memory_cards);
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
                $notebook->setImages($request->general_general_images, true);
                $notebook->setHddTypes($request->hdd_types);
                $notebook->setMemoryCards($request->memory_cards);
                $notebook->setTvTuners($request->tv_tuner);
                $notebook->setComplects($request->set);
            }
        );
    }
}
