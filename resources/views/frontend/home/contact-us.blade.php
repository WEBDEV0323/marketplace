@extends('layouts.frontend.master')
@section('title', 'Contact Us -The Marketplace')
@section('banner')
<div class="inner-banner shop5">

    <h1 class="page-title" style="color: #ffff;">Contact Us</h1>
    <div class="CR_CCS">Reach out us today!</div>
    <br><br><br>
</div>

<div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="search-popup">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="search-wrapper">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search.." aria-label="Username" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </span>
                                <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
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
    <div class="Container">
        <div class="contact-page-form-all">
            <div class="CU_CSS2">
                <!-- <div class="CU_CCS">contact us</div>
            
            <div class="CR_CCS">Reach out us today!</div>

            <br> -->
                <form action="{{ route('contactus_post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="ALL_FORM_CSS">
                        <div class="form-group">
                            <label class="labbs">Your email address</label>
                            <input type="email" class="form-control CCD" name="email" />
                            <small id="emailHelp" class="form-text text-muted"></small>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>


                        <div class="form-group">
                            <label class="labbs">Subject</label>
                            <input type="text" class="form-control CCD" name="subject" />
                            @error('subject')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label class="labbs">Description </label>
                                <!-- <input
                                        type="text"
                                        class="form-control CCD"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        placeholder=""
                                    /> -->
                                <textarea id="contactFormRichEditor" name="description"></textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <br>

                            <div class="form-group">
                                <label class="labbs">Reason for contact</label>
                                <!-- <input
                                            type="text"
                                        
                                            id="exampleInputPassword1"
                                            placeholder=""
                                        /> -->
                                <select class="form-control CCD" name="reason">
                                    <option selected value="Order">Order</option>
                                    <option value="Account">Account</option>
                                    <option value="Technical">Technical</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('reason')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="labbs">Order Number (optional)</label>
                                <input type="text" class="form-control CCD" name="order_no" />
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                            <br>

                            <div class="form-group">
                                <label class="labbs" for="exampleInputSubject">Phone Number</label>
                                <input type="text" class="form-control CCD" name="phone" />
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <br>

                            <h3 class="AO_CCS">Attachments (optional)</h3>


                            <!-- <div class="CHOOSEFILE_STYLE">
                                  <label for="myfile"></label>
                                  <input type="file" id="myfile" name="myfile" multiple><br><br>  -->
                            <input type="file" name="file" id="form-upload-file" hidden>
                            <label for="form-upload-file" class="upload-file-button">
                                <div class="innertext_1">Add file </div>
                                <div class="innertext_2"> or drop files here</div>
                            </label>
                        </div>
                        <br>
                        <input type="submit" id="contactFormSubmit">
                    </div>


            </div>



            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#contactFormRichEditor', {
            theme: 'snow'
        });
    </script>
    <!-- <section class="contact-sec1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <a href="{{ url('/') }}" class="contact-page-link smooth-transition"><i class="fa fa-arrow-left"></i> Get
                                back to home page</a>
                             
                                <a href="#">
                                <i class="fab fa-facebook-f"></i>
                                </a>
                             
                                <a href="#">
                                <i class="fab fa-twitter"></i>
                                </a>
                           
                                <a href="#">
                                <i class="fab fa-google"></i>
                                </a>
                          
                                <a href="#">
                                <i class="fab fa-instagram"></i>
                                </a>
                             
                                <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                                </a>
                          
                                <a href="#">
                                <i class="fab fa-pinterest"></i>
                                </a>
                              
                                <a href="#">
                                <i class="fab fa-vk"></i>
                                </a>
                            
                                <a href="#">
                                <i class="fab fa-stack-overflow"></i>
                                </a>
                          
                                <a href="#">

                                <i class="fab fa-youtube"></i>
                                </a>
                           
                                <a href="#">
                                <i class="fab fa-slack-hash"></i>
                                </a>
                         
                                <a href="#">
                                <i class="fab fa-github"></i>
                                </a>
                               
                                <a href="#">
                                <i class="fab fa-dribbble"></i>
                                </a>
                         
                                <a href="#">
                                <i class="fab fa-reddit-alien"></i>
                                </a>
                      
                                <a href="#">
                                <i class="fab fa-whatsapp"></i>
                                </a>
                                            <h1>CONTACT<br>US</h1>
                                                        <p>Need a hand? Or a high five?<br>Here's how to reach us.</p>
                                                        <a href="#" class="contact-page-link smooth-transition">Submit a help request <i
                                                                class="fa fa-arrow-right"></i></a>
                                                        <a href="#" class="contact-page-link smooth-transition">PR enquirers <i
                                                                class="fa fa-arrow-right"></i></a>
                                                        <ul>
                                                            <li><span><img src="./assets/images/tele-icon.png" alt=""></span> 1 800 5131678</li>
                                                            <li><span><img src="./assets/images/mag-icon.png" alt=""></span> Work@thisislove.pt</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6 d-none d-lg-block d-md-block">
                                                        <img src="./assets/images/placeholder1.jpg" width="100%" height="100%" alt="">
                                                    </div>
                                                </div>
                                            </div>
            </section>
            <section class="contactsec2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11 offset-md-1">
                            <h1>Anything to<br>say? Let's Chat!</h1>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <p>Fill this out So we can learn more about you and your needs.</p>
                        </div>
                        <div class="col-md-6">
                            <form action="">
                                <div class="col-auto">
                                    <input type="text" placeholder="Your Name">
                                </div>
                                <div class="col-auto">
                                    <input type="email" name="" id="" placeholder="Your Email">
                                </div>
                                <div class="col-auto">
                                    <textarea name="" id="" rows="4"></textarea>
                                </div>
                                <div class="col-auto">
                                    <input type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contact-sec3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11 offset-md-1">
                            <h1>Get Directions<br>To Our Stores</h1>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <table class="table-res table-striped">
                                <tr>
                                    <td>
                                        <h5>Adelaide</h5>
                                        <p>Open 9:00 AM - 5:00 PM</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Albury</h5>
                                        <p>Open 9:00 AM - 5:00 PM</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Ballarat</h5>
                                        <p>Open 9:00 AM - 5:00 PM</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Bankstown</h5>
                                        <p>Open 9:00 AM - 5:00 PM</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Bendigo</h5>
                                        <p>Open 9:00 AM - 5:00 PM</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <iframe
                                src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near"
                                width="100%" height="450" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contact-sec4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <h1>Follow Us On<br>Instagram</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed lorem et felis congue
                                ultricies Lorem ipsum dolor sit amet
                            </p>
                            <a href="#">Our Instagram</a>
                        </div>
                    </div>
                </div>
            </section> -->
</main>
@endsection