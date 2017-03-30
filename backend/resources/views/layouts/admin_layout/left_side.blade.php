<div class="admin-panel__left-side">
    <div class="with-scroll">
        <div class="admin-panel__left-side--logo">
            <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <use xlink:href='#logo_dark'></use>
            </svg>
        </div>

        <div class="admin-panel__sidebar-sep"></div>

        <div class="admin-panel__left-side--search">
            <input type="text" placeholder="поиск...">
            <button type="submit">
                <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <use xlink:href='#search_solid_light'></use>
                </svg>
            </button>
        </div>

        <div class="admin-panel__sidebar-sep"></div>

        <nav class="admin-panel__left-side--menu">
            <ul>

                @foreach($adminMenu as $adminMenuItem)
                    <li>
                        <a class="menu-item" href="javascript:;">
                            <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <use xlink:href='{{ $adminMenuItem->getImg() }}'></use>
                            </svg>
                            <span>{{ $adminMenuItem->getTitle() }}</span>
                            <strong>{{ $adminMenuItem->getSubMenuSize() }}</strong>
                        </a>
                        <ul class="sub" style="display: {{ $menu_active[0]['display'] or 'none' }}">
                            @foreach($adminMenuItem->getSubMenu() as $adminSubMenuItem)
                                <li class="">
                                    <a class="menu-item-sub" href="{{ $adminSubMenuItem->getLink() }}">{{ $adminSubMenuItem->getTitle() }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            </ul>
        </nav>



    </div>
    <div class="admin-panel__sidebar-sep"></div>

</div>


