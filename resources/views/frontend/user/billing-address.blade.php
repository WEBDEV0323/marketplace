@extends('frontend.user.user-masters')
@section('user-content')
      <div class="column content edit-address">
        <h1 class="address-heading">Billing address</h1>
        
        <form action="{{route('billing-address-process')}}" class="common-form billing-form" method = "post">
        @csrf  
        <div class="form-row">
            <div class="form-group col-md-6 pr-0 pr-md-4">
              <input type="text" class="form-control" value = "<?php echo (!empty($user_address->firstname) ? $user_address->firstname : '' ); ?>"  name="fName" id="fName" required>
              <input type="hidden" class="form-control" value = "{{$user->id}}"  name="user_id" id="user_id">
              <label for="fName">First name <span>*</span></label>
            </div>
            <div class="form-group col-md-6 pl-0 pl-md-4">
              <input type="text" class="form-control" value = "<?php echo (!empty($user_address->lastname) ? $user_address->lastname : '' ); ?>" name="lName" id="lName" required>
              <label for="lName">Last name <span>*</span></label>
            </div>
            <div class="form-group col-md-12">
              <input type="text" class="form-control" value = "<?php echo (!empty($user_address->company) ? $user_address->company : '' ); ?>" name="companyName" id="companyName">
              <label for="companyName">Company name (optional)</label>
            </div>
          </div>

          <h6 class="mt-4 mb-5">United Kingdom (UK) <br><small>Country / Region</small> <span>*</span></h6>

          <div class="form-group">
            <input type="text" class="form-control" value = "<?php echo (!empty($user_address->street_address) ? $user_address->street_address : '' ); ?>" name="streetAddres" id="streetAddres" placeholder="House number and street name" required>
            <label for="streetAddres">Street address 1 <span>*</span></label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value = " <?php echo (!empty($user_address->appartment_address) ? $user_address->appartment_address : '' ); ?>" name="appartmentSuit" id="appartmentSuit"
              placeholder="Street address 2 (optional)">
              <label for="streetAddres">Street address 2 (optional)</label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value = "<?php  echo (!empty ($user_address->city) ? $user_address->city : '' ); ?>" name="city" id="city" required>
            <label for="city">Town / City <span>*</span></label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value = "<?php echo (!empty ($user_address->country) ? $user_address->country : '' ); ?>" name="country" id="country">
            <label for="country">County (optional) </label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value ="<?php  echo (!empty ($user_address->pastcode) ? $user_address->pastcode : '' ); ?>" name="postCode" id="postCode" required>
            <label for="postCode">Postcode <span>*</span></label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" value = "<?php echo (!empty ($user_address->phone) ? $user_address->phone : '' ); ?>" name="phone" id="phone" required>
            <label for="phone">Phone <span>*</span></label>
          </div>
          <div class="form-group">
            <input type="email" value = "<?php  echo (!empty($user_address->email) ? $user_address->email : '' );  ?>"  class="form-control" name="email" id="email" required >
            <label for="email">Emial address <span>*</span></label>
          </div>
          <button type = "submit" class="btn blue-button">save address</button>
        </form>
      </div>
      @endsection
