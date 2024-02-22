


@if(isset($data) && $flags == 1)
<option value="0">Select Your Shop Category</option>
    @foreach($data as $color)

        <option value="{{ $color->id }}">{{ $color->shop_cat_name }}</option>

    @endforeach
@endif



@if(isset($data) && $flags == 2)
{{--
<?php
    $sz=array();
    $names=array();
    $j=0;

?>

    @foreach($data as $i=>$category_size)
    @if($category_size->size->size!="XXXL")

    <?php
    $sz[$j]["value"]=$category_size->size->size;
    $sz[$j]["size_id"]=$category_size->size->id;
    $names[$j]=$category_size->size->size;
    ?>

    <?php $j=$j+1; ?>
    @endif
    @endforeach



<?php

$a=array_multisort($names, SORT_ASC, $sz);



?>
<?php
    $i=0;
?>

@foreach($data as $category_size)
    @if($category_size->size->size!="XXXL")



    <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3 col-md-4">
        <input type="checkbox" name="category_size_id[ {{$sz[$i]['size_id']}}]" value="{{$sz[$i]['size_id']}}"  class="custom-control-input" id="{{$sz[$i]['size_id']}}">
        <label class="custom-control-label" for="{{$sz[$i]['size_id']}}">{{$sz[$i]['value']}}</label>
        <input type="hidden" name="size_id[ {{$sz[$i]['size_id']}}]" value="{{$sz[$i]['size_id']}}" >
        <input class = "form-control" type="text" name="category_size_quantity[{{$sz[$i]['size_id']}}]" placeholder = "Please Enter Stock this size {{$sz[$i]['value']}} ">
    </div>


    <?php

    $i++;
        ?>
    @endif



    @endforeach
@endif  --}}



{{-- new code for size add --}}
@if($admin_size_get == "Yes")
    @foreach($data as $category_size)
        <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3 col-md-4" style="float: left;">
            <input type="checkbox" name="size_id[]" value="{{$category_size->size->id}}" class="custom-control-input" id="{{$category_size->size->id}}">        
            <label class="custom-control-label" for="{{$category_size->size->id}}">{{$category_size->size->size}}</label>        
            <input class="form-control" type="text" value="" name="category_size_quantity[{{ $category_size->size->id }}]" placeholder="Please Enter Stock this size">
        </div>
    @endforeach
@else
{{-- new code for size add --}}
    @foreach($data as $category_size)
        <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3 col-md-4">
            <input type="checkbox" name="category_size_id[ {{$category_size->size->id}}]" value="{{$category_size->size->id}}"  class="custom-control-input" id="{{$category_size->size->id}}">
            <label class="custom-control-label" for="{{$category_size->size->id}}">{{$category_size->size->size}}</label>
            <input type="hidden" name="size_id[ {{$category_size->size->id}}]" value="{{$category_size->size->id}}" >
            <input class = "form-control" type="text" name="category_size_quantity[{{$category_size->size->id}}]" placeholder = "Please Enter Stock this size {{$category_size->size->size}} ">
        </div>
    @endforeach
@endif


   
@endif




