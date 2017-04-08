<?php

namespace App\Http\Controllers;

use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TableTab;
use App\Classes\Widget\WidgetCheckbox;
use App\Classes\Widget\WidgetChosen;
use App\Classes\Widget\WidgetFile;
use App\Classes\Widget\WidgetInput;
use App\Classes\Widget\WidgetSelect;
use App\Classes\Widget\WidgetSimpleFile;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Collections\WidgetCollection;
use App\Models\Database\Complect;
use App\Models\Database\ComputerType;
use App\Models\Database\CursorControlType;
use App\Models\Database\GraphicCard;
use App\Models\Database\GraphicCardType;
use App\Models\Database\HddType;
use App\Models\Database\Material;
use App\Models\Database\MemoryCard;
use App\Models\Database\Processor;
use App\Models\Database\ProcessorCore;
use App\Models\Database\ProcessorStage;
use App\Models\Database\RamType;
use App\Models\Database\ScreenDiagonal;
use App\Models\Database\ScreenResolution;
use App\Models\Database\ScreenSurface;
use App\Models\Database\StorageSize;
use App\Models\Database\TvTuner;
use App\Models\Image;
use App\Repositories\NotebookRepository;
use App\Repositories\TvRepository;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Models\Database\Brand;
use App\Models\Database\ScreenType;
use App\Models\Database\ScreenAspectRatio;
use App\Models\Database\Color;
use App\Models\Database\StandType;
use App\Models\Database\MatrixType;
use App\Models\Database\VesaWallMount;
use App\Models\Database\Year;

class AdminCatalogController extends Controller
{
    public function tvList()
    {
        $table = new Table('Список ноутбуков в каталоге');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Название');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Цена');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('На складе');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Просмотры');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Добавлен', false, TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', false, TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Все', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(TvRepository::tvsToRows(TvRepository::getTvs()));
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            '/admin/catalog/tv/delete'
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            '/admin/catalog/tv/create'
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();

        $page = [
            'title' => 'AnyComp | Панель управления - Каталог телевизоров',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Каталог телевизоров',
            'sub_descr' => 'Можно добавлять, изменять и удалять элементы таблицы.',
            'view_system_name' => 'admin.blocks.table',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }

    public function tvCreateUpdate(Request $request)
    {
        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $tv = TvRepository::getTvById($request->tv_id);

        $widgets = [];

        // Section 1 (general)
        $widgetCollection = new WidgetCollection('Основная информация');

        if ($tv) {
            $widget = new WidgetInput('Ид', 'tv_id', true);
            $widget->setValue($tv->getId());
            $widget->setValueType('hidden');
            $widgetCollection->pushWidget($widget);
        }

        $widget = new WidgetSelect('Бренд', 'general_brand_id', true);
        $widget->setValue($tv ? $tv->getBrand() : false);
        $widget->setSelectItems(Brand::getAll());
        $widget->setAllowAddName('general_brand_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Модель', 'general_model', true);
        $widget->setValue($tv ? $tv->getModel() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSimpleFile('Главное изоображение', 'general_general_images');
        $widget->setValue($tv, Image::PRODUCT_TYPE_TV);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetFile('Изоображения', 'general_images');
        $widget->setValue($tv, Image::PRODUCT_TYPE_TV);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Дата выхода на рынок', 'general_year_id', false);
        $widget->setValue($tv ? $tv->getYear() : false);
        $widget->setSelectItems(Year::getAll());
        $widget->setAllowAddName('general_year_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип экрана', 'general_screen_type_id', false);
        $widget->setValue($tv ? $tv->getScreenType() : false);
        $widget->setSelectItems(ScreenType::getAll());
        $widget->setAllowAddName('general_screen_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Диагональ экрана', 'general_screen_diagonal_id', false);
        $widget->setValue($tv ? $tv->getScreenDiagonal() : false);
        $widget->setSelectItems(ScreenDiagonal::getAll());
        $widget->setAllowAddName('general_screen_diagonal_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Разрешение экрана', 'general_screen_resolution_id', false);
        $widget->setValue($tv ? $tv->getScreenResolution() : false);
        $widget->setSelectItems(ScreenResolution::getAll());
        $widget->setAllowAddName('general_screen_resolution_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Соотношение сторон', 'general_screen_aspect_ratio_id', false);
        $widget->setValue($tv ? $tv->getScreenAspectRatio() : false);
        $widget->setSelectItems(ScreenAspectRatio::getAll());
        $widget->setAllowAddName('general_screen_aspect_ratio_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Изогнутый экран', 'general_screen_curved', false);
        $widget->setValue($tv ? $tv->isScreenCurved() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Поддержка 3D', 'general_3d_support', false);
        $widget->setValue($tv ? $tv->is3dSupport() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Индекс качества динамичных сцен', 'general_dynamic_scenes_quality_index', false);
        $widget->setValue($tv ? $tv->getDynamicScenesQualityIndex() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Smart TV', 'general_smart_tv', false);
        $widget->setValue($tv ? $tv->isSmartTv() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Цвет корпуса', 'general_color_body_id', false);
        $widget->setValue($tv ? $tv->getColorBody() : false);
        $widget->setSelectItems(Color::getAll());
        $widget->setAllowAddName('general_screen_color_body_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Цвет рамки', 'general_color_border_id', false);
        $widget->setValue($tv ? $tv->getColorBorder() : false);
        $widget->setSelectItems(Color::getAll());
        $widget->setAllowAddName('general_screen_color_border_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Цвет подставки', 'general_color_stand_id', false);
        $widget->setValue($tv ? $tv->getColorStand() : false);
        $widget->setSelectItems(Color::getAll());
        $widget->setAllowAddName('general_screen_color_stand_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Подставка', 'general_stand_type_id', false);
        $widget->setValue($tv ? $tv->getStandType() : false);
        $widget->setSelectItems(StandType::getAll());
        $widget->setAllowAddName('general_stand_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Колличество (шт)', 'general_quantity', false);
        $widget->setValue($tv ? $tv->getQuantity() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Цена', 'general_price', true);
        $widget->setValue($tv ? $tv->getPrice() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Популярный', 'general_is_popular', false);
        $widget->setValue($tv ? $tv->isPopular() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 2 (configuration)
        $widgetCollection = new WidgetCollection('Технические характеристики');

        $widget = new WidgetSelect('Тип матрицы', 'config_matrix_type_id', false);
        $widget->setValue($tv ? $tv->getMatrixType() : false);
        $widget->setSelectItems(MatrixType::getAll());
        $widget->setAllowAddName('config_matrix_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Smart TV', 'config_local_dimming', false);
        $widget->setValue($tv ? $tv->isLocalDimming() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Ковровая LED-подсветка', 'config_led_backlight', false);
        $widget->setValue($tv ? $tv->isLedBacklight() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Расширенный дин. диапазон', 'config_hdr', false);
        $widget->setValue($tv ? $tv->isHdr() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Ядра процессора (шт.)', 'config_processor_core_id', false);
        $widget->setValue($tv ? $tv->getProcessorCore() : false);
        $widget->setSelectItems(ProcessorCore::getAll());
        $widget->setAllowAddName('config_processor_core_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Частота обновления экрана (Гц)', 'config_screen_refresh_rate', false);
        $widget->setValue($tv ? $tv->getScreenRefreshRate() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Макс. потребляемая мощность (Вт)', 'config_max_power_consumption', false);
        $widget->setValue($tv ? $tv->getMaxPowerConsumption() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 3 (functions)
        $widgetCollection = new WidgetCollection('Функции');

        $widget = new WidgetCheckbox('Беспроводная передача видео', 'function_wireless_video_transmission', false);
        $widget->setValue($tv ? $tv->isWirelessVideoTransmission() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Видеокамера', 'function_video_camera', false);
        $widget->setValue($tv ? $tv->isVideoCamera() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Фоновая подсветка', 'function_backlight', false);
        $widget->setValue($tv ? $tv->isBacklight() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Управление голосом', 'function_voice_control', false);
        $widget->setValue($tv ? $tv->isVoiceControl() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Частота обновления экрана (Гц)', 'config_screen_refresh_rate', false);
        $widget->setValue($tv ? $tv->getScreenRefreshRate() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 4 (in signal)
        $widgetCollection = new WidgetCollection('Прием сигнала');

        $widget = new WidgetChosen('TV-тюнер', 'signal_tuners', false);
        $widget->setValue($tv ? $tv->getTvTuners() : false);
        $widget->setChosenItems(TvTuner::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Два тюнера', 'signal_two_tuners', false);
        $widget->setValue($tv ? $tv->isDts() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 5 (audio system)
        $widgetCollection = new WidgetCollection('Аудиосистема');

        $widget = new WidgetCheckbox('Сабвуфер', 'audio_subwoofer', false);
        $widget->setValue($tv ? $tv->isSubwoofer() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Мощность динамиков (Вт)', 'audio_build_in_speakers_power', false);
        $widget->setValue($tv ? $tv->getBuildInSpeakersPower() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Колличество динамиков', 'audio_build_in_speakers_count', false);
        $widget->setValue($tv ? $tv->getBuildInSpeakersPower() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Поддержка кодека DTS', 'audio_dts', false);
        $widget->setValue($tv ? $tv->isDts() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 6 (interfaces)
        $widgetCollection = new WidgetCollection('Интерфейсы');

        $widget = new WidgetCheckbox('Bluetooth', 'interface_bluetooth', false);
        $widget->setValue($tv ? $tv->isBluetooth() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Wi-Fi', 'interface_wi_fi', false);
        $widget->setValue($tv ? $tv->isWiFi() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Wi-Fi Direct', 'interface_wi_fi_direct', false);
        $widget->setValue($tv ? $tv->isWiFiDirect() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('DisplayPort (шт.)', 'interface_input_display_port', false);
        $widget->setValue($tv ? $tv->getInputDisplayPort() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Аудиовход (шт.)', 'interface_input_audio', false);
        $widget->setValue($tv ? $tv->getInputAudio() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('MHL (шт.)', 'interface_input_mhl', false);
        $widget->setValue($tv ? $tv->getInputMhl() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Компонентный вход (шт.)', 'interface_input_component', false);
        $widget->setValue($tv ? $tv->getInputComponent() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Композитный вход (шт.)', 'interface_input_composite', false);
        $widget->setValue($tv ? $tv->getInputComposite() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('SCART (шт.)', 'interface_input_scart', false);
        $widget->setValue($tv ? $tv->getInputScart() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('VGA (шт.)', 'interface_input_vga', false);
        $widget->setValue($tv ? $tv->getInputVga() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('HDMI (шт.)', 'interface_input_hdmi', false);
        $widget->setValue($tv ? $tv->getInputHdmi() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Цифровой выход S/PDIF (шт.)', 'interface_input_spdif', false);
        $widget->setValue($tv ? $tv->getInputSpdif() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Выход на наушники (шт.)', 'interface_input_headphones', false);
        $widget->setValue($tv ? $tv->getInputHeadphones() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 2.0 (шт.)', 'interface_input_usb20', false);
        $widget->setValue($tv ? $tv->getInputUsb20() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 3.0 (шт.)', 'interface_input_usb30', false);
        $widget->setValue($tv ? $tv->getInputUsb30() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Ethernet (шт.)', 'interface_input_ethernet', false);
        $widget->setValue($tv ? $tv->getInputEthernet() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Выносной блок интерфейсов', 'interface_remote_interface_unit', false);
        $widget->setValue($tv ? $tv->isRemoteInterfaceUnit() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 7 (complect)
        $widgetCollection = new WidgetCollection('Комплектация');

        $widget = new WidgetCheckbox('3D-очки', 'complect_glasses_3d', false);
        $widget->setValue($tv ? $tv->isGlasses3d() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Smart-пульт', 'complect_smart_console', false);
        $widget->setValue($tv ? $tv->isSmartConsole() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Настенное крепление', 'complect_wall_mount', false);
        $widget->setValue($tv ? $tv->isWallMount() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 8 (sizes)
        $widgetCollection = new WidgetCollection('Размеры и вес');

        $widget = new WidgetSelect('Крепление VESA', 'sizes_vesa_id', false);
        $widget->setValue($tv ? $tv->getVesaWallMount() : false);
        $widget->setSelectItems(VesaWallMount::getAll());
        $widget->setAllowAddName('sizes_vesa_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Ширина (мм)', 'sizes_width', false);
        $widget->setValue($tv ? $tv->getWidth() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Высота с учетом подставки (мм)', 'sizes_height_with_stand', false);
        $widget->setValue($tv ? $tv->getHeightWithStand() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Глубина с учетом подставки (мм)', 'sizes_depth_with_stand', false);
        $widget->setValue($tv ? $tv->getDepthWithStand() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Толщина панели (мм)', 'sizes_thickness', false);
        $widget->setValue($tv ? $tv->getThickness() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Вес с подставкой (мм)', 'sizes_weight', false);
        $widget->setValue($tv ? $tv->getWeight() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = array(
            'widgets' => $widgets,
            'url' => '/admin/catalog/tv/save',
        );

        $page = [
            'title' => 'AnyComp | Панель управления - Добавление телевизора в каталог',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Добавление телевизора в каталог',
            'sub_descr' => 'Будьте внимательны, заполняя поля формы.',
            'view_system_name' => 'admin.blocks.form',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    public function tvSave(Request $request)
    {
        TvRepository::saveTv($request);

        return redirect()->route('admin.catalog.tv.list');
    }

    public function tvDelete(Request $request)
    {
        TvRepository::removeTvs($request->deleteItems);

        return redirect()->route('admin.catalog.tv.list');
    }

    public function notebookList()
    {
        $table = new Table('Список ноутбуков в каталоге');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Название');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Цена');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('На складе');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Просмотры');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Добавлен', false, TableField::SORT_TYPE_SORTABLE);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('', false, TableField::SORT_TYPE_NO_SORTABLE);
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Все', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(NotebookRepository::notebooksToRows(NotebookRepository::getNotebooks()));
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            '/admin/catalog/notebook/delete'
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_EXTERNAL,
            '/admin/catalog/notebook/create'
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();

        $page = [
            'title' => 'AnyComp | Панель управления - Каталог ноутбуков',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Каталог ноутбуков',
            'sub_descr' => 'Можно добавлять, изменять и удалять элементы таблицы.',
            'view_system_name' => 'admin.blocks.table',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'table' => $table->toArray(),
            ]
        );
    }

    public function notebookCreateUpdate(Request $request)
    {
        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $notebook = NotebookRepository::getNotebookById($request->notebook_id);

        $widgets = [];

        // Section 1 (general)
        $widgetCollection = new WidgetCollection('Основная информация');

        if ($notebook) {
            $widget = new WidgetInput('Ид', 'notebook_id', true);
            $widget->setValue($notebook->getId());
            $widget->setValueType('hidden');
            $widgetCollection->pushWidget($widget);
        }

        $widget = new WidgetSelect('Бренд', 'general_brand_id', true);
        $widget->setValue($notebook ? $notebook->getBrand() : false);
        $widget->setSelectItems(Brand::getAll());
        $widget->setAllowAddName('general_brand_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Модель', 'general_model', true);
        $widget->setValue($notebook ? $notebook->getModel() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Конфигурация', 'general_config', false);
        $widget->setValue($notebook ? $notebook->getConfig() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSimpleFile('Главное изоображение', 'general_general_images');
        $widget->setValue($notebook, Image::PRODUCT_TYPE_NOTEBOOK);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetFile('Изоображения', 'general_images');
        $widget->setValue($notebook, Image::PRODUCT_TYPE_NOTEBOOK);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип', 'general_computer_type_id', false);
        $widget->setValue($notebook ? $notebook->getComputerType() : false);
        $widget->setSelectItems(ComputerType::getAll());
        $widget->setAllowAddName('general_computer_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Трансформер', 'general_transformer', false);
        $widget->setValue($notebook ? $notebook->isTransformer() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Дата выхода на рынок', 'general_year_id', false);
        $widget->setValue($notebook ? $notebook->getYear() : false);
        $widget->setSelectItems(Year::getAll());
        $widget->setAllowAddName('general_year_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Колличество (шт)', 'general_quantity', false);
        $widget->setValue($notebook ? $notebook->getQuantity() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Цена', 'general_price', false);
        $widget->setValue($notebook ? $notebook->getPrice() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Популярный', 'general_is_popular', false);
        $widget->setValue($notebook ? $notebook->isPopular() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 2 (processor)

        $widgetCollection = new WidgetCollection('Процессор');

        $widget = new WidgetSelect('Платформа', 'processor_stage_id', false);
        $widget->setValue($notebook ? $notebook->getProcessorStage() : false);
        $widget->setSelectItems(ProcessorStage::getAll());
        $widget->setAllowAddName('processor_stage_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Процессор', 'processor_id', false);
        $widget->setValue($notebook ? $notebook->getProcessor() : false);
        $widget->setSelectItems(Processor::getAll());
        $widget->setAllowAddName('processor_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Модель процессора', 'processor_model', false);
        $widget->setValue($notebook ? $notebook->getProcessorModel() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Количество ядер', 'processor_core_id', false);
        $widget->setValue($notebook ? $notebook->getProcessorCore() : false);
        $widget->setSelectItems(ProcessorCore::getAll());
        $widget->setAllowAddName('processor_core_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Тактовая частота (МГц)', 'processor_clock_frequency', false);
        $widget->setValue($notebook ? $notebook->getProcessorClockFrequency() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Turbo-частота (МГц)', 'processor_turbo_clock_frequency', false);
        $widget->setValue($notebook ? $notebook->getProcessorTurboClockFrequency() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Энергопотребление процессора (TDP)', 'processor_tdp', false);
        $widget->setValue($notebook ? $notebook->getProcessorTdp() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 3 (body)

        $widgetCollection = new WidgetCollection('Конструкция');

        $widget = new WidgetSelect('Цвет корпуса', 'color_body_id', false);
        $widget->setValue($notebook ? $notebook->getColorBody() : false);
        $widget->setSelectItems(Color::getAll());
        $widget->setAllowAddName('color_body_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Цвет крышки', 'color_roof_id', false);
        $widget->setValue($notebook ? $notebook->getColorRoof() : false);
        $widget->setSelectItems(Color::getAll());
        $widget->setAllowAddName('color_roof_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Материал корпуса', 'material_body_id', false);
        $widget->setValue($notebook ? $notebook->getMaterialBody() : false);
        $widget->setSelectItems(Material::getAll());
        $widget->setAllowAddName('material_body_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Материал крышки', 'material_roof_id', false);
        $widget->setValue($notebook ? $notebook->getMaterialRoof() : false);
        $widget->setSelectItems(Material::getAll());
        $widget->setAllowAddName('material_roof_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Подсветка корпуса', 'body_backlight', false);
        $widget->setValue($notebook ? $notebook->isBodyBacklight() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Пыле-, влаго-, ударопрочность', 'shockproof', false);
        $widget->setValue($notebook ? $notebook->isShockproof() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 4 (size)

        $widgetCollection = new WidgetCollection('Размеры и вес');

        $widget = new WidgetInput('Ширина (мм)', 'width', false);
        $widget->setValue($notebook ? $notebook->getWidth() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Глубина (мм)', 'depth', false);
        $widget->setValue($notebook ? $notebook->getDepth() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Толщина (мм)', 'thickness', false);
        $widget->setValue($notebook ? $notebook->getThickness() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Вес (г)', 'weight', false);
        $widget->setValue($notebook ? $notebook->getWeight() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 5 (screen)

        $widgetCollection = new WidgetCollection('Экран');

        $widget = new WidgetSelect('Диагональ экрана', 'screen_diagonal_id', false);
        $widget->setValue($notebook ? $notebook->getScreenDiagonal() : false);
        $widget->setSelectItems(ScreenDiagonal::getAll());
        $widget->setAllowAddName('screen_diagonal_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Разрешение экрана', 'screen_resolution_id', false);
        $widget->setValue($notebook ? $notebook->getScreenResolution() : false);
        $widget->setSelectItems(ScreenResolution::getAll());
        $widget->setAllowAddName('screen_resolution_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Технология экрана', 'screen_type_id', false);
        $widget->setValue($notebook ? $notebook->getScreenType() : false);
        $widget->setSelectItems(ScreenType::getAll());
        $widget->setAllowAddName('screen_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Поверхность экрана', 'screen_surface_id', false);
        $widget->setValue($notebook ? $notebook->getScreenSurface() : false);
        $widget->setSelectItems(ScreenSurface::getAll());
        $widget->setAllowAddName('screen_surface_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Сенсорный экран', 'touch_screen', false);
        $widget->setValue($notebook ? $notebook->isTouchScreen() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Поддержка ввода пером', 'pen_input_support', false);
        $widget->setValue($notebook ? $notebook->isPenInputSupport() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('3D-экран', 'screen_3d', false);
        $widget->setValue($notebook ? $notebook->isScreen3d() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 6 (ram)

        $widgetCollection = new WidgetCollection('Оперативная память');

        $widget = new WidgetSelect('Тип оперативной памяти', 'ram_type_id', false);
        $widget->setValue($notebook ? $notebook->getRamType() : false);
        $widget->setSelectItems(RamType::getAll());
        $widget->setAllowAddName('ram_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Объём памяти (Гб)', 'ram_size_id', false);
        $widget->setValue($notebook ? $notebook->getRamSize() : false);
        $widget->setSelectItems(StorageSize::getAll());
        $widget->setAllowAddName('ram_size_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Максимальный объём памяти (Гб)', 'ram_max_size_id', false);
        $widget->setValue($notebook ? $notebook->getRamMaxSize() : false);
        $widget->setSelectItems(StorageSize::getAll());
        $widget->setAllowAddName('ram_max_size_new');
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 7 (functions)

        $widgetCollection = new WidgetCollection('Функции');

        $widget = new WidgetCheckbox('Регистрация силы нажатий', 'touch_force', false);
        $widget->setValue($notebook ? $notebook->isTouchForce() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 8 (hdd)

        $widgetCollection = new WidgetCollection('Хранение данных');

        $widget = new WidgetChosen('Тип жесткого диска (дисков)', 'hdd_types', false);
        $widget->setValue($notebook ? $notebook->getHddTypes() : false);
        $widget->setChosenItems(HddType::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Ёмкость жесткого диска (Гб)', 'hdd_size_id', false);
        $widget->setValue($notebook ? $notebook->getHddSize() : false);
        $widget->setSelectItems(StorageSize::getAll());
        $widget->setAllowAddName('hdd_size_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Ёмкость SSD (Гб)', 'ssd_size_id', false);
        $widget->setValue($notebook ? $notebook->getSsdSize() : false);
        $widget->setSelectItems(StorageSize::getAll());
        $widget->setAllowAddName('ssd_size_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Скорость вращения (RPM)', 'hdd_rotational_speed', false);
        $widget->setValue($notebook ? $notebook->getHddRotationalSpeed() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Оптический привод (ODD)', 'ood', false);
        $widget->setValue($notebook ? $notebook->isOod() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Карты памяти', 'is_memory_cards', false);
        $widget->setValue($notebook ? $notebook->isMemoryCards() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetChosen('Типы карт памяти', 'memory_cards', false);
        $widget->setValue($notebook ? $notebook->getMemoryCards() : false);
        $widget->setChosenItems(MemoryCard::getAll());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 9 (graphic)

        $widgetCollection = new WidgetCollection('Графика');

        $widget = new WidgetSelect('Графический адаптер', 'graphic_card_id', false);
        $widget->setValue($notebook ? $notebook->getGraphicCard() : false);
        $widget->setSelectItems(GraphicCard::getAll());
        $widget->setAllowAddName('graphic_card_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Тип графического адаптера', 'graphic_card_type_id', false);
        $widget->setValue($notebook ? $notebook->getGraphicCardType() : false);
        $widget->setSelectItems(GraphicCardType::getAll());
        $widget->setAllowAddName('graphic_card_type_new');
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Модель графического адаптера', 'graphic_card_model', false);
        $widget->setValue($notebook ? $notebook->getGraphicCardModel() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Локальная видеопамять (Гб)', 'graphic_memory_size_id', false);
        $widget->setValue($notebook ? $notebook->getGraphicMemorySize() : false);
        $widget->setSelectItems(StorageSize::getAll());
        $widget->setAllowAddName('graphic_memory_size_new');
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 10 (camera)

        $widgetCollection = new WidgetCollection('Камера и звук');

        $widget = new WidgetInput('Встроенная камера (шт)', 'build_in_camera', false);
        $widget->setValue($notebook ? $notebook->getBuildInCamera() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Количество пикселей камеры (Мп)', 'build_in_camera_pixels', false);
        $widget->setValue($notebook ? $notebook->getBuildInCameraPixels() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Встроенный микрофон (шт)', 'build_in_microphone', false);
        $widget->setValue($notebook ? $notebook->getBuildInMicrophone() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Встроенные динамики (шт)', 'build_in_speakers', false);
        $widget->setValue($notebook ? $notebook->getBuildInSpeakers() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 11 (keyboard)

        $widgetCollection = new WidgetCollection('Клавиатура и тачпад');

        $widget = new WidgetCheckbox('Цифровое поле (Numpad)', 'numpad', false);
        $widget->setValue($notebook ? $notebook->isNumpad() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Подсветка клавиатуры', 'keyboard_backlight', false);
        $widget->setValue($notebook ? $notebook->isKeyboardBacklight() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Заводская «кириллица» на клавишах', 'keyboard_kirill', false);
        $widget->setValue($notebook ? $notebook->isKeyboardKirill() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Мультимедийная сенсорная панель', 'multi_touch_panel', false);
        $widget->setValue($notebook ? $notebook->isMultiTouchPanel() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetSelect('Управление курсором', 'cursor_control_type_id', false);
        $widget->setValue($notebook ? $notebook->getCursorControlType() : false);
        $widget->setSelectItems(CursorControlType::getAll());
        $widget->setAllowAddName('cursor_control_type_new');
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 12 (functionality)

        $widgetCollection = new WidgetCollection('Функциональность');

        $widget = new WidgetCheckbox('Сканер отпечатков пальцев', 'fingerprint_scanner', false);
        $widget->setValue($notebook ? $notebook->isFingerprintScanner() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Система управления взглядом', 'eyes_control', false);
        $widget->setValue($notebook ? $notebook->isEyesControl() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetChosen('TV-тюнер', 'tv_tuner', false);
        $widget->setValue($notebook ? $notebook->getTvTuners() : false);
        $widget->setChosenItems(TvTuner::getAll());
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 13 (interfaces)

        $widgetCollection = new WidgetCollection('Интерфейсы');

        $widget = new WidgetCheckbox('NFC', 'nfc', false);
        $widget->setValue($notebook ? $notebook->isNfc() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Bluetooth', 'bluetooth', false);
        $widget->setValue($notebook ? $notebook->isBluetooth() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('LAN (шт)', 'lan', false);
        $widget->setValue($notebook ? $notebook->getLan() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Wi-Fi', 'wi_fi', false);
        $widget->setValue($notebook ? $notebook->isWiFi() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Сотовая связь', 'mobile_connect', false);
        $widget->setValue($notebook ? $notebook->isMobileConnect() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 2.0 (шт)', 'input_usb20', false);
        $widget->setValue($notebook ? $notebook->getInputUsb20() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 3.0 (шт)', 'input_usb30', false);
        $widget->setValue($notebook ? $notebook->getInputUsb30() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 3.1A (шт)', 'input_usb31a', false);
        $widget->setValue($notebook ? $notebook->getInputUsb31A() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 3.1B (шт)', 'input_usb31b', false);
        $widget->setValue($notebook ? $notebook->getInputUsb31B() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('USB 3.1C (шт)', 'input_usb31c', false);
        $widget->setValue($notebook ? $notebook->getInputUsb31C() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('VGA (RGB) (шт)', 'input_vga', false);
        $widget->setValue($notebook ? $notebook->getInputVga() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('HDMI (шт)', 'input_hdmi', false);
        $widget->setValue($notebook ? $notebook->getInputHdmi() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('DisplayPort (шт)', 'input_display_port', false);
        $widget->setValue($notebook ? $notebook->getInputDisplayPort() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Thunderbolt (шт)', 'input_thunderbolt', false);
        $widget->setValue($notebook ? $notebook->getInputThunderbolt() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Аудио выходы (шт)', 'input_audio', false);
        $widget->setValue($notebook ? $notebook->getInputAudio() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 14 (accumulator)

        $widgetCollection = new WidgetCollection('Аккумулятор');

        $widget = new WidgetInput('Количество ячеек аккумулятора (шт)', 'battery_cells', false);
        $widget->setValue($notebook ? $notebook->getBatteryCells() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Запас энергии (Вт*ч)', 'energy_reserve', false);
        $widget->setValue($notebook ? $notebook->getEnergyReserve() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetInput('Время работы (ч)', 'working_hours', false);
        $widget->setValue($notebook ? $notebook->getWorkingHours() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        // Section 15 (set)

        $widgetCollection = new WidgetCollection('Комплектация');

        $widget = new WidgetChosen('Комплект поставки', 'set', false);
        $widget->setValue($notebook ? $notebook->getComplects() : false);
        $widget->setChosenItems(Complect::getAll());
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Вторая батарея', 'second_battery', false);
        $widget->setValue($notebook ? $notebook->isSecondBattery() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Мышь', 'mouse', false);
        $widget->setValue($notebook ? $notebook->isMouse() : false);
        $widgetCollection->pushWidget($widget);

        $widget = new WidgetCheckbox('Сумка или чехол', 'bag', false);
        $widget->setValue($notebook ? $notebook->isBag() : false);
        $widgetCollection->pushWidget($widget);

        $widgets[] = $widgetCollection->toArray();

        $form = array(
            'widgets' => $widgets,
            'url' => '/admin/catalog/notebook/save',
        );

        $page = [
            'title' => 'AnyComp | Панель управления - Добавление ноутбука в каталог',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Добавление ноутбука в каталог',
            'sub_descr' => 'Будьте внимательны, заполняя поля формы.',
            'view_system_name' => 'admin.blocks.form',
        ];

        return view(
            $page['view_system_name'],
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'form' => $form,
            ]
        );
    }

    public function notebookSave(Request $request)
    {
        NotebookRepository::saveNotebook($request);

        return redirect()->route('admin.catalog.notebook.list');
    }

    public function notebookDelete(Request $request)
    {
        NotebookRepository::removeNotebooks($request->deleteItems);

        return redirect()->route('admin.catalog.notebook.list');
    }
}
