@extends ('layouts.admin_layout.right_side')

@section('admin_content')
    <!-- Table actions -->
    @if($table['table_actions'])
        <div class="admin-panel__buttons" style="margin-top:0;">
            @foreach($table['table_actions'] as $tableAction)
                @if($tableAction['action_type'] == 'delete')
                    @if($tableAction['action_form'] == 'inline')
                        <a href="javascript:;" class="admin-panel__button red DBDeleteBtn"
                           data-action="{{ $tableAction['action_link'] }}">Удалить</a>
                    @else
                        <a href="{{ $tableAction['action_link'] }}" class="admin-panel__button red">Удалить</a>
                    @endif
                @elseif($tableAction['action_type'] == 'create')
                    @if($tableAction['action_form'] == 'inline')
                        <a href="javascript:;" class="admin-panel__button green DBAddBtn"
                           data-action="{{ $tableAction['action_link'] }}">Добавить</a>
                    @else
                        <a href="{{ $tableAction['action_link'] }}" class="admin-panel__button green">Добавить</a>
                    @endif
                @elseif($tableAction['action_type'] == 'update')
                    @if($tableAction['action_form'] == 'inline')
                        <a href="javascript:;" class="hidden admin-panel__button DBEditBtnInline"
                           data-action="{{ $tableAction['action_link'] }}">Изменить</a>
                    @else
                        <a href="{{ $tableAction['action_link'] }}" class="admin-panel__button green">Изменить</a>
                    @endif
                @endif
            @endforeach
            <div class="clearfix"></div>
        </div>
    @endif
    <!-- / Table actions -->

    <div class="admin-panel__widget">
        <div class="title">
            <div class="text">
                {{ $table['title'] }}
            </div>
            <ul class="tabs">
                @foreach($table['table_tabs'] as $tabIndex => $tableTab)
                    <li class="tab">
                        <a href={{'/'.Request::path().'?tab='.$tabIndex}} class="{{$tableTab['tab_status']}}">
                            {{$tableTab['tab_name']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget__dynamic-table">
            <div class="dynamic-table__filters">
                <div class="search">
                    <label for="">
                        <span>Поиск:</span>
                        <input type="text">
                    </label>
                </div>
                {{--<div class="data-count">--}}
                    {{--<label for="">--}}
                        {{--<span>Показать:</span>--}}
                        {{--<div class="selector">--}}
                            {{--<span>10</span>--}}
                            {{--<select name="" id="">--}}
                                {{--<option value="">15</option>--}}
                                {{--<option value="">30</option>--}}
                                {{--<option value="">50</option>--}}
                                {{--<option value="">100</option>--}}
                                {{--<option value="">Всё</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</label>--}}
                {{--</div>--}}
            </div>
            <div class="admin-form-table">
                <table cellpadding="0" cellspacing="0" border="0" class="tabs responsive">
                    <thead>
                    <tr>
                        @foreach($table['table_fields'] as $tableField)
                            <td class="{{ $tableField['field_class'] . ' ' .$tableField['field_sort_type'] }}"style="width: {{$tableField['field_size']}}; min-width: {{$tableField['field_size']}}">
                                {!! $tableField['field_name'] !!}
                                @if($tableField['field_class'] == 'checker')
                                    <div class="admin-panel__checkers">
                                        <div class="admin-panel__checker">
                                        <span class="mainChecker">
                                            <input type="checkbox">
                                        </span>
                                        </div>
                                    </div>
                                @endif
                                <span></span>
                            </td>
                        @endforeach
                    </tr>
                    </thead>
                    @foreach($table['table_rows'] as $tabNumber => $tabRows)
                        @if($table['table_tabs'][$tabNumber]['tab_status'] == 'active')
                            <tbody class="tab">
                        @else
                            <tbody class="tab hidden">
                            @endif
                            @foreach($tabRows as $tabRow)
                                <tr>
                                    @foreach($tabRow as $cell)
                                        <td class="{{$cell['cell_class']}}">
                                            @if($cell['cell_class'] == 'checker')
                                                <div class="admin-panel__checkers">
                                                    <div class="admin-panel__checker">
                                                    <span class="subChecker" data-id="{{$cell['cell_value']}}">
                                                        <input type="checkbox">
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                @if($cell['cell_type'] == 'link' || $cell['cell_type'] == 'popup')
                                                    <a href="{{$cell['cell_link_href']}}"
                                                       class="{{$cell['cell_link_class']}}"
                                                       target="{{$cell['cell_link_target']}}">
                                                        {{$cell['cell_value']}}
                                                    </a>
                                                    @if($cell['cell_type'] == 'popup')
                                                        <div class="additional-info hidden">
                                                            @foreach($cell['cell_popup'] as $popupItem)
                                                                @if(!empty($popupItem['popup_value']))
                                                                    <div class="additional-info__row">
                                                                        <div class="additional-info__left">
                                                                <span class="{{$popupItem['popup_type']}}">
                                                                    <svg class="contacts__svg"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                    @if($popupItem['popup_type'] == 'phone')
                                                                            <use xlink:href='#admin_phone'></use>
                                                                        @elseif($popupItem['popup_type'] == 'phone_home')
                                                                            <use xlink:href='#admin_home_phone_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'full_name')
                                                                            <use xlink:href='#admin_user_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'organization')
                                                                            <use xlink:href='#admin_factory_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'address')
                                                                            <use xlink:href='#admin_location_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'hash')
                                                                            <use xlink:href='#admin_qr-code_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'code')
                                                                            <use xlink:href='#admin_hash_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'box')
                                                                            <use xlink:href='#admin_box_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'set')
                                                                            <use xlink:href='#admin_attach_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'defect')
                                                                            <use xlink:href='#admin_bug_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'worker')
                                                                            <use xlink:href='#admin_master_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'edit')
                                                                            <use xlink:href='#admin_edit_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'xls')
                                                                            <use xlink:href='#admin_xls_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'status')
                                                                            <use xlink:href='#admin_status_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'comment')
                                                                            <use xlink:href='#admin_comment_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'place')
                                                                            <use xlink:href='#admin_place_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'appearance')
                                                                            <use xlink:href='#admin_appearance_595959'></use>
                                                                        @elseif($popupItem['popup_type'] == 'price')
                                                                            <use xlink:href='#admin_price_595959'></use>
                                                                        @endif
                                                                    </svg>
                                                                </span>
                                                                        </div>
                                                                        <div class="additional-info__right">
                                                                            @if($popupItem['popup_form'] == 'link')
                                                                                <a href="{{$popupItem['popup_link_href'] ?? 'javascript:;'}}"
                                                                                   target="{{$popupItem['popup_link_target']}}"
                                                                                   class="{{$popupItem['popup_class']}}"
                                                                                   data-id="{{$popupItem['popup_inline-link_data_id'] ?? ''}}"
                                                                                   data-action="{{$popupItem['popup_inline-link_data_action'] ?? ''}}"
                                                                                   data-selected="{{$popupItem['popup_inline-link_data_selected'] ?? ''}}">
                                                                                    {{$popupItem['popup_value']}}
                                                                                </a>
                                                                            @else
                                                                                {{ $popupItem['popup_value'] ?? '' }}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @else
                                                    <span>{{$cell['cell_value']}}</span>
                                                    @if($cell['cell_type'] == 'edit')
                                                        <div class="admin-panel__button-small hide-me DBEditBtn"
                                                             data-id="{{$cell['cell_data_id']}}"
                                                             data-action="2">
                                                            <span class="edit"></span>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                            @endforeach
                </table>
            </div>
            <div class="dynamic-table__stats tabs">
                @foreach($table['table_paginations'] as $key => $pagination)
                    @if($table['table_tabs'][$key]['tab_status'] == 'active')
                        <div class="dynamic-table__pagination tab">
                            @else
                                <div class="dynamic-table__pagination tab hidden">
                                    @endif
                                    @if($pagination['total'])
                                        <div class="info">Показано {{ $pagination['range'] }} из {{ $pagination['total'] }}
                                            записей
                                        </div>
                                        <div class="pagination">
                                            @if($pagination['currentPage'] - 1)
                                            <a class="pagination__item pagination__item_first" href={{$pagination['firstPageUrl']}}>Первая</a>
                                            <a class="pagination__item pagination__item_number" href={{$pagination['previousPageUrl']}}>Назад</a>
                                            @endif
                                            @foreach($pagination['pageNumbers'] as $pageNumber)
                                                <a class="pagination__item {{$pageNumber['current'] ? 'pagination__item_current' : ''}}" href={{$pageNumber['path']}}>{{$pageNumber['index']}}</a>
                                            @endforeach
                                            @if($pagination['currentPage'] + 1 < $pagination['lastPage'])
                                            <a class="pagination__item pagination__item_number" href={{$pagination['nextPageUrl']}}>Вперед</a>
                                            <a class="pagination__item pagination__item_first" href={{$pagination['lastPageUrl']}}>Последняя</a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="nothing">Список пока пуст</div>
                                    @endif
                                </div>
                                @endforeach
                        </div>
            </div>
        </div>

        <!-- Table actions -->
        @if($table['table_actions'])
            <div class="admin-panel__buttons" style="margin-bottom:0;">
                @foreach($table['table_actions'] as $tableAction)
                    @if($tableAction['action_type'] == 'delete')
                        @if($tableAction['action_form'] == 'inline')
                            <a href="javascript:;" class="admin-panel__button red DBDeleteBtn"
                               data-action="{{ $tableAction['action_link'] }}">Удалить</a>
                        @else
                            <a href="{{ $tableAction['action_link'] }}" class="admin-panel__button red">Удалить</a>
                        @endif
                    @elseif($tableAction['action_type'] == 'create')
                        @if($tableAction['action_form'] == 'inline')
                            <a href="javascript:;" class="admin-panel__button green DBAddBtn"
                               data-action="{{ $tableAction['action_link'] }}">Добавить</a>
                        @else
                            <a href="{{ $tableAction['action_link'] }}" class="admin-panel__button green">Добавить</a>
                        @endif
                    @endif
                @endforeach
                <div class="clearfix"></div>
            </div>
    @endif
    <!-- / Table actions -->

@stop