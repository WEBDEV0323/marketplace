    @if($flags == 3)
        @if(count($sizes) > 0)
            @foreach($sizes as $size)
                <div id="b-tab1" aria-labelledby="b1">
                    <div class="form-group">
                        <input type="radio" name="size_id" id="" required value = "{{($size != null ?  $size->size_id : '' )}}">
                        <label for="">{{$size != null ? $size->size: ''}} </label>
                    </div>
                </div>
            @endforeach
        @endif
     @else
            @foreach($sizes as $size)
            <div id="b-tab1" aria-labelledby="b1">
                <div class="form-group">
                    <input type="radio" name="size_id" id="" required value = "{{($size->size != null ?  $size->size->id : '' )}}">
                    <label for="">{{$size->size != null ? $size->size->size : ''}} </label>
                </div>
            </div>
            @endforeach
    @endif
    </div>
