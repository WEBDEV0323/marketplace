@extends('layouts.frontend.master')
@section('title', 'Start Selling - The Marketplace')
@section('banner')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <div class="inner-banner shop2">
        <h1 class="page-title"  style="color: #ffff;">News</h1>
    </div>

@endsection

@section('content')
<main class="subpost-page">
    <section class="subpost-sec1">
        <div class="container">
            <div class="row">
        
                <div class="col-md-12 col-sm-12">
                    <!-- single sub-post -->
                    <div class="subpost-card">
                        <div class="subpost-header">
                            
                            <div class="single-postimg">
                                <img src="{{get_image($news->news_image_url, 'default-news.jpeg')}}" class="img-fluid" alt="">
                            </div>
                            
                            <h1>{{$news->title}}</h1>
                            
                            <p class="cite-details">
                                <a href="#" class="smooth-transition">
                                    <i class="fa-solid fa-user mr-2" aria-hidden="true"></i>
                                    <span class="subpost-title">{{$news->brand->brand_name}}</span>
                                </a>
                            </p>

                            <div class="news-description">
                                <p>{!! $news->description !!}</p>
                            </div>

                        </div>
                    </div>
                    
                   <div class="col-md-12 col-sm-12">
                      <div class="post-views text-center">
                          <font><i class="fa fa-eye pr-2"></i>Post Views: <span><?php echo $news->visit;?></span>
                           <span title="Source Title" class="pr-4 ml-2">
                                    <i class="fa fa-calendar-days pr-2"></i> <?php $monthName = date("F d,Y", strtotime($news->created_at)); echo $monthName;?>
                                </span>
                          </font>
                     </div>
                   </div>

                    <!-- change sub-post -->
                    <div class="clearfix"></div>
                    <div class="change-post">
                        @if(isset($previous))
                            <a href="{{route('single.news',[$previous->news_slug])}}" class="prev-post">
                                <ul>
                                    <li><i class="fa fa-arrow-left mr-3"></i></li>
                                    <li>
                                        <p>Previous Post</p>
                                        <h5 class="smooth-tansition">{{$previous->news_slug}}</h5>
                                    </li>
                                </ul>
                            </a>
                        @endif
    
                        @if(isset($next))
                            <a href="{{route('single.news',[$next->news_slug])}}" class="next-post">
                                <ul>
                                    <li>
                                        <p>Next Post</p>
                                        <h5 class="smooth-tansition">{{$next->title}}</h5>
                                    </li>
                                    <li><i class="fa fa-arrow-right ml-3"></i></li>
                                </ul>
                            </a>
                        @endif
                    </div>
                    
                    <!-- related sub-post -->
                    <h4 class="related-posts-heading">Related Posts</h4>

                    <div class="related-posts">

                        <div class="container">
                            @if(isset($related_news))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="carousel carousel-showmanymoveone slide" id="carousel-news-products">

                                            <div class="carousel-inner">

                                                @foreach($related_news as $i => $news)

                                                    <div class="item {{$i == 0 ? ' active ' : ''}}">

                                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                                            <div class="card" onclick="news('{{$news->news_slug}}','{{url('/')}}');">
                                                                <img src="{{get_image($news->news_image_url, 'default-news.jpeg')}}" class="card-img-top img-fluid img-responsive" alt="">

                                                                <div class="card-body">
                                                                    <p class="small-brandname">{{$news->Brand->brand_name}}</p>
                                                                    <h4 class="card-title">{{$news->title}}</h4>
                                                                    <p class="card-text">{{substr(strip_tags($news->description), 0, 40)}}...</p>
                                                                    <p class="card-text"><small class="text-muted"><i class="fa-sharp fa-solid fa-calendar-days"></i> <?php $monthName = date("d F,Y", strtotime($news->created_at)); echo $monthName;?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                            <a class="left carousel-control" href="#carousel-news-products" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                            <a class="right carousel-control" href="#carousel-news-products" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @else

                                <div class="item">
                                    <div class="card">
                                        <h5 class="brand-title">No Products</h5>
                                    </div>
                                </div>

                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script>
    function news(title,url)
    {
        window.location.href =url+"/news/"+title;
    }

    jQuery(document).ready(function() {

        /* setup your carousels as you normally would using JS
        or via data attributes according to the documentation
        https://getbootstrap.com/javascript/#carousel */
        jQuery('#carousel-news-products').carousel({interval: 3600});

        jQuery('.carousel-showmanymoveone .item').each(function() {
            let itemToClone = jQuery(this);

            for (let i = 1; i < 4; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = jQuery(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone().addClass("cloneditem-" + (i)).appendTo(jQuery(this));
            }
        });
    });
</script>


