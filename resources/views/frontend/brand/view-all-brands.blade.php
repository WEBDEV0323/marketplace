@extends('layouts.frontend.master')
@section('title', 'Our Brands - The Marketplace')
@section('banner')
<div class="inner-banner">
            <h1 class="dark-heading">The Marketplace</h1>
            <h1 class="page-title">Our Brands</h1>
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

<section class="news-sec1">
    <div class="container">
    
    <?php foreach ($brands as $key => $brand) {
        ?>
        <a class = "view_all_brands" href="{{route('product.brand',[$brand['brand_slug']])}}" ><?php echo $brand['brand_name']; ?></a>
        <hr>
        <?php }?>
        
    </div>
</main>
@endsection