@if($item['type'] == 'time')
    <div class="form-group">
        <label class="col-md-3 control-label" for="{{$item['name']}}">{{$item['title']}}</label>
        <div class="col-md-5">
            <div class="input-group bootstrap-timepicker">
                <input type="text" @if(isset($item['id'])) id="{{$item['id']}}" @endif
                name="{{$item['name']}}"
                       class="form-control input-timepicker24 {{$item['append']['class']}}"
                       placeholder='{{$item['placeholder']}}'
                       value='{{$item['value']}}'
                       style="{{$item['append']['style']}}" {{$item['extra']}}>
                <span class="input-group-btn">
                    <a href="javascript:void(0)"
                       class="btn btn-effect-ripple btn-primary"><i
                                class="fa fa-clock-o"></i></a>
                </span>
            </div>
            @if(isset($item['help']))
                <span class="help-block">{{$item['help']}}</span>
            @endif
        </div>
    </div>
@endif