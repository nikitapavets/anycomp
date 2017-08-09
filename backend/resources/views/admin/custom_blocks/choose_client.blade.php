@extends ('admin.blocks.block')

@section('block_content')

    <div class="choose-client">
        <div class="row">
            <div class="col-md-6">
                <div class="choose-client__find find">
                    <div class="find__field">
                        <input type="text" class="admin-form-input" id="chooseClientField"/>
                    </div>
                    <div class="find__btn">
                        {{link_to_route('admin.repair.create', 'Добавить клиента', [], ['class' => 'admin-form-button admin-form-button_slim admin-form-button_blue'])}}
                    </div>
                </div>
                <div class="choose-client__clientsList">
                    @foreach($block['clients'] as $number => $client)
                        <div class="choose-client__client {{$number === 0 ? 'active' : ''}}"
                             data-id="{{$client['id']}}"
                             data-first_name="{{$client['first_name']}}"
                             data-second_name="{{$client['second_name']}}"
                             data-father_name="{{$client['father_name']}}"
                             data-organization="{{$client['organization']}}"
                             data-mobile_phone="{{$client['mobile_phone']}}"
                             data-mobile_phone_native="{{$client['mobile_phone_native']}}"
                             data-home_phone="{{$client['home_phone']}}"
                             data-home_phone_native="{{$client['home_phone_native']}}"
                             data-address="{{$client['address']}}"
                             data-repairs="{{count($client['repairs'])}}"
                             data-last-repair="{{$client['repairs'][count($client['repairs']) - 1]['receipt_number'] ?? ''}}">
                            {{$client['full_name']}}
                        </div>
                    @endforeach
                    <div class="choose-client__not-found hidden" id="chooseClientNotFound">Ничего не найдено</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="choose-client__info">Информация о клиенте:</div>
                <div class="choose-client__client-info client-info" id="clientInfo">
                    <div class="client-info__row">
                        <div class="client-info__type">Фамилия:</div>
                        <div class="client-info__value"
                             id="clientInfoSecondName">{{$block['clients'][0]['second_name'] ? $block['clients'][0]['second_name'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Имя:</div>
                        <div class="client-info__value"
                             id="clientInfoFirstName">{{$block['clients'][0]['first_name'] ? $block['clients'][0]['first_name'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Отчество:</div>
                        <div class="client-info__value"
                             id="clientInfoFatherName">{{$block['clients'][0]['father_name'] ? $block['clients'][0]['father_name'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Организация:</div>
                        <div class="client-info__value"
                             id="clientInfoOrganization">{{$block['clients'][0]['organization'] ? $block['clients'][0]['organization'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Мобильный телефон:</div>
                        <div class="client-info__value"
                             id="clientInfoMobilePhone">{{$block['clients'][0]['mobile_phone_native'] ? $block['clients'][0]['mobile_phone_native'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Доп. телефон:</div>
                        <div class="client-info__value"
                             id="clientInfoHomePhone">{{$block['clients'][0]['home_phone_native'] ? $block['clients'][0]['home_phone_native'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Адрес:</div>
                        <div class="client-info__value"
                             id="clientInfoAddress">{{$block['clients'][0]['address'] ? $block['clients'][0]['address'] : '-'}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Колличество заказов:</div>
                        <div class="client-info__value"
                             id="clientInfoRepairs">{{count($block['clients'][0]['repairs'])}}</div>
                    </div>
                    <div class="client-info__row">
                        <div class="client-info__type">Последний заказ:</div>
                        <div class="client-info__value"
                             id="clientInfoLastRepair">{{$block['clients'][0]['repairs'] ? $block['clients'][0]['repairs'][count($block['clients'][0]['repairs']) - 1]['receipt_number'] : '-'}}</div>
                    </div>
                    <div class="client-info__btn">
                        {{link_to_route('admin.repair.create', 'Добавить заказ', ['client_id' => $block['clients'][0]['id']], ['class' => 'admin-form-button admin-form-button_blue', 'id' => 'chooseClientAddOrder'])}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop