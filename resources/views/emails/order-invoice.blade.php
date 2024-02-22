<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-type" content="text/html; charset-utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>The-Marketplace</title>
  <style type="text/css">
    @media screen and (max-width: 600px) {
      body {
        padding-left: 15px !important;
        padding-right: 15px !important;
      }

      .product-img {
        max-width: 15% !important;
      }

      .product-title {
        max-width: 48% !important;
      }

      .product-title td,
      .product-quantity td,
      .product-price td {
        padding-top: 5px !important;
      }

      .product-title p {
        font-size: 14px !important;
      }

      .product-quantity p,
      .product-price p {
        line-height: 25px !important;
        font-size: 12px !important;
      }

      .pricing-td .pricing-headings p,
      .pricing-td .pricing-values p {
        font-size: 12px !important;
        font-weight: 600 !important;
        Margin: 0 auto !important;
      }
    }

    @media screen and (max-width: 450px) {
      .logo-table img {
        max-width: 80px !important;
      }

      .heading-td p {
        font-size: 28px !important;
      }

      .order-no-td p {
        font-size: 24px !important;
        Margin-top: 30px !important;
      }

      .sub-heading-td p {
        font-size: 16px !important;
      }

      .address-td .billing-info,
      .address-td .shipping-info {
        max-width: 100% !important;
      }

      .address-td .space-table {
        display: none !important;
      }

      .address-td .shipping-info {
        Margin-top: 30px !important;
      }

      .why-us .why .icon {
        padding-bottom: 5px !important;
      }

      .why-us p {
        font-size: 10px !important;
      }

      .social-td {
        padding: 30px 0 0 !important;
      }

      .social-td a img {
        width: 100% !important;
        max-width: 25px !important;
      }

      .footer-message-td {
        text-align: center !important;
        padding: 20px 0 !important;
        font-size: 0 !important;
      }

      .footer-message-td p {
        font-size: 12px !important;
        font-weight: 400 !important;
      }

      .view-more-btn {
        font-size: 12px !important;
      }
    }

    @media screen and (max-width: 300px) {
      .product-title {
        max-width: 47% !important;
      }
    }
  </style>
</head>

<body style="Margin:0;padding:0;">
  <center class="wrapper" style="width:100%;table-layout:fixed;background-color:#fff;padding-top:20px;padding-bottom:20px;">
    <div class="webkit" style="max-width:600px;background-color:#fff;">
      <table class="outer" align="center" style="font-family:'Poppins', sans-serif;Margin:0 auto;width:100%;max-width:600px;border-spacing:0;color:#000;">

        <!-- Logo Row -->
        <tr style="min-width:100% !important;">
          <td class="header-td" style="min-width:100%;padding:0;padding-bottom:40px;">
            <table class="logo-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;max-width:calc(100%/2 - 3px);vertical-align:top;display:inline-block !important;">
              <tr style="width:100%;min-width:100% !important;display:inline-block !important;">
                <td style="min-width:100%;padding:0;width:100%;display:inline-block !important;">
                  <a href="#"><img src="{{asset('assets/images/logo-black.png')}}" alt="logo-img" style="border:0;max-width: 205px;margin-top: 10px;"></a>
                </td>
              </tr>
            </table>
            <table class="action-buttons-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;max-width:calc(100%/2 - 3px);vertical-align:top;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:inline-block !important;">
                <tr style="width:100%;min-width:100% !important;display:inline-block !important;">
                  <td class="detail-td" align="right" style="min-width:100%;padding:0;width:100%;padding-top:13px;padding-bottom:13px;display:inline-block !important;">
                    <a href="#" style="display:inline-block;line-height:0;font-size:0;margin-left:15px;text-decoration:none !important;">
                      <img src="{{asset('assets/images/icon-user.png')}}" alt="icon-user" style="border:0;">
                    </a>
                    <a href="#" style="display:inline-block;line-height:0;font-size:0;margin-left:15px;text-decoration:none !important;">
                      <img src="{{asset('assets/images/icon-wishlist')}}.png" alt="icon-wishlist" style="border:0;">
                    </a>
                    <a href="#" style="display:inline-block;line-height:0;font-size:0;margin-left:15px;text-decoration:none !important;">
                      <img src="{{asset('assets/images/icon-cart.png')}}" alt="icon-cart.png" style="border:0;">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Logo Row End-->

        <!-- Banner Text -->
        <tr style="min-width:100% !important;">
          <td style="min-width:100%;padding:0;">
            <table align="center" class="thankyou-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td class="heading-td" align="center" style="min-width:100%;padding:0;">
                  <p style="font-size:32px;font-weight:800;Margin-top:0;Margin-bottom:5px;">Thank you for your order!
                  </p>
                </td>
              </tr>
              <tr style="min-width:100% !important;">
                <td align="center" class="notify-text-td" style="min-width:100%;padding:0;">
                  <p style="font-weight:600;font-size:16px;Margin:0 auto 0px;">Your order is confirmed! Review your order information below.</p>
                  <p style="font-weight:600;font-size:16px;Margin:0 auto 0px;">We'll drop you another email when your order ships.</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Banner Text End-->

        <!-- Your Order Text Start -->
        <tr style="min-width:100% !important;">
          <td style="min-width:100%;padding:0;">
            <table class="your-order" align="center" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;background-color:#00a9ec;margin:30px auto;">
              <tr style="min-width:100% !important;">
                <td align="center" class="order-no-td" style="min-width:100%;padding:0;">
                  <p style="font-size:28px;font-weight:700;text-transform:uppercase;Margin-top:20px;Margin-bottom:5px;color:#fff;">
                    Order # {{$order->reference}}</p>
                </td>
              </tr>
              <tr style="min-width:100% !important;">
                <td align="center" class="date-td" style="min-width:100%;padding:0;">
                  <p style="font-weight:500;Margin:0 auto 20px;color:#fff;">{{$order->created_at->format('d-M-Y')}}</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Your Order Text End -->

        <!-- Purchased Heading -->
        <tr style="min-width:100% !important;">
          <td style="min-width:100%;padding:0;">
            <table style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td class="sub-heading-td" style="min-width:100%;padding:0;">
                  <p style="text-transform:uppercase;font-size:18px;font-weight:400;border-bottom:1px solid #000;color:#535353;Margin:0 auto 25px;width:100%;">
                    Purchased Items</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Purchased Heading End-->

        @php
        $subtotal = 0;
        @endphp

        <!-- Product 1 Row -->
        @if(isset($order->order_detail))
        @foreach($order->order_detail as $orderDetail)
        @foreach ($orderDetail->product as $product)

        {{--start - calculate the subtotal which is used in the below code--}}
        @if((float)$product->sale_price > 0)
        <?php $subtotal = $subtotal + $product->sale_price * (float)$orderDetail->quantity; ?>
        @elseif((float)$product->sale_price_sizes > 0)
        <?php $subtotal = $subtotal + $product->sale_price_sizes * (float)$orderDetail->quantity; ?>
        @else
        <?php $subtotal = $subtotal + $product->regular_price * (float)$orderDetail->quantity; ?>
        @endif
        {{--end - calculate the subtotal which is used in the below code--}}

        <!-- Products Row Start -->
        <tr style="min-width:100% !important;">
          <td class="product-wrapper-td" valign="top" style="min-width:100%;padding:0;">
            <table class="product-img" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;max-width:25%;font-size:0;Margin:0;padding:0;width:100%;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:block;">
                <tr style="width:100%;display:block;min-width:100% !important;">
                  <td style="min-width:100%;width:100%;display:block;padding:0;">
                 
                  @php 
                    if($product->image_url != '' &&  Storage::disk('public')->exists($product->image_url)){
                      $productImage = $product->image_url;
                    }else{
                      $productImage = asset('assets/images/product-placeholder.png');
                    }
                    @endphp
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="product-title" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;max-width:40%;Margin:0;padding:0;width:100%;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:block;">
                <tr style="width:100%;display:block;min-width:100% !important;">
                  <td style="min-width:100%;width:100%;display:block;padding:0;padding-top:15px !important;">
                    <p style="Margin:0;font-size:18px;font-weight:700;Margin-left:10px;">{{ $product->product_name }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="product-quantity" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;max-width:12%;text-align:center;Margin:0;padding:0;width:100%;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:block;">
                <tr style="width:100%;display:block;min-width:100% !important;">
                  <td style="min-width:100%;width:100%;display:block;padding:0;padding-top:15px !important;">
                    <p style="Margin:0;font-weight:500;line-height:30px;font-size:14px;">x{{ $orderDetail->quantity }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="product-price" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;max-width:20%;Margin:0;padding:0;width:100%;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:block;">
                <tr style="width:100%;display:block;min-width:100% !important;">
                  <td align="right" style="min-width:100%;width:100%;display:block;padding:0;padding-top:15px !important;">
                    <p style="Margin:0;text-align:right;font-weight:500;line-height:30px;font-size:14px;">£<?php if ($orderDetail->price != NULL) echo  number_format((float)$orderDetail->price, 2, '.', '');
                    else echo number_format((float)$orderDetail->price, 2, '.', '');  ?></p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Products Row End -->

        @endforeach
        @endforeach
        @endif

        <!-- Divider -->
        <tr style="min-width:100% !important;">
          <td style="min-width:100%;padding:0;">
            <table class="divider" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td class="sub-heading-td" style="min-width:100%;padding:0;">
                  <p style="text-transform:uppercase;font-size:18px;font-weight:400;border-bottom:1px solid #000;color:#535353;Margin:0 auto 25px;width:100%;Margin:20px auto 10px;">
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Divider End -->


        <!-- Subtotal Start -->
        <tr style="min-width:100% !important;">
          <td class="pricing-td" style="min-width:100%;padding:0;font-size:0 !important;">
            <table class="pricing-headings" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:calc(100% - 110px) !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      Subtotal</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="pricing-values" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:110px !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      £{{ number_format((float)$subtotal, 2, '.', '') }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Subtotal End -->

        <!-- Shipping Start -->
        <tr style="min-width:100% !important;">
          <td class="pricing-td" style="min-width:100%;padding:0;font-size:0 !important;">
            <table class="pricing-headings" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:calc(100% - 110px) !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      Shipping Fee</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="pricing-values" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:110px !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      £{{ number_format((float)$order->shipping, 2, '.', '') }}
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Shipping End -->

        <!-- Processing Start -->
        <tr style="min-width:100% !important;">
          <td class="pricing-td" style="min-width:100%;padding:0;font-size:0 !important;">
            <table class="pricing-headings" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:calc(100% - 110px) !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      Processing Fee</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="pricing-values" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:110px !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      £{{ number_format((float)$order->processing, 2, '.', '') }}
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Processing End -->

        <!-- Discount Start -->
        <tr style="min-width:100% !important;">
          <td class="pricing-td" style="min-width:100%;padding:0;font-size:0 !important;">
            <table class="pricing-headings" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:calc(100% - 110px) !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      Discount</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="pricing-values" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:110px !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      £{{number_format((float)(($subtotal + $order->shipping + $order->processing) - $order->total_price), 2, '.', '')}}
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Discount End -->

        <!-- Total End -->
        <tr style="min-width:100% !important;">
          <td class="pricing-td" style="min-width:100%;padding:0;font-size:0 !important;">
            <table class="pricing-headings" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:calc(100% - 110px) !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      Total</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="pricing-values" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;display:inline-block !important;width:100% !important;max-width:110px !important;">
              <tbody style="min-width:100%;display:inline-block !important;width:100% !important;min-width:100% !important;">
                <tr style="display:inline-block !important;width:100% !important;min-width:100% !important;">
                  <td align="right" style="min-width:100%;padding:0;font-size:0 !important;display:inline-block !important;width:100% !important;min-width:100% !important;">
                    <p style="font-size:14px;font-weight:600;Margin:5px auto 0 !important;text-align:right !important;">
                      £{{ number_format((float)$order->total_price, 2, '.', '') }}
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Total End -->

        <!-- Payment info Heading -->
        <tr style="min-width:100% !important;">
          <td style="min-width:100%;padding:0;">
            <table style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td class="sub-heading-td payment-sub-heading" style="min-width:100%;padding:0;">
                  <p style="text-transform:uppercase;font-size:18px;font-weight:400;border-bottom:1px solid #000;color:#535353;Margin:0 auto 25px;width:100%;Margin-bottom:0 !important;margin-top:20px !important;">
                    Payment info</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Payment info Heading End-->

        <!-- Payment Method Details -->
        <tr style="min-width:100% !important;">
          <td class="payment-td" style="min-width:100%;padding:0;padding-top:0px !important;">
            <table class="card-number-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;max-width:calc(100%/2 - 15px);vertical-align:top;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:inline-block !important;">
                <tr style="width:100%;min-width:100% !important;display:inline-block !important;">
                  <td class="detail-td" style="min-width:100%;padding:0;width:100%;display:inline-block !important;">
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">{{ $order->getPaymentType() }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="space-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;max-width:20px;vertical-align:top;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:inline-block !important;">
                <tr style="width:100%;min-width:100% !important;display:inline-block !important;">
                  <td style="min-width:100%;padding:0;width:100%;display:inline-block !important;"></td>
                </tr>
              </tbody>
            </table>
            <table class="amount-table" style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;max-width:calc(100%/2 - 15px);vertical-align:top;display:inline-block !important;">
              <tbody style="min-width:100%;width:100%;display:inline-block !important;">
                <tr style="width:100%;min-width:100% !important;display:inline-block !important;">
                  <td class="detail-td" align="right" style="min-width:100%;padding:0;width:100%;display:inline-block !important;">
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;text-align:right !important;">£{{ number_format((float)$order->total_price, 2, '.', '') }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Payment Method Details End -->

        <!-- Billing Info -->
        <tr style="min-width:100% !important;">
          <td class="address-td" style="min-width:100%;padding:0;padding-top:60px;">
            <table class="billing-info" style="border-spacing:0;font-family:'Poppins', sans-serif;display:block;width:100%;">
              <tbody style="min-width:100%;display:block;width:100%;">
                <tr style="display:block;width:100%;min-width:100% !important;">
                  <td class="sub-heading-td" style="min-width:100%;padding:0;display:block;width:100%;">
                    <p style="text-transform:uppercase;font-size:18px;font-weight:400;border-bottom:1px solid #000;color:#535353;Margin:0 auto 25px;width:100%;Margin:0 auto 10px;">
                      Billing Info</p>
                  </td>
                </tr>
                <tr style="display:block;width:100%;min-width:100% !important;">
                  <td class="detail-td" style="min-width:100%;padding:0;display:block;width:100%;">
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">{{$billing->first_name ?? ""}} {{$billing->last_name ?? ""}}</p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">{{$billing->phone}}</p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;"><a href="#" style="color:#00a9ec;text-decoration:none !important;">{{$billing->email}}</a></p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">{{$billing->country ?? ""}}</p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">City/Town: {{$billing->city ?? ""}}</p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">{{$billing->street_address ?? ""}}</p>
                    <p style="font-size:14px;font-weight:600;Margin:3px auto 0;">Post Code: {{$billing->post_code ?? ""}} </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Billing Info End-->

        <!-- View My Order Btn -->
        <tr style="min-width:100% !important;">
          <td class="view-more-td" style="min-width:100%;padding:0;padding:50px 0;">
            <table style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td align="center" style="min-width:100%;padding:0;">
                  <a href="{{ url('/user/orders') }}" class="view-more-btn" style="background-color:#00a9ec;color:#fff;padding:10px 20px;font-size:16px;font-weight:400;text-decoration:none;border-radius:40px;box-shadow:none !important;">View
                    My Order</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- View My Order Btn End -->

        <!-- Why Us -->
        <tr style="min-width:100% !important;">
          <td class="why-us" style="min-width:100%;padding:0;background-color:#a7a7a7;">
            <table class="column" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;display:inline-block;vertical-align:center;width:100%;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;">
              <tbody style="display:block;min-width:100%;">
                <tr style="display:block;min-width:100%;min-width:100% !important;">
                  <td class="why" style="padding:0;display:block;min-width:100%;padding:20px 0px;">
                    <table class="icon" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:40px;font-size:0;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <img src="{{asset('assets/images/icon-1.png')}}" style="border:0;">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="label" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:110px;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <p style="display:inline-block;Margin:0;vertical-align:middle;color:#00a9ec;font-weight:600;text-transform:uppercase;font-size:14px;">
                              Free Delivery</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="column" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;display:inline-block;vertical-align:center;width:100%;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;">
              <tbody style="display:block;min-width:100%;">
                <tr style="display:block;min-width:100%;min-width:100% !important;">
                  <td class="why" style="padding:0;display:block;min-width:100%;padding:20px 0px;">
                    <table class="icon" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:40px;font-size:0;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <img src="{{asset('assets/images/icon-2.png')}}" style="border:0;">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="label" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:110px;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <p style="display:inline-block;Margin:0;vertical-align:middle;color:#00a9ec;font-weight:600;text-transform:uppercase;font-size:14px;">
                              High Quality</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="column" valign="top" style="border-spacing:0;font-family:'Poppins', sans-serif;display:inline-block;vertical-align:center;width:100%;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;">
              <tbody style="display:block;min-width:100%;">
                <tr style="display:block;min-width:100%;min-width:100% !important;">
                  <td class="why" style="padding:0;display:block;min-width:100%;padding:20px 0px;">
                    <table class="icon" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:40px;font-size:0;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <img src="{{asset('assets/images/icon-3.png')}}" style="border:0;">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="label" style="border-spacing:0;font-family:'Poppins', sans-serif;vertical-align:center;max-width:calc(100%/3 - 3px);text-align:center;vertical-align:middle;display:inline-block;width:100%;max-width:110px;">
                      <tbody style="display:block;min-width:100%;">
                        <tr style="display:block;min-width:100%;min-width:100% !important;">
                          <td style="padding:0;display:block;min-width:100%;">
                            <p style="display:inline-block;Margin:0;vertical-align:middle;color:#00a9ec;font-weight:600;text-transform:uppercase;font-size:14px;">
                              Best Choice</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <!-- Why Us End-->

        <!-- Social Icons -->
        <tr style="min-width:100% !important;">
          <td class="social-td" style="min-width:100%;padding:0;padding:40px 0 30px;text-align:center;">
            <table style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td style="min-width:100%;padding:0;">
                  <a href="#" style="display:inline-block;Margin:0 10px;font-size:0;"><img src="{{asset('assets/images/social-icon-fb.png')}}" alt="facebook" style="border:0;"></a>
                  <a href="#" style="display:inline-block;Margin:0 10px;font-size:0;"><img src="{{asset('assets/images/social-icon-twt.png')}}" alt="twitter" style="border:0;"></a>
                  <a href="#" style="display:inline-block;Margin:0 10px;font-size:0;"><img src="{{asset('assets/images/social-icon-ins.png')}}" alt="instagram" style="border:0;"></a>
                  <a href="#" style="display:inline-block;Margin:0 10px;font-size:0;"><img src="{{asset('assets/images/social-icon-yt.png')}}" alt="youtube" style="border:0;"></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Social Icons End -->

        <!-- Footer Message -->
        <tr style="min-width:100% !important;">
          <td class="footer-message-td" style="min-width:100%;padding:0;text-align:center;padding:20px 0;font-size:0;">
            <table style="border-spacing:0;font-family:'Poppins', sans-serif;width:100%;">
              <tr style="min-width:100% !important;">
                <td style="min-width:100%;padding:0;">
                  <p style="font-size:14px;font-weight:500;Margin:0;">
                    You are receiving this email because you have visited our site or asked us about the regular newsletter. Make sure our messages get to your inbox (and not your bulk or junk folders).
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- Footer Message End-->

      </table>
    </div>
  </center>
</body>

</html>