
@extends('frontend.user.user-masters')
@section('user-content')

      <div class="column content edit-address">
        <p>The following addresses will be used on the checkout page by default.</p>

        <div class="address-type">
          <div>
            <div class="top">
              <h3>Billing address @if((int)$billing == 0) <span style="color:red;font-size: 17px;">Required</span> @endif </h3>
              <a href="{{route('billing_address')}}" class="btn blue-button-outline">@if((int)$billing == 0)  Add @else Edit @endif</a>
            </div>
            @if((int)$billing == 0)
            <p>You have not set up this type of address yet.</p>
            @endif
          </div>
          <div>
            <div class="top">
              <h3>Shipping address  @if((int)$shipping == 0) <span style="color:red;font-size: 17px;">Required</span> @endif </h3>
              <a href="{{route('shipping_address')}}" class="btn blue-button-outline"> @if((int)$shipping == 0) Add @else Edit @endif</a>
            </div>
            @if((int)$shipping == 0)
            <p>You have not set up this type of address yet.</p>
            @endif
          </div>
        </div>

      </div>
  
  @endsection
  @section('scripts')

  
  @endsection