@if($item['type'] == 'hidden')
    <input type='hidden' value='{{$item['value']}}' name='{{$item['name']}}'>
@endif