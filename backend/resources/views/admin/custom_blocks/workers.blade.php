<div class="admin-panel__widget">
    <div class="title">
        <div class="text">
            {{ $block['title'] }}
        </div>
    </div>
    @foreach($block['people'] as $person)
        <div class="widget-row">
            <div class="admins__admin admin">
                <div class="admin__image">
                    <img src="{{$person['img_small']}}" title="{{$person['full_name']}}" alt="{{$person['full_name']}}">
                </div>
                <div class="admin__info">
                    <div class="admin__name">{{$person['full_name']}}</div>
                    <div class="admin__skill">{{$person['skill_native']}}</div>
                    <div class="admin__repairs-count">Отремонтированно: {{$person['completed_repairs_count']}} ед.</div>
                </div>
            </div>
        </div>
    @endforeach
</div>