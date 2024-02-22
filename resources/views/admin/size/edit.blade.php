@extends('layouts.admin.master')
@section('body-content')
<div class="page-wrapper">
    <!-- Page Title -->
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2 class="page-title-text"></h2>
            </div>
            <div class="col-sm-6 text-right">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Dashboard</li>
                        <li>Size</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">                 
                    <div class="panel-body">               
                        <form action = "{{route('size.process')}}" method = "post" id="form_submit_size">
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Brand Name</label>
                                        <select name="brand" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                            @if(isset($brands))
                                            @foreach($brands as $brand)
                                            @if($size['brand_id']==$brand['id'])
                                            <option selected value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                            @else
                                            <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Gender</label>
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="gender" name="gender">
                                            @foreach ($list_gender as $lg) 
                                                @if($lg->parent_id == 0)
                                                <option value="{{ $lg->id}}" <?php if($gen['gender'] == $lg->id){?>selected <?php }?>>{{ $lg->shop_cat_name??'' }}</option>
                                                @endif        
                                            @endforeach
                                        </select>

                                        {{-- <select id="categories" name="categories" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="getcat(this.value);">
                                            @if(isset($categories))
                                            @foreach($list_gender as $category)
                                            <option value="{{$category->id}}" @if($gender==$category->id) selected @endif >{{$category->shop_cat_name}}</option>
                                            @endforeach
                                            @endif
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Category</label>
                                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categories" name="categories">
                                            @foreach ($categories as $category) 
                                                @if($category->parent_id != 0)
                                                <option value="{{ $category->id}}" <?php if($gen['shop_category_id'] == $category->id){?>selected <?php }?>>{{ $category->shop_cat_name??'' }}</option>
                                                @endif        
                                            @endforeach
                                        </select>

                                        {{-- <select id="shop_cat_id" name="shop_category" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                            @foreach($categories as $category)
                                            @if($category->parent_id != 0)
                                            @if(isset($product['shop_category']['id']) && $product['shop_category']['id'] == $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->shop_cat_name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                            @endif
                                            @endif
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="exampleInputEmail1">Size</label>
                                <input type="hidden" name="id" value="<?php echo $size['id'];?>">
                                <input required type="text" value="<?php echo $size['size'];?>" name = "name" id="exampleInputEmail1" placeholder="Enter Your Size">                         
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Size</label> 
                                <input required type="text" value="<?php echo $size['size_id'];?>" name = "size_id" id="exampleInputEmail1" placeholder="Enter Your Size">
                            </div> --}}
                            
                            <div class="form-group">
                                <div class="new_more_sizes">  
                                    @if(count($size_guide) > 0)
                                        @foreach($size_guide as $row)
                                            <div class="mb-4 add_more_size_div">
                                                <input class="mb-1 befor_exit_same_size" required type="text" name="size_all_title_old[{{$row->id}}]" value="{{$row->guide_size_title}}"  placeholder="Enter Your Title">
                                                <input class="mb-0 " required type="text" name="size_all_old[{{$row->id}}]" value="{{$row->guide_size}}" placeholder="Enter Your Size">
                                                <a href="#" class="remove_project_file btn btn-sm btn-danger mt-1">Remove</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <span class="inputname " >
                                    <br>
                                    <a href="#" class="add_project_file  btn btn-info btn-sm px-4"> Add</a>
                                </span> 
                                                            
                            </div> <br> 


                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary mr-2 btn_upload_size">Update Size</button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger btn-outline-1x">Cancel</a>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Add new input with associated 'remove' link when 'add' button is clicked.
$('.add_project_file').click(function(e) {
    e.preventDefault();
    $(".new_more_sizes").append(
        `<div class="mb-2 add_more_size_div">
        <input class="mb-1 befor_exit_same_size" required type="text" name="size_all_title[]" placeholder="Enter Your Title">
        <input class="mb-0 " required type="text" name="size_all[]" placeholder="Enter Your Size">
      <a href="#" class="remove_project_file btn btn-sm btn-danger mt-1" border="2">Remove</a></div>`);
});
// Remove parent of 'remove' link when link is clicked.
$('.new_more_sizes').on('click', '.remove_project_file', function(e) {
    e.preventDefault();
    $(this).parent().remove();
});

$('#form_submit_size').submit(function(e) {
    e.preventDefault();    
    var values = [];
    var hasDuplicate = false;
    $('.befor_exit_same_size').each(function () {
        var value = $(this).val();            
        if (values.indexOf(value) !== -1) {
            hasDuplicate = true;
            return false;
        } else {
            values.push(value);
        }
    });
    if (hasDuplicate) {
        alert('Size guide title are not allowed same');
    } else {
        this.submit();
    }      
})

</script>
@endsection