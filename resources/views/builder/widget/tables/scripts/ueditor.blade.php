<script>
    @foreach($receive as $key=>$item)
        @if($item['type'] == 'ueditor')
            UE.getEditor('{{$item['name']}}');
        @endif
    @endforeach
</script>
