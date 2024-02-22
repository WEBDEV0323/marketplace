@extends('layouts.frontend.master')
@section('title', 'News - The Marketplace')
@section('banner')

    <div class="inner-banner shop2">
        <h1 class="page-title"  style="color: #ffff;">News</h1>
    </div>

@endsection
@section('content')

    <main class="news-page">
        <div class="news-center">
            @if(count($data['featured'])>0)
                <div class="news-banner">
                    <div class="container">
                        <div class="row">
                        <div class="col-12 mb-3">
                                <h5 class="heading-5">Featured</h5>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme news-card-slide">
                            @foreach($data['featured'] as $item)
                            <div class="item">
                                <a href="{{url('/')}}/news/{{$item->brand->brand_slug}}/{{$item->news_slug}}">
                                  <img src="{{asset('storage/news/'.$item->id.'/'.$item->news_image)}}" alt="news"></a>
                            <span class="featured_slide_news_title" >{{$item->title }}</span>
                          </div>
                            @endforeach
                        </div> 
                    </div>
                </div> 
            @endif     

            @if(count($data['brands'])>0)
                <div class="brand-section">
                    <div class="container">
                        <div class="owl-carousel owl-theme news-brands-slider">
                            @foreach($data['brands'] as $item)
                            <div class="item">
                                <div class="card">
                                    <a href="{{route('news.brand',[$item->brand_slug])}}" class="content">
                                        <div class="img-box"> 
                                            <img class="img-fluid lazy " src="{{asset('storage/brands/'.$item->id.'/'.$item->image)}}"> 
                                        </div>
                                        <h5 class="brand-title news_brand_name" style="text-align:center;color:#3a3a3a;"> {{$item->brand_name}}</h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div> 
                    </div>
                </div>  
            @endif      
        </div>
      
      
   
      
      @if(count($data['top-trending'])>0)
        
      <div class="bg-light">
            <div class="container">
                <div class="row  top_news_list">
                    <div class="col-12 mb-3">
                        <h5 class="heading-5">Top Trending</h5>
                    </div>
                  
                      @foreach($data['top-trending'] as $item)
                  	<div class="col-12 col-sm-6 col-md-4 mb-4">	 
                          <a href="{{url('/')}}/news/{{$item->brand->brand_slug}}/{{$item->news_slug}}" class="new-card">
                              <img src="{{asset('storage/news/'.$item->id.'/'.$item->news_image)}}" alt="news">
                            <span class="list_news_title" >{{$item->title }}</span>
                          </a>
                      </div>
                      @endforeach
                   
                </div>
            </div>
        
        	<div class="load-more-section">
         
        @if($data['hasMorePages'])
 				<span class="load-more-btn" id="load-more-btn-top"
                  data-page="{{ (int)$data['currentPage'] + 1  }}">Load More</span>
        @else
            <span class="load-more-btn-no-products">No more products</span>
        @endif
        </div>
        
        
        </div>
      
      
      
       
      
       
      
    @endif
      
      
      
      
    
    @if(count($data['most-recent'])>0)
        <div class="news-banner my-5">
            <div class="container">
                <div class="row">
                <div class="col-12 mb-3">
                        <h5 class="heading-5">Most Recent</h5>
                    </div>
                </div>
                <div class="owl-carousel owl-theme news-card-slide">
                    @foreach($data['most-recent'] as $item)
                    <div class="item">
                        <a href="{{url('/')}}/news/{{$item->brand->brand_slug}}/{{$item->news_slug}}">
                          <img src="{{asset('storage/news/'.$item->id.'/'.$item->news_image)}}" alt="news">
                      	 <span class="featured_slide_news_title" >{{$item->title }}</span>
                      </a>
                    </div>
                    @endforeach
                </div> 
            </div>
        </div>  
    @endif    
      
      
      

    @if(count($data['other-article'])>0)
        <div class="bg-light">
            <div class="container">
                <div class="row other_news_list">
                    <div class="col-12 mb-3">
                        <h5 class="heading-5">Other Articles</h5>
                    </div>
                    @foreach($data['other-article'] as $item)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="{{url('/')}}/news/{{$item->brand->brand_slug}}/{{$item->news_slug}}" class="new-card">
                            <img src="{{asset('storage/news/'.$item->id.'/'.$item->news_image)}}" alt="news">
                          <span class="list_news_title" >{{$item->title }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
          
          
          <div class="load-more-section-other">


                    <span class="load-more-btn" id="load-more-btn-other"
                      data-otherpage="{{ (int)$data['currentPage'] + 1  }}">Load More</span>

          </div>
      
          
          
          
        </div>
      
      
   
      
      
      
    @endif    

    </main>


 
  





    <script>

        function isImage(url) {
            return /\.(jpg|jpeg|png|webp|avif|gif|svg)$/.test(url);
        }

        function redi(name) {
            window.location = location.pathname + "/brand/" + name;
        }
        
        function newsFilter(name){
            
            localStorage.setItem("filter", name);
            window.location = '{{route('news')}}' + '?filter=' + name;
        }
        
    </script>

    <script>

        $(document).ready(function() {
            
            //re-select dd value
            $('#news_filter').val(localStorage.getItem('filter'));
            $('.cat-heading').html('<h2>' + localStorage.getItem('filter') + '</h2>');
            
            /* setup your carousels as you normally would using JS
            or via data attributes according to the documentation
            https://getbootstrap.com/javascript/#carousel */
            $('#carousel-news-brands').carousel({interval: 3600});
            
            $('#carousel-news-slider').carousel({interval: 3600});
            

            $('.carousel-showmanymoveone .item').each(function() {
                let itemToClone = $(this);

                for (let i = 1; i < 4; i++) {
                    itemToClone = itemToClone.next(); 

                    // wrap around if at end of item collection
                    if (!itemToClone.length) {
                        itemToClone = $(this).siblings(':first');
                    }

                    // grab item, clone, add marker class, add to collection
                    itemToClone.children(':first-child').clone().addClass("cloneditem-" + (i)).appendTo($(this));
                }
            });

        });

    </script>





 <script>
      
      
       //script for trending news load more button
   
        $(document).ready(function() {
         // var totalProducts = @if(isset($totalProducts)) {{$totalProducts}} @else '' @endif;
                          
 
         $('#load-more-btn-top').on('click', function() {
             var nextPage = parseInt($(this).data('page'));
       			// Make an AJAX request to load more products
           
          
                $.ajax({
                  
                    url: '/news_top_trending_load_more',
                    type: 'GET',
                    data: { page: nextPage}, // Include the page parameter
                    success: function(response) {
                     
                        // Update the product list with the new products
                      //  $('.product-list').append(response.products);
                      
                      
                      var htmlContent = "";
                      
      
                       
                     response['top-trending'].forEach(function(item) {
  				 			htmlContent += ` 
							<div class="col-12 col-sm-6 col-md-4 mb-4">		
                            <a href="/news/${item.news_slug}" class="new-card">
                                    <img src="storage/news/${item.id}/${item.news_image}" alt="news">
                                    <span class="list_news_title">${item.title}</span>
                                </a>
							</div>
                           
                        `;
					});
         
                    

       

                      // Update the content of the .updated-content div
                      $('.top_news_list').append(htmlContent);
                      
                     	
                    
                      
                        // Update the "Load More" button if there are more pages
                        if (response.hasMorePages) {
                            $('.load-more-btn').data('page', parseInt(response.currentPage) + 1);
                          
                          
                          total_showing_record.textContent = parseInt(response.currentPage) * 50;
                          
                          
                             // Check if the element exists
                            if (spanElement) {
                                // Replace the content with a new number, for example, 15
                                spanElement.textContent = parseInt(response.currentPage) * 50;
                            }
                         
                        } else {
                            $('.load-more-section').html('<span class="load-more-btn-no-products">You have reached the end of this section</span>');
                        }
                    },
                    error: function(error) {
                      
                        console.error('Error loading more products:', error);
                    }
                });
      
   
                 });
        });
      
      
   
   
      
    
    //script for other articles news load more button
   
        $(document).ready(function() {
         // var totalProducts = @if(isset($totalProducts)) {{$totalProducts}} @else '' @endif;
                          
 
         $('#load-more-btn-other').on('click', function() {
             var nextPage = parseInt($(this).data('otherpage'));
       			// Make an AJAX request to load more products
           
         
          
                $.ajax({
                  
                    url: '/news_other_articles_load_more',
                    type: 'GET',
                    data: { otherpage: nextPage}, // Include the page parameter
                    success: function(response) {
                      
                        // Update the product list with the new products
                      //  $('.product-list').append(response.products);
                      
                      
                      var htmlContent_other = "";
                      

                       
                     response['other-article'].forEach(function(item) {
  				 			htmlContent_other += ` 
							<div class="col-12 col-sm-6 col-md-4 mb-4">		
                            <a href="/news/${item.news_slug}" class="new-card">
                                    <img src="storage/news/${item.id}/${item.news_image}" alt="news">
                                    <span class="list_news_title">${item.title}</span>
                                </a>
							</div>
                           
                        `;
					});
                      
                      
                     
                      
                      
                          

         
                    

       

                      // Update the content of the .updated-content div
                      $('.other_news_list').append(htmlContent_other);
                      
                     	
                   
                        // Update the "Load More" button if there are more pages
                        if (response.hasMorePages) {
                            $('#load-more-btn-other').data('otherpage', parseInt(response.currentPage) + 1);

                      
                         // total_showing_record.textContent = parseInt(response.currentPage) * 50;
                          
                          
                             // Check if the element exists
                            //if (spanElement) {
                                // Replace the content with a new number, for example, 15
                              //  spanElement.textContent = parseInt(response.currentPage) * 50;
                           // }
                         
                        } else {
                            $('.load-more-section-other').html('<span class="load-more-btn-no-products">You have reached the end of this section</span>');
                        }
                    },
                    error: function(error) {
                      
                        console.error('Error loading more products:', error);
                    }
                });
      
   
                 });
        });
      
      
   
   
   
   
      
    </script>


















@endsection
