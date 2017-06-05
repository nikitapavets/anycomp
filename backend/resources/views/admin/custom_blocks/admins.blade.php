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
                    <img src="{{$person['image']}}" title="{{$person['full_name']}}" alt="{{$person['full_name']}}">
                </div>
                <div class="admin__info">
                    <div class="admin__name">{{$person['full_name']}}</div>
                    <div class="admin__skill">{{$person['skill']}}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>