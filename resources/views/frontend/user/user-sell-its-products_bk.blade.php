@extends('frontend.user.user-masters')

@section('user-content')
<div class="column content">
    <div class="sell-product-page">
        <div class="tab-container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                
                <li class="nav-item">
                    {{-- <a class="nav-link smooth-transition skip_tab_down cust" id="profile-tab" data-toggle="tab" href="#general" role="tab" aria-controls="product-general" aria-selected="false">GENERAL</a> --}}
                    <a class="nav-link active smooth-transition condtion-and-fault" href="#general" role="tab" data-toggle="tab" aria-controls="product-general" aria-selected="false">GENERAL</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link smooth-transition condtion-and-fault" style="display:none" id="home-tab" data-toggle="tab" href="#image" role="tab" aria-controls="product-image" aria-selected="true">IMAGE</a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link smooth-transition" id="categories-tab" data-toggle="tab" href="#categories"
                        role="tab" aria-controls="product-categories" aria-selected="false">Categories</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link smooth-transition skip_tab_down" id="brand-tab" data-toggle="tab" href="#brand" role="tab"
                        aria-controls="product-brand" aria-selected="false">BRANDS</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link smooth-transition condtion-and-fault" style="display:none" id="condition-tab" data-toggle="tab" href="#condition" role="tab" aria-controls="product-condition" aria-selected="false">CONDITION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smooth-transition condtion-and-fault" style="display:none" id="fault-tab" data-toggle="tab" href="#fault" role="tab" aria-controls="product-fault" aria-selected="false">FAULT(S)</a>
                </li>
                <li class="nav-item ">
                    {{-- <a class="nav-link smooth-transition skip_tab_up" id="sizes-tab"  data-toggle="tab" href="#sizes" role="tab" aria-controls="product-sizes" aria-selected="false">SIZES</a> --}}
                    <a class="nav-link smooth-transition condtion-and-fault" id="sizes-tab" data-toggle="tab" href="#sizes" role="tab" aria-controls="product-sizes" aria-selected="false">SIZES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smooth-transition condtion-and-fault skip_tab_up" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="product-overview" aria-selected="false">OVERVIEW</a>
                </li>
            </ul>
            <div class="tabs-pane-wrapper">
                <form action="{{route('vendor-products')}}" method="post" enctype=multipart/form-data>
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                            <h5>Product Image</h5>


                            <div style="text-align:center;margin-top:15%;">
                                <!-- <h5>Upload Additional Images</h5> -->
                                <h5>Feature Image</h5>

                                {{-- <p>You can select: <span></span> image</p>  --}}

                            </div>
                            
                            <!-- Hide Image tab section and brought the feature image tab in here 29/12/2022 -->
                            <!-- <div style="text-align:center;margin-left: 16%;">
                                <input type="file" multiple name="multi_images[]" required class="cust" style="width:60%;">
                            </div> -->
                            <!-- Hide Image tab section and brought the feature image tab in here 29/12/2022 -->
                            <div class="unique">
                            <div id="abs" style="display:none;">
                                <div class="img-tab-pane-sec1">
                                    <div class="img-holder">
                                        <img id="blah" src="{{asset('assets/images/product-placeholder.png')}}" alt="">
                                    </div>
                                    <input type="file" class="cutom-file-button" onchange="readURL(this);" name="feature_image" id="image-picker" style="width:59%;">
                                    <label class="sr-only" for="image-picker">Feature Image</label>
                                </div>
                            </div>
                            </div>
                            
                            <input type="file" id="files11" class="cutom-file-button" multiple name="multi_images[]" id="image-picker" style="width:59%;">

                            <div class="multiple-images" id="blah12">
                                <div id="abs">
                                    <div class="img-tab-pane-sec1">
                                        <div class="img-holder">
                                            <img src="{{asset('assets/images/product-placeholder.png')}}" alt="">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="abs">
                                    <div class="img-tab-pane-sec1">
                                        <div class="img-holder">
                                            <img src="{{asset('assets/images/product-placeholder.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div id="abs">
                                    <div class="img-tab-pane-sec1">
                                        <div class="img-holder">
                                            <img src="{{asset('assets/images/product-placeholder.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <h5>Product General</h5>

                            <div class="general-tab-pane-sec1">

                                {{-- <div class="form-group">
                                    <label for="name" class="col-md-6">Product Name</label>
                                    <input type="text" class="col-md-6" name="product_name" id="product_name">
                            </div> --}}

                                <div class="form-group">
                                    <label for="price" class="col-md-4">Selling Price</label>
                                    {{-- £<input type="text" class="col-md-6" name="price" id="price"> --}}

                                    <div class="input-group mb-2" style="margin-right: 33%;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">£</div>
                                        </div>
                                        <input type="text" class="form-control" name="price" id="price">

                                    </div>
                                    <input type="hidden" class="ship">

                                    <?php $fixed_shipping =   App\Models\Setting::where('key', 'fixed_shipping')->first(); ?>
                                    <?php $commission =   App\Models\Setting::where('key', 'commission')->first(); ?>
                                    <input type="hidden" id="commission" name="commission" value=<?php echo $commission->value; ?>>
                                    <input type="hidden" id="fixed_shipping" name="fixed_shipping" value=<?php echo $fixed_shipping->value; ?>>
                                </div>

                                <div class="form-group">
                                    <label for="sku" class="col-md-4">SKU</label>
                                    <input type="text" name="sku" id="sku" style="margin-right:33%;">
                                </div>
                                <div class="sku_list text-center">

                                </div>
                                {{-- <div class="form-group">
                                    <label for="sku" class="col-md-6">PID</label>
                                    <input type="text" class="col-md-6" name="product_id" id="product-id">
                                </div> --}}

                            </div>
                            <div class="general-tab-pane-sec2">
                                <div class="form-group">
                                    <label for="product">This product is</label><br>
                                    <label for="new">New</label>: <input type="radio" name="product_type" value="1" id="new" checked>
                                    <label for="pre-owned">Pre-Loved</label>: <input type="radio" value="2" name="product_type" id="pre-owned">
                                </div>
                                
                                <!-- Featured Image section move to above in image tab -->
                                <!-- <div id="abs" style="display:none;">

                                    <div class="img-tab-pane-sec1">
                                        <div class="img-holder">
                                            <img id="blah" src="{{asset('assets/images/product-placeholder.png')}}" alt="">
                                        </div>
                                        <input type="file" class="cutom-file-button" onchange="readURL(this);" name="feature_image" id="image-picker" style="width:59%;">
                                        <label class="sr-only" for="image-picker">Feature Image</label>
                                    </div>





                                </div> -->
                                <!-- Featured Image section move to above in image tab -->

                            </div>

                            <script>
                            </script>
                            {{-- <div class="general-tab-pane-sec3">
                                <input type="text" name="product_id" id="product-id"
                                    placeholder="Please enter the ID of the product">
                                <label class="sr-only" for="product-id">product-id</label>
                            </div> --}}

                        </div>
                        {{-- <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                           <h5>Product Categories</h5>

                            <div class="accordion" id="accordionExample">
                                <div class="accordian-item">
                                    <?php $shop_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get()->toArray();
                                    foreach ($shop_cats as $key => $shop_cat) {
                                    ?>
                                    <div class="" id="tab1">
                                        <h2 class="mb-0">

                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapse<?php echo $shop_cat['id']; ?>" aria-expanded="true"
                                                aria-controls="collapse<?php echo $shop_cat['id']; ?>">
                                                <?php echo $shop_cat['shop_cat_name']; ?> <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse<?php echo $shop_cat['id']; ?>" class="collapse" aria-labelledby="tab1">
                                        <div class="tab-body">
                                            <?php
                                            $child_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id', $shop_cat['id'])->orderBy('shop_cat_name', 'ASC')->get()->toArray();
                                            foreach ($child_cats as $key => $child_cat) {
                                            ?>
                                            <div class="form-group">
                                                <input type="radio" name="category_id" value="{{ $child_cat['id'] }}"
                        >
                        <label for="Hoodies"><?php echo $child_cat['shop_cat_name']; ?></label>
                    </div>
                <?php } ?>

            </div>
        </div>
    <?php } ?>
    </div>
</div>

</div> --}}
{{-- <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brands-tab">
                            <h5>Product Brands</h5>

                            <div class="accordion" id="accordionExample">
                                <div class="accordian-item">
                                    <?php 
                                        $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])->get()->toArray();
                                    ?>                            
                                    <div class="" id="tab1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                Brands <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse show" aria-labelledby="tab1" style="">
                                    
                                        <div class="tab-body">
                                        <?php foreach ($brands as $key => $brand) { ?>
                                            <div class="form-group">
                                                <input type="radio" name="brand_id" value="<?php echo $brand['id']; ?>">
                                                <label for="Hoodies"><?php echo $brand['brand_name']; ?></label>
                                            </div>
                                            <?php } ?>
                                                                                         
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
<div class="tab-pane fade" id="condition" role="tabpanel" aria-labelledby="condition-tab">
    <h5>Product Condition</h5>

    <p class="text-center">What is the condition of the product?</p>

    <div class="condition-tab-pane-sec1">
        <div class="form-group">
            <ul>
                <li>
                    <label for="radio-condition1">Brand new without tags
                        <font>Product hasn't been worn, but tags have been removed</font>
                    </label>
                    <input type="radio" id="radio-condition1" value="Brand new without tags" name="condition">
                    {{-- <input type="radio" id="radio-condition1" value="" name="condition">  --}}
                </li>
                <li>
                    <label for="radio-condition2">Minimal Wear
                        <font>Product has been be worn a couple of occasions, but no wear to the product</font>
                    </label>
                    <input type="radio" id="radio-condition2" value="Minimal Wear" name="condition">
                </li>
                <li>
                    <label for="radio-condition3">Slight Wear
                        <font>Product has been worn on a few occasions but no damage</font>
                    </label>
                    <input type="radio" id="radio-condition3" value="Slight Wear" name="condition">
                </li>
                <li>
                    <label for="radio-condition4">Moderate Wear
                        <font>Product has been worn on multiple occasions and it has some stains/marks</font>
                    </label>
                    <input type="radio" id="radio-condition4" value="Moderate Wear" name="condition">
                </li>
                <li>
                    <label for="radio-condition5">Visible Wear / Damage
                        <font>Product has been worn on multiple occasions and there is damage to the product</font>
                    </label>
                    <input type="radio" id="radio-condition5" value="Visible Wear / Damage" name="condition">
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="fault" role="tabpanel" aria-labelledby="fault-tab">
    <h5>Product Faults</h5>

    <p class="text-center">Please list all faults here</p>

    <div class="fault-tab-pane-sec1">
        <div class="form-group">
            <ul>
                <li>

                    <div>
                        <label for="defaultCheck1">
                            No Faults
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product has no faults.</span>
                            <i class="fa fa-question" data-toggle="tooltip" data-placement="top" title=""></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][0]" value="No Faults" id="defaultCheck1">

                </li>
                <li>

                    <div>
                        <label for="defaultCheck2">
                            No Original Packing
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product is missing some/all of the packaging it come with (could be Tags, Dust bags, Wrapping).</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][1]" value="No Original Packing" id="defaultCheck2">

                </li>
                <li>

                    <div>
                        <label for="defaultCheck3">
                            Stains / Marks
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product is Stained or Marked.</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][2]" value="Stains / Marks" id="defaultCheck3">

                </li>
                <li>
                    <div>
                        <label for="defaultCheck4">
                            Rips / Tears
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product has a hole</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][3]" value="Rips / Tears" id="defaultCheck4">

                </li>
                <li>
                    <div>
                        <label for="defaultCheck5">
                            Manufacturing Fault
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product has a fault that was made during manufacturing (could be Structing, Glue, Slanted Logo).</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][4]" value="Manufacturing Fault" id="defaultCheck5">

                </li>
                <li>
                    <div>
                        <label for="defaultCheck6">
                            Discolouring
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product is not the same colours as when bought (could be Washed out or Faded)</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][5]" value="Discolouring" id="defaultCheck6">

                </li>
                <li>
                    <div>
                        <label for="defaultCheck7">
                            Missing Labels
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product is missing some of the labels inside.</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][6]" value="Missing Labels" id="defaultCheck7">

                </li>
                <li>
                    <div>
                        <label for="defaultCheck8">
                            Missing Part(s)
                        </label>
                        <div class="my_tooltip">
                            <span class="my_tooltip_element">This product is missing certain parts (could be Buttons, Strings or Zips).</span>
                            <i class="fa fa-question"></i>
                        </div>
                    </div>
                    <input type="checkbox" name="product[faults][7]" value="Missing Part(s)" id="defaultCheck8">

                </li>

                <script>
                    let question_mark = document.querySelectorAll(".fa-question");
                    let tool_tip = document.querySelectorAll(".my_tooltip_element");

                    for (let i = 0; i < question_mark.length; i++) {
                        let x = tool_tip[i]
                        question_mark[i].addEventListener('click', () => {
                            x.classList.toggle("d-block")
                        })
                    }
                </script>

            </ul>
        </div>
    </div>
</div>
<div class=" tab-pane fade" id="sizes" role="tabpanel" aria-labelledby="sizes-tab">
    <h5>Product Sizes</h5>

    <div class="accordion1" id="accordionExample1">
        <div class="brands-tab">
            <div id="b1">
                <div class="mb-0">

                </div>
            </div>
        </div>
    </div>

</div>
<div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
    <h5>Product Overview</h5>
    <ul>
        <li>
            <p>Selling Price: £<span id="selling_price"></span></p>
        </li>
        <li>
            <p>Transaction Fee: £<span id="transaction_fee" class="trn"></span></p>
        </li>
        <li>
            <p>Shipping Fee: £<span id="shipping_fee"></span></p>
        </li>
        <li>
            <p>Payout Amount: £<span id="payout"></span></p>
        </li>
    </ul>
</div>

</div>
<div class="buttons-wrapper">
    <div class="col-md-4">
    <button type="button" class="prevtab btn blue-button">Previous</button>
    </div>
    <div class="col-md-4">
    <div class="buttons-wrapper-inner">
        <div class="form-group">
            <input type="checkbox" name="draft" value="draft" id="draft">
            <label for="draft">Draft</label>
        </div>
        <button type="submit" class="btn blue-button">Publish</button>
    </div>
    </div>
    <div class="col-md-4 text-right text-align-right">
    <button type="button" class="nexttab btn blue-button next_btn_right_show">Next</button>
    </div>
</div>
</form>
</div>

</div> <!-- /.container -->


</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(this).on('load', function(){
        // alert("545");
        $(".prevtab").css("display","none");
    });

    $("#overview-tab").click(function() {

        var tp = parseFloat($("#price").val());
        var tr = tp * 7.5 / 100;
        var shipping = parseFloat($(".ship").val());
        var payt = tp - tr - shipping;
        $("#selling_price").text(tp.toFixed(2));
        $("#transaction_fee").text(tr.toFixed(2));
        $("#payout").text(payt.toFixed(2));

    });

    $("#pre-owned").change(function() {
        $("#abs").show();
    });

    $("#new").change(function() {
        $("#abs").hide();
        $("a.nav-link.active").css("display","block");
        $("#sizes-tab").css("display","block");
        $("#overview-tab").css("display","block");
    });

    function hide_general(){
        if( $('#general').css('opacity') == 1 )  { 
            $('#general').css('display','none');
        } 
    }
    

    function bootstrapTabControl() {
        var i, items = $('.tab-container .nav-link'),
            pane = $('.tab-container .tab-pane');

        function show_general_tab(){
            if ($("#pre-owned").prop("checked")) {
                if(i == 1){
                    $('#image').css('display','none');
                    $('#general').css('display','block');
                    $('#general').css('opacity','1');
                    // alert("JJKJK");
                    // $('#general').css('opacity','1');
                }else{
                    $('#general').css('opacity','0');
                    $('#general').css('display','none');
                } 
            }
        }

        function show_image_tab(){
            if ($("#pre-owned").prop("checked")) {
                if(i == 2){
                    $('#image').css('display','block');
                    $('#image').css('opacity','1');
                    $('#general').css('display','none');
                    $('#condition').css('display','none');
                    // alert("UIUIU22");
                }else{
                    $('#image').css('opacity','0');
                }
            } 
        }

        function show_condition_tab(){
            if ($("#pre-owned").prop("checked")) {
                if(i == 3){
                    $('#condition').css('display','block');
                    $('#condition').css('opacity','1');
                    // $('#general').css('display','none');
                    // alert("UIUIU22");
                }else{
                    $('#condition').css('opacity','0');
                    $('#condition').css('display','none');
                }
            } 
        }

        function show_image_tab_next(){
            if ($("#pre-owned").prop("checked")) {
                if(i == undefined){
                    $('#image').css('display','block');
                    $('#image').css('opacity','1');
                    $('#general').css('display','none');
                    $('#condition').css('display','none');
                    // alert("UIUIU22");
                }else{
                    $('#image').css('opacity','0');
                    $('#image').css('display','none');
                }
            } 
        }

        function show_condition_tab_next(){
            if ($("#pre-owned").prop("checked")) {
                if(i == 0){
                    $('#condition').css('display','block');
                    $('#condition').css('opacity','1');
                    $('#image').css('display','none');
                    // alert("UIUIU22");
                }else{
                    $('#condition').css('opacity','0');
                    $('#condition').css('display','none');
                }
            } 
        }
        
        // next
        $('.nexttab').on('click', function(e) {
            console.log("==> Next " + i);
            // show_general_tab();
            // show_image_tab();
            // show_condition_tab();
            show_image_tab_next();
            show_condition_tab_next();
            if ($("#new").prop("checked")) {
                if(i == undefined || i != 0 ){
                    // alert("INSIDE");
                    // $("#general").removeClass(" show active");
                    $("#general").css("display","none");
                    $("#sizes-tab").addClass('active');
                    $(pane[2]).removeClass('show active');
                    $(pane[4]).addClass('show active');
                    $(".prevtab").css("display","block");
                    // hide_general();
                    
                }else if(i == 0){
                    // alert("jlj"+i);
                    $("#sizes-tab").removeClass('active');
                    $("#condition").css("display","none");
                    $(".prevtab").css("display","block");
                    $(".nexttab").css("display","none");
                    $("#overview-tab").addClass('active');
                    $(pane[4]).removeClass('show active');
                    $(pane[5]).addClass('show active');
                    hide_general();
                } else{
                    // alert("hh" +i);
                    // break;
                }
                
            } else if ( i == 3 ){
                $(".nexttab").css("display","none");
                console.log("3 Index of i")
            }

            hide_general();
            $(".prevtab").css("display","block");
            var custom_imag = $(".cust").val();
            // if (custom_imag.length > 0) {
                if ($("#profile-tab").hasClass("active")) {
                    if ($("#pre-owned").prop("checked")) {
                        var custom_image = $(".cutom-file-button").val();
                        if (custom_image.length > 0) {

                            var price = $("#price").val();
                            var tr = price * 7.5 / 100;
                            var shipping = parseFloat($(".ship").val());

                            var payout = price - tr - shipping;
                            $("#transaction_fee").text(tr.toFixed(2));
                            $("#payout").text(payout.toFixed(2));
                            for (i = 0; i < items.length; i++) {
                                if ($(items[i]).hasClass('active') == true) {
                                    break;
                                }
                            }
                            
                            //console.log($(items[i]).hasClass('condtion-and-fault') &&  $(items[i]).css('display') == 'none');
                            if (i < items.length - 1) {
                                // for tab
                                if (items[i].matches('.skip_tab_down')) {
                                    if ($("#pre-owned").prop("checked") == true) {
                                        $(items[i]).removeClass('active');
                                        $(items[i + 1]).addClass('active');
                                        // for pane
                                        $(pane[i]).removeClass('show active');
                                        $(pane[i + 1]).addClass('show active');

                                    } else {

                                        $(items[i]).removeClass('active');
                                        $(items[i + 3]).addClass('active');
                                        // for pane
                                        $(pane[i]).removeClass('show active');
                                        $(pane[i + 3]).addClass('show active');

                                    }
                                } else {
                                    $(items[i]).removeClass('active');
                                    $(items[i + 1]).addClass('active');
                                    // for pane
                                    $(pane[i]).removeClass('show active');
                                    $(pane[i + 1]).addClass('show active');
                                }
                            }
                        } else {
                            alert("Please upload image");
                        }
                    } else {
                        
                        // Go Next tabs custom
                        $(pane[i]).removeClass('show active');
                        $(pane[i + 1]).addClass('show active');
                        // Go Next tabs custom
                        
                        var price = $("#price").val();
                        var tr = price * 7.5 / 100;
                        var shipping = parseFloat($(".ship").val());
                        var payout = price - tr - shipping;

                        $("#transaction_fee").text(tr.toFixed(2));
                        $("#payout").text(payout.toFixed(2));
                        for (i = 0; i < items.length; i++) {

                            if ($(items[i]).hasClass('active') == true) {
                                break;
                            }
                        }

                        //console.log($(items[i]).hasClass('condtion-and-fault') &&  $(items[i]).css('display') == 'none');
                        if (i < items.length - 1) {

                            // for tab
                            if (items[i].matches('.skip_tab_down')) {
                                if ($("#pre-owned").prop("checked") == true) {
                                    $(items[i]).removeClass('active');
                                    $(items[i + 1]).addClass('active');
                                    // for pane
                                    $(pane[i]).removeClass('show active');
                                    $(pane[i + 1]).addClass('show active');

                                } else {

                                    $(items[i]).removeClass('active');
                                    $(items[i + 3]).addClass('active');
                                    // for pane
                                    $(pane[i]).removeClass('show active');
                                    $(pane[i + 3]).addClass('show active');

                                }
                            } else {
                                $(items[i]).removeClass('active');
                                $(items[i + 1]).addClass('active');
                                // for pane
                                $(pane[i]).removeClass('show active');
                                $(pane[i + 1]).addClass('show active');
                            }
                        }
                    }

                } else {

                    var price = $("#price").val();
                    var tr = price * 7.5 / 100;
                    var shipping = parseFloat($(".ship").val());
                    var payout = price - tr - shipping;
                    $("#transaction_fee").text(tr.toFixed(2));

                    $("#payout").text(payout.toFixed(2));
                    for (i = 0; i < items.length; i++) {

                        if ($(items[i]).hasClass('active') == true) {
                            break;
                        }
                    }

                    //console.log($(items[i]).hasClass('condtion-and-fault') &&  $(items[i]).css('display') == 'none');
                    if (i < items.length - 1) {

                        // for tab
                        if (items[i].matches('.skip_tab_down')) {
                            if ($("#pre-owned").prop("checked") == true) {
                                $(items[i]).removeClass('active');
                                $(items[i + 1]).addClass('active');
                                // for pane
                                $(pane[i]).removeClass('show active');
                                $(pane[i + 1]).addClass('show active');

                            } else {

                                $(items[i]).removeClass('active');
                                $(items[i + 3]).addClass('active');
                                // for pane
                                $(pane[i]).removeClass('show active');
                                $(pane[i + 3]).addClass('show active');

                            }
                        } else {
                            $(items[i]).removeClass('active');
                            $(items[i + 1]).addClass('active');
                            // for pane
                            $(pane[i]).removeClass('show active');
                            $(pane[i + 1]).addClass('show active');
                        }
                    }
                }
            // } else {

            //     alert('Please select additional image');

            // }
        });

        $("#profile-tab").click(function() {


            var custom_imag = $(".cust").val();
            // if (custom_imag.length > 0) {
            if (custom_imag.length) {
                for (i = 0; i < items.length; i++) {
                    if ($(items[i]).hasClass('active') == true) {
                        break;
                    }
                }
                //console.log($(items[i]).hasClass('condtion-and-fault') &&  $(items[i]).css('display') == 'none');

                if (i <= items.length - 1) {
                    $(items[i]).removeClass('active');
                    $(pane[i]).removeClass('show active');

                    $(items[0 + 1]).addClass('active');
                    // for pane

                    $(pane[0 + 1]).addClass('show active');


                }
            } else {
                alert('Please select additional image');
            }

        });


        // Prev
        $('.prevtab').on('click', function() {
    
            if ($("#new").prop("checked")) {
                if(i == 1){
                    $("#sizes-tab").addClass('active');
                    $("#condition").css("display","none");
                    $(".nexttab").css("display","block");
                    $("#overview-tab").removeClass('active');
                    $(pane[5]).removeClass('show active');
                    $(pane[4]).addClass('show active');
                    // alert("hh" +i);
                }else if(i == 2){
                    $(".prevtab").css("display","none");
                    $("#image").css("display","none");
                    $("#sizes-tab").removeClass('active');
                    $(pane[4]).removeClass('show active');
                    $("#general").css("display","block");
                    $("#general").css("opacity","1");
                    
                }else{
                    // alert("hh" +i);
                    $("#general").css("opacity","0");
                    // break;
                }
             } 

            for (i = 0; i < items.length; i++) {
                if ($(items[i]).hasClass('active') == true) {
                    break;
                }
            }
            if (i != 0) {
                
                // for tab
                show_general_tab();
                show_image_tab();
                show_condition_tab();
                console.log(i);
                if (items[i].matches('.skip_tab_up')) {

                    $(items[i]).removeClass('active');
                    $(items[i - 1]).addClass('active');
                    // for pane
                    $(pane[i]).removeClass('show active');
                    $(pane[i - 1]).addClass('show active');
                } else {
                    $(items[i]).removeClass('active');
                    $(items[i - 1]).addClass('active');
                    // for pane
                    $(pane[i]).removeClass('show active');
                    $(pane[i - 1]).addClass('show active');
                }
            } else {
                $(".prevtab").css("display","none");
            }
        });
    }
    bootstrapTabControl();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(300);
            };
            $('#blah').show();

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $("#files11").change(function() {
            $('#blah12').html('');
        var  html = "";
            if (this.files && this.files[0]) {
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[i]);
            }
            }
        });
    });

    function imageIsLoaded(e) {

        html = '<div id="abs">';
        html += '    <div class="img-tab-pane-sec1">';
        html += '        <div class="img-holder">';
        html += '            <img src="'+e.target.result+'" alt="">';
        html += '       </div>';
        html += '    </div>';
        html += '</div>';
        
        // html = '<div class="img-box" style="position:relative; overflow:hidden;">';
        // html += '<img src="'+e.target.result+'" >';
        // html += '</div>';
        $('#blah12').append(html);

    };


    $(document).ready(function() {
        $('#overview-tab').click(function() {
            selling_price = $('#price').val().toFixed(2);
            commission = $('#commission').val();
            fixed_shipping = $('#fixed_shipping').val();

            total_selling_price = selling_price;
            $('#selling_price').html(total_selling_price);
            if ($('#price').val() > 0) {
                transaction = (total_selling_price * commission) / 100;
                //$('#shipping_fee').html("ANas");
                //$('#transaction_fee').html(parseFloat(transaction).toFixed(2));
                //$('#shipping_fee').html(fixed_shipping.toFixed(2));
                //payout = (total_selling_price - fixed_shipping - parseFloat(transaction).toFixed(2));
                //$('#payout').html(payout);
            }
        });

         $('#sku').change(function() {
            $('.sku_list').html('');
            var skyvalue = $('#sku').val();
            if(skyvalue !=""){
                $.ajax({
                    url: "{{ route('size-list-ajax') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        sku: skyvalue,
                        flags: 3,
                    },
                    success: function(result) {
                        $('.sku_list').html(result.product_name);
                    }
                });
            }
        });

        $('#sku').change(function() {
            //product_id = $('#product-id').val();
            sku = $('#sku').val();
            if (sku != "") {
                $.ajax({
                    url: "{{ route('size-ajax') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        // product_id: product_id,
                        sku: sku,
                        flags: 3,
                    },
                    success: function(result) {
                        if (result.message) {

                            // $('.search-class ').addClass('show');
                            // $('.search-class #para').html(result.message);

                            $('.alert-dismissible').addClass('success-alert');
                            $('.alert-dismissible').addClass('show').find('p').html(result.message);

                        } else {
                            //console.log(result);
                            shipping();
                            $('#accordionExample1').css('display', 'block').html(result);
                        }

                    }
                });
            }
        });

        function shipping() {

            sku = $('#sku').val();
            if (sku != "") {
                $.ajax({
                    url: "{{ route('shipping') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        // product_id: product_id,
                        sku: sku,

                    },
                    success: function(result) {

                        var a = JSON.parse(result);
                        $("#shipping_fee").text(a.shipping);
                        $(".ship").val(a.shipping);
                    }
                });
            }

        }

        $('.nexttab').click(function() {
            // if ($(".tab-content").find('.active').attr('id') == 'categories') {
            //     //product_id = $('#product-id').val();

            // }
            // if ($(".tab-content").find('.active').attr('id') == 'overview') {

                selling_price = $('#price').val();
                commission = $('#commission').val();
                fixed_shipping = $('#fixed_shipping').val();

                total_selling_price = parseFloat(selling_price);

                $('#selling_price').html(total_selling_price.toFixed(2));
                if ($('#price').val() > 0) {
                    transaction = (total_selling_price * commission) / 100;

                    var fg = parseFloat(fixed_shipping);
                    //$('#transaction_fee').html(parseFloat(transaction).toFixed(2));
                    //$('#shipping_fee').html(fg.toFixed(2));
                    //payout = (total_selling_price - fixed_shipping - parseFloat(transaction).toFixed(2));
                    //$('#payout').html(payout);
                }
            // }
            // if ($(".tab-content").find('active').attr('id') == 'condition') {

            // }
        });

        $("input[type='radio']").click(function() {
            var productType = $("input[name='product_type']:checked").val();
            if (productType == 1) {
                $('.condtion-and-fault').hide();
                $('#brand-tab').addClass('skip_tab_down');
                $('#sizes-tab').addClass('skip_tab_up');
            } else if (productType == 2) {
                $('.condtion-and-fault').show();
                $('#brand-tab').removeClass('skip_tab_down');
                $('#sizes-tab').removeClass('skip_tab_up');
            }
        });


    });
</script>


@endsection