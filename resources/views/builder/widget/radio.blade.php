@if($item['type'] == 'radio')
    <div class="form-group">
        <label class="col-md-3 control-label">{{$item['title']}}</label>
        <div class="col-md-9">
            @foreach($item['parameter'] as $key=>$radio)
                @if($key == $item['value'])
                    <label class="radio-inline" for="{{$item['name']}}">
                        <input type="radio" @if(isset($item['id'])) id="{{$item['id']}}" @endif
                        name="{{$item['name']}}" value="{{$key}}"
                               checked> {{$radio}}
                    </label>
                @else
                    <label class="radio-inline" for="{{$item['name']}}">
                        <input type="radio" @if(isset($item['id'])) id="{{$item['id']}}" @endif
                        name="{{$item['name']}}"
                               value="{{$key}}"> {{$radio}}
                    </label>
                @endif
            @endforeach

            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif
