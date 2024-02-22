
@extends('layouts.frontend.master')
@section('title', 'About Us -The Marketplace')
@section('banner')
@endsection
@section('content')



<main class="aboutus-page">
    @if(count($banner_images) > 0)
    <section class="about-us-banner padding-tb-100 bg-light-gray">
        <div class="container">
            <div class="owl-carousel owl-theme single-img-slider_banner">

                {{-- <div class="item">
                    <video autoplay muted loop id="myVideo">
                        <source src="{{route('home')}}/Slideshow_1.mp4" type="video/mp4">
                    </video>
                </div> --}}
                <?php $videois = 0; ?>
                @foreach($banner_images as $row)
                <div class="item">
                    @if($row->titile == 'Video')
                        @if($videois == 0)
                            <video autoplay muted loop id="myVideo" class="myVideo" controls>
                        @else
                            <video muted loop id="myVideo_{{$videois}}" class="myVideo" controls>
                        @endif
                            <source src="{{url('/').'/storage/about_us/banner/'.$row->image}}" type="video/mp4">
                        </video> 
                        <?php $videois++; ?>
                    @else
                        <img src="{{url('/').'/storage/about_us/banner/'.$row->image}}" class="about-banner-home" alt="img">
                    @endif
                </div>
               
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @if($our_story)
    <section class="our-story mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12"><h3 class="about-page-heading text-center">Our Story</h3></div>
                <div class="col-md-12">
                   <p>
                        {!! $our_story->description !!}
                   </p>
                </div>
            </div>
        </div>
    </section>
    @endif
   
    <section class="ourmission">
        <div class="container">
            <div class="row justify-content-between">
                @if($our_mission)
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="ourmission-cnt">
                        <h3 class="about-page-heading">Our Mission</h3>
                        {!! $our_mission->description !!}
                    </div>
                </div>
                @endif
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <img src="./assets/images/TMP-Core-Values.jpg" alt="" class="w-100">
                </div>
                @if($our_vision)
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="ourmission-cnt">
                        <h3 class="about-page-heading">Our Vision</h3>
                        {!! $our_vision->description !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
   
    @if(count($our_team) > 0) 
    <section class="team-section">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-12 mb-4">
                    <h3 class="about-page-heading text-center">Meet our team</h3>
                </div>

                @foreach($our_team as $row)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 mb-md-0">
                    <div class="ab-sec5-card first-child">
                        <span style="border-color: #36dde3;"></span>
                        <img class="card-img-top modle_open_class" src="{{url('/').'/storage/about_us/our_team/'.$row->image}}" alt="image" data-toggle="modal" data-target="#team-modal1" data-etitle="{{$row->titile}}" data-subtitle="{{$row->sub_titile}}" data-image_url="{{url('/').'/storage/about_us/our_team/'.$row->image}}" data-desc="{{$row->description}}" >
                        <div class="cardbody">
                            <span data-toggle="modal" data-target="#team-modal1"  data-etitle="{{$row->titile}}" data-subtitle="{{$row->sub_titile}}" data-image_url="{{url('/').'/storage/about_us/our_team/'.$row->image}}" data-desc="{{$row->description}}" class="modle_open_class"><i class="fa fa-plus"></i></span>
                            <h4 class="card-title">{{$row->titile}}</h4>
                            <h5 class="card-subtitle">{{$row->sub_titile}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="services-page-new">
            <div class="modal fade team-modal serviceModal" id="team-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="service_row">
                                <div class="service_imgLeft">
                                    <img class="card-img-top team_image" src="" alt="">
                                </div>
                                <div class="service_modalsection">
                                    <h4 class="card-title team_title"></h4>
                                    <h5 class="card-subtitle team_posint"></h5>
                                    <div class="service_description">
                                        <p class="team_description"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(count($key_metrics) > 0)
    <section class="countersecton">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3 class="about-page-heading text-center text-white">Key Metrics</h3>
                </div>
                <div class="col-md-12 mb-4">
                    <ul class="counter-inner">
                        @php   $i=1;  @endphp
                        @foreach($key_metrics as $row)
                        <li>
                            <div class="count-up">
                                <div class="text-count">
                                    {{-- <div class="counter-count">{{$row->sub_titile}}</div> --}}
                                    @if($i == 1)
                                        <div class="counter-count">{{$total_product}}</div>
                                    @elseif($i == 2)
                                        <div class="counter-count">{{$total_users}}</div>
                                    @elseif($i == 3)
                                        <div class="counter-count">{{$total_seller}}</div>
                                    @elseif($i == 4)
                                        <div class="counter-count">{{$total_brands}}</div>
                                    @elseif($i == 5)
                                        <div class="counter-count">{{ $row->sub_titile }}</div>
                                    @endif

                                    @if($row->description =="Yes")
                                        <span>+</span>
                                    @endif
                                </div>
                                <p>{{$row->titile}}</p>
                            </div>
                        </li>
                        @php   $i++;  @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif

    
    <section class="influencers">
        <div class="container">
            @if(count($influencer_images) > 0)
            <h3 class="about-page-heading text-center">Influencers</h3>
            <!-- <div class="influencers-grid">
                @foreach($influencer_images as $row)
                    <div class="influencers-img">
                        <img src="{{url('/').'/storage/about_us/influencer/'.$row->image}}" alt="image">
                    </div>
                @endforeach
            </div> -->

            <div class="owl-carousel owl-theme three-col-slider">
                @foreach($influencer_images as $row)
                    <div class="item">
                        <div class="influencers-img">
                            <img src="{{url('/').'/storage/about_us/influencer/'.$row->image}}" alt="image">
                        </div>
                    </div>
                    @endforeach
            </div>
            @endif
            
        </div>
        
        @if(isset($contact_us_url) || isset($instagram_url))
        <div class="connect-col">
            <h4>Connect with us to collaborate</h4>
            <div class="d-flex align-items-center justify-content-center">
                @if(isset($contact_us_url))
                    <a href="{{$contact_us_url->description}}"><i class="fa fa-envelope"></i></a>
                @endif
                @if(isset($instagram_url))
                <a class="ml-3" href="{{$instagram_url->description}}" target="_blank"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>
        @endif

    </section>
   
    @if(count($testimonial_images) > 0)
    <section class="testimonials-sec bg-light-gray padding-tb-100">
        <div class="container">
            <h3 class="about-page-heading text-center">Testimonials</h3>
            <!-- <div class="testimonials-grid">
                @foreach($testimonial_images as $row)
                <div class="testimonials-img">
                    <img src="{{url('/').'/storage/about_us/testimonial/'.$row->image}}" alt="image">
                </div>
                @endforeach
            </div> -->
            {{-- <div class="owl-carousel owl-theme four-col-slider">
                @foreach($testimonial_images as $row)
                    <div class="item">
                        <div class="testimonials-img">
                        <img src="{{url('/').'/storage/about_us/testimonial/'.$row->image}}" alt="image">
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <div class="owl-carousel owl-theme four-col-slider">
                @foreach($testimonial_images->chunk(2) as $three)
                    <div class="item">
                        @foreach($three as $row)
                            <div class="testimonials-img">
                                <img src="{{url('/').'/storage/about_us/testimonial/'.$row->image}}" alt="image">
                            </div>                           
                        @endforeach
                    </div>                    
                @endforeach
            </div>

        </div>
    </section>
    @endif
    @if(count($industry_data) > 0)
    <section class="about-us-banner mt-0 padding-tb-100">
        <div class="container">
            <h3 class="about-page-heading text-center">Industry Data</h3>
            <div class="owl-carousel owl-theme single-img-slider">
                @foreach($industry_data as $row)
                <div class="item">
                    <img src="{{url('/').'/storage/about_us/industry_data/'.$row->image}}" alt="img">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @if(count($statistics) > 0)
    <section class="about-us-banner mt-0 padding-tb-100 bg-light-gray">
        <div class="container">
            <h3 class="about-page-heading text-center">Statistics</h3>
            <div class="owl-carousel owl-theme single-img-slider">
                @foreach($statistics as $row)
                <div class="item">
                    <img src="{{url('/').'/storage/about_us/statistics/'.$row->image}}" alt="img">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif



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

        $(document).ready(function(){
            $(document).on('click','.modle_open_class',function(){
               let titile = $(this).data('etitle');
               let subtitle = $(this).data('subtitle');
               let image_url = $(this).data('image_url');
               let desc = $(this).data('desc');
               $(".team_title").html(titile);
               $(".team_posint").html(subtitle);
               $(".team_description").html(desc);
               $(".team_image").attr('src', image_url);
            })
        })
    </script>
    </main>
    @endsection