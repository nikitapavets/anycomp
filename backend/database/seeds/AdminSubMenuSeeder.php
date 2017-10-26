<?php

use Illuminate\Database\Seeder;
use App\Models\AdminSubMenu;
use App\Repositories\SpareRepository;

class AdminSubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_sub_menus')->delete();

        AdminSubMenu::create(
            [
                'admin_menu_id' => 1,
                'title'         => 'Добавить в ремонт',
                'link'          => '/admin/repairs/choose_client',
                'system_name'   => 'admin.repair.choose_client',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 1,
                'title'         => 'Техника в ремонте',
                'link'          => '/admin/repairs',
                'system_name'   => 'admin.repair.list',
                'pos'           => 2,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 1,
                'title'         => 'Детали для ремонта',
                'link'          => SpareRepository::getLink(),
                'pos'           => 3,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 1,
                'title'         => 'Статистика',
                'link'          => '/admin/repair/statistics',
                'system_name'   => 'admin.repair.statistics',
                'pos'           => 4,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 2,
                'title'         => 'Ремонт',
                'link'          => '/admin/clients/repair',
                'system_name'   => 'admin.clients.repair',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 3,
                'title'         => 'Телевизоры',
                'link'          => '/admin/catalog/tv/list',
                'system_name'   => 'admin.catalog.tv.list',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 3,
                'title'         => 'Ноутбуки',
                'link'          => '/admin/catalog/notebook/list',
                'system_name'   => 'admin.catalog.notebook.list',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Категории',
                'link'          => '/admin/db/categories',
                'system_name'   => 'admin.db.categories',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Бренды',
                'link'          => '/admin/db/brands',
                'system_name'   => 'admin.db.brands',
                'pos'           => 2,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Организации',
                'link'          => '/admin/db/organizations',
                'system_name'   => 'admin.db.organizations',
                'pos'           => 3,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы экранов',
                'link'          => '/admin/db/screen-types',
                'system_name'   => 'admin.db.screen_types',
                'pos'           => 4,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Разрешения экранов',
                'link'          => '/admin/db/screen-resolutions',
                'system_name'   => 'admin.db.screen_resolutions',
                'pos'           => 5,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Диагонали экранов',
                'link'          => '/admin/db/screen-diagonals',
                'system_name'   => 'admin.db.screen_diagonals',
                'pos'           => 6,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Соотношении сторон экранов',
                'link'          => '/admin/db/screen-aspect-ratios',
                'system_name'   => 'admin.db.screen_aspect_ratios',
                'pos'           => 7,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Цвета',
                'link'          => '/admin/db/colors',
                'system_name'   => 'admin.db.colors',
                'pos'           => 8,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы подставок',
                'link'          => '/admin/db/stand-types',
                'system_name'   => 'admin.db.stand_types',
                'pos'           => 9,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы матриц',
                'link'          => '/admin/db/matrix-types',
                'system_name'   => 'admin.db.matrix_types',
                'pos'           => 10,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Размеры креплений VESA',
                'link'          => '/admin/db/vesa-wall-mounts',
                'system_name'   => 'admin.db.vesa_wall_mounts',
                'pos'           => 11,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Года',
                'link'          => '/admin/db/years',
                'system_name'   => 'admin.db.years',
                'pos'           => 12,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'ТВ тюнеры',
                'link'          => '/admin/db/tv-tuners',
                'system_name'   => 'admin.db.tv_tuners',
                'pos'           => 13,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Ядра процессора',
                'link'          => '/admin/db/processor-cores',
                'system_name'   => 'admin.db.processor_cores',
                'pos'           => 14,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Населенные пункты',
                'link'          => '/admin/db/city-types',
                'system_name'   => 'admin.db.city_types',
                'pos'           => 15,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы компьютеров',
                'link'          => '/admin/db/computer-types',
                'system_name'   => 'admin.db.computer_types',
                'pos'           => 16,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Платформы процессоров',
                'link'          => '/admin/db/processor-stages',
                'system_name'   => 'admin.db.processor_stages',
                'pos'           => 17,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Процессоры',
                'link'          => '/admin/db/processors',
                'system_name'   => 'admin.db.processors',
                'pos'           => 18,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Материалы',
                'link'          => '/admin/db/materials',
                'system_name'   => 'admin.db.materials',
                'pos'           => 19,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Поверхности экранов',
                'link'          => '/admin/db/screen-surfaces',
                'system_name'   => 'admin.db.screen_surfaces',
                'pos'           => 20,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы оперативной памяти',
                'link'          => '/admin/db/ram-types',
                'system_name'   => 'admin.db.ram_types',
                'pos'           => 21,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы жестких дисков',
                'link'          => '/admin/db/hdd-types',
                'system_name'   => 'admin.db.hdd_types',
                'pos'           => 22,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Карты памяти',
                'link'          => '/admin/db/memory-cards',
                'system_name'   => 'admin.db.memory_cards',
                'pos'           => 23,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Графические карты',
                'link'          => '/admin/db/graphic-cards',
                'system_name'   => 'admin.db.graphic_cards',
                'pos'           => 24,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы графических карт',
                'link'          => '/admin/db/graphic-card-types',
                'system_name'   => 'admin.db.graphic_card_types',
                'pos'           => 25,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Типы управления курсором',
                'link'          => '/admin/db/cursor-control-types',
                'system_name'   => 'admin.db.cursor_control_types',
                'pos'           => 26,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Комплекты поставки',
                'link'          => '/admin/db/complects',
                'system_name'   => 'admin.db.complects',
                'pos'           => 27,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Размеры устройств хранения',
                'link'          => '/admin/db/storage-sizes',
                'system_name'   => 'admin.db.storage_sizes',
                'pos'           => 28,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 4,
                'title'         => 'Пункты приема заказа',
                'link'          => '/admin/db/reception-places',
                'system_name'   => 'admin.db.reception-places',
                'pos'           => 29,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 5,
                'title'         => 'Сайт',
                'link'          => '/admin/orders/site',
                'system_name'   => 'admin.orders.site',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 6,
                'title'         => 'Главная',
                'link'          => '/admin',
                'system_name'   => 'admin',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 7,
                'title'         => 'Новый привоз',
                'link'          => '/admin/deliveries/create',
                'pos'           => 1,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 7,
                'title'         => 'Новая деталь',
                'link'          => sprintf('%s/create', SpareRepository::getLink()),
                'pos'           => 2,
            ]
        );

        AdminSubMenu::create(
            [
                'admin_menu_id' => 7,
                'title'         => 'Список привозов',
                'link'          => '/admin/deliveries',
                'pos'           => 3,
            ]
        );
    }
}
