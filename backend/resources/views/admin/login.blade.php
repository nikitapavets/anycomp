@extends ('layouts.general')

@section('content')

    <div class="login">

        <div class="login__inner">

            @if (session('status'))
                <div class="admin-panel__notes fail">
                    <p><strong>Ошибка: </strong>{{ session('status') }}</p>
                </div>
            @endif

            <div class="widget">
                <div class="widget__title">
                    Вход в панель управления
                </div>

                {{ Form::open(array('url' => '/check')) }}

                <div class="widget__row">
                    <label for="login" class="cell__name">
                        <span>Логин:</span>
                        <span class="required">*</span>
                    </label>
                    <div class="cell__value">
                        <input type="text" id="login" name="login" class="admin-form-input">
                    </div>
                </div>

                <div class="widget__row">
                    <label for="login" class="cell__name">
                        <span>Пароль:</span>
                        <span class="required">*</span>
                    </label>
                    <div class="cell__value">
                        <input type="password" id="password" name="password" class="admin-form-input">
                    </div>
                </div>

                <div class="widget__row">
                    <div class="cell">
                        <input class="checker" type="checkbox" checked="checked" id="remember" name="remember">
                        <label for="remember">Запомнить</label>
                    </div>

                    <div class="admin-panel__buttons">
                        <button class="admin-form-button admin-form-button--red">Войти</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>

            <div class="login__logo">
                <svg class="tags-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <use xlink:href='#logo_dark'></use>
                </svg>
            </div>

        </div>
    </div>

@stop