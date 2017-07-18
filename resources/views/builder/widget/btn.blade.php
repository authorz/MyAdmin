<td>
    @foreach($rightBtn as $key=>$rb)
        <a href="javascript:;"
           value="{{$rb['value']}}_right"
        @foreach($rb['custom'] as $key => $rbcu)
            {{$rbcu}} = '{{$item[$rbcu]}}'
        @endforeach
        class="btn btn-effect-ripple btn-sm btn-danger {{$rb['class']}}">{{$rb['name']}}</a>
    @endforeach
</td>
