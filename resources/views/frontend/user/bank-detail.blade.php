@extends('frontend.user.user-masters')
@section('user-content')
    <div class="column content">
        <form action="{{route('card')}}" method="post" class="common-form bank-info-form" id="card_form_validation">

            <br/>

            @csrf

            <h1>Buying Details</h1>

            <div class="form-row new-form-card">

                <div class="form-group col-md-12">
                    @php 
                        $inputtype = "text";
                    @endphp 
                    @if(isset($details->buying_card_no))
                        {{ '**** **** **** ' . substr($details->buying_card_no, -4)}}
                        @php
                            $inputtype = "password";
                        @endphp
                    @endif
                    <div class="input-group align-items-center">
                        <input type="{{$inputtype}}"  class="form-control pr-2 only_integer" value="{{$details->buying_card_no ?? ""}}" name="buying_card_no" id="buying-cardNo" required />
                        <span class="eye-icon">
                            <span class="fa {{ ($inputtype == 'password'?'fa-eye-slash':'fa-eye')}}" id="togglePassword"></span>
                        </span>
                    </div>

                    <label for="buying-cardNo">Card Number <span>*</span></label>
                    @if($errors->has('buying_card_no'))
                        <div class="error text-danger">{{ $errors->first('buying_card_no') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <input type="number" value="{{$details->buying_expiry_month ?? ""}}" class="form-control pr-2" name="buying_expiry_month" id="buying-expMonth" placeholder="11" min="1" required>
                    <label for="buying-expMonth">Expiry Month <span>*</span></label>
                </div>
                <div class="form-group col-md-3">
                    <input type="number" value="{{$details->buying_expiry_year ?? ""}}" class="form-control pr-2" name="buying_expiry_year" id="buying-expYear" placeholder="25" required />
                    <label for="buying-expYear">Expiry Year <span>*</span></label>
                    @if($errors->has('buying_expiry_year'))
                        <div class="error text-danger">{{ $errors->first('buying_expiry_year') }}</div>
                    @endif
                </div>

                

                <div class="form-group col-md-6">
                    <input type="number" value="{{$details->buying_cvc ?? ""}}" class="form-control pr-2" name="buying_cvc" id="buying-cvcNo" placeholder="456" min="100" required>
                    <label for="buying-cvcNo">CVC <span>*</span></label>
                </div>
            </div>
            
            
            @if(auth()->user()->user_type == 1)
                <h1>Selling Details</h1>                
                <div class="form-row new-form-card">
                    <div class="form-group col-md-12">
                        @php 
                            $inputtype = "text";
                        @endphp 
                        @if(isset($details->selling_card_no))
                            {{ '**** **** **** ' . substr($details->selling_card_no, -4)}}
                            @php
                                $inputtype = "password";
                            @endphp
                        @endif
                        <div class="input-group align-items-center">
                            <input type="{{$inputtype}}" value="{{$details->selling_card_no ?? ""}}" class="form-control pr-2 only_integer" name="selling_card_no" id="selling-cardNo" required>
                            <span class="eye-icon">
                                <span class="fa {{($inputtype == 'password'?'fa-eye-slash':'fa-eye')}}" id="togglePassword_two"></span>
                            </span>
                        </div>
                        <label for="selling-cardNo">Card Number <span>*</span></label>
                        @if($errors->has('selling_card_no'))
                            <div class="error text-danger">{{ $errors->first('selling_card_no') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <input type="number" class="form-control pr-2" value="{{$details->selling_expiry_month ?? ""}}" name="selling_expiry_month" id="selling-expMonth" placeholder="02" min="1" required>
                        <label for="selling-expMonth">Expiry Month <span>*</span></label>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="number" class="form-control pr-2" value="{{$details->selling_expiry_year ?? ""}}" name="selling_expiry_year" id="selling-expYear" placeholder="25" required>
                        <label for="selling-expYear">Expiry Year <span>*</span></label>
                        @if($errors->has('selling_expiry_year'))
                            <div class="error text-danger">{{ $errors->first('selling_expiry_year') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control pr-2" value="{{$details->selling_cvc ?? ""}}" name="selling_cvc" id="selling-cvcNo" placeholder="1234" min="100" required>
                        <label for="selling-cvcNo">CVC <span>*</span></label>
                    </div>
                </div>

                <h1>Payout</h1>

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <input type="email" value="{{$details->selling_paypal_email ?? ""}}" class="form-control pr-2" name="selling_paypal_email" id="selling-cardNo_email" required>
                        <label for="selling-cardNo_email">Paypal Email <span>*</span></label>
                    </div>
                    @if(Session::has('selling_before_add_bank_details'))
                        <div class="error text-danger mb-3">{{session('selling_before_add_bank_details')}}</div>
                    @endif
                </div>

            @endif

            <button class="btn blue-button" id="save-changes">Save</button>

        </form>
    </div>


    <script>
       $(document).ready(function(){
        $(document).on('click',"#togglePassword", function(){
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                const type = $('#buying-cardNo').attr('type') === 'password' ?'text' : 'password';   
                $('#buying-cardNo').attr('type', type);   
                if(type == 'text'){
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                }
            });
        $(document).on('click',"#togglePassword_two", function(){
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                const type = $('#selling-cardNo').attr('type') === 'password' ?'text' : 'password';   
                $('#selling-cardNo').attr('type', type);   
                if(type == 'text'){
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                }
            });
    });

    //   $(document).on("keypress", ".only_integer", function(evt){
    //       if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57){
    //           evt.preventDefault();
    //       }
    //   });

    //   $(document).on("keypress", "#buying-cardNo", function(evt){
    //     if(this.value.length > 15){
    //         evt.preventDefault()
    //     }
    //   });
    //   $(document).on("keypress", "#selling-cardNo", function(evt){
    //     if(this.value.length > 15){
    //         evt.preventDefault()
    //     }
    //   });
    //   $(document).on("keypress", "#buying-expYear", function(evt){
    //     if(this.value.length > 1){
    //         evt.preventDefault()
    //     }
    //   });
    //   $(document).on("keypress", "#selling-expYear", function(evt){
    //     if(this.value.length > 1){
    //         evt.preventDefault()
    //     }
    //   });

        const inputBuyCard = document.getElementById('buying-cardNo');
        inputBuyCard.addEventListener('input', function(event) {
        const valueBuyC = event.target.value;
            if (valueBuyC.length >= 16) {
                event.target.value = valueBuyC.slice(0, 16);
            }
        });
       

      const inputexpYear = document.getElementById('buying-expYear');
        inputexpYear.addEventListener('input', function(event) {
        const valueBuy = event.target.value;
            if (valueBuy.length >= 2) {
                event.target.value = valueBuy.slice(0, 2);
            }
        });
      const inputexpMonth = document.getElementById('buying-expMonth');
      inputexpMonth.addEventListener('input', function(event) {
        const valueExmoBuy = event.target.value;
            if (valueExmoBuy.length >= 2) {
                event.target.value = valueExmoBuy.slice(0, 2);
            }
        });
      


        $(document).ready(function() {
        $('#buying-cardNo').on('input', function(event) {
            var inputValue = $(this).val();
            $(this).val(inputValue.replace(/[^0-9]/g, ''));
          });
        
         $('#selling-cardNo').on('input', function(event) {
            var inputValue = $(this).val();
            $(this).val(inputValue.replace(/[^0-9]/g, ''));
          });
    });


    const inputSellCard = document.getElementById('selling-cardNo');
        inputSellCard.addEventListener('input', function(event) {
        const valueSellCard = event.target.value;
            if (valueSellCard.length >= 15) {
                event.target.value = valueSellCard.slice(0, 16);
            }
        });

    const inputSellingexpYear = document.getElementById('selling-expYear');
        inputSellingexpYear.addEventListener('input', function(event) {
            const valueSelling = event.target.value;
            if (valueSelling.length >= 2) {
                event.target.value = valueSelling.slice(0, 2);
            }
        });
    const inputSellingexpMonth = document.getElementById('selling-expMonth');
    inputSellingexpMonth.addEventListener('input', function(event) {
            const valueSellingEPMonth = event.target.value;
            if (valueSellingEPMonth.length >= 2) {
                event.target.value = valueSellingEPMonth.slice(0, 2);
            }
        });
    </script>
@endsection
