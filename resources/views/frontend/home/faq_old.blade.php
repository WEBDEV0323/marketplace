

@extends('layouts.frontend.master')
@section('title', 'FAQ -The Marketplace')
@section('banner')
@endsection
@section('content')

<style>

.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  display: flex;
}
.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
  transform: translateX(33.333%);
}

.carousel-inner .carousel-item-left.active,
.carousel-inner .carousel-item-prev {
  transform: translateX(-33.333%);
}
.carousel-inner .carousel-item {
  transition: transform 1.5s ease;
}
.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left {
  transform: translateX(0);
}
.color-1 {
  background-color: #a7a7a7;
}
.color-2 {
  background-color:#a7a7a7;
}
.color-3 {
  background-color: #a7a7a7;
}
.color-4 {
  background-color: #a7a7a7;
}
.color-5 {
  background-color:#a7a7a7;
}
.bordered {
  padding: 5px 5px 5px 5px;
  height: 30rem;
}
.overlay {
  z-index: 1;
  padding: 0;
  border: none;
  background: rgba(68, 68, 68, 0.5);
}

span#basic-addon1 {
    background-color: #00a9ec !important;
    color: #fff;
    font-size: 20px;
    border-color: #00a9ec;
    width: 70px;
    text-align: center;
    height: 37px;
    border-radius: 0 0 1px 0px;
}

.faq-page-section .main-sec-faq{
    padding-right:0;
    padding-left:0;
    background:white;
    border:0px solid; 
}
.faq-page-section .main-sec-faq .card{
        position:relative;
        border:0px solid; 

}

.faq-page-section .main-sec-faq .card{
        position:relative;
        
        
}

.faq-page-section .main-sec-faq .card .card-sc{
    position:relative;
    height:20%;
    display:flex;
    justify-content:center;
    z-index: 1;

}
.faq-page-section .main-sec-faq .card .card-sc img{ 
    margin:auto;
    display:block;
    border-radius:100%;
    border:5px solid #007bff; 
    
    position:absolute;
   

    transform:scale(1.2) translateY(10px) ;
        
}

.faq-page-section .main-sec-faq .card .card-sd{
    position:relative;
    border:5px solid #007bff; 
    height:80%;
    text-align:center;
    padding-top:40%;
    font-size:1.8rem;
    font-weight:600;

}


.faq-page-section .carousel-inner{
    /* overflow:unset;
    overflow-x:visible;
    overflow-y:hidden; */
 
    
}

</style>

{{-- <div class="inner-banner shop6" style="padding: 150px 40px 0 50px;">
            
    <h1 class="page-title">Frequently Asked Questions</h1>
    
    <div class="form-group " style="margin:auto 5%; display: none;">
    <div class="row">
        <div class="col-6 mx-auto">
        <div class="input-group">
            <input type="text" autofocus="" onkeypress="handleKeyPress(event)" class="form-control search_result_all1" placeholder="Search.." aria-label="Username" aria-describedby="basic-addon1" id="search">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="uil uil-search home-first"></i></span>
            </div>
        </div>
        </div>
        </div>
    </div>
    <br><br><br>
</div> --}}


<main class="faq-page-section">

                    
    <div class="container">
      <div class="row">
        <div class="col-12 mx-auto">
          <div class="bordered" style="display: none;">
            <div class="row mx-auto h-100">
              <div id="carousel-1" class="carousel slide w-100" data-ride="carousel">
                
                <div class="carousel-inner h-100">
                  <div class="carousel-item active h-100">
                    <div class="col-4 h-100  main-sec-faq" id="pad">
                      <div class="card h-100 ">
                      <div class="card-sc">
                            <img  src="{{asset('assets/images/avatar.png')}}"/>
                        </div>
                            <div class="card-sd color-1">
                            <a href="#General">General</a>
                        </div> 
                        
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item h-100">
                    <div class="col-4 h-100 main-sec-faq" id="pad">
                      <div class="card h-100 ">
                        <div class="card-sc">
                            <img  src="{{asset('assets/images/avatar.png')}}"/>
                        </div>
                        <div class="card-sd color-2">
                        Account
                        </div> 
                    </div>
                    </div>
                  </div>
                  <div class="carousel-item h-100">
                    <div class="col-4 h-100 main-sec-faq" id="pad">
                      <div class="card h-100">
                      <div class="card-sc">
                            <img  src="{{asset('assets/images/avatar.png')}}"/>
                        </div>
                        <div class="card-sd color-3">
                        Costs
                        </div> 
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item h-100">
                    <div class="col-4 h-100 main-sec-faq" id="pad">
                         <div class="card h-100">
                    <div class="card-sc">
                            <img  src="{{asset('assets/images/avatar.png')}}"/>
                        </div>
                        <div class="card-sd color-4">
                        Products
                        </div> 
                        </div> 
                    </div>
                  </div>
                  <div class="carousel-item h-100">
                    <div class="col-4 h-100 main-sec-faq" id="pad">
                    <div class="card h-100">
                    <div class="card-sc">
                            <img  src="{{asset('assets/images/avatar.png')}}"/>
                        </div>
                        <div class="card-sd color-5">
                        Shipping
                        </div> 
                                                </div> 
                    </div>
                  </div>
                </div>

                <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                  <span class="carousel-control-next-icon bg-dark rounded-circle" id="bordered-2" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <!-- FAQ Section Start -->
    <div class="container">
        <div class="faq-sec">
            <div class="accordion" id="faqs-group1">
                <h4 style="margin: 0 auto; text-align: left; padding: 40px 0 20px 0px; font-weight: 700;" id="General">General</h4>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq1" aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What is T.MP?</button>
                <div id="faq1" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>The Marketplace is a fully e-commerce platform but with a twist. We stock and sell the most luxurious items that are available to buy at any time. We stock all items from clothing to footwear to accessories at the best price. On top of that we also allow individuals to sell their unwanted luxury items too.
                        This platform is fully anonymous and completely secure, so you can put your trust in us. We process and authenticate all transactions that flow through our site to ensure both the buyer and seller are completely satisfied. 
                        From allowing individuals to sell their own luxury items, this contributes to us being the lowest provider for all your luxury needs while allowing a profession to review and authenticate so you get what you pay for.
                        </p>
                        <p>This platform is fully anonymous and completely secure, so you can put your trust in us. We process and authenticate all transactions that flow through our site to ensure both the buyer and seller are completely satisfied. </p>
                        <p>From allowing individuals to sell their own luxury items, this contributes to us being the lowest provider for all your luxury needs while allowing a profession to review and authenticate so you get what you pay for.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq2"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Are returns or exchanges allowed?</button>
                <div id="faq2" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Due to all transactions being anonymous on our site. We sadly don't accept returns, refunds or exchanges.</p>
                        <p>However, we do allow all items that have been purchased to be relisted and resold on our platform at any time.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq3"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How much are the fees?</button>
                <div id="faq3" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <h5>Buying</h5>
                        <p>When buying a product on The Marketplace you will come across 2 Fee’s 1) Processing and 2) Shipping. </p>
                        <p>The Processing Fee is a fixed percentage of 7.5% of the item's price and will be included in your final pay now price.</p>
                        <p>The Shipping Fee is variable and will depend on standard shipping factors, such as: Weight of item, Cost of item and Size of item. This is so that we can ensure all products are sent securely and safely to you and if any problems do occur while in transit, all items will be fully insured – allowing all parties ease of mind.</p>
                        <h5>Selling</h5>
                        <p>When buying a product on The Marketplace you will come across 2 Fee’s 1) Transaction Fee and 2) Shipping.</p>
                        <p>The Transaction Fee is variable and will depend on the loyalty of the customer. The percentage will depend on how many items the customer has bought/sold on The Marketplace, as the more that is bought/sold the lower the fee. There will be 4 groups for sellers where the Fees range from 8.5% - 7%. </p>
                        <p>The Shipping Fee is variable and will depend on standard shipping factors, such as: Weight of item, Cost of item and Size of item. This is so that we can ensure all products are sent securely and safely to you and if any problems do occur while in transit, all items will be fully insured – allowing all parties ease of mind.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq4"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Why am I supposed to send my items to T.MP?</button>
                <div id="faq4" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>When selling, the reason we request that you send your items to us, is that we would need to perform various authentication processes to ensure the item is as described. From sending the product to us, we can allow specialists to do a full review of the product and then progress on to the next stage of sending it to the buyer.</p>
                        <p>Another reason is that it allows us to be in control of the order. For example, if we allowed a seller to send straight to the buyer, this could cause various problems such as the buyer saying the “item is not as described”, “I didn’t receive the item”, “the item is a replica” and so on... From allowing us to access the item we can allow security on both ends and use the most secure shipping methods so that all items come as described.</p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq5"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What do I do if I have a problem with my order?</button>
                <div id="faq5" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you have a problem with your order, please contact us immediately! Use the ‘Contact Us’ page located at the bottom of every page or click the link below...
                        <a href="{{route('contactus')}}">Contact Us.</a></p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq6"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What happens when someone violates the rules?</button>
                <div id="faq6" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Failure to complete a sale will result in a fee equal to 10% of the transaction price and indefinite suspension of your account. This fee is dependent on the number of sales you have made on StockX as well as the severity of the authentication failure (if your product fails authentication). Your account can be subject to a penalty fee if you sell and ship us:</p>
                        <p>−	An item that isn’t authentic or doesn’t exactly match the item as it is described on The Marketplace.</p>
                        <p>−	Also, if you fail to ship the item within the specified time period (typically two business days).</p>
                        <p>The Marketplace has no obligation to return items that do not conform to the description or are counterfeit (in which case, we may turn those items over to the proper authorities) at your cost.</p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq7"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What happens if my item is found to be a replica?</button>
                <div id="faq7" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>The Marketplace has no obligation to return counterfeited products. We may turn those items over to the proper authorities, at your cost. This is due to the fact the sale of counterfeit goods is illegal and can harm our reputation, and those who wish to try will be dealt with appropriately. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq8"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                My item just sold. What do I do now?</button>
                <div id="faq8" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Congrats! Once your item has sold you will receive a prepaid shipping label via email with the order details. </p>
                        <p>You would need to insert the Invoice page into your shipping box, so that it is easy to navigate your order once it arrives. </p>
                        <p>Then securely package your item up and attach the prepaid label then drop the package off with the courier listed on the prepaid shipping label within 2 business days (Monday – Saturday) of the order being placed. </p>
                        <p>You are eligible to track your item from the specified tracking number on the label so you can monitor your item’s journey. </p>
                        <p>If you do not use the prepaid shipping label provided by The Marketplace, we will not be liable for any lost, missing or damaged items. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq9"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                I’m having issues purchasing a product that someone else has listed. What should I do?</button>
                <div id="faq9" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>We are sorry to hear that. If you cannot add a seller's product to your basket, please open up a new browser and search for the product again. </p>
                        <p>If this is still the case, please contact us and let us know all details about the product you are trying to buy. (Link, SKU, Product Name, Size, Price). </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq10"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How do I get my prepaid shipping label?</button>
                <div id="faq10" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Your prepaid label will be sent directly to the email address listed on your profile once a sale has been made. </p>
                        <p>If you are having trouble viewing your prepaid label, you can also view it in My Dashboard > Sold Items. </p>
                        <p>Please note if you do not use the prepaid shipping label provided by The Marketplace, we will not be liable for any lost, missing or damaged items. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq11"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How long does my order take?</button>
                <div id="faq11" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>We aim to have all orders delivered within 7 business days. We will alert you via email if any problems occur with your order. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq12"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How do I cancel an order/sale?</button>
                <div id="faq12" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Once an order/sale has been made, it cannot be cancelled. This policy is to maintain marketplace integrity, as the order/sale will already have been processed and even potentially shipped by the seller. </p>
                        <p>Please remember that there is a buyer/seller on the other side of the order expecting it to be fulfilled. When you buy/sell an item on The Marketplace you are committing to the transaction.</p>
                        <p>If you are a seller and no longer want to sell your product, you may be subjected to a ‘Cancellation Fee’ and even Account Suspension due to not following The Marketplace rules and guidelines. Please consider this before selling your items. </p>
                        <p>If you are a buyer and no longer want the item that you have purchased, you are eligible to sell that product on our platform at any time, as we sadly do not offer refunds. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq13"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                I’ve just sold a product. How long do I have to ship?</button>
                <div id="faq13" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Great news! When you sell a product, you have 2 business days (Mon – Sat) to ship your item. If you do not ship within the specified time frame you may be charged a late fee or even have your order cancelled and have to pay a cancellation fee. </p>
                    </div>    
                </div>
                <h4 style="margin: 0 auto; text-align: left; padding: 40px 0 20px 0px; font-weight: 700;">Account</h4>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq14"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Resetting password?</button>
                <div id="faq14" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you are having trouble remembering your password, you can reset it here <a href="{{route('lost_password')}}">FORGET PASSWORD</a></p>
                        <p>If you are still having problems gaining access to your account, please contact us! </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq15"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How do I delete my account?</button>
                <div id="faq15" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you no longer want to be a part of The Marketplace and wish to have your account and information removed. Please contact us with the subject ‘Delete my account’ and we will sort the rest.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq16"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What to do if my account has been compromised?</button>
                <div id="faq16" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you believe your account has been compromised, please change your password IMMEDIATELY. If you cannot access your account, contact us at the earliest convenience. </p>
                        <p>If you have received an unauthorised charge, we suggest contacting your Bank as soon as possible and to also contact us and notify us of this charge. Your security is our main priority here at The Marketplace so we endeavour to solve all your problems as soon as we can. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq17"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What to do if I receive a questionable email from T.MP?</button>
                <div id="faq17" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you receive a questionable email from The Marketplace which you are uncertain about. Please contact us immediately so we can confirm. </p>
                        <p>It’s better to be safe than sorry and we aim to protect your data at all costs.</p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq18"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                My account has been blocked?</button>
                <div id="faq18" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If your account has been blocked due to too many failed password attempts, please use the “Lost your password?” on the ‘Sign In’ page and proceed to reset your password. </p>
                        <p>If your account has been blocked due to failure to comply with The Marketplace’s rules and guidelines, there is nothing we can do to help. This is a strict policy which helps to maintain a secure and trustworthy platform, which everyone can benefit from.</p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq19"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What is two-step verification?</button>
                <div id="faq19" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <h6>What is two-step verification? </h6>
                        <p>Two-step verification is an added layer of security to protect your account from unauthorised access. Two-step verification requires you to sign in with your password and verify your identity through an automated text to your mobile device. </p>
                        <h6>Why should I use two-step verification? </h6>
                        <p>Two-step verification dramatically improves the security of your account and your personal information. With two-step verification, you can only sign into your account if you have both your password and access to a trusted device. </p>
                        <h6>How do I set up two-step verification? </h6>
                        <p>You can activate two-step verification by going to the security tab in your ‘Dashboard’ and opting in to two-step verification. Upon opting in, you will be asked to input your phone number. You will then receive a random 6-digit code. By entering your specific code into the display, you’ll finish the activation. You can choose to remember this device, which will verify your trusted device and not require two-step verification when attempting to log in for the next 30 days. After 30 days, you will need to re-verify your device. </p>
                        <p>At setup, you will also be provided with a recovery code. Please keep this in a safe place as it is the only way to gain access to your account if you do not have your trusted device. </p>
                        <h6>What if I don’t have my cell phone when I’m signing in? </h6>
                        <p>If you do not have your cell phone when signing in, you must use your recovery code. When you first activate two-step verification you will be provided with a recovery code to keep safe. This code will grant you access to your account without having your phone. If you do not have either your phone or your recovery code, you will not be able to access your account. This serves to further secure your account so an unauthorised user cannot gain access to your account without your trusted device. </p>
                        <h6>What if I lose my recovery code? </h6>
                        <p>If you lose your recovery code, you will need to contact support. Please be prepared to provide a picture of an official identification. </p>
                        <h6>Can I change the number used to verify my identity? </h6>
                        <p>Yes. To change the number used to verify your account, go to the security tab in your Dashboard and disable two-step verification. After disabling two-step verification, you can re-enable it to enter a new number. </p>
                        <h6>Does activating two-step verification sign me out of my other instances of my account? </h6>
                        <p>Activating two-step verification on one device will not log you out on any other device with which you are currently signed in. After logging out on those devices, you will be prompted with two-step verification on your next login attempt. </p>
                        <h6>Why do I have to verify my device every time I log in? </h6>
                        <p>By selecting “remember this device” on the two-step verification screen, you will not have to verify your device for up to 30 days. </p>
                        <h6>If I log in through two-step verification on my phone, will I have to re-verify when I log in on my computer? </h6>
                        <p>Yes. Each time you log into your account you will need to re-verify your device, unless you choose to remember the device after logging in. Remembering a device will allow you to log in without authentication for up to 30 days. After those 30 days have passed, you will need to re-verify the device. </p>
                        <h6>Can I turn off two-step verification? </h6>
                        <p>Yes. Simply go to your security tab in your Dashboard and you can toggle two-step verification off. Prior to turning off two-step verification, you will be prompted one final time to verify your identity. </p>
                        <h6>What if I don’t have a phone or if I want to use two-step verification through my email or another method? </h6>
                        <p>Two-step verification is only supported through SMS (text message) at this time. </p>
                        <h6>I can’t log in even with my code. Why can’t I log in? </h6>
                        <p>If you can’t log in with your SMS code, try your recovery code. If that doesn’t work, please contact support. Please be prepared to provide your official identification. </p>
                        <h6>Do I need to update my mobile app to enable two-step verification? </h6>
                        <p>To enable two-step verification through your mobile app, you will need to update your iOS app to version 5.0.0, or android app to version 4.8.5. Without updating your mobile app, you can enable two-step verification through the web. If you activate two-step verification through the web and do not update your mobile app, you will still have to pass two-step verification when logging in on mobile, but won’t have access to configure its settings. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq20"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How do I manage my email notifications?</button>
                <div id="faq20" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>To manage all your email notifications, please head over to My Dashboard > My Subscriptions and it will be here where you can sign up / unsubscribe to email notifications.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq21"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                I requested to sell. When will my account be verified?</button>
                <div id="faq21" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Majority of accounts will be verified within 24 hours of the request. However, some accounts may take slightly longer as we conduct a full investigation into each account to ensure The Marketplace is a secured, safe platform for all users. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq22"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                It’s been longer than 24hrs, why isn’t my account verified?</button>
                <div id="faq22" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>On some occasions it takes longer than 24 hours to verify your account. This can be due to our team needing longer to check your details to ensure you are who you say you are. </p>
                        <p>Please do not worry if your account is taking longer to process as this is all to ensure The Marketplace is a safe, secure platform. However, if you feel that your account has been pending for a while. Please contact us. </p>
                    </div>    
                </div>
                <h4 style="margin: 0 auto; text-align: left; padding: 40px 0 20px 0px; font-weight: 700;">Costs</h4>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq23"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How much does shipping cost? (For buyers and sellers?</button>
                <div id="faq23" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Shipping costs for buying and selling will be fixed. Although they will be different from each other… Please find a cost breakdown below: </p>
                        <p>When selling a Product, the shipping fee will equal £4.99 or equivalent. </p>
                        <p>When buying a Product, the shipping fee will equal £7.99 or equivalent. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq24"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How are the T.MP Processing Fee & Transaction Fee?</button>
                <div id="faq24" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>When buying, the ‘Processing Fee’ is calculated by customer loyalty. Upon creating a new account, the processing fee is fixed at 8.5% and as you begin to buy more on our platform, this will reduce to 7%. </p>
                        <p>When selling, the ‘Transaction Fee’ is also calculated by customer loyalty. Upon creating a new account, the processing fee is fixed at 8.5% and as you begin to sell more on our platform, this will reduce to 7%.</p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq25"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                When do I get paid as a seller?</button>
                <div id="faq25" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Once you’ve sold your item and it passes our authentication process, then your payout will be sent immediately to your chosen pay PayPal pal account (In your ‘Bank Information’). </p>
                        <p>Sometimes transactions to PayPal accounts can fail. Here are some reasons why: </p>
                        <p> −	Incorrect email address entered</p>
                        <p> −	Email is not verified with PayPal</p>
                        <p>If you are still experiencing issues with your payout, please contact us. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq26"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What payment types are accepted when buying?</button>
                <div id="faq26" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>We accept all major payment types when trying to buy a product, whether it be using Credit Card, Debit Card or PayPal. </p>
                    </div>    
                </div>
                <h4 style="margin: 0 auto; text-align: left; padding: 40px 0 20px 0px; font-weight: 700;">Products</h4>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq27"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How does the authentication process work?</button>
                <div id="faq27" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Once we receive your items that you have sold. A team of specialists will conduct a full review of the item to spot any flaws/issues that a seller may not have mentioned. </p>
                        <p>This involves looking at tags, logos, buttons and any unique features that a branded product has. </p>
                        <p>Once our authentication team has confirmed that the item is in fact authentic and in the said condition, they will then re-package and send it to the new owner. </p>
                        <p>If for any reason your item does not pass the authentication stage, you will receive an email stating the reason for failure and we will begin getting your item shipped back to you. </p>
                        <p>Please note that The Marketplace has no obligation to return counterfeited products. We may turn those items over to the proper authorities, at your cost. This is due to the fact the sale of counterfeit goods is illegal and can harm our reputation, and those who wish to try will be dealt with appropriately. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq28"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What if I want to sell an item that isn’t listed on T.MP?</button>
                <div id="faq28" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you want to sell a product but the original product isn’t listed on our platform. Please contact us, as we will request information about the product and get it uploaded at the earliest convenience. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq29"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                I’m convinced I’ve been sold a replica! What should I do?</button>
                <div id="faq29" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you believe you have received a replica item, please contact us immediately. We try our hardest to stop this from happening and as the luxury market is continuously expanding, so is the counterfeit market. </p>
                        <p>Please note that if for any reason a counterfeit item does get through our authentication process, we apologise immensely as we will rectify this issue immediately. </p>
                        <p>In addition to this, there will always be that one person who has received an authentic item and has claimed it is a replica and will try to send us the replica item and keep the authentic item for themselves. If you are found out to be this person, your account will be blocked immediately and your details will be blacklisted on our site forever. This means that you will never be allowed to create an account again. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq30"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Can you do a ‘legit check’ for me?</button>
                <div id="faq30" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>No. The Marketplace has an in-house authentication team that are solely used to ensure all items going through our platform are authentic. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq31"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                I never received my order. What do i do?</button>
                <div id="faq31" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>If you haven’t received your order despite it being listed as ‘Delivered’, please contact us. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq32"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                My order has arrived damaged. What should I do?</button>
                <div id="faq32" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>We are sorry to hear about this. Please contact us immediately so we can resolve this issue. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq33"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How shall I send my order once I’ve sold it?</button>
                <div id="faq33" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p> 1. Head over to My Dashboard > Sold Items and click on the “Shipping Label” button to load up your specific shipping label. Print both the Shipping label and order invoice out and place the order invoice with the item you are selling. </p>
                        <p> 2. Place the item into a bigger and sufficiently sized shipping box that is no more than 5 cm larger than your item on each side. Remove all old labels and stickers from the shipping box if you are reusing an old box. </p>
                        <p> 3. Use bubble wrap and/or packing paper to ensure your item is secure while in transit. </p>
                        <p> 4. Seal the package securely to ensure your item is not vulnerable to damage. We recommend that you use strong shipping tape that will hold all flaps of the shipping box. </p>
                        <p> 5. Tape and secure the provided shipping label to the outside of your shipping box. </p>
                        <p> 6. Once your item has been securely packaged up, you should find your nearest … drop off point and ship the item. </p>
                    </div>    
                </div>
                <h4 style="margin: 0 auto; text-align: left; padding: 40px 0 20px 0px; font-weight: 700;">Shipping</h4>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq34"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                How much does shipping cost? (For buyers and sellers)?</button>
                <div id="faq34" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Shipping costs for buying and selling will be fixed. Although they will be different from each other… Please find a cost breakdown below: </p>
                        <p>When selling a Product, the shipping fee will equal £4.99 or equivalent. </p>
                        <p>When buying a Product, the shipping fee will equal £7.99 or equivalent. </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq35"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Shipping instructions.</button>
                <div id="faq35" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>1. Head over to My Dashboard > Sold Items and click on the “Shipping Label” button to load up your specific shipping label. Print both the Shipping label and order invoice out and place the order invoice with the item you are sending. </p>
                        <p>2. Place the item into a bigger and sufficiently sized shipping box that is no more than 5 cm larger than your item on each side. Remove all old labels and stickers from the shipping box if you are reusing an old box. </p>
                        <p>3. Use bubble wrap and/or packing paper to ensure your item is secure while in transit. </p>
                        <p>4. Seal the package securely to ensure your item is not vulnerable to damage. We recommend that you use strong shipping tape that will hold all flaps of the shipping box. </p>
                        <p>5. Tape and secure the provided shipping label to the outside of your shipping box. </p>
                        <p>6. Once your item has been securely packaged up, you should find your nearest … drop off point and ship the item. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq36"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                What happens after I ship my item to you.</button>
                <div id="faq36" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Sit back and relax. </p>
                        <p>Once your order has been shipped you are able to track your item in transit to ensure it safely arrives at our dedicated destination. Upon arrival we will send you an email notification letting you know that we have successfully received your item. </p>
                        <p>From arrival we will then pass this to our authentication team to review and inspect your item to ensure it is in the same condition as stated by you. </p>
                        <p>Once it has passed authentication, we will then release your payout to you and your item will be shipped to its new owner. The rest remains history... </p>
                    </div>    
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq37"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                Can I track my order?</button>
                <div id="faq37" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>Yes. All orders will come with a tracking number via email. </p>
                    </div>
                </div>
                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq38"
                    aria-expanded="false">
                <span class="faq-icon">
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus"></i>
                </span>
                It’s been a few business days and the seller hasn’t shipped. What now?</button>
                <div id="faq38" class="collapse" data-parent="#faqs-group1">
                    <div class="faq-para p-3">
                        <p>The seller has 2 business days to ship their sold items. If for any reason the seller takes longer to ship their item or even refuses to ship, we will notify you immediately. </p>
                        <p>It may just be some unforeseen circumstances and the seller has taken longer to ship, however if you want the latest update, please contact us. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Section End -->



        
        <!-- page top section
         <section class="faq-sec1">
            <div class="container">
                <div class="row">
                    <div class="col-11 offset-md-1">
                        <a href="#" class="contact-page-link smooth-transition"><i class="fa fa-arrow-left"></i> Get
                            back to home page</a>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <h1 class="faq-main-heading">
                            FREQUENTLY<br />ASKED<br />QUESTIONS
                        </h1>
                    </div>
                    <div class="col-md-5">
                        <div class="img-wrapper">
                            <img src="{{asset('/')}}assets/images/placeholder1.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        
        <section class="faq-sec2">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h1 class="text-md-right font-weight-normal">Delivery</h1>
                    </div>
                    <div class="col-md-8 col-sm-12 offset-md-1">
                        <p>How much is the charges and time frames?</p>
                        <p>Here's a summery of all our delivery types and options.</p>
                        <a href="#" class="smooth-transition">Visit the delivery page for full details.</a>
                        <div>
                            <table class="table-responsive striped">
                                <thead>
                                    <tr>
                                        <th>Delivery type</th>
                                        <th>Charges</th>
                                        <th>Time Frame</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5>3 hour pack and collect</h5>
                                        </td>
                                        <td>
                                            <p>Free</p>
                                        </td>
                                        <td>
                                            <p>Proin in nisi interdum, pulvinar justo vitae, commodo tortor. Sed ut
                                                neque in enim porttitor faucibus.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Store Transfer</h5>
                                        </td>
                                        <td>
                                            <p>Free</p>
                                        </td>
                                        <td>
                                            <p>Proin in nisi interdum, pulvinar justo vitae, commodo tortor. Sed ut
                                                neque :
                                            <ul>
                                                <li>1-2 days for urban destinations
                                                </li>
                                                <li>3-5 days for suburbs </li>
                                            </ul>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Special day delivery</h5>
                                        </td>
                                        <td>
                                            <p>$14.85 flat fee</p>
                                        </td>
                                        <td>
                                            <p>Proin in nisi interdum, pulvinar justo vitae, commodo tortor. Sed ut
                                                neque in enim porttitor faucibus eu non lectus. Pellentesque.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>Tristique dui. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. In rhoncus dictum.</p>


                        
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-sec3">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h1 class="text-md-right font-weight-normal">
                            Returns & Exchanges
                        </h1>
                    </div>
                    <div class="col-md-8 col-sm-12 offset-md-1">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptates deleniti
                            temporibus recusandae rem dolorem accusantium excepturi, corporis tempore enim quo eveniet
                            tenetur totam ad quisquam ex, dolores deserunt suscipit!</p>
                    </div>
                    <div class="col-md-8 col-sm-12 offset-md-4">
                        <div class="faq-sec">
                            <div class="accordion" id="faqs-group2">
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq1-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    Can I return or exchange an item i bought online?</button>
                                <div id="faq1-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    Pinkmart is the shop theme you have been always looking for, it is versatile, it is
                                    flexible and it is fast. It has the features that you may have only of you use a
                                    commercial theme or if you hire an expert to create every feature you want.
                                </div>
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq2-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    How do I return an item?</button>
                                <div id="faq2-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    Pinkmart is the shop theme you have been always looking for, it is versatile, it is
                                    flexible and it is fast. It has the features that you may have only of you use a
                                    commercial theme or if you hire an expert to create every feature you want.
                                </div>
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq3-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    How long do I have to return an item?</button>
                                <div id="faq3-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    By buying Pinkmart not only benefit from lifetime updates but constant upgrading. It
                                    means that if you need a feature, we will consider adding it as soon as possible, if
                                    you are not the only one that needs it (a few customers like you requested it) we
                                    will add this to our theme immediately.
                                </div>
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq4-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    Can I exchange an item online?</button>
                                <div id="faq4-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    Pinkmart is the shop theme you have been always looking for, it is versatile, it is
                                    flexible and it is fast. It has the features that you may have only of you use a
                                    commercial theme or if you hire an expert to create every feature you want.
                                </div>
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq5-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    Can I exchange an item in-store?</button>
                                <div id="faq5-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    Pinkmart is the shop theme you have been always looking for, it is versatile, it is
                                    flexible and it is fast. It has the features that you may have only of you use a
                                    commercial theme or if you hire an expert to create every feature you want.
                                </div>
                                <button type="button" class="faq-btn" data-toggle="collapse" data-target="#faq6-g2"
                                    aria-expanded="false">
                                    <span class="faq-icon">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-minus"></i>
                                    </span>
                                    Are any items excluded from the return policy?</button>
                                <div id="faq6-g2" class="collapse faq-para" data-parent="#faqs-group2">
                                    Pinkmart is the shop theme you have been always looking for, it is versatile, it is
                                    flexible and it is fast. It has the features that you may have only of you use a
                                    commercial theme or if you hire an expert to create every feature you want.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-sec4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h1 class="text-md-right font-weight-normal">
                            Contact Our Support Team
                        </h1>
                    </div>
                    <div class="col-md-8 col-sm-12 offset-md-1">
                        <div>
                            <ul>
                                <li>
                                    <h4>Hours of operation (GMT) </h4>
                                </li>
                                <li>
                                    <p>Mon-Wed 9am - 6pm </p>
                                </li>
                                <li>
                                    <p>Thu-Fri 9am - 9pm</p>
                                </li>
                                <li>
                                    <p>Sat 9am - 6pm </p>
                                </li>
                                <li>
                                    <p>sun 10am - 5pm </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
       -->

        
</main>

<script>
    $("#carousel-1").carousel({
        interval: 0
    });

    $("#carousel-1.carousel .carousel-item").each(function() {
    const total = 3;
    let next = $(this).next();

    for (var i = 0; i < total - 1; i++) {
        if (!next.length) {
        next = $(this).siblings(":first");
        }
        next
        .children(":first-child")
        .clone()
        .appendTo($(this));
        next = next.next();
    }
    });

</script>
        <!-- <div class="row faq-bottom-sec">
            <div class="col-md-9">
                <div class="left-side">
                    <div class="inner-col1">
                        <img src="{{asset('/')}}assets/images/placeholder1.jpg" width="300px" height="200px" alt="">
                    </div>
                    <div class="inner-col2">
                        <p>Didn't find what you need? No Problem! Ask your question and support team will respond as soon as possible.</p>
                        <form action="">
                            <div class="form-group">
                                <label for="your-name" class="sr-only">Your Name</label>
                                <input type="text" required placeholder="Your Name" id="your-name" name="your-name">
                            </div>
                            <div class="form-group">
                                <label for="your-email" class="sr-only">Your Name</label>
                                <input type="text" required placeholder="Your Email" id="your-email" name="your-email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Your Name</label>
                                <input type="text" placeholder="Subject" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="your-message" class="sr-only">Your Name</label>
                                <textarea name="your-message" id="your-message" required placeholder="Your Message" rows="3"></textarea>
                            </div>
                            <input type="button" class="smooth-transition" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none d-md-block d-lg-block">
            </div>
        </div> -->
@endsection