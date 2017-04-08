@extends ('layouts.admin_layout.right_side')

@section('admin_content')

    <div id="blockErrors"></div>

    <div class="blockForm">
        {{ Form::open(array('url' => $form['url'], 'enctype' => 'multipart/form-data')) }}
        @php
            $index = 0;
        @endphp
        @foreach($form['widgets'] as $widget)
            <div class="admin-panel__buttons {{ $index > 0 ? 'hidden' : '' }}" style="margin-top: 0;">
                @if($index < count($form['widgets']) - 1)
                    <button class="admin-panel__button formNextBtn top" data-pos="{{ $index }}">Далее</button>
                @else
                    <button type="submit" class="admin-panel__button green formNextBtn top" id="formSendBtn" data-pos="{{ $index }}">Готово</button>
                @endif
                @if($index > 0)
                    <button class="admin-panel__button formBackBtn top" data-pos="{{ $index }}">Назад</button>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="admin-panel__widget {{ $index > 0 ? 'hidden' : '' }}">
                <div class="title">
                    <div class="text">
                        {{ $widget['title'] }}
                    </div>
                </div>
                @foreach($widget['rows'] as $row)
                        <div class="widget-row row {{ isset($row['type']) ? $row['type'] : '' }}">
                            <label for="{{ isset($row['name']) ? $row['name'] : '' }}">
                                <span class="fieldForValidate" data-require="{{isset($row['required']) && $row['required'] == true ? 'require' : ''}}" data-type="{{ isset($row['validation_type']) ? $row['validation_type'] : '' }}">{{ isset($row['label']) ? $row['label'] : '' }}</span>:
                                @if(isset($row['required']) && $row['required'] == true)
                                    <span class="fieldForValidate required" data-type="{{ isset($row['validation_type']) ? $row['validation_type'] : '' }}"> *</span>
                                @endif
                            </label>
                            <div class="widget-row__right">
                                @if($row['item'] == 'input')
                                    <input type="{{ isset($row['type']) ? $row['type'] : 'text' }}"
                                           id="{{ isset($row['name']) ? $row['name'] : '' }}"
                                           name="{{ isset($row['name']) ? $row['name'] : '' }}"
                                           class="{{ isset($row['class']) ? $row['class'] : '' }}"
                                           value="{{ isset($row['value']) ? $row['value'] : '' }}">
                                @elseif($row['item'] == 'select')
                                    <div class="selector">
                                        @if(isset($row['select_gag_selected']))
                                            <span>{{ $row['select_gag_selected'] }}</span>
                                        @else
                                            <span>{{ isset($row['select_gag']) ? $row['select_gag'] : '' }}</span>
                                        @endif
                                        <select class="inp_select" name="{{ isset($row['name']) ? $row['name'] : '' }}" id="{{ isset($row['name']) ? $row['name'] : '' }}">
                                            @if(isset($row['select_items']) and is_array($row['select_items']))
                                                <option value="{{$row['required'] ? 0 : 1}}">{{ isset($row['select_gag']) ? $row['select_gag'] : '' }}</option>
                                                @foreach($row['select_items'] as $optionItem)
                                                    <option value="{{ isset($optionItem['id']) ? $optionItem['id'] : '' }}" {{ isset($optionItem['selected']) ? $optionItem['selected'] : '' }}>
                                                        {{ isset($optionItem['value']) ? $optionItem['value'] : '' }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if(isset($row['add_new']) && $row['add_new'])
                                            <a href="javascript:;" class="inp_plus"></a>
                                        @endif
                                    </div>
                                    @if(isset($row['add_new']) && $row['add_new'])
                                        <input type="{{ isset($row['add_new_type']) ? $row['add_new_type'] : 'text' }}"
                                               id="{{ isset($row['add_new_name']) ? $row['add_new_name'] : '' }}"
                                               name="{{ isset($row['add_new_name']) ? $row['add_new_name'] : '' }}"
                                               class="hidden">
                                    @endif
                                @elseif($row['item'] == 'simpleFile')
                                    <div class="uploader uploaderSingleImage">
                                        <input type="input"
                                               id="{{ isset($row['name']) ? $row['name'] : '' }}"
                                               name="{{ isset($row['name']) ? $row['name'] : '' }}"
                                               class="inp_img"
                                               value="{{ isset($row['value']) ? implode(',', $row['value']) : '' }}">
                                        <span class="filename">{{ isset($row['value']) && $row['value'] ? 'Выбрано файлов: ' . count($row['value']) : 'Файлы не выбраны' }}</span>
                                        <span class="action">Choose File</span>
                                        <div class="upload-files single hidden">
                                            <div class="upload-files__area">
                                                <div class="items">
                                                    @if(isset($row['value']))
                                                        @foreach($row['value'] as $img)
                                                            <div class="item">
                                                                <img src="{{ $img }}" data-link="{{ $img }}">
                                                                <a href="javascript:;" class="cross">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <use xlink:href='#cross_ff491f'></use>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="hidden" class="inp_img">
                                                <div class="admin-panel__buttons">
                                                    <button class="admin-panel__button green" id="UploadSingleImage">
                                                        Выбрать файлы
                                                        <div class="loader hidden">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <use xlink:href='#loader_balls'></use>
                                                            </svg>
                                                        </div>
                                                        <div class="error"></div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($row['item'] == 'file')
                                    <div class="uploader uploaderMultiImage">
                                        <input type="input"
                                               id="{{ isset($row['name']) ? $row['name'] : '' }}"
                                               name="{{ isset($row['name']) ? $row['name'] : '' }}"
                                               class="inp_img"
                                               value="{{ isset($row['value']) ? implode(',', $row['value']) : '' }}">
                                        <span class="filename">{{ isset($row['value']) && $row['value'] ? 'Выбрано файлов: ' . count($row['value']) : 'Файлы не выбраны' }}</span>
                                        <span class="action">Choose File</span>
                                        <div class="upload-files hidden">
                                            <div class="upload-files__area">
                                                <div class="items">
                                                    @if(isset($row['value']))
                                                        @foreach($row['value'] as $img)
                                                            <div class="item">
                                                                <img src="{{ $img }}" data-link="{{ $img }}">
                                                                <a href="javascript:;" class="cross">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <use xlink:href='#cross_ff491f'></use>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="hidden" class="inp_img">
                                                <div class="admin-panel__buttons">
                                                    <button class="admin-panel__button green" id="UploadFiles">
                                                        Выбрать файлы
                                                        <div class="loader hidden">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <use xlink:href='#loader_balls'></use>
                                                            </svg>
                                                        </div>
                                                        <div class="error"></div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($row['item'] == 'checkbox')
                                    <div class="admin-panel__checkers" style="margin-top: 3px">
                                        <div class="admin-panel__checker">
                                            <span class="{{ isset($row['checked']) && $row['checked'] == 'checked' ? 'checked' : '' }}">
                                                <input type="checkbox"
                                                       {{ isset($row['checked']) && $row['checked'] == 'checked' ? 'checked="checked"' : '' }}
                                                       id="{{ isset($row['name']) ? $row['name'] : '' }}"
                                                       name="{{ isset($row['name']) ? $row['name'] : '' }}">
                                            </span>
                                        </div>
                                    </div>
                                @elseif($row['item'] == 'chosen')
                                    <div class="admin-chosen">
                                        <ul class="admin-chosen__area">
                                            @foreach($row['select_items'] as $select_item)
                                                @if(isset($select_item['selected']) && $select_item['selected'] == 'selected')
                                                    <li class="admin-chosen__area--item">
                                                        <span>{{ $select_item['value'] }}</span>
                                                        <a href="javascript:;" class="close"></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="admin-chosen__drop hidden">
                                            <ul>
                                                @foreach($row['select_items'] as $select_item)
                                                    <li class="admin-chosen__drop--item {{ (isset($select_item['selected']) && $select_item['selected'] == 'selected') ? 'hidden' : '' }}"
                                                        data-id="{{ $select_item['id'] }}">{{ $select_item['value'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <input type="hidden"
                                               class="admin-chosen__input"
                                               id="{{ isset($row['name']) ? $row['name'] : '' }}"
                                               name="{{ isset($row['name']) ? $row['name'] : '' }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                @endforeach
            </div>
            <div class="admin-panel__buttons {{ $index > 0 ? 'hidden' : '' }}" style="margin-bottom: 0;">
                @if($index < count($form['widgets']) - 1)
                    <button class="admin-panel__button formNextBtn bottom" data-pos="{{ $index }}">Далее</button>
                @else
                    <button type="submit" class="admin-panel__button green formNextBtn bottom" id="formSendBtn" data-pos="{{ $index }}">Готово</button>
                @endif
                @if($index > 0)
                    <button class="admin-panel__button formBackBtn bottom" data-pos="{{ $index }}">Назад</button>
                @endif
                <div class="clearfix"></div>
            </div>
            @php
                $index++;
            @endphp
        @endforeach
        {{ Form::close() }}
    </div>

@stop