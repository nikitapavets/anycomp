@extends ('layouts.general')

@section('content')

    <div class="admin-panel__login">

        <div class="admin-panel">

            @if (session('status'))
                <div class="admin-panel__notes fail">
                    <p><strong>Ошибка: </strong>{{ session('status') }}</p>
                </div>
            @endif

            <div class="admin-panel__widget">
                <div class="title">
                    <div class="text">
                        Вход в панель управления
                    </div>
                </div>

                {{ Form::open(array('url' => '/check')) }}

                <div class="widget-row row">
                    <label for="login">Логин: <span class="required">*</span></label>
                    <div class="widget-row__right">
                        <input type="text" id="login" name="login">
                    </div>
                </div>
                <div class="widget-row row">
                    <label for="password">Пароль: <span class="required">*</span></label>
                    <div class="widget-row__right">
                        <input type="password" id="password" name="password">
                    </div>
                </div>
                <div class="widget-row row">
                    <div class="admin-panel__checkers">
                        <div class="admin-panel__checker">
                            <span class="checked">
                                <input type="checkbox" checked="checked" id="remember" name="remember">
                            </span>
                        </div>
                        <label for="remember">Запомнить</label>
                    </div>
                    <div class="admin-panel__buttons">
                        <button class="admin-panel__button red">Войти</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>


                <div class="admin-panel__logo">
                    <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href='#logo_dark'></use>
                    </svg>
                </div>

        </div>
    </div>

@stop