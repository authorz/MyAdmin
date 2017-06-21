@if($item['type'] == 'upload')
    <div class="form-group">
        <label class="col-md-3 control-label" for="{{$item['name']}}">{{$item['title']}}</label>
        <div class="col-md-9">
            <input id="{{$item['name']}}" type="file" name="{{$item['name']}}">

            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif