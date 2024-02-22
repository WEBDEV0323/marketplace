@extends('frontend.user.user-masters')

@section('user-content')
<div class="column content brands-column">
    <div class="subscribed">
        <h4 class="main-title">My Subscriptions</h4>
        <br>
        <?php
         $brand_name_exit = "No";
      if ($user_subscribes->isNotEmpty()) {
        foreach($user_subscribes as $subscribe){
          if(isset($subscribe->brand->brand_name)){
                $brand_name_exit = "Yes";
          ?>
        <div class="brand">
            <h5 class="title"><?php echo $subscribe->brand->brand_name;?></h5>
            <a href="javascript:void(0)" data-subscribe_id = "{{$subscribe->id}}" data-brand_id = "{{$subscribe->brand->id}}" class="btn blue-button btn_subscribe_un">Unsubscribe</a>
        </div>
        <?php } } } else{  $brand_name_exit = "Yes"; ?>
      <div class="brand">
          <h5 class="title">None</h5>
      </div>
    <?php }     
    if($brand_name_exit == "No"){?>
        <div class="brand">
             <h5 class="title">None</h5>
         </div>        
    <?php } ?>

    </div>
    <br>

   


    <div class="brands">
      
    <h4 class="main-title">Brands</h4>
      <?php
        foreach($brands as $brand){
          ?>
          <div class="brand">
            <h5 class="title"><?php echo $brand->brand_name;?></h5>
            <a href="javascript:void(0)" data-brand_id = "{{$brand->id}}" class="btn blue-button-outline">Subscribe</a>
          </div>
          <?php
        }
      
      ?>
       
        
     
    </div>

    <div class="seller_notifications">
      <h4 class="main-title">Notifications <span class="notification_status_message text-success"></span></h4>
      <div class="customcheck-design">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input onclickcheckbox" id="newsletter_notification" {{(auth()->user()->newsletter_notification_status == "Yes"?'checked':'')}} />
          <label class="custom-control-label onclickcheckbox" for="newsletter_notification">Newsletter</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input onclickcheckbox" id="promotions_notification" {{(auth()->user()->promotions_notification_status == "Yes"?'checked':'')}} />
          <label class="custom-control-label onclickcheckbox" for="promotions_notification">Promotions</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input onclickcheckbox" id="discounts_notification" {{(auth()->user()->discounts_notification_status == "Yes"?'checked':'')}} />
          <label class="custom-control-label onclickcheckbox" for="discounts_notification">Discounts</label>
        </div>
        {{-- <div class="ml-auto">
            <button type="button" class="btn-theme notification_submit" style="display: none">Submit</button>
        </div> --}}
      </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    // $(document).on('click','.notification_submit',function(){
    $(document).on('click','.onclickcheckbox',function(){
     var newsletter_notification = $('#newsletter_notification:checked').val();
     var promotions_notification = $('#promotions_notification:checked').val();
     var discounts_notification = $('#discounts_notification:checked').val();     
     if(typeof newsletter_notification === "undefined"){
        newsletter_notification = "No";
     }else{
        newsletter_notification = "Yes";
     }
     if(typeof promotions_notification === "undefined"){
        promotions_notification = "No";
     }else{
        promotions_notification = "Yes";
     }
     if(typeof discounts_notification === "undefined"){
        discounts_notification = "No";
     }else{
        discounts_notification = "Yes";
     }
      $.ajax({
            url: "{{ route('user_notification_process') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                newsletter_notification:newsletter_notification,
                promotions_notification:promotions_notification,
                discounts_notification:discounts_notification
            },
            success: function (result) {
                  $('.notification_status_message').html('Notifications Successfully Updated.');
                  setTimeout(()=>{
                      $(".notification_status_message").html('');
                  },1500)
            }
      });
    }); 


   $('.btn_subscribe_un').on('click',function(){
    subscribe_id =  $(this).data('subscribe_id');
      brand_id =  $(this).data('brand_id');
      //console.log(brand_id);
      $.ajax({
                url: "{{ route('user_unsubscribe_process') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    subscribe_id:subscribe_id,
                    brand_id:brand_id,
                },
                success: function (result) {
                   console.log(result);  
                  // result = JSON.parse(result);
                 
                   

                  // setTimeout(function(){
                    window.location.reload(1);
                   // }, 1000);
                    //result.error;

                }
      });
    }); 

    $('.blue-button-outline').on('click',function(){
      brand_id =  $(this).data('brand_id');
      //console.log(brand_id);
      $.ajax({
                url: "{{ route('user_subscribe_process') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    brand_id:brand_id,
                },
                success: function (result) {
                   console.log(result);  
                  // result = JSON.parse(result);
                 
                   

                  // setTimeout(function(){
                    window.location.reload(1);
                   // }, 1000);
                    //result.error;

                }
      });
    });
    
  });
</script>
@endsection