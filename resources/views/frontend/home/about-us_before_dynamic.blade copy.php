
@extends('layouts.frontend.master')
@section('title', 'About Us -The Marketplace')
@section('banner')
@endsection
@section('content')


<div class="container">
    <div class="about-us-banner">
        <div class="owl-carousel owl-theme single-img-slider">
            <div class="item">
                <img src="./assets/images/about-logo.jpg" alt="img">
            </div>
            <div class="item">
                <img src="./assets/images/about-img01.jpg" alt="img">
            </div>
        </div>
    </div>
</div>

<main class="aboutus-page">
    <section class="our-story mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12"><h3 class="about-page-heading text-center">Our Story</h3></div>
                <div class="col-md-6">
                    <p>Welcome to our platform! We are absolutely thrilled to have you here with us. We hope that your online shopping experience has been a breeze, saving you time and effort in searching for the best prices and deals across numerous sites.</p>
                    <p>Let us introduce ourselves. We are The Marketplace, affectionately known as TMP, a multi-brand retailer offering thousands of products, from trendy socks to stylish shirts, and everything in between. But that's not all - we also empower sellers to list their own products for sale, whether they're brand new or pre-loved (as long as it's listed on our platform, of course!). This means you can snag some amazing deals and save some cash on that exact product you've been eyeing, without breaking the bank. It's like finding a fashion treasure, and it's a true godsend when you've been searching for that elusive item in your size!</p>
                    <p>The idea for TMP was born in 2020, and we've been working tirelessly ever since, even facing some hiccups along the way (we've all been there - firing teams, missed deadlines - you name it!). But through it all, we've kept pushing forward, growing, improving, and educating ourselves to ensure we have the right tools for the job. Countless hours have been spent designing, troubleshooting, planning for the unexpected, and collaborating with our amazing team. And despite the challenges, we are still head over heels in love with our idea.</p>
                    <p>As we continue to grow and evolve as individuals, we are committed to reinvesting all our time and resources into continuously expanding and improving our platform. We have big plans for the future, with our sights set on becoming the number one destination for online shopping.</p>
                    <p>We're thrilled to have you join us on this exciting journey, and we can't wait to see what the future holds. So, stick around, buckle up, and let's make some fashion magic happen! Cheers to an enjoyable shopping experience with TMP!</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 col-sm-6 align-self-center">
                            <div class="story-image">
                                <img src="./assets/images/about01.jpg" alt="img">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="story-image">
                                <img src="./assets/images/about02.jpg" alt="img">
                            </div>
                            <div class="story-image mt-4">
                                <img src="./assets/images/about03.jpg" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ourmission">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 align-self-center">
                    <div class="ourmission-cnt">
                        <h3 class="about-page-heading">Our Mission</h3>
                        <p>To be the first-choice luxury service, providing a satisfying experience and offering outstanding support!</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 align-self-start">
                    <div class="ourmission-image">
                        <img src="./assets/images/mission01.jpg" alt="img">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 align-self-start">
                    <div class="ourmission-image">
                        <img src="./assets/images/mission02.jpg" alt="img">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  align-self-center">
                    <div class="ourmission-cnt">
                        <h3 class="about-page-heading">Our Vision</h3>
                        <p><strong>People:</strong> To change the way people shop by giving them everything they need in one place!</p>
                        <p><strong>Portfolio:</strong> Offering a diverse portfolio, so that there’s something for everyone!</p>
                        <p><strong>Profit:</strong> To maximise profits while saving the customer money!</p>
                        <p><strong>Responsiveness:</strong> Adapting swiftly and effortlessly to the changing markets and always looking for opportunities to step into the future and being the first to make that change!</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
       
    <section class="team-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12 mb-4">
                    <h3 class="about-page-heading text-center">Meet our team</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="ab-sec5-card first-child">
                        <span style="border-color: #36dde3;"></span>
                        <img class="card-img-top" src="./assets/images/user-image.jpg" alt="image">
                        <div class="cardbody">
                            <span data-toggle="modal" data-target="#team-modal1"><i class="fa fa-plus"></i></span>
                            <h4 class="card-title">Harrison Wynne</h4>
                            <h5 class="card-subtitle">Director</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="ab-sec5-card second-child">
                        <span style="border-color: #ff318b;"></span>
                        <img class="card-img-top" src="./assets/images/user-image.jpg" alt="image">
                        <div class="cardbody">
                            <span data-toggle="modal" data-target="#team-modal1"><i class="fas fa-plus"></i></span>
                            <h4 class="card-title">Lewis Busby</h4>
                            <h5 class="card-subtitle">Director</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade team-modal" id="team-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <button type="button" class="dsimissBtn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <div class="row">
                            <div class="col-6 col-sm-5">
                                <div class="member-img">
                                    <img class="card-img-top" src="./assets/images/user-image.jpg" alt="image">
                                </div>
                            </div>
                            <div class="col-6 col-sm-7">
                                <h4 class="card-title">Harrison Wynne</h4>
                                <h5 class="card-subtitle">Director</h5>
                                <div class="member_description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="countersecton">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3 class="about-page-heading text-center text-white">Key Metrics</h3>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="count-up">
                        <div class="text-count">
                            <div class="counter-count">200</div>
                            <span>+</span>
                        </div>
                        <p>Products listed</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="count-up">
                        <div class="text-count">
                            <div class="counter-count">70</div>
                            <span>K</span>
                        </div>
                        <p>Amount of Users</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="count-up">
                        <div class="text-count">
                            <div class="counter-count">20</div>
                            <span>K</span>
                        </div>
                        <p>Amount of Sellers</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="count-up">
                        <div class="text-count">
                            <div class="counter-count">100</div>
                            <span>+</span>
                        </div>
                        <p>No. of Brands listed</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="count-up">
                        <div class="text-count">
                            <div class="counter-count">50</div>
                            <span>K</span>
                        </div>
                        <p>No of Team Members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="influencers">
        <div class="container">
            <h3 class="about-page-heading text-center">Influencers</h3>
            <div class="influencers-grid">
                <div class="influencers-img">
                    <img src="./assets/images/influencers01.jpg" alt="image">
                </div>
                <div class="influencers-img">
                    <img src="./assets/images/user-image.jpg" alt="image">
                </div>
                <div class="influencers-img">
                    <img src="./assets/images/influencers01.jpg" alt="image">
                </div>
            </div>
        </div>
    </section>


    <section class="industryData">
        <div class="container">
            <h3 class="about-page-heading text-center">Industry Data</h3>
            <div class="influencers-grid">
                <div class="influencers-img">
                    <img src="./assets/images/influencers01.jpg" alt="image">
                </div>
                <div class="influencers-img">
                    <img src="./assets/images/user-image.jpg" alt="image">
                </div>
                <div class="influencers-img">
                    <img src="./assets/images/influencers01.jpg" alt="image">
                </div>
            </div>
        </div>
    </section>




    <script>
        $('.counter-count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                
                //chnage count up speed here
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
    </main>
    @endsection