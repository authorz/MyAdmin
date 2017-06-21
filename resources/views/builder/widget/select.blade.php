@if($item['type'] == 'select')
    <div class="form-group">
        <label class="col-md-3 control-label" for="{{$item['name']}}">{{$item['title']}}</label>
        <div class="col-md-5">
            <select @if(isset($item['id'])) id="{{$item['id']}}" @endif
            name="{{$item['name']}}"
                    class="select-chosen {{$item['append']['class']}}"
                    data-placeholder="{{$item['placeholder']}}"
                    style="{{$item['append']['style']}}" {{$item['extra']}}>;
                <option></option>
                @foreach($item['parameter'] as $key => $select)
                    <option @if($key == $item['value']) selected @endif value="{{$key}}">{{$select}}</option>
                @endforeach
            </select>
            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif
