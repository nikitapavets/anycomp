@extends ('admin.blocks.block')

@section('block_content')

    <div class="repairInfo">

        <div class="generalInfo">
            <div class="generalInfo__block">
                <div class="image">
                    <img src="/images/repair/no-image.png" alt="No image" title="No image" class="image__src">
                </div>
                <div class="generalInfo__links">
                    <a href="/admin/repair/{{$block['repair']['id']}}/update">Изменить</a>
                    <a href="/admin/repair/print_doc?id={{$block['repair']['id']}}">Распечатать</a>
                </div>
            </div>
            <div class="generalInfo__block">
                <div class="generalInfo__title">
                    {{$block['repair']['product_full_name']}}
                </div>
                <div class="generalInfo__date">
                    @if($block['repair']['completed_at'])
                        <span>был</span>
                    @endif
                    <span>в ремонте с</span>
                    {{$block['repair']['created_at']}}
                    @if($block['repair']['completed_at'])
                        <span>по</span>
                        {{$block['repair']['completed_at']}}
                    @endif
                </div>
                <div class="generalInfo__client infoBox client">
                    <a class="client__field" href="{{$block['repair']['client']['link']}}">{{$block['repair']['client']['full_name']}}</a>
                    <a class="client__field" href="#">{{$block['repair']['client']['organization']}}</a>
                    <div class="client__field">{{$block['repair']['client']['mobile_phone_native']}}</div>
                    <div class="client__field">{{$block['repair']['client']['home_phone_native']}}</div>
                </div>
                <div class="generalInfo__changeStatus infoBox">
                    <div class="changeStatus sender" data-link="/api/repairs/updateStatus">
                        <a href="#" class="changeStatus__item sender__push {{$block['repair']['status']['number'] == 0 ? 'active' : ''}}" data-repair-id="{{$block['repair']['id']}}" data-status-id="0">В ремонте</a>
                        <a href="#" class="changeStatus__item sender__push {{$block['repair']['status']['number'] == 1 ? 'active' : ''}}" data-repair-id="{{$block['repair']['id']}}" data-status-id="1">На выдаче</a>
                        <a href="#" class="changeStatus__item sender__push {{$block['repair']['status']['number'] == 2 ? 'active' : ''}}" data-repair-id="{{$block['repair']['id']}}" data-status-id="2">У клиента</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="fullInfo">
            <div class="fullInfo__title">Полное описание техники</div>
            <div class="infoField">
                <div class="infoField__title">Номер квитанции</div>
                <div class="infoField__value">{{$block['repair']['receipt_number']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Название</div>
                <div class="infoField__value">{{$block['repair']['product_full_name']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Серийный номер</div>
                <div class="infoField__value">{{$block['repair']['product_hash_code']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Неисправность</div>
                <div class="infoField__value">{{$block['repair']['product_defect']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Внешний вид</div>
                <div class="infoField__value">{{$block['repair']['product_appearance']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">В комплекте</div>
                <div class="infoField__value">{{$block['repair']['product_set']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Комментарий</div>
                <div class="infoField__value">{{$block['repair']['product_comment']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Ориентировочная стоимость</div>
                <div class="infoField__value">{{$block['repair']['product_approximate_cost']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Место приема товара</div>
                <div class="infoField__value">{{$block['repair']['product_reception_place']}}</div>
            </div>
            <div class="infoField">
                <div class="infoField__title">Принял в ремонт</div>
                <div class="infoField__value">{{$block['repair']['worker']['sf_name']}}</div>
            </div>
        </div>

        <div class="repairDescription">
            <div class="flexibleTable__title">
                Описание ремонта
                <div class="flexibleTable__Btns">
                    <a href="#" class="flexibleTable__addBtn">
                        <svg class="flexibleTable__svg">
                            <use xlink:href='#admin_add_595959'/>
                        </svg>
                    </a>
                    <a href="#" class="flexibleTable__removeBtn">
                        <svg class="flexibleTable__svg">
                            <use xlink:href='#admin_remove_595959'/>
                        </svg>
                    </a>
                </div>
            </div>
            <table class="flexibleTable flex" data-cells-names='["value", "price"]' data-default-values='["Описание", "0.00"]' data-model-id="{{$block['repair']['id']}}" data-link="/api/repair_description">
                <thead>
                    <tr>
                        <th style="width: 50px">
                            <div class="checkers checkers_main">
                                <div class="checkers__checker">
                                        <span class="checkers__subChecker">
                                            <input type="checkbox">
                                        </span>
                                </div>
                            </div>
                        </th>
                        <th>Описание</th>
                        <th style="width: 150px">Цена</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($block['repair']['descriptions'] as $description)
                        <tr data-id="{{$description['id']}}">
                            <td class="flexibleTable__checker">
                                <div class="checkers">
                                    <div class="checkers__checker">
                                        <span class="checkers__subChecker">
                                            <input type="checkbox">
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="flexibleTable__currentValue">{{$description['value']}}</span>
                                <input type="text" class="flexibleTable__editInput hidden" name="value" value="{{$description['value']}}">
                                <a href="#" class="flexibleTable__editBtn hidden">
                                    <svg class="flexibleTable__svg">
                                        <use xlink:href='#admin_edit_595959'/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <span class="flexibleTable__currentValue">{{$description['price']}}</span>
                                <input type="text" class="flexibleTable__editInput hidden" name="price" value="{{$description['price']}}">
                                <a href="#" class="flexibleTable__editBtn hidden">
                                    <svg class="flexibleTable__svg">
                                        <use xlink:href='#admin_edit_595959'/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="repairDescription">
            <div class="flexibleTable__title">
                Используемые детали
                <div class="flexibleTable__Btns">
                    <a href="#" class="flexibleTable__addBtn">
                        <svg class="flexibleTable__svg">
                            <use xlink:href='#admin_add_595959'/>
                        </svg>
                    </a>
                    <a href="#" class="flexibleTable__removeBtn">
                        <svg class="flexibleTable__svg">
                            <use xlink:href='#admin_remove_595959'/>
                        </svg>
                    </a>
                </div>
            </div>
            <table class="flexibleTable search" data-cells-names='["full_name", "price"]' data-model-id="{{$block['repair']['id']}}" data-link="/api/spares/bind-to-repair">
                <thead>
                <tr>
                    <th style="width: 50px">
                        <div class="checkers checkers_main">
                            <div class="checkers__checker">
                                        <span class="checkers__subChecker">
                                            <input type="checkbox">
                                        </span>
                            </div>
                        </div>
                    </th>
                    <th>Описание</th>
                    <th style="width: 150px">Цена</th>
                </tr>
                </thead>
                <tbody>
                @foreach($block['repair']['spares'] as $spare)
                    <tr data-id="{{$spare['id']}}">
                        <td class="flexibleTable__checker">
                            <div class="checkers">
                                <div class="checkers__checker">
                                        <span class="checkers__subChecker">
                                            <input type="checkbox">
                                        </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="flexibleTable__currentValue">{{$spare['full_name']}}</span>
                            <input type="text" class="flexibleTable__editInput hidden" name="value">
                            <a href="#" class="flexibleTable__editBtn hidden">
                                <svg class="flexibleTable__svg">
                                    <use xlink:href='#admin_edit_595959'/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <span class="flexibleTable__currentValue">{{$spare['price']}}</span>
                            <input type="text" class="flexibleTable__editInput hidden" name="price">
                            <a href="#" class="flexibleTable__editBtn hidden">
                                <svg class="flexibleTable__svg">
                                    <use xlink:href='#admin_edit_595959'/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@stop