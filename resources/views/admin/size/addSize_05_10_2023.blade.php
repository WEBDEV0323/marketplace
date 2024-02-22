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
                        <form action = "{{route('size.process')}}" method = "post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Brand Name</label>
                                    <select required name="brand" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        @if(isset($brands))
                                            @foreach($brands as $brand)
                                                <option selected value="{{ $brand['id'] }}">
                                                    {{ $brand['brand_name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Select Gender</label>
                                    <select id="shop_cat_id" name="gender" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        @if(isset($genders))
                                            @foreach($genders as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->shop_cat_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Select Shop Category</label>
                                    <select id="shop_cat_id" name="shop_category" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" selected>{{ $category->shop_cat_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Size</label>
                                <input required type="text" name = "name" id="exampleInputEmail1" placeholder="Enter Your Size">
                            </div>


                            <div class="form-group">
                                <div class="new_more_sizes">                                   
                                </div>
                                <span class="inputname" ><br>
                                    <a href="#" class="add_project_file  btn btn-info btn-sm px-4"> Add</a>
                                </span>                               
                            </div><br> 


                            <input type="hidden" name="brand_id" value="{{ $brand_id }}">
                            <input type="hidden" name="shop_category_id" value="{{ $category_id }}">
                            <input type="hidden" name="gender" value="{{ $genders[0]->id }}">
                                      <!--  <div class="form-group">
                                        <label class="col-form-label">Parent Category</label>
                                        <select name = "parent_id" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                            <option  value="0">Select Parent Category</option>
                                            @if(isset($main_categories))
                                                @foreach($main_categories as $main_category)
                                                    <option value="{{$main_category['id']}}">{{$main_category['shop_cat_name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> -->
                                       
                                    
                                        
                                        <div class="panel-footer">
                                            <button type="submit" class="btn btn-primary mr-2 ">Save Size</button>
                                            <a href="{{route('size-home',$category_id )}}?brand_slug={{$brand_id ?? ""}}">   <button type="button" class="btn btn-danger">Cancel</button> </a>

                                         </div>
                                    </form>
                                </div>
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
     `<div class="mb-2 add_more_size_div"><input class="mb-0" required type="text" name="size_all[]" placeholder="Enter Your Size">
      <a href="#" class="remove_project_file btn btn-sm btn-danger mt-1" border="2">Remove</a></div>`);
});
// Remove parent of 'remove' link when link is clicked.
$('.new_more_sizes').on('click', '.remove_project_file', function(e) {
    e.preventDefault();
    $(this).parent().remove();
});
</script>
@endsection
