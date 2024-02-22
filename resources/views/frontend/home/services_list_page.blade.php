@extends('layouts.frontend.master')
@section('title', 'Services – The Marketplace')
@section('banner')

@endsection
@section('content')

<main class="services-page-new">
    <section class="services-page-new-inner">
        <div class="container">
            <div class="services-page-design">
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#stylistModal">
                        <img src="{{asset('assets/images/stylist.jpeg')}}" alt="" />
                        <div class="service-title">Styling</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#personalModal">
                        <img src="{{asset('assets/images/personal-shopper.jpeg')}}" alt="" />
                        <div class="service-title">Personal Shopping</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#sourcingModal">
                        <img src="{{asset('assets/images/sourcing.jpeg')}}" alt="" />
                        <div class="service-title">Sourcing</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#shipping">
                        <img src="{{asset('assets/images/VIPShipping.jpg')}}" alt="" />
                        <div class="service-title">VIP Shipping</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#fees">
                        <img src="{{asset('assets/images/NoFees.jpg')}}" alt="" />
                        <div class="service-title">No Fees</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#access">
                        <img src="{{asset('assets/images/ExclusiveAccess.jpg')}}" alt="" />
                        <div class="service-title">Exclussive Access</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#valuation">
                        <img src="{{asset('assets/images/ProductValuation.jpg')}}" alt="" />
                        <div class="service-title">Product Valuation</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#customer">
                        <img src="{{asset('assets/images/Customerservice.jpg')}}" alt="" />
                        <div class="service-title">VIP Customer Services</div>
                    </a>
                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#database">
                        <img src="{{asset('assets/images/LuxuryDatabase.jpg')}}" alt="" />
                        <div class="service-title">Tailored Database</div>
                    </a>
                </div>
                <div class="services-card" style="border:none;margin:0 auto!important;">

                </div>
                <div class="services-card">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#listing">
                        <img src="{{asset('assets/images/Boosted.jpg')}}" alt="" />
                        <div class="service-title">Boosting Listings</div>
                    </a>
                </div>
                <div class="services-card" style="border:none;margin:0 auto!important;">

                </div>
            </div>
        </div>
    </section>

    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="stylistModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Styling</h3>
                            <div class="service_description h-auto">
                                <p>This service is for these 3 type of people… 1) those who have more important tasks to focus on 2) Those who are strung for ideas on their next outfit purchase, and 3) Those who don’t know; where to start, what’s hot or their endless possibilities.</p>
                                <p>So we came up with the solution…</p>
                                <p>We have created a personalised shopping experience based electronically allowing you to exhaust our expertise at any given moment. Our team of professionals are always available and eager to suit your needs relieving you of this burden.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="personalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Personal Shopping</h3>
                            <div class="service_description h-auto">
                                <p>In need of an expert to assist with your shopping experience? We understand that it would take days to go through our hundreds of thousands of products to find some new potential candidates for your wardrobe. That’s why our team are here to do all the work. </p>
                                <p>We aim to inspire you from our range of curated collections from the most prestigious luxury brands known globally. </p>
                                <p>Here at The Marketplace we strive to build long lasting relationships with each of our clients from delivering an exceptional service and gaining your trust. </p>
                                <p>To take our relationship further, we will create a database from the information you give to us, so we can keep you in the updated with your favourite brands, new collections in your sizes and even sale items, so that you never miss out. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="sourcingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Sourcing</h3>
                            <div class="service_description h-auto">
                                <p>Chanel, Goyard & Louis V are a few of the many brands that break our hearts when the must-have item we desire is sold out everywhere. Say goodbye to the endless hours of digging into the world wide web, as we are at your service. </p>
                                <p>Whether it be an item from past seasons, or the most exclusive item in the world, entrust us with the task and let us show you why we’re number one!</p>
                                <p>From our extensive network and years of experience, we’ll go above and beyond to make your shopping desires come true. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="shipping" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>VIP Shipping</h3>
                            <div class="service_description h-auto">
                                <p>
                                    Urgency is key, we understand that. <br><br>
                                    This is for those in desperate need of a luxury item, whether it be a scheduled event for the next day or two, or you just don’t want to wait the usual shipping time. <br><br>
                                    If you order before 6pm you will get that item the same day, brought straight to you by one of our representatives, so for whatever the reason, you’ll be covered.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="fees" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>No Fees</h3>
                            <div class="service_description h-auto">
                                <p>
                                    Exclusive for those who buy the Premium Services Package, you will be granted with 0% fees on all your Purchases and Sales. This means that you are getting the very best price on the market while also keeping every penny of that sale.
                                    <br><br> This cannot be accessed any other way.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="access" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Exclussive Access</h3>
                            <div class="service_description h-auto">
                                <p> 
                                    Exclusive access for our exclusive members.<br><br>
                                    From accessing our premium services you will be the very 1st to hear about any new product releases, any deals/promotions/offers or anything else that could benefit your life on our platform by granting you 1st pick.<br><br>
                                    We understand that the newest releases are very sought after, and that is why we are giving you exclusive access.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="valuation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Product Valuation</h3>
                            <div class="service_description h-auto">
                                <p> Have a product and need a valuation. Our specialists have you covered.<br><br>
                                    Just get in contact with us via the “VIP Customer Services” section and we will give you an accurate and honest valuation, so whether you just wanted to know, or are thinking about selling, you know the worth.<br><br>
                                    We also use external evaluators to ensure we give you the most accurate valuation (With market proof).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="customer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>VIP Customer Services</h3>
                            <div class="service_description h-auto">
                                <p>
                                    Get dealt with in an instant. No more waiting on hold for hours to then be thrown around multiple departments to try to solve a query.<br><br>
                                    How our VIP Customer Service works is that all you have to do is submit a ticket, with the issue you are facing and the correct department will call YOU, all within 15 minutes.<br><br>
                                    Therefore making you our priority and ensuring the issue is solved within an instant.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="database" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Tailored Database</h3>
                            <div class="service_description h-auto">
                                <p>
                                    Get involved with our tailored database once you purchase our premium services… it’s no skin off your back.<br><br>
                                    So what does this entail? Well, this can be specific to you or even your whole family. There is no limit.<br><br>
                                    What we will do is take details of who you would like in your database, this may include, Sizes, Preferred Brands, Special dates or anything that you would want us to monitor.<br><br>
                                    And what will happen with this, is when we get an item, in a size and brand as listed in your database, you are notified instantly with a direct link to pay. This also benefits you if you have inserted a “Special day” this could be an anniversary, birthday or anything as such, so that when this day is slowly approaching, we will generate a concise and thoughtful list of products so that you don’t have to. While also giving you a gentle reminder.<br><br>
                                    So leave all the work up to us.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Card Modal -->
    <div class="modal fade serviceModal" id="listing" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="service_row">
                        <div class="service_modalsection mx-widthFull">
                            <h3>Boosting Listings</h3>
                            <div class="service_description h-auto">
                                <p>
                                    We understand listing items can be a pain. That is why we are offering you an opportunity to have all of your products boosted for no additional cost.<br><br>
                                    When listing a product, there will be an option to have your product(s) boosted. What this means is, your product will be sent to our range of Affiliates who will promote your product to their audience in the hope that they can get the sale (Before it happens organically) and the best news… this is absolutely free for all our Premium Service Clients, meaning your old, unwanted products should be out the door in no time. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection