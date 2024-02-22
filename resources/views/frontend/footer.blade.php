<footer>
    <div class="container">
        <div class="row">
            <div class="col-4 footer-logo">

                <img src="{{asset('assets/images/logo-white.png')}}" class="img-fluid logo-img">
            </div>

            <div class="col-3 usefull-links">
                <h4>Useful Links</h4>

                <ul class="list-unstyled">

                    <li><a href="{{route('about_us')}}">About Us</a></li>
                    <li><a href="{{route('shop_products')}}">Shop</a></li>
                    <li><a href="{{route('news')}}">News</a></li>
                    <li><a href="{{route('start_selling_home')}}">Start Selling</a></li>
                    <li><a href="{{route('faq')}}">FAQ</a></li>
                    <li><a href="{{route('contactus')}}">Contact Us</a></li>

                </ul>

            </div>

            <div class="col-3 usefull-links">

                <h4>Policies</h4>

                <ul class="list-unstyled">
                    <li><a href="{{route('copyright-policy')}}">Copyright</a></li>
                    <li><a href="{{route('disclaimer')}}">Disclaimer</a></li>                    
                    <li><a href="{{route('privacy_policy')}}">Privacy</a></li>
                    <li><a href="{{route('return-refund')}}">Returns & Refunds</a></li>
                    <li><a href="{{route('shipping-policy')}}">Shipping</a></li>
                    <li><a href="{{route('terms_condition')}}">Terms & Conditions</a></li>                   
                    <li><a href="{{route('vendor-agreement-policy')}}">Seller Agreement</a></li>
                </ul>

            </div>

            <div class="col-2 social-links">

                <h4>Follow Us:</h4>

                <ul class="list-unstyled">
                    <li><a href="https://www.instagram.com/the.marketplace/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>

            </div>

        </div>

        <div class="copyright-tag">

            © <script language="javascript" type="text/javascript">
                document.write((new Date()).getFullYear())
              </script> Copyright All Rights Reserved : <a href="{{url('/')}}">The Marketplace</a>

        </div>

    </div>

    <div class="container" style="display: none;">

    <!--<img src="{{asset('assets/images/logo-white.png')}}" class="img-fluid logo-img">-->

        <div class="container text-center-content-list" >
            <div class="row align-items-right">
                <div class="col-6 col-sm-3">
                    <div class="col-6 col-sm-3-text-color">Useful Links</div>
                    <ul class="list-unstyled-list">
                        <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="col-6 col-sm-3-text-color">Services</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="col-6 col-sm-3-text-color">Social Media</div>
                </div>
            </div>
        </div>

        <!--<ul class="list-unstyled">-->
        <!--  <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>-->
        <!--  <li><a href="{{route('terms_condition')}}">Terms & Conditions</a></li>-->
        <!--  <li><a href="{{route('contactus')}}">Contact Us</a></li>-->
        <!--  <li><a href="{{route('faq')}}">FAQ</a></li>-->
        <!--  <li><a href="{{route('about_us')}}">About Us</a></li>-->
        <!--  <li><a href="{{route('Buying')}}">Buying</a></li>-->
        <!--</ul>-->
        <!--<p>© 2019-2020 Copyright All Rights Reserved : Digitalech</p>-->

        <ul class="list-unstyled">

            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a href="#"><i class="fab fa-skype"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>

        </ul>
    </div>

</footer>

<div class="loading hide"></div>

<button style = "display:none" onclick="topFunction()" id="go-to-top" title="Go to top">

    <i class="fas fa-sort-up gtp-first"></i>
    <i class="fas fa-sort-up gtp-second"></i>
</button>

<script src="{{asset('assets/js/custom-js.js')}}"></script>
<script src="{{asset('assets/js/sliders-js.js')}}"></script>
<script src="{{asset('assets/js/custom-select.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lazy-master/jquery.lazy.min.js')}}"></script>
<script src="{{asset('assets/js/off-canvas-menu.js')}}"></script>
<script>

    $(document).ready(function() {
        $(function () {

            $('.lazy').Lazy();

            // remove alert after 5 seconds
            if($('.alert').hasClass('show')) {
                setTimeout(function () {
                    $('.alert').alert('close');
                }, 5000);
            }
        });
    });

    //Get the button
    var mybutton = document.getElementById("go-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {

        if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>

@yield('scripts')
</body>

</html> </html>
