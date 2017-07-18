@if($item['type'] == 'checkbox')
    <div class="form-group">
        <label class="col-md-3 control-label">{{$item['title']}}</label>
        <div class="col-md-9">
            @foreach($item['parameter'] as $key=>$checkbox)
                <div class="checkbox">
                    <label for="{{$item['name']}}">
                        <input type="checkbox" @if(isset($item['id'])) id="{{$item['id']}}" @endif
                        name="{{$item['name']}}[]"
                               value="{{$key}}" class="{{$item['append']['class']}}"
                               style="{{$item['append']['style']}}"
                               {{$item['extra']}} @if(in_array($key,$item['value'])) checked @endif> {{$checkbox}}
                    </label>
                </div>
            @endforeach
            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif