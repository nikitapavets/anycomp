<div class="selector">
    @if(isset($widget['select_gag_selected']))
        <span>{{ $widget['select_gag_selected'] }}</span>
    @else
        <span>{{ $widget['select_gag'] }}</span>
    @endif
    <select class="inp_select" name="{{ $widget['name'] }}" id="{{ $widget['name'] }}">
        @if(isset($widget['select_items']) && is_array($widget['select_items']))
            <option value="{{$widget['required'] ? 0 : 1}}">{{ $widget['select_gag'] }}</option>
            @foreach($widget['select_items'] as $optionItem)
                <option value="{{ $optionItem['id']  }}" {{ $optionItem['selected'] }}>
                    {{ $optionItem['value'] }}
                </option>
            @endforeach
        @endif
    </select>
    @if($widget['add_new'])
        <a href="javascript:void(0);" class="inp_plus"></a>
    @endif
</div>
