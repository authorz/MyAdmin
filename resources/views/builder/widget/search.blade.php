@if($isSearch)
    <div class="block full"
         style="@if(isset($_GET['page']) && count($_GET) > 1) display: block @else display:none @endif"
         id="search">
        <form action="" method="get" class="form-inline" style="text-align: right">
            <input type="hidden" value="@if(isset($_GET['page'])){{$_GET['page']}}@else{{1}}@endif" name="page">
            @foreach($fromData as $key=>$fd)
                <div class="form-group">
                    <label class="sr-only" for="{{$fd['value']}}">{{$fd['name']}}</label>
                    <input type="text" value="{{$_GET[$fd['value']]}}" id="{{$fd['value']}}"
                           name="{{$fd['value']}}"
                           class="form-control"
                           placeholder="{{$fd['name']}}">
                </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-effect-ripple btn-primary"
                        style="overflow: hidden; position: relative;">搜索
                </button>
            </div>
        </form>
    </div>
@endif