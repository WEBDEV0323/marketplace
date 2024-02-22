@extends('layouts.admin.master')

@section('styles')
    <style>
        .main-section {
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
            background-color: #fff;
            box-shadow: 0px 0px 20px #c1c1c1;
        }

        .fileinput-remove,
        .fileinput-upload {
            display: none;
        }

        #blah {
            display: none;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="page-title-text">
                        <h2>Abandoned Carts</h2>
                    </h2>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="breadcrumbs">
                        <ul>
                            <!-- Add breadcrumbs if needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <!-- Panel title if needed -->
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="container mt-4">
                                <h1>Abandoned Carts</h1>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th>Email</th>
                                                <th>Items in Cart (Quantity)</th>
                                                <th>Cart total</th>
                                               	<th>Date - Added to cart</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($abandonedCarts as $cartItem)
                                                <tr>
                                                     
                                                    <td>{{ $cartItem->user->email }}</td>
                                                    <td>
                                                       
                                                    @php
                                                        $totalQuantity = 0;
                                                    @endphp

                                                    @foreach ($cartItem->carts as $relatedCartItem)
                                                        
                                                        @php
                                                            $totalQuantity += $relatedCartItem->quantity;
                                                        @endphp
                                                        
                                                    @endforeach

                                                     {{ $totalQuantity }}

                                                      
                                                      
                                                      
                                                    </td>
                                                    <td>{{ number_format($cartItem->total_price, 2, '.', ',') }}</td>
                                                    
                                                  <td>
                                                      @php
                                                          $lastProductDate = null;
                                                      @endphp

                                                      @foreach ($cartItem->carts as $relatedCartItem)
                                                          
                                                          @php
                                                              $lastProductDate = $relatedCartItem->created_at;
                                                          @endphp
                                                      @endforeach

                                                      @if ($lastProductDate)
                                                          {{ $lastProductDate->format('Y-m-d') }}
                                                      @endif
                                                  </td>

                                                  
                                                  
                                                  <td>
                                                    
                                                     <button class="btn btn-danger">  
                                                       <a href="{{ route('abandoned-cart-detail', ['id' => $cartItem->id]) }}">
        												View Details
                                                       </a> </button>             
                                                    
                                                   <button class="btn btn-danger" 
                                                            onclick="deleteCartItem({{ $cartItem->user_id }}, {{ $cartItem->id }})">
                                                      Delete</button>        
                                                    
                                                   
                                                                         
                                                  
                                                  
                                                    
                                                  </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteCartItem(cartItemId) {
            // Implement your logic for deleting the cart item using AJAX or form submission
            alert('Deleting cart item with ID: ' + cartItemId);
        }
    </script>




	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            function deleteCartItem(userId, cartItemId) {
                if (confirm('Are you sure you want to delete this cart item?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/delete_cartitem_row') }}/${userId}/${cartItemId}`,
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'cartItemId': cartItemId,
                        },
                        success: function (response) {
                            // Handle the response, e.g., show a success message
                            alert('Cart item deleted successfully');
                            // Optionally, reload the page after deletion
                            location.reload();
                        },
                        error: function (error) {
                          
                            // Handle errors, e.g., show an error message
                           console.error('Error deleting cart item:', error);
                    alert('Error deleting cart item. Check console for details.');
                        }
                    });
                }
            }
        </script>


@endsection