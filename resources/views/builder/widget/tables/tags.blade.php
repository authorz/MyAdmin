@if($item['type'] == 'tags')
    <div class="form-group">
        <label class="col-md-3 control-label">{{$item['title']}}</label>
        <div class="col-md-9">
            <input type="text" @if(isset($item['id'])) id="{{$item['id']}}" @endif
            name="{{$item['name']}}" class="input-tags {{$item['append']['class']}}"
                   value="{{$item['value']}}" style="{{$item['append']['style']}}" {{$item['extra']}}>
            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif