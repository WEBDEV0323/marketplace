@extends('layouts.frontend.master')
@section('title', 'News - The Marketplace')
@section('banner')
<div class="inner-banner">
            <h1 class="dark-heading">The Marketplace</h1>
            <h1 class="page-title">Latest News</h1>
        </div>

        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            id="search-popup">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="search-wrapper">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search.." aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <div class="typing-indicator">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </span>
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="uil uil-search"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="show_all_results">
                                <div class="emptyresult">Nothing Found For : </div>
                                <a href="#" class="productsearchlink"> dsf</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('content')
<main class="news-page">

<section class="news-sec2">
    <div class="container">
        <div class="row">
            <div class="col-md-11">
              
                <form action="">

                    <select name="" id="" class="form-control">
                        <option value="">Most Viewed</option>
                        <option value="">Newest</option>
                    </select>
                </form>
            </div>
            <div class="col-md-10 m-auto">
                @foreach($all_news as $news)
                <div class="news-wrapper <?php  echo (!(empty($news->news_image)) ? $news->news_image : 'no-img')?>">
                @if(!empty($news->news_image))    
                    <div class="img-wrapper">
                        <a href="{{route('single.news',['slug'=>$news->news_slug])}}"><img src="{{$news->news_image_url}}" alt=""></a>
                    </div>
                    @endif
                    <div class="card card-modal-new-1" style="width:55%;margin-left: 1%;margin-bottom: 1%;">
                        <div class="card-header" style="border: 3px solid #00a9ec;">
                            <p class="top-text"><a href="#"><b>{{$news->brand->brand_name}}</b></a></p>
                            <h1><a href="{{route('single.news',['slug'=>$news->news_slug])}}">{{$news->title}}</a></h1>
                           {{-- <h4>{{strip_tags($news->description)}}</h4> --}}
                            <cite title="Source Title" class="pr-5 bottom-text">
                             <b>   <?php $monthName = date("F d,Y", strtotime($news->created_at));
                                        echo $monthName;?>
                                     
                                    </cite>
                                    
                                  {{--  <a href="#"><i
                                        class="far fa-user" aria-hidden="true"></i><cite title="Source Title"
                                        class="ml-2">admin</cite></a></p>  --}}
                        </div>
                    </div>
                </div>
                                  
                             
                @endforeach

                @if($all_news->count() < 1)
                                        <div class="pagination justify-content-center">{{ __('No record found.') }} </div>
                                    @endif
                                    <div class="pagination mt-3">{{$all_news->links('pagination::bootstrap-4')}}</div>
                
            </div>
        </div>
    </div>
</section>
</main>
@endsection