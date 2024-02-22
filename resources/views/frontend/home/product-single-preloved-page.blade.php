@extends('layouts.frontend.master')
@section('title')
PreLoved - The Marketplace
@endsection
@section('banner')
@endsection
@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .product-page {
        min-height: 780px;
    }

    .slider-container {
        position: relative;
        margin: auto;
        overflow: hidden;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease;

    }

    .slide img {
        width: 100%;
        max-width: 300px;
        height: auto;
        max-height: 300px;
    }

    .slide {
        flex: 0 0 100%;
        text-align: center;
    }

    .counter {
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .prev-btn,
    .next-btn {
        padding: 10px;
        cursor: pointer;
        color: black;
        display: flex;
        text-decoration: none !important;
    }

    .prev-btn .fa,
    .next-btn .fa {
        font-size: 22px;
    }

    .prev-btn.disabled,
    .next-btn.disabled {
        color: lightgray;
        pointer-events: none;
    }

    .social-graph-wrapper {
        text-align: center;
        padding: 1rem 1.25rem 0.2rem 1.25rem;
        position: relative;
        color: #fff;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .social-graph-wrapper .s-icon {
        font-size: 1.5rem;
        position: relative;
        padding: 0 0.625rem;
        color: black;
    }

    .social-graph-wrapper img {
        width: 200px;
        height: auto;
    }

    .disabled {
        color: lightgrey;
    }

    .brand_detail {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .brand_detail span {
        font-size: 16px;
        font-weight: 600;
    }

    .description h4 {
        font-size: 20px;
    }

    .description p {
        font-size: 14px;
        color: #1f1f1f;
        font-weight: 400;
    }

    .hr-lines:before {
        content: " ";
        display: block;
        height: 3px;
        width: 130px;
        position: absolute;
        top: 15%;
        left: 15px;
        background: #00a9ec;
    }

    .products_main {
        background: #00a9ec;
        border-radius: 8px;
        display: flex;
        flex-direction: row;
    }

    .products_category {
        width: 350px;
        text-align: center;
    }

    .products_icon {
        width: 70px;
        background-color: white;
        color: #00a9ec;
        height: 70px;
        border-radius: 50px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .products_icon i {
        padding: 17px;
    }

    .products_category p {
        color: white;
    }

    .products_category a {
        color: white;
        font-size: 13px;

    }

    .cancel_btn {
        background-color: white;
        color: #00a9ec;
        border: 2px solid #00a9ec;
        padding: 7px;
        border-radius: 3px;
        outline: none !important;
    }

    .cart_btn {
        background-color: #00a9ec;
        color: white;
        border: 2px solid #00a9ec;
        padding: 7px;
        outline: none !important;
        border-radius: 3px;
    }

    @media screen and (max-width:990px) {
        .hr-lines:before {
            top: 13%;
        }
    }

    @media screen and (max-width:768px) {
        .hr-lines:before {
            top: 12%;
        }

    }

    @media screen and (max-width:540px) {
        .hr-lines:before {
            top: 10%;
        }
    }
</style>

<main class="product-page product-page-new pb-0">

    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="slider-container">
                    <div class="slider">
                        <div class="slide">
                            <img src="{{asset('assets/images/new-p1.jpeg')}}" alt="Product 1">
                        </div>
                        <div class="slide">
                            <img src="{{asset('assets/images/new-p2.jpeg')}}" alt="Product 2">
                        </div>
                        <div class="slide">
                            <img src="{{asset('assets/images/new-p5.jpeg')}}" alt="Product 3">
                        </div>
                        <!-- Add more slides as needed -->
                    </div>
                    <div class="mt-3" style="display: flex;justify-content: center;">
                        <a class="prev-btn">
                            <img src="{{asset('assets/images/left-arrow.png')}}" alt="">
                        </a>
                        <div class="counter">1 / <span class="total-slides"> 3</span></div>
                        <a class="next-btn">
                            <img src="{{asset('assets/images/right-arrow.png')}}" alt="">
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-12 mx-auto">
                <div class="brand_main">
                    <div class="brand_head text-center">
                        <h5>Brand</h5>
                        <h4>Product Name</h4>

                        <h5>Price</h5>
                    </div>
                    <div class="brand_detail py-1 pt-3">
                        <h5>Size</h5>
                        <span>$95</span>
                    </div>
                    <div class="brand_detail  py-1">
                        <h5>Condition</h5>
                        <span>New</span>
                    </div>

                    <div class="brand_detail  py-1">
                        <h5>Faults</h5>
                        <span>None</span>
                    </div>

                    <div class="brand_button pt-3 text-center">
                        <button class="cancel_btn">Cancel</button>
                        <button class="cart_btn">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="description pt-4">
                    <h4 class="hr-lines">Description</h4>
                    <p class="pt-2">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet
                        vero exercitationem omnis error. Laborum, voluptatem ratione.
                        Porro sed, magni exercitationem, accusantium alias non sapiente
                        beatae quas debitis, laudantium voluptates amet.
                    </p>
                    <p class="pt-2">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet
                        vero exercitationem omnis error. Laborum, voluptatem ratione.
                        Porro sed, magni exercitationem, accusantium alias non sapiente
                        beatae quas debitis, laudantium voluptates amet.
                    </p>
                </div>

                <div class="products_main p-4 mt-2">
                    <div class="products_category">
                        <div class="products_icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.5 31H26.5C29.5 31 31 29.5 31 26.5V23.5C31 20.5 29.5 19 26.5 19H23.5C20.5 19 19 
                                    20.5 19 23.5V26.5C19 29.5 20.5 31 23.5 31ZM5.5 31H8.5C11.5 31 13 29.5 13 26.5V23.5C13 20.5 
                                    11.5 19 8.5 19H5.5C2.5 19 1 20.5 1 23.5V26.5C1 29.5 2.5 31 5.5 31ZM25 13C26.5913 13 28.1174 12.3679 29.2426 11.2426C30.3679 10.1174 31 8.5913 31 7C31 5.4087 30.3679 3.88258 29.2426 2.75736C28.1174 1.63214 26.5913 1 25 1C23.4087 1 21.8826 1.63214 20.7574 2.75736C19.6321 3.88258 19 5.4087 19 7C19 8.5913 19.6321 10.1174 20.7574 11.2426C21.8826 12.3679 23.4087 13 25 13Z" stroke="#00A9EC" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M8.5 13H5.5C2.5 13 1 11.5 1 8.5V5.5C1 2.5 2.5 1 5.5 1H8.5C11.5 1 13 2.5 13 5.5V8.5C13 11.5 11.5 13 8.5 13Z" stroke="#00A9EC" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>

                        <p class="mb-0">Category</p>
                        <a href="">Cardigans</a>
                    </div>


                    <div class="products_category">
                        <div class="products_icon">
                            <svg width="46" height="45" viewBox="0 0 46 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.0683 0.168119C21.7759 0.261665 20.934 0.764475 20.1973 1.29067C17.8821 2.9628 18.3615 
                                2.78741 16.1398 2.78741C13.9064 2.78741 13.2516 2.91603 12.3863 3.50069C11.4976 4.10874 11.1468 
                                4.68171 10.4569 6.7748C10.1061 7.8155 9.75528 8.73927 9.67343 8.84451C9.59158 8.93805 8.84321 
                                9.53441 8.00129 10.1542C6.21223 11.4989 6.06022 11.6392 5.65095 12.5396C5.14814 13.6387 5.19492 
                                14.3637 5.95498 16.7258L6.57472 18.6902L5.95498 20.5845C5.48725 22.0111 5.33523 22.6659 
                                5.33523 23.1921C5.32354 24.6655 5.83804 25.5775 7.31139 26.665L8.29363 27.39L4.61025 
                                31.0851C-0.265829 35.9728 -0.254136 35.587 4.37639 37.3877L7.2997 38.5337L8.43394 
                                41.4453C9.69682 44.6609 9.83713 44.8831 10.6674 44.8831C11.1468 44.8831 11.1702 
                                44.848 15.6136 40.428L20.0804 35.9728L20.8639 36.5107C21.7642 37.1188 22.3489 37.3176 23.261 
                                37.3176C24.1731 37.3176 24.7577 37.1188 25.6581 36.5107L26.4415 35.9728L30.9084 40.428C35.3518 
                                44.848 35.3752 44.8831 35.8546 44.8831C36.6848 44.8831 36.8251 44.6609 38.088 41.4453L39.2223 
                                38.5453L42.1456 37.3994C45.3261 36.1482 45.5951 35.9845 45.5951 35.2011C45.5951 34.8035 45.3963 
                                34.5813 41.9117 31.0851L38.2283 27.39L39.2106 26.665C40.6605 25.5892 41.1867 24.6889 41.1984 
                                23.2506C41.1984 22.7829 41.0347 22.0813 40.5787 20.643L39.9472 18.6785L40.567 16.7258C41.327 
                                14.3637 41.3738 13.6387 40.871 12.5396C40.4617 11.6392 40.3097 11.4989 38.5207 10.1542C37.6904 
                                9.53441 36.9304 8.93805 36.8485 8.84451C36.7667 8.73927 36.4159 7.8155 36.0651 6.7748C35.3986 
                                4.77526 35.001 4.06197 34.2643 3.55916C33.3406 2.92772 33.0599 2.85757 30.6043 2.7991C28.5112 
                                2.72894 28.2774 2.70555 27.9734 2.48338C25.9153 0.96326 24.9214 0.308438 24.4069 0.156426C23.6702 
                                -0.0540526 22.7932 -0.0540526 22.0683 0.168119ZM24.021 2.53015C24.2198 2.64709 24.9916 3.20836 
                                25.7633 3.75795C27.529 5.0559 27.7629 5.12605 30.2418 5.12605C32.2531 5.12605 32.6974 
                                5.20791 33.1184 5.67564C33.2353 5.80426 33.6095 6.76311 33.9486 7.80381C34.2994 8.84451 
                                34.7321 9.90859 34.9075 10.1658C35.0945 10.4348 35.9248 11.1481 36.8836 11.8497C38.4388 
                                12.9956 38.7078 13.2646 38.8715 13.8492C38.9065 13.9895 38.6844 14.8899 38.3219 16.0125C37.515 
                                18.5616 37.515 18.8422 38.3219 21.2978C39.1872 23.8937 39.2573 23.7183 36.4743 25.788C35.6792 
                                26.3727 35.1179 26.8989 34.8724 27.2614C34.6619 27.5771 34.2643 28.5476 33.9486 29.4831C33.3289 
                                31.4008 33.1769 31.7282 32.8144 31.927C32.6507 32.0322 31.8087 32.1024 30.3354 32.1491C28.6866 
                                32.1959 27.9851 32.2661 27.5992 32.4064C27.3185 32.5233 26.3948 33.108 25.5412 33.716C23.869 
                                34.9204 23.4715 35.1075 22.9102 34.9438C22.7114 34.8854 21.8461 34.3358 20.9925 33.7277C20.1389 
                                33.108 19.2151 32.5233 18.9228 32.4181C18.5369 32.2661 17.847 32.1959 16.1866 32.1491C14.7132 
                                32.1024 13.8713 32.0322 13.7076 31.927C13.3451 31.7282 13.158 31.3306 12.5617 29.4597C11.8835 
                                27.3549 11.5911 26.934 10.0476 25.788C7.25293 23.7066 7.33478 23.9054 8.18839 21.3212C9.01861 
                                18.8422 9.01861 18.5733 8.20008 16.0125C7.83759 14.8899 7.61542 13.9895 7.6505 13.8492C7.8142 
                                13.2646 8.08315 12.9956 9.63835 11.8497C10.5738 11.1715 11.4274 10.4348 11.6028 10.1775C11.7782 
                                9.93198 12.2109 8.86789 12.5617 7.8155C12.9125 6.7748 13.2983 5.80426 13.4036 5.67564C13.8245 
                                5.20791 14.2689 5.12605 16.2801 5.12605C18.7591 5.12605 19.0046 5.0559 20.7703 3.75795C21.5304 
                                3.20836 22.3138 2.65878 22.5009 2.53015C22.9453 2.26121 23.5767 2.26121 24.021 2.53015ZM10.3984 
                                30.4069C10.9246 32.1258 11.3456 32.956 12.0004 33.5289C12.9008 34.3241 13.4854 34.4761 15.7539 
                                34.4761C16.8297 34.4761 17.7652 34.5229 17.847 34.5696C17.9406 34.6281 16.8414 35.8208 14.5027 
                                38.1478L11.0182 41.6324L10.3633 39.9485C10.0008 39.0365 9.61496 38.0192 9.49803 37.7034C9.3811 
                                37.3994 9.18231 37.0252 9.05369 36.8849C8.91337 36.7329 7.8142 36.2301 6.49287 35.7039L4.1776 
                                34.8035L7.01906 31.9504C8.58596 30.3835 9.8956 29.0972 9.94237 29.0972C9.97745 29.0972 10.1879 
                                29.6936 10.3984 30.4069ZM39.5029 31.9504L42.3444 34.8035L40.0525 35.7039C38.7896 36.195 37.6554 
                                36.6861 37.5267 36.7914C37.3396 36.9551 36.9772 37.8321 35.5623 41.4687C35.5272 41.5739 34.2176 
                                40.3461 32.0192 38.1478C29.6806 35.8208 28.5814 34.6281 28.675 34.5696C28.7568 34.5229 29.6923 
                                34.4761 30.768 34.4761C33.0365 34.4761 33.6212 34.3241 34.5216 33.5289C35.1764 32.956 35.5974 
                                32.1258 36.1235 30.4069C36.334 29.6936 36.5445 29.0972 36.5796 29.0972C36.6264 29.0972 37.936 30.3835 
                                39.5029 31.9504Z" fill="#00A9EC"></path>
                                <path d="M22.5711 8.58723C22.3957 8.71586 21.8344 9.74487 21.0743 11.3118C20.4078 12.6916 19.8349 13.8492 19.8115 13.8843C19.7764 13.9077 18.4551 14.1181 16.8765 14.3637L13.9882 14.7847L13.6491 15.1822C13.006 15.8838 13.1346 16.0943 15.5317 18.5148L17.6248 20.6196L17.1454 23.426C16.8414 25.1916 16.7011 26.3493 16.7478 26.5598C16.8414 26.9222 17.4377 27.3432 17.8587 27.3432C18.0107 27.3432 19.2853 26.7352 20.7002 25.9868L23.261 24.6421L25.8218 25.9868C27.2367 26.7352 28.5112 27.3432 28.6633 27.3432C29.0842 27.3432 29.6806 26.9222 29.7741 26.5598C29.8209 26.3493 29.6806 25.1916 29.3765 23.426L28.8971 20.6196L30.9902 18.5148C33.1769 16.3048 33.3756 16.0241 33.0599 15.4278C32.7442 14.8431 32.4402 14.7379 29.7507 14.3637C28.3358 14.1649 27.073 13.9895 26.9327 13.9544C26.7573 13.9194 26.3948 13.2879 25.4827 11.3702C24.7577 9.88518 24.1497 8.75094 23.9743 8.62231C23.6352 8.35337 22.9453 8.32998 22.5711 8.58723ZM24.1964 14.0246C24.6642 14.9951 25.167 15.8604 25.3073 15.954C25.4359 16.0358 26.4065 16.2463 27.4589 16.3983C28.4996 16.5503 29.3882 16.7023 29.4116 16.7374C29.4467 16.7608 28.8504 17.3572 28.102 18.0588C27.3536 18.7604 26.6637 19.497 26.5819 19.6958C26.4532 20.0115 26.4766 20.3039 26.769 21.976C26.9444 23.0284 27.0847 23.9171 27.0613 23.9288C27.0379 23.9522 26.2545 23.578 25.3307 23.0869C24.2432 22.5139 23.5065 22.1982 23.2727 22.1982C23.0271 22.1982 22.2904 22.5139 21.203 23.0869C20.2675 23.578 19.4841 23.9639 19.4607 23.9405C19.4373 23.9171 19.5776 23.0284 19.753 21.976C20.0453 20.3156 20.0687 20.0115 19.9401 19.6958C19.8582 19.497 19.18 18.7604 18.42 18.0588C17.6716 17.3572 17.0753 16.7608 17.1103 16.7374C17.1337 16.714 18.0107 16.562 19.0631 16.3983C20.1155 16.2463 21.086 16.0358 21.2264 15.954C21.355 15.8604 21.8578 14.9951 22.3255 14.0246C22.8049 13.0541 23.2259 12.2589 23.261 12.2589C23.2961 12.2589 23.717 13.0541 24.1964 14.0246Z" fill="#00A9EC"></path>
                            </svg>
                        </div>

                        <p class="mb-0">Brand</p>
                        <a href="">Canada Goose</a>
                    </div>

                    <div class="products_category">
                        <div class="products_icon">
                            <svg width="37" height="40" viewBox="0 0 37 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.36719 0.252397C7.18903 0.430563 7.12964 2.46958 7.12964 8.17089V15.8518H4.99164C3.58611 15.8518 2.77447 15.931 2.6161 16.0894C2.43793 16.2676 2.37854 18.4649 2.37854 24.7997V33.2725H1.42832C-0.0761931 33.2725 -0.293952 33.7872 0.319732 35.846C0.557287 36.6181 0.893823 37.1526 1.66588 37.9444C3.40795 39.6667 2.75467 39.6073 18.2155 39.6073C33.6764 39.6073 33.0231 39.6667 34.7652 37.9444C35.5372 37.1526 35.8738 36.6181 36.1113 35.846C36.725 33.7872 36.5073 33.2725 35.0027 33.2725H34.0525V24.7997C34.0525 18.4649 33.9931 16.2676 33.815 16.0894C33.6566 15.931 32.845 15.8518 31.4394 15.8518H29.3014V8.17089C29.3014 2.46958 29.242 0.430563 29.0639 0.252397C28.7273 -0.0841391 7.70373 -0.0841391 7.36719 0.252397ZM14.2563 6.11208C14.2563 11.8134 14.2563 11.8134 16.7506 10.0911L18.2155 9.08152L19.6805 10.0911C22.1748 11.8134 22.1748 11.8134 22.1748 6.11208V1.59854H24.9463H27.7177V10.3089V19.0192H18.2155H8.71334V10.3089V1.59854H11.4848H14.2563V6.11208ZM20.5911 5.18166C20.5911 7.97293 20.5317 8.72519 20.3535 8.60641C20.215 8.50743 19.7398 8.19069 19.3241 7.89375C18.3541 7.20088 18.077 7.20088 17.1069 7.89375C16.6912 8.19069 16.2161 8.50743 16.0973 8.60641C15.8994 8.72519 15.84 7.97293 15.84 5.18166V1.59854H18.2155H20.5911V5.18166ZM7.12964 18.7817C7.12964 19.5735 7.22862 20.2268 7.36719 20.3654C7.70373 20.7019 28.7273 20.7019 29.0639 20.3654C29.2024 20.2268 29.3014 19.5735 29.3014 18.7817V17.4355H30.8851H32.4688V25.354V33.2725H27.9553C23.1052 33.2725 22.9666 33.2923 22.9666 34.3019V34.8562H18.2155H13.4644V34.3019C13.4644 33.2923 13.3259 33.2725 8.47578 33.2725H3.96224V25.354V17.4355H5.54594H7.12964V18.7817ZM11.8807 35.4105C11.8807 35.7075 11.9797 36.0638 12.1183 36.2024C12.4548 36.5389 23.9762 36.5389 24.3128 36.2024C24.4513 36.0638 24.5503 35.7075 24.5503 35.4105V34.8562H29.5984C34.2901 34.8562 34.6464 34.876 34.6464 35.2126C34.6464 35.7669 33.7358 36.9546 32.9241 37.4495L32.1719 37.9246H18.3145C5.05103 37.9246 4.41755 37.9049 3.68509 37.5485C2.87345 37.1328 1.78465 35.8262 1.78465 35.2126C1.78465 34.876 2.0618 34.8562 6.83269 34.8562H11.8807V35.4105Z" fill="#00A9EC"></path>
                                <path d="M17.6612 22.5232C16.9684 23.1368 14.2563 26.6804 14.2563 26.9773C14.2563 27.4128 14.672 27.7296 15.2857 27.7296H15.84V30.2635C15.84 31.966 15.9192 32.8766 16.0775 33.035C16.3943 33.3517 20.0368 33.3517 20.3535 33.035C20.5119 32.8766 20.5911 31.966 20.5911 30.2635V27.7296H21.1454C21.7591 27.7296 22.1748 27.4128 22.1748 26.9773C22.1748 26.8189 21.5017 25.8291 20.6703 24.7799C19.146 22.8795 18.5125 22.1866 18.2155 22.1866C18.1363 22.1866 17.879 22.345 17.6612 22.5232ZM18.9678 25.1957C19.5419 25.9281 19.5617 26.0469 19.3043 26.3438C19.0668 26.6012 19.0074 27.2347 19.0074 29.1747V31.6888H18.2155H17.4237V29.1747C17.4237 27.2347 17.3643 26.6012 17.1267 26.3438C16.8694 26.0469 16.8892 25.9281 17.4633 25.1957C17.8196 24.7403 18.1561 24.3642 18.2155 24.3642C18.2749 24.3642 18.6115 24.7403 18.9678 25.1957Z" fill="#00A9EC"></path>
                            </svg>
                        </div>

                        <p class="mb-0">SKU</p>
                        <a href="">QWER123REWQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const slider = document.querySelector('.slider');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const counter = document.querySelector('.counter');
    const totalSlides = document.querySelector('.total-slides');

    let slideIndex = 0;
    const intervalTime = 5000; // 3 seconds

    function updateCounter() {
        counter.textContent = `${slideIndex + 1} / ${slider.children.length}`;
    }

    function updateButtonState() {
        if (slideIndex === 0) {
            prevBtn.classList.add('disabled');
        } else {
            prevBtn.classList.remove('disabled');
        }

        if (slideIndex === slider.children.length - 1) {
            nextBtn.classList.add('disabled');
        } else {
            nextBtn.classList.remove('disabled');
        }
    }

    function nextSlide() {
        if (slideIndex < slider.children.length - 1) {
            slideIndex++;
        } else {
            slideIndex = 0;
        }
        updateCounter();
        updateButtonState();
        slider.style.transform = `translateX(-${slideIndex * 100}%)`;
    }

    // Call nextSlide function every 3 seconds
    setInterval(nextSlide, intervalTime);

    // Add event listeners for manual navigation
    prevBtn.addEventListener('click', () => {
        if (slideIndex > 0) {
            slideIndex--;
            updateCounter();
            updateButtonState();
            slider.style.transform = `translateX(-${slideIndex * 100}%)`;
        }
    });

    nextBtn.addEventListener('click', () => {
        if (slideIndex < slider.children.length - 1) {
            slideIndex++;
            updateCounter();
            updateButtonState();
            slider.style.transform = `translateX(-${slideIndex * 100}%)`;
        }
    });
</script>
@endsection