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
                                                <th>Items in Cart (Quantity)</th>
                                                <th>Cart total</th>
                                                <th>Date - Added to cart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
