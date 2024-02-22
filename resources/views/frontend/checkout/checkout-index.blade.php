@extends('layouts.frontend.master')
@section('custom-style')
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css?ver=4') }}">
@endsection
@section('title', 'Home ')
@section('banner')

    <div class="inner-banner shop3">
        <h1 class="page-title" style="color: #ffff;">Checkout</h1>
        <br><br><br>
    </div>

    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="search-popup">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="search-wrapper">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search.." aria-label="Username"
                                       aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </span>
                                    <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="show_all_results">
                            <div class="emptyresult">Nothing Found For : </div>
                            <a href="#" class="productsearchlink"> dsf</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
    <div class="checkout-wrapper">
        
          @csrf
            <div class="column form-wrapper">

                @if( session()->has('message') )
                    <div class="alert alert-icon alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
                            <i class="uil uil-multiply"></i>
                        </button>
                        <p><strong>Success</strong> {{ session('message') }}.</p>
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
                            <i class="uil uil-multiply"></i>
                        </button>
                        <p><strong>Error</strong> {{ session('error') }}.</p>
                    </div>
                @endif

                    <h5 class="sub-heading">buying details</h5>
                    <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert" style="margin-bottom: 20px; color:red"></div>
                    <input type="hidden" name="token" id="token">
                <!-- <h5 class="sub-heading">buying details</h5>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="number" value="{{$bank->buying_card_no ?? ""}}" class="form-control pr-2" name="buying_card_no" id="buying-cardNo" required>
                        <label for="buying-cardNo">Card Number <span>*</span></label>
                    </div>

                    <div class="form-group col-md-3">
                        <input type="number" value="{{$bank->buying_expiry_month ?? ""}}" class="form-control pr-2" name="buying_expiry_month" id="buying-expMonth" placeholder="11" min="1" required>
                        <label for="buying-expMonth">Expiry Month <span>*</span></label>
                    </div>
                  
                  <div class="form-group col-md-3">
                        <input type="number" value="{{$bank->buying_expiry_year ?? ""}}" class="form-control pr-2" name="buying_expiry_year" id="buying-expYear" placeholder="2025" required>
                        <label for="buying-expYear">Expiry Year <span>*</span></label>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="number" value="{{$bank->buying_cvc ?? ""}}" class="form-control pr-2" name="buying_cvc" id="buying-cvcNo" placeholder="456" min="100" required>
                        <label for="buying-cvcNo">CVC <span>*</span></label>
                    </div>
                </div> -->
                <form name="checkout" id="place-order-form" method="post" action="{{ route('checkout.process') }}" enctype="multipart/form-data" class="checkout-form" style="display: contents !important;">
        
                <h5 class="sub-heading">billing details</h5>

                <div class="form-row">
                    <div class="form-group col-md-6 pr-0 pr-md-4">
                        <input type="text" class="form-control" name="billing_first_name" id="fName" value="{{$billing_address->firstname ?? ''}}" required>
                        <label for="fName">First name <span>*</span></label>
                    </div>
                    <div class="form-group col-md-6 pl-0 pl-md-4">
                        <input type="text" class="form-control" name="billing_last_name" id="lName" value="{{$billing_address->lastname ?? ''}}" required>
                        <label for="lName">Last name <span>*</span></label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h6>United Kingdom (UK) <input type="hidden" name="billing_country" id="billing_country" value="GB"><br><small>Country / Region</small> <span>*</span></h6>

                        <input type="text" class="form-control" name="billing_address_1" id="streetAddres" value="{{$billing_address->street_address ?? ''}}" required>
                        <label for="streetAddres">Street address 1<span>*</span></label>

                        <input type="text" class="form-control" name="billing_address_2" id="appartmentSuit" value="{{$billing_address->appartment_address ?? ''}}">
                        <label for="streetAddres">Street address 2 (optional)</label>

                        <input type="text" class="form-control" value="{{$billing_address->city ?? ''}}" name="billing_city" id="city" required>
                        <label for="city">Town / City <span>*</span></label>

                        <input type="text" class="form-control" value="{{$billing_address->state ?? ''}}" name="billing_state" id="country">
                        <label for="country">County </label>

                        <input type="text" class="form-control" name="billing_postcode" value="{{$billing_address->pastcode ?? ''}}" id="postCode">
                        <label for="postCode">Postcode <span>*</span></label>

                        <input type="text" class="form-control" name="billing_phone" value="{{$billing_address->phone ?? ''}}" id="phone">
                        <label for="phone">Phone <span>*</span></label>

                        <input type="email" class="form-control" value="{{$billing_address->email ?? ''}}" name="billing_email" id="email">
                        <label for="email">Email address <span>*</span></label>
                    </div>
                </div>

                <h5 class="sub-heading">shipping details</h5>

                <div class="form-group form-check">
                    <input type="checkbox" name="ship_to_different_address" class="form-check-input"
                           id="differentAddressCheck" value="2">
                    <label class="form-check-label" >Shipping to another address?</label>

                    <div class="different-address">
                        <div class="form-row">
                            <div class="form-group col-md-6 pr-0 pr-md-4">
                                <input type="text" value="{{$shipping_address->firstname  ?? ''}}" class="form-control" name="fName2" id="fName2">
                                <label for="fName2">First name <span>*</span></label>
                            </div>
                            <div class="form-group col-md-6 pl-0 pl-md-4">
                                <input type="text" class="form-control" value="{{$shipping_address->lastname  ?? ''}}" name="lName2" id="lName2">
                                <label for="lName2">Last name <span>*</span></label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">

                                <h6>United Kingdom (UK) <br><small>Country / Region</small> <span>*</span></h6>
                                <input type="hidden" name="country" value="GB">
                                <input type="text" class="form-control" value="{{$shipping_address->street_address  ?? ''}}" name="streetAddres2" id="streetAddres2">
                                <label for="streetAddres2">Street address 1 <span>*</span></label>

                                <input type="text" class="form-control" value="{{$shipping_address->appartment_address  ?? ''}}" name="appartmentSuit2" id="appartmentSuit2">
                                <label for="appartmentSuit2">Street address 2 (optional)</label>

                                <input type="text" value="{{$shipping_address->city  ?? ''}}" class="form-control" name="city2" id="city2">
                                <label for="city2">Town / City <span>*</span></label>

                                <input type="text" value="{{$shipping_address->state  ?? ''}}" class="form-control" name="shipping_state" id="shipping_state">
                                <label for="shipping_state">County</label>

                                <input type="text" value="{{$shipping_address->pastcode ?? ''}}" class="form-control" name="postCode2" id="postCode2">
                                <label for="postCode2">Postcode <span>*</span></label>

                                <input type="text" value="{{$shipping_address->phone  ?? ''}}" class="form-control" name="shipping_phone" id="shipping_phone">
                                <label for="shipping_phone">Phone </label>

                                <input type="text" value="{{$shipping_address->email ?? ''}}" class="form-control" name="shipping_email" id="shipping_email">
                                <label for="shipping_email">Email <span>*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="column summary-details">
                <div class="first_div">
                    <h2 class="main-heading">your order</h2>

                    <div class="product-summary">
                        <table class="table summary-table">
                            <tr>
                                <th>product</th>
                                <th>total</th>
                            </tr>
                            @php $sub_total = 0; $delivery_charges=0; $ship=0; @endphp

                            @foreach($data as $d)

                                <?php 
                                $shipping_charges = ($d->shipping_payer == 'seller') ? 0 : $d->shipping;

                                $ship = $shipping_charges + $ship; 
                                ?>

                                @if((float)$d->sale_price > 0)
                                    <?php $sub_total = $sub_total + $d->sale_price * (float)$d->quantity; ?>
                                @elseif((float)$d->sale_price_sizes > 0)
                                    <?php $sub_total = $sub_total + $d->sale_price_sizes * (float)$d->quantity; ?>
                                @else
                                    <?php $sub_total = $sub_total + $d->regular_price * (float)$d->quantity; ?>
                                @endif

                                <?php  $sub_total = number_format((float)$sub_total, 2, '.', ''); ?>

                                <tr class="product-row">
                                    <td>
                                        <a style="color:#00A9EC !important;" type="button" href="{{route("deletecart")}}?id={{$d->id}}">
                                            <i class="fas fa-times"></i>
                                        </a>

                                        {{ $d->product_name ?? $d->product_parent_name }} x {{ $d->quantity }}
                                    </td>

                                    @if((float)$d->sale_price > 0)
                                        <td>£@php echo   number_format((float)$d->quantity * $d->sale_price, 2, '.', '');  @endphp</td>
                                    @elseif((float)$d->sale_price_sizes > 0)
                                        <td>£@php echo number_format((float)$d->quantity * $d->sale_price_sizes, 2, '.', '');  @endphp</td>
                                    @else
                                        <td>£@php echo number_format((float)$d->quantity * $d->regular_price, 2, '.', '');  @endphp</td>
                                    @endif
                                </tr>

                            @endforeach

                            <tr>
                                <th>subtotal</th>
                                <th>£{{ $sub_total }}</th>
                            </tr>

                            <tr>
                                <td>Shipping Fee</td>
                                <td class="shipping_fee">£{{ number_format((float)$ship, 2, '.', '')  }}</td>
                            </tr>
                            <tr>
                                <td>Processing Fee</td>
                                <?php //$processiong = ($shipping * count($data) + $sub_total) * 7.5 / 100;  ?>
                                @php 
                                      $processiong = ProcessingFeeCalculate($sub_total);      

                                @endphp
                                <td class="processing_fee">£{{ number_format((float)$processiong   , 2, '.', '')   }}</td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <div class="">
                                        <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#promoCode">
                                            DISCOUNT CODE? <i class="fas fa-caret-down"></i>
                                        </button>

                                        <div class="collapse" id="promoCode">

                                            <p>IF YOU HAVE A COUPON CODE, PLEASE APPLY IT BELOW.</p>

                                            <div class="coupon">

                                                <input type="text" name = "coupon_code" id = "coupon_code" class="form-control">
                                                <button class="btn btn-outline-secondary user_coupon_code" type="button">Apply Coupon</button>
                                            </div>

                                            <div class="coupon_alert"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class = "total">
                                <th>total</th>

                                <th>
                                    <span><b>£</b></span>
                                    <span class="total_charges">
                                        <b>{{  number_format($ship + $sub_total + $processiong, 2, '.', '')   }}</b>
                                    </span>
                                </th>
                            </tr>
                        </table>
                    </div>

                    <div class="cash-on-delivery">
                        <!-- <h6>CASH ON DELIVERY</h6>
                        <p>Pay with cash upon delivery.</p> -->
                        <div class="form-group form-check my-4 py-2">
                            <input type="checkbox" class="form-check-input" name="accept" id="accept">
                            <label class="form-check-label" for="accept" style="margin: 2px 0px 0px 20px !important;">I would like to receive exclusive emails with discounts and product information</label>
                        </div>

                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a target="_blank" href="{{route('coming_soon')}}">privacy policy.</a></p>
                    </div>
                </div>

                <input type="hidden" name="coupon" id="coupon" class="coupon">
                <input type="hidden" class="allTotal" value="{{  number_format($ship + $sub_total + $processiong, 2, '.', '')  }}">
                <input type="hidden" class="shiping_fee" value="{{  number_format($ship, 2, '.', '')  }}">

                <button type="submit" class="btn btn-block place-order1">Place Order</button>

            </div>

        </form>

    </div>

@endsection
@section('scripts')
    <script>

        


        $(document).ready(function() {

        // var stripe = Stripe('pk_test_51JFfTBBSH6f3eK6wglJadNJLqauot54GmklDZisMZgEupKGdQuFSdzu1UuPjc2iU66Jqcdwcco37uHSJ7OsrqstJ00tSi9QAJH', {
        // locale: 'en-GB'
        // });
        var stripe = Stripe({!! json_encode(config('services.stripe.key')) !!});
        var elements = stripe.elements({
            clientSecret: 'pi_3MtwBwLkdIwHu7ix28a3tqPa_secret_YrKJUKribcBjcG8HVhfZluoGH',
            });

        const options = {
        layout: {
            type: 'tabs',
            defaultCollapsed: false
        }
        };
        var cardElement = elements.create('payment');
        cardElement.mount('#card-element');

        var cardErrors = document.getElementById('card-errors');

        const form = document.querySelector('#place-order-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                cardErrors.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    formData.append('token_id', result.token.id);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    
                    fetch("{{ route('checkout.process') }}", {
                        method: 'POST',
                        dataType: 'json',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle response from backend
                        if (data.success)
                            window.location.href = "/"+data.url+"/"+data.reference;
                        else
                            cardErrors.textContent = data.error;
                    })
                    .catch(error => {
                        // Handle errors
                        console.error('There was a problem with the fetch operation:', error);
                    });
                }
            });
        });

            $(".user_coupon_code").click(function () {
                coupon();
            });

            $('#differentAddressCheck').click(function () {
                if ($(this).prop("checked") == true) {

                    $('.shipping').show();
                } else {

                    $('.shipping').hide();
                }
            });
        });

        function remcou() {
            $.ajax({
                url: "{{ route('coupon.remove') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (result) {
                    $('.coupon_alert').addClass('alert-danger').html((JSON.parse(result)).remove);
                    window.location.reload(1);
                }
            });
        }

        function coupon() {

            let ship = $('.shiping_fee').val();
            let pro = $('.processing_fee').text();
            let total = $(".allTotal").val();
            let coupon_code = $('#coupon_code').val();

            $(".coupon").val(coupon_code);

            $.ajax({
                url: "{{ route('coupon.user') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    coupon_code: coupon_code,
                    total: total,
                    ship: ship,
                    pro: pro
                },
                success: function (result) {
                    if(!$('.coupon_alert').hasClass('alert')){
                        $('.coupon_alert').addClass('alert');
                    }

                    if (result.error) {

                        $('.coupon_alert').removeClass('alert-success').addClass('alert-danger').html(result.error);

                    } else {

                        if (result.flag == true) {

                            $('.coupon_alert').removeClass('alert-danger').html('');
                            $('.first_div').html(result.data);
                        } else {

                            $(".coupon_alert").removeClass('alert-success').addClass('alert-danger').html(result.message);
                        }
                    }
                }
            });
        }
    </script>
@endsection
