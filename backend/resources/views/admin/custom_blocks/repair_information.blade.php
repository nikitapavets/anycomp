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
                {{--<div class="generalInfo__changeStatus infoBox ">--}}
                    {{--<div class="selector">--}}
                        {{--<span>{{$block['repair']['status']['name']}}</span>--}}
                        {{--<select class="inp_select">--}}
                            {{--<option value="0" @if($block['repair']['status']['number'] == 0) selected @endif>В ремонте</option>--}}
                            {{--<option value="1" @if($block['repair']['status']['number'] == 1) selected @endif>На выдаче</option>--}}
                            {{--<option value="2" @if($block['repair']['status']['number'] == 2) selected @endif>У клиента</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
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
            <div class="repairDescription__title">Описание ремонта</div>
            <table class="flexibleTable">
                <thead>
                    <tr>
                        <th>Описание</th>
                        <th style="width: 150px">Цена</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="flexibleTable__currentValue">Описание</span>
                            <input type="text" class="flexibleTable__editInput hidden">
                            <a href="#" class="flexibleTable__editBtn hidden">
                                <svg class="flexibleTable__svg">
                                    <use xlink:href='#admin_edit_595959'/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <span class="flexibleTable__currentValue">10.00</span>
                            <input type="text" class="flexibleTable__editInput hidden">
                            <a href="#" class="flexibleTable__editBtn hidden">
                                <svg class="flexibleTable__svg">
                                    <use xlink:href='#admin_edit_595959'/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>Цена</td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>Цена</td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>Цена</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@stop