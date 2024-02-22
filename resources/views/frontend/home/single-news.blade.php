@extends('layouts.frontend.master')
@section('url', $ogUrl)
@section('image', $ogImage)
@section('description', $ogDescription)
@section('title', 'News - The Marketplace')
@section('banner')

    <div class="inner-banner shop2">
        <h1 class="page-title"  style="color: #ffff;">News</h1>
    </div>

@endsection

@section('content')
<main class="subpost-page">
    <section class="subpost-sec1">
       
            <div class="conatiner">
                <div class="subpost-banner">
                    <img src="{{asset('storage/news/'.$news->id.'/'.$news->news_image)}}" alt="news" class="w-100">
                </div>
                <div class="subpost-cnt">
                    <h1>{{$news->title}}</h1>
                    {{-- <div class="user-test"><i class="fa fa-user"></i> {{$news->created_name}} </div> --}}
                    <div class="user-test"><i class="fa fa-user"></i> {{isset($news->brand)?$news->brand->brand_name:''}}</div>
                    <p>{!!$news->description!!}</p>
                    <div class="view-and-date">
                        <span><i class="fa fa-eye"></i> {!! thousand_format($news->visit) !!} Views</span>
                        <span><i class="fa fa-calendar-alt"></i> {{date_format($news->created_at,"d M Y")}}</span>
                    </div>
                    <div class="text-center">
                        <div class="social">
                            <p>Share This on :</p>
                            <a href="http://www.facebook.com/sharer/sharer.php?u={{$ogUrl}}" target="_blank" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="http://www.twitter.com/share?url={{$ogUrl}}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
                            <a class="wpshare" href="javascript:void(0)" data-link="{{$ogUrl}}"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                 
            </div>
    </section>
    @if(count($related_news)>0)
            <div class="relatednews-section">
                <div class="container">
                    <h3>Related News</h3>
                    <div class="owl-carousel owl-theme relatednews-slider">
                        @foreach($related_news as $data)
                            <div class="item">
                                <div class="newsImg">
                                    <a href="{{url('/')}}/news/{{$data->brand->brand_slug}}/{{$data->news_slug}}">
                                    <img src="{{asset('storage/news/'.$data->id.'/'.$data->news_image)}}" alt="news">
                                    </a>
                                    <span class="date-news"><i class="fa fa-calendar-alt"></i> {{date_format($data->created_at,"d M Y")}}</span>
                                </div>
                                <div class="news-detail">
                                    <h4>{{$data->title}}</h4>
                                    {{-- <div class="user-test"><i class="fa fa-user"></i> {{$data->created_name}}</div> --}}
                                    <div class="user-test"><i class="fa fa-user"></i> {{isset($data->brand)?$data->brand->brand_name:''}}</div>
                                    {{-- <span class="text-truncate">{!!$data->description!!} <a href="{{url('/')}}/news/{{$data->news_slug}}">Read More</a></span> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
</main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click','.wpshare',function(){
                var message = $(this).data('link');
                window.open(
                    'https://api.whatsapp.com/send?text=' + encodeURIComponent(message),
                    '_blank' 
                );
            })
            function wpShare() {
                
            }
        });
    </script>
@endsection