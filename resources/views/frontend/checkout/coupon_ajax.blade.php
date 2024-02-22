        <h2 class="main-heading">your order</h2>

        <div class="product-summary">
            <table class="table summary-table">
                <tr>
                    <th>product</th>
                    <th>total</th>
                </tr>

                <?php  $total = 0; $delivery_charges = 0;  ?>

                    @foreach($carts as $c)

                    <?php  $delivery_charges = $delivery_charges + $c->delivery_charges; ?>
                        <tr class="product-row">
                            <td>
                                <a style="color:#00A9EC !important;" type="button" href="{{route("deletecart")}}?id={{$c->id}}">
                                    <i class="fas fa-times"></i>
                                </a>

                                {{ $c->product_name ?? $c->product_parent_name }} x {{ $c->quantity }}
                            </td>

                            @if((float)$c->sale_price > 0)
                                <td>£@php   echo number_format((float)$c->quantity * $c->sale_price, 2, '.', '');  @endphp</td>
                            @elseif((float)$c->sale_price_sizes > 0)
                                <td>£@php echo   number_format((float)$c->quantity * $c->sale_price_sizes, 2, '.', '');  @endphp</td>
                            @else
                                <td>£@php echo   number_format((float)$c->quantity * $c->regular_price, 2, '.', '');  @endphp</td>
                            @endif
                        </tr>

                    @endforeach

                    <tr>
                        <td>Shipping Fee</td>
                        <td class="shipping_fee">£{{$data["ship"]}}</td>
                    </tr>
                    <tr>
                        <td>Processing Fee</td>

                        <td class="processing_fee">{{$data["pro"]}}</td>
                    </tr>

                    <tr>
                        <th>subtotal</th>
                        <th>£{{  number_format((float)$data["total"], 2, '.', '') }}</th>
                    </tr>
                    <tr class = "coupon_code_field">
                        @if(session()->has('coupon'))

                       <td>Discount ( {{session()->get('coupon')['name']}} )
                         <button id="remove_coupon" onclick="remcou();" class="btn btn-sm2-pills alert-danger " type="button">Remove</button></td>

                        <td>£  {{  number_format((float)$data["discount"], 2, '.', '') }} </td>
                        @endif
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
                                        <input type="text" name = "coupon_code" id = "coupon_code" value="{{$data["coupon"]}}" class="form-control" disabled>
                                        <button class="btn btn-outline-secondary user_coupon_code" onclick="coupon();" type="button" disabled>Apply Coupon</button>
                                    </div>
                                    <div class="alert coupon_alert"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>total</th>

                        <th>£{{  number_format((float)$data["total"] - $data["discount"], 2, '.', '')    }}</th>

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

        {{-- <button type="submit" class="btn btn-block place-order">Place Order</button>
        </form> --}}

@section('scripts')

@endsection
