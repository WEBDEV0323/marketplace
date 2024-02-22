@extends('layouts.frontend.master')
@section('title', 'Coming Soon -The Marketplace')
@section('banner')


<style>
body {
    background: rgb(166,239,254);
    background: linear-gradient(317deg, rgba(166,239,254,1) 6%, rgba(255,255,255,1) 64%);
}

</style>

<div class="inner-banner shop10">
           
            <h1 class="page-title" style="color: #ffff;">Coming Soon</h1>
            <br><br><br>
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

<main class="contactus-page">
        <section class="contact-sec1">
            <div class="container">
                <div class="row comingsoon-page">
                    <img src="{{asset('assets/custom/tmp-logo.png')}}" alt=""/>
                    <h1>Page Coming Soon</h1>
                    <h3>We thank you for your patience</h3>
                </div>
            </div>
        </section>
<main>
@endsection