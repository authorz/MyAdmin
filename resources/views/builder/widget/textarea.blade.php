@if($item['type'] == 'textarea')
    <div class="form-group">
        <label class="col-md-3 control-label" for="{{$item['name']}}">{{$item['title']}}</label>
        <div class="col-md-9">
        <textarea name="{{$item['name']}}" rows="{{isset($item['rows']) ? $item['rows'] : 7}}"
                  class="form-control"
                  @if(isset($item['id'])) id="{{$item['id']}}" @endif
                  placeholder="{{$item['placeholder']}}"
                  style="{{$item['append']['style']}}" {{$item['extra']}}>{{$item['value']}}</textarea>
            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif