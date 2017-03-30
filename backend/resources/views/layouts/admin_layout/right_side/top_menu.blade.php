<div class="admin-panel__right-side--top-menu">
    <div class="profile">
        <a href="#">
            <img src="{{ $admin->getImg(128) }}" alt="{{ $admin->getFullName() }}" title="{{ $admin->getFullName() }}">
        </a>
        {{ $admin->getFullName() }}
    </div>
    <nav class="top_nav">
        <ul>
            <li>
                <a href="javascript:;" class="showAdminMenu">
                    <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href='#admin_menu'></use>
                    </svg>
                    <span>Меню</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href='#admin_user'></use>
                    </svg>
                    <span>Профиль</span>
                </a>
            </li>
            <li>
                <a href="/logout">
                    <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href='#admin_back_arrow'></use>
                    </svg>
                    <span>Выйти</span>
                </a>
            </li>
        </ul>
    </nav>
</div>