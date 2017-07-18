<td>
    <a style="text-decoration:underline"
       href="{{$col['extend']['url']}}@if($col['extend']['param'])?@foreach($col['extend']['param'] as $key=>$value){{$value}}={{$item[$value]}}&@endforeach @endif">{{$item[$col['value']]}}</a>
</td>