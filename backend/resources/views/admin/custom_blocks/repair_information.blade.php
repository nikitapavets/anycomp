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
                <div class="generalInfo__title">{{$block['repair']['product_full_name']}}</div>
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
                <div class="generalInfo__client client">
                    <a class="client__field" href="{{$block['repair']['client']['link']}}">{{$block['repair']['client']['full_name']}}</a>
                    <a class="client__field" href="#">{{$block['repair']['client']['organization']}}</a>
                    <div class="client__field">{{$block['repair']['client']['mobile_phone_native']}}</div>
                    <div class="client__field">{{$block['repair']['client']['home_phone_native']}}</div>
                </div>
            </div>
        </div>
        <div class="fullInfo">
            <div class="fullInfo__title">Полное описание</div>
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
    </div>

@stop