<?php

namespace App\Http\Controllers;

use App\Classes\Table\Table;
use App\Classes\Table\TableAction;
use App\Classes\Table\TableField;
use App\Classes\Table\TableTab;
use App\Collections\TableActionCollection;
use App\Collections\TableFieldCollection;
use App\Collections\TableTabCollection;
use App\Models\Database\ReceptionPlace;
use App\Models\Database\Brand;
use App\Models\Database\CityType;
use App\Models\Database\Complect;
use App\Models\Database\ComputerType;
use App\Models\Database\CursorControlType;
use App\Models\Database\GraphicCard;
use App\Models\Database\GraphicCardType;
use App\Models\Database\HddType;
use App\Models\Database\Material;
use App\Models\Database\MemoryCard;
use App\Models\Database\Organization;
use App\Models\Database\Processor;
use App\Models\Database\ProcessorCore;
use App\Models\Database\ProcessorStage;
use App\Models\Database\RamType;
use App\Models\Database\ScreenSurface;
use App\Models\Database\StorageSize;
use App\Models\Database\TvTuner;
use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminMenu;
use App\Models\Database\Category;
use App\Models\Database\ScreenType;
use App\Models\Database\ScreenResolution;
use App\Models\Database\ScreenDiagonal;
use App\Models\Database\ScreenAspectRatio;
use App\Models\Database\Color;
use App\Models\Database\StandType;
use App\Models\Database\MatrixType;
use App\Models\Database\VesaWallMount;
use App\Models\Database\Year;

class DatabaseController extends Controller
{
    public function db(Request $request)
    {
        $class = null;
        $requestDbClass = $request->db_class;
        switch ($requestDbClass) {
            case 'categories' : {
                $class = Category::class;
                break;
            }
            case 'brands' : {
                $class = Brand::class;
                break;
            }
            case 'organizations' : {
                $class = Organization::class;
                break;
            }
            case 'screen-types' : {
                $class = ScreenType::class;
                break;
            }
            case 'screen-resolutions' : {
                $class = ScreenResolution::class;
                break;
            }
            case 'screen-diagonals' : {
                $class = ScreenDiagonal::class;
                break;
            }
            case 'screen-aspect-ratios' : {
                $class = ScreenAspectRatio::class;
                break;
            }
            case 'colors' : {
                $class = Color::class;
                break;
            }
            case 'stand-types' : {
                $class = StandType::class;
                break;
            }
            case 'matrix-types' : {
                $class = MatrixType::class;
                break;
            }
            case 'vesa-wall-mounts' : {
                $class = VesaWallMount::class;
                break;
            }
            case 'years' : {
                $class = Year::class;
                break;
            }
            case 'tv-tuners' : {
                $class = TvTuner::class;
                break;
            }
            case 'processor-cores' : {
                $class = ProcessorCore::class;
                break;
            }
            case 'city-types' : {
                $class = CityType::class;
                break;
            }
            case 'computer-types' : {
                $class = ComputerType::class;
                break;
            }
            case 'processor-stages' : {
                $class = ProcessorStage::class;
                break;
            }
            case 'processors' : {
                $class = Processor::class;
                break;
            }
            case 'materials' : {
                $class = Material::class;
                break;
            }
            case 'screen-surfaces' : {
                $class = ScreenSurface::class;
                break;
            }
            case 'ram-types' : {
                $class = RamType::class;
                break;
            }
            case 'hdd-types' : {
                $class = HddType::class;
                break;
            }
            case 'memory-cards' : {
                $class = MemoryCard::class;
                break;
            }
            case 'graphic-cards' : {
                $class = GraphicCard::class;
                break;
            }
            case 'graphic-card-types' : {
                $class = GraphicCardType::class;
                break;
            }
            case 'cursor-control-types' : {
                $class = CursorControlType::class;
                break;
            }
            case 'complects' : {
                $class = Complect::class;
                break;
            }
            case 'storage-sizes' : {
                $class = StorageSize::class;
                break;
            }
            case 'reception-places' : {
                $class = ReceptionPlace::class;
                break;
            }
            default : {
                return redirect()->route('admin');
            }
        }
        $table = new Table('База данных');

        // Table fields
        $tableFields = new TableFieldCollection();

        $tableField = new TableField('', '50px', TableField::SORT_TYPE_NO_SORTABLE, TableField::CLASS_CHECKER);
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('№', '50px');
        $tableFields->pushTableField($tableField);

        $tableField = new TableField('Название');
        $tableFields->pushTableField($tableField);

        $table->setTableFields($tableFields);

        // Table tabs
        $tableTabs = new TableTabCollection();

        $tableTab = new TableTab('Вcе', TableTab::STATUS_ACTIVE);
        $tableTab->setRows(DatabaseRepository::databaseToRows(DatabaseRepository::getDatabaseItems($class)));
        $tableTabs->pushTableTab($tableTab);

        $table->setTableTabs($tableTabs);

        // Table actions
        $tableActions = new TableActionCollection();

        $tableAction = new TableAction(
            TableAction::TYPE_DELETE,
            TableAction::FORM_INLINE,
            '/admin/db/'.$requestDbClass.'/remove'
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_CREATE,
            TableAction::FORM_INLINE,
            '/admin/db/'.$requestDbClass.'/save'
        );
        $tableActions->pushTableAction($tableAction);

        $tableAction = new TableAction(
            TableAction::TYPE_UPDATE,
            TableAction::FORM_INLINE,
            '/admin/db/'.$requestDbClass.'/save'
        );
        $tableActions->pushTableAction($tableAction);

        $table->setTableActions($tableActions);

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();

        $page = [
            'title' => 'AnyComp | Панель управления - Редактирование базы данных',
            'css' => '/styles/admin.min.css',
            'css_header' => '',
            'sub_title' => 'Редактирование базы данных',
            'sub_descr' => 'Вы можете добавлять, изменять и удалять элементы их списка элементов базы данных.',
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

    public function dbRemove(Request $request)
    {
        $class = null;
        $requestDbClass = $request->db_class;
        switch ($requestDbClass) {
            case 'categories' : {
                $class = Category::class;
                break;
            }
            case 'brands' : {
                $class = Brand::class;
                break;
            }
            case 'organizations' : {
                $class = Organization::class;
                break;
            }
            case 'screen-types' : {
                $class = ScreenType::class;
                break;
            }
            case 'screen-resolutions' : {
                $class = ScreenResolution::class;
                break;
            }
            case 'screen-diagonals' : {
                $class = ScreenDiagonal::class;
                break;
            }
            case 'screen-aspect-ratios' : {
                $class = ScreenAspectRatio::class;
                break;
            }
            case 'colors' : {
                $class = Color::class;
                break;
            }
            case 'stand-types' : {
                $class = StandType::class;
                break;
            }
            case 'matrix-types' : {
                $class = MatrixType::class;
                break;
            }
            case 'vesa-wall-mounts' : {
                $class = VesaWallMount::class;
                break;
            }
            case 'years' : {
                $class = Year::class;
                break;
            }
            case 'tv-tuners' : {
                $class = TvTuner::class;
                break;
            }
            case 'processor-cores' : {
                $class = ProcessorCore::class;
                break;
            }
            case 'city-types' : {
                $class = CityType::class;
                break;
            }
            case 'computer-types' : {
                $class = ComputerType::class;
                break;
            }
            case 'processor-stages' : {
                $class = ProcessorStage::class;
                break;
            }
            case 'processors' : {
                $class = Processor::class;
                break;
            }
            case 'materials' : {
                $class = Material::class;
                break;
            }
            case 'screen-surfaces' : {
                $class = ScreenSurface::class;
                break;
            }
            case 'ram-types' : {
                $class = RamType::class;
                break;
            }
            case 'hdd-types' : {
                $class = HddType::class;
                break;
            }
            case 'memory-cards' : {
                $class = MemoryCard::class;
                break;
            }
            case 'graphic-cards' : {
                $class = GraphicCard::class;
                break;
            }
            case 'graphic-card-types' : {
                $class = GraphicCardType::class;
                break;
            }
            case 'cursor-control-types' : {
                $class = CursorControlType::class;
                break;
            }
            case 'complects' : {
                $class = Complect::class;
                break;
            }
            case 'storage-sizes' : {
                $class = StorageSize::class;
                break;
            }
            case 'reception-places' : {
                $class = ReceptionPlace::class;
                break;
            }
            default : {
                return redirect()->route('admin');
            }
        }

        DatabaseRepository::removeDatabaseItems($class, $request->deleteItems);

        return redirect()->route('admin.db', ['db_class' => $requestDbClass]);
    }

    public function dbSave(Request $request)
    {
        $class = null;
        $requestDbClass = $request->db_class;
        switch ($requestDbClass) {
            case 'categories' : {
                $class = Category::class;
                break;
            }
            case 'brands' : {
                $class = Brand::class;
                break;
            }
            case 'organizations' : {
                $class = Organization::class;
                break;
            }
            case 'screen-types' : {
                $class = ScreenType::class;
                break;
            }
            case 'screen-resolutions' : {
                $class = ScreenResolution::class;
                break;
            }
            case 'screen-diagonals' : {
                $class = ScreenDiagonal::class;
                break;
            }
            case 'screen-aspect-ratios' : {
                $class = ScreenAspectRatio::class;
                break;
            }
            case 'colors' : {
                $class = Color::class;
                break;
            }
            case 'stand-types' : {
                $class = StandType::class;
                break;
            }
            case 'matrix-types' : {
                $class = MatrixType::class;
                break;
            }
            case 'vesa-wall-mounts' : {
                $class = VesaWallMount::class;
                break;
            }
            case 'years' : {
                $class = Year::class;
                break;
            }
            case 'tv-tuners' : {
                $class = TvTuner::class;
                break;
            }
            case 'processor-cores' : {
                $class = ProcessorCore::class;
                break;
            }
            case 'city-types' : {
                $class = CityType::class;
                break;
            }
            case 'computer-types' : {
                $class = ComputerType::class;
                break;
            }
            case 'processor-stages' : {
                $class = ProcessorStage::class;
                break;
            }
            case 'processors' : {
                $class = Processor::class;
                break;
            }
            case 'materials' : {
                $class = Material::class;
                break;
            }
            case 'screen-surfaces' : {
                $class = ScreenSurface::class;
                break;
            }
            case 'ram-types' : {
                $class = RamType::class;
                break;
            }
            case 'hdd-types' : {
                $class = HddType::class;
                break;
            }
            case 'memory-cards' : {
                $class = MemoryCard::class;
                break;
            }
            case 'graphic-cards' : {
                $class = GraphicCard::class;
                break;
            }
            case 'graphic-card-types' : {
                $class = GraphicCardType::class;
                break;
            }
            case 'cursor-control-types' : {
                $class = CursorControlType::class;
                break;
            }
            case 'complects' : {
                $class = Complect::class;
                break;
            }
            case 'storage-sizes' : {
                $class = StorageSize::class;
                break;
            }
            case 'reception-places' : {
                $class = ReceptionPlace::class;
                break;
            }
            default : {
                return redirect()->route('admin');
            }
        }

        DatabaseRepository::saveDatabaseItem($class, $request);

        return redirect()->route('admin.db', ['db_class' => $requestDbClass]);
    }
}
