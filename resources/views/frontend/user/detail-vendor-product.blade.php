@extends('frontend.user.user-masters')
@section('user-content')
<div class="column content ajax_response">
   
<div class="my-listings-page table-responsive">

    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>
                                    <p>Product ID</p>
                                </th>
                                <th>
                                    <p>Product Name</p>
                                </th>
                                <th>
                                    <p>Brand Name</p>
                                </th> 
                                <th>
                                    <p>Total Quantity</p>
                                </th>
                                <th>
                                    <p>Sold Quantity</p>
                                </th>
                                <th>
                                    <p>Remaining Quantity</p>
                                </th>
                                <th>
                                    <p>Total Payout</p>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($vendor_products as $vendor_product)
                            <tr>
                                <td>
                                    <p>{{$vendor_product->vendor_product->product->id}}</p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->vendor_product->product->product_name}}</p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->vendor_product->brand->brand_name}}</p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->vendor_product->vendor_quantity}}</p>
                                </td>
                                <td>
                                    <p><?php 
                                        if($vendor_product->vendor_product->vendor_quantity > 0){
                                            $vendor_stock =  $vendor_product->vendor_product->vendor_stock->quantity;
                                            echo ($vendor_product->vendor_product->vendor_quantity - $vendor_stock);
                                        }
                                    ?></p>
                                </td>
                                <td>
                                    <p><?php 
                                        if($vendor_product->vendor_product->vendor_quantity > 0){
                                            $vendor_stock =  $vendor_product->vendor_product->vendor_stock->quantity;
                                            echo $vendor_stock;
                                        }
                                    ?></p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->vendor_product->price}}</p>
                                </td>
                                
                                
                            </tr>
                            <tr style = "margin-left:20%" > 
                                <th><p>Due Amount</p></th>
                                <th><p>Paid Amount</p></th>
                                <th><p>Category</p></th>
                                <th><p>Date</p></th>
                            </tr>
                            <tr style = "margin-left:20%">
                            
                                <td>
                                    <p>{{$vendor_product->due_amount}}</p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->paid_amount}}</p>
                                </td>
                                <td>
                                    <p>{{$vendor_product->vendor_product->category->shop_cat_name}}</p>
                                </td>
                                <?php $originalDate = $user->created_at;
                                                        $newDate = date("d-m-Y", strtotime($originalDate));?>
                                                <td><p>{{$newDate}}<p></td>
                            </tr >
                            <th>
                                    <p>Product ID</p>
                                </th>
                                <th>
                                    <p>Product Name</p>
                                </th>
                                <th>
                                    <p>Brand Name</p>
                                </th> 
                                <th>
                                    <p>Total Quantity</p>
                                </th>
                                <th>
                                    <p>Sold Quantity</p>
                                </th>
                                <th>
                                    <p>Remaining Quantity</p>
                                </th>
                                <th>
                                    <p>Total Payout</p>
                                </th>
                               
                            @endforeach
                        </tbody>
                    </table>

</div>

@endsection
