@extends('layouts.frontend.master')
@section('title', 'News - The Marketplace')
@section('banner')

    <div class="inner-banner shop2">
        <h1 class="page-title"  style="color: #ffff;">Brand News</h1>
    </div>

@endsection
@section('content')

    <main class="news-page news_brand_page">     
        <div class="bg-light">
        <div class="container">
            <div class="row brand_news_list">
                <div class="col-12 mb-3">
                    <h5 class="heading-5"> {{ $data['brands']->brand_name??'' }}</h5>
                </div>
                @if(count($data['brand_news'])>0)
                    @foreach($data['brand_news'] as $item)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="{{url('/')}}/news/{{$data['brands']->brand_slug}}/{{$item->news_slug}}" class="new-card">
                            <img src="{{asset('storage/news/'.$item->id.'/'.$item->news_image)}}" alt="news">
                            <span class="list_news_title" >{{$item->title }}</span>
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center now_news_found" >
                            <p>No News found.</p>
                            <a href="{{route('news')}}" class="back-to-shop no_djax btn btn-primary">Back to News</a>
                    </div>
                @endif
            </div>
        </div>
          
          <div class="load-more-brand-news">

 				<span class="load-more-btn" id="load-more-brand-news"
                      data-otherpage="{{ (int)$data['currentPage'] + 1  }}"  data-brandslug="{{$data['brandSlug']}}">Load More</span>

          </div> 
          
          
          
          
    </div>
    
    
     

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
      
      
      
      
      
      
      
      
      
      //script for brand news load more button
   
        $(document).ready(function() {
         
                          
 
         $('#load-more-brand-news').on('click', function() {
             var nextPage = parseInt($(this).data('otherpage'));
           	var brandSlug = $(this).data('brandslug');
       			// Make an AJAX request to load more products
           
       
          
                $.ajax({
                  
                    url: '/brand_news_articles_load_more',
                    type: 'GET',
                    data: { otherpage: nextPage,brandSlug:brandSlug }, // Include the page parameter
                    success: function(response) {
                      
                        // Update the product list with the new products
                      //  $('.product-list').append(response.products);
                      
                      
                      var htmlContent_other = "";
                      
					 
                       
                     response['other-article'].forEach(function(item) {
  				 			htmlContent_other += ` 
							<div class="col-12 col-sm-6 col-md-4 mb-4">		
                            <a href="/news/${item.news_slug}" class="new-card">
                                    <img src="../storage/news/${item.id}/${item.news_image}" alt="news">
                                    <span class="list_news_title">${item.title}</span>
                                </a>
							</div>
                           
                        `;
					});
                      
              
       

                      // Update the content of the .updated-content div
                      $('.brand_news_list').append(htmlContent_other);
                      
                     	
                   
                        // Update the "Load More" button if there are more pages
                        if (response.hasMorePages) {
                            $('#load-more-brand-news').data('otherpage', parseInt(response.currentPage) + 1);

                      
                          
                        } else {
                            $('.load-more-brand-news').html('<span class="load-more-btn-no-products">You have reached the end of this section</span>');
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
