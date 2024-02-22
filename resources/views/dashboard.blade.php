
@extends('layouts.admin.master')

@section('body-content')

<div class="page-wrapper">
    
    <!-- Page Body -->
    <div class="page-body">
      

        <section class="dashboard-stats-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <a href="#" class="btn stats-btn" data-toggle="modal" data-target="#revenue-modal">
                        <div class="stat-box color-primary">
                            <div class="textual-detail">
                                <h1 class="value">£ {{number_format((float)$data["total_revenue"], 2, '.', '')}}</h1>
                                <h5 class="title">revenue</h5>
                            </div>
                            <div class="icon">
                                <i class="icon-layers"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn stats-btn" data-toggle="modal" data-target="#orders-made-modal">
                        <div class="stat-box color-magenta">
                            <div class="textual-detail">
                                <h1 class="value">{{$data["total_orders"]}}</h1>
                                <h5 class="title">orders made</h5>
                            </div>
                            <div class="icon">
                                <i class="icon-layers"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn stats-btn" data-toggle="modal" data-target="#orders-pending-modal">
                        <div class="stat-box color-danger">
                            <div class="textual-detail">
                                <h1 class="value">{{ $data["cart"] + $data["shipped"] }}</h1>
                                <h5 class="title">orders pending</h5>
                            </div>
                            <div class="icon">
                                <i class="icon-layers"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn stats-btn" data-toggle="modal" data-target="#users-modal">
                        <div class="stat-box color-success">
                            <div class="textual-detail">
                                <h1 class="value">{{$data["user"]}}</h1>
                                <h5 class="title">Unverified Users</h5>
                            </div>
                            <div class="icon">
                                <i class="icon-layers"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="btn stats-btn" data-toggle="modal" data-target="#sellers-modal">
                        <div class="stat-box color-warning">
                            <div class="textual-detail">
                                <h1 class="value">{{$data["seller"] + $data["waiting"] }}</h1>
                                <h5 class="title">sellers</h5>
                            </div>
                            <div class="icon">
                                <i class="icon-layers"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <div class="website-traffic">

            <h1>Website Traffic</h1>

            <div class="row">
                <div class="col-sm-4">
                    <div class="box">
                        <h2 class="value numscroller" data-delay='5' data-increment='89'>{{$data["yesterday"]}}</h2>
                        <h5 class="title">Yesterday</h5>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box">
                        <h2 class="value numscroller"  data-delay='5' data-increment='143'>{{$data["week"]}}</h2>
                        <h5 class="title">last Week</h5>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box">
                        <h2 class="value numscroller" data-delay='5' data-increment='973'>{{$data["month"]}}</h2>
                        <h5 class="title">last Month</h5>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Revenue Modal -->
        <div class="modal fade common-popup" id="revenue-modal" tabindex="-1" role="dialog" aria-labelledby="revenue-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            +
                        </button>
                        <h5 class="modal-title" id="orders-made-modalLabel">Revenue</h5>

                        <form action="">
                            <div class="big-box">
                                <div class="box">
                                    <div class="input-group">
                                        <label for="gender">Select Gender</label>
                                        <div class="select-wrapper">
                                            <select name="gender" id="gender">
                                                <option value="">choose..</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Children</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="data-box">
                                        <h1 class="numbers gender_revenue"></h1>
                                        <h5 class="title">Revenue Per Gender</h5>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="input-group">
                                        <label for="gender">Select Category</label>
                                        <div class="select-wrapper">
                                            <select class="cateoptionselect" name="category" id="category">
                                            
                                                <option value="">choose..</option> 
                                             <option class="cateoptionhead" disabled value="">Menswear</option>
                                                @foreach($data["menswear"] as $category)
                                                
                                                <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                                
                                                @endforeach
                                                <option class="cateoptionhead" disabled value="">Womenswear</option>
                                                @foreach($data["womenswear"] as $category)
                                                
                                                <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                                
                                                @endforeach

                                                <option class="cateoptionhead" disabled value="">Childrens</option>
                                                @foreach($data["children"] as $category)
                                                
                                                <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                                
                                                @endforeach

                                            </select> 


                                      {{--      <select class="cateoptionselect" name="category" id="category">
                                            
                                                <option value="">choose..</option> 
                                                @foreach($data["categories"] as $category)
                                                
                                                <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                                
                                                @endforeach
                                             
                                    
                                            </select> --}}
                                              
                                        </div>
                                        
                                    </div>
                                    <div class="data-box">
                                        <h1 class="numbers cat_rev">£{{-- {{$data["total_category"]}} --}}{{number_format((float)$data["total_revenue"], 2, '.', '')}}</h1>
                                        <h5 class="title">Revenue Per Category</h5>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                      
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Orders Made Modal -->
        <div class="modal fade common-popup" id="orders-made-modal" tabindex="-1" role="dialog" aria-labelledby="orders-made-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            +
                        </button>
                        <h5 class="modal-title" id="orders-made-modalLabel">Orders Made</h5>
                        
                        <div class="detail-box">
                            <div class="box">
                                <h2 class="numbers">{{$data["shipped"]}}</h2>
                                <t5 class="title">shipped</t5>
                            </div>
                            <div class="box">
                                <h2 class="numbers">{{$data["not_shipped"]}}</h2>
                                <t5 class="title">not shipped</t5>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Orders Pending Modal -->
        <div class="modal fade common-popup" id="orders-pending-modal" tabindex="-1" role="dialog" aria-labelledby="orders-pending-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            +
                        </button>
                        <h5 class="modal-title" id="orders-made-modalLabel">Orders Pending</h5>
                        
                        <div class="detail-box">
                            <div class="box">
                                <h2 class="numbers">{{$data["cart"]}}</h2>
                                <t5 class="title">in cart</t5>
                            </div>
                            <div class="box">
                                <h2 class="numbers">{{$data["shipped"]}}</h2>
                                <t5 class="title">shipped to us</t5>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Users Modal -->
        <div class="modal fade common-popup" id="users-modal" tabindex="-1" role="dialog" aria-labelledby="users-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            +
                        </button>
                        <h5 class="modal-title" id="orders-made-modalLabel">Unverified Users</h5>
                        
                        <div class="detail-box">
                         {{--   <div class="box">
                                <h2 class="numbers">{{$data["user"]}}</h2>
                                <t5 class="title">all users</t5>
                            </div>  --}}
                            <div class="box">
                                <h2 class="numbers">{{$data['unverified_users']}}</h2>
                                <t5 class="title">Unverified Users</t5>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Sellers Modal -->
        <div class="modal fade common-popup" id="sellers-modal" tabindex="-1" role="dialog" aria-labelledby="sellers-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            +
                        </button>
                        <h5 class="modal-title" id="orders-made-modalLabel">Sellers</h5>
                        
                        <div class="detail-box">
                            <div class="box">
                                <h2 class="numbers">{{$data["seller"]}}</h2>
                                <t5 class="title">all sellers</t5>
                            </div>
                            <div class="box">
                                <h2 class="numbers">{{$data["waiting"]}}</h2>
                                <t5 class="title">waiting to be approved</t5>
                            </div>
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

$(document).ready(function(){



   $("#gender").change(function(){
        let val=$(this).val();
        category=$("#category").val();

       
        $.ajax({
                url: '{{route("gender")}}',
                method: 'get',
                data: {
                gender: val,
                //category:  category
            },
            success: function (result) 
            {
             var total_price=0;   
             var ab=0;
             var kam=JSON.parse(result);
             for(i=0; i<kam.length; i++)
             {
                var price=parseFloat(kam[i].price);
                var shipping=parseFloat(kam[i].product_shipping);
                var processing=parseFloat(kam[i].product_processing);
                var discount=parseFloat(kam[i].product_discount);
                var k=price-discount+shipping+processing;
               total_price=total_price+k;

             }

             $(".gender_revenue").text("£"+total_price);
                    //$(".cat_rev").text("£"+result.total_price);
            }
        });
    });
    $("#category").change(function(){
        let gender=$("#gender").val();
        let val=$(this).val();

        $.ajax({
                url: "{{route("category")}}",
                method: 'get',
                data: {
                category: val,
                gender : gender
            },
            success: function (result) 
            {
              
                var total_price=0;   
             var ab=0;
             var kam=JSON.parse(result);

         
             
             for(i=0; i<kam.length; i++)
             {
                var price=parseFloat(kam[i].price);
                var shipping=parseFloat(kam[i].product_shipping);
                var processing=parseFloat(kam[i].product_processing);
                var discount=parseFloat(kam[i].product_discount);
                var k=price-discount+shipping+processing;
               total_price=total_price+k;

             }

             
                    $(".cat_rev").text("£"+total_price.toFixed(2));
















            }
        });
    });
});


</script>

@endsection

