@extends('layouts.admin.master')

@section('styles')
    <style>
        /* Add your styles here */
    </style>
@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="page-title-text">
                        Abandoned Cart Details
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
                                <h1>Abandoned Cart Details</h1>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Telephone</th>
                                                <th>Items in Cart (Product Name, Size, Quantity, Price)</th>
                                                <th>Cart Total</th>
                                                <th>Date Added to Cart</th>
                                                <!-- Add more headings if needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $cartItem->user->email }} </td>
                                                <td>{{ $cartItem->user->first_name }}</td>
                                                <td>{{ $cartItem->user->last_name }}</td>
                                                <td>{{ $cartItem->user->phone }}</td>
                                              <td>
                                              <table>
                                                  @foreach ($cartItem->carts as $relatedCartItem)
                                                      <tr>
                                                          <td style="text-align: left;">Name: {{ $relatedCartItem->product->product_name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td style="text-align: left;">Size: {{ $relatedCartItem->size->size }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td style="text-align: left;">Quantity: {{ $relatedCartItem->quantity }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td style="text-align: left;">Price: {{ number_format($relatedCartItem->product->regular_price, 2, '.', ',') }}</td>
                                                      </tr>
                                                      <tr>
                                                          <td colspan="2"><hr></td>
                                                      </tr>
                                                  @endforeach
                                              </table>
                                          </td>


                                                <td>{{number_format($cartItem->total_price, 2, '.', ',')}}</td>
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
                                                <!-- Add more columns if needed -->
                                            </tr>
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
        // Your JavaScript logic if needed
    </script>
@endsection
