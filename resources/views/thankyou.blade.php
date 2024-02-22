<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<title>Thankyou</title>

<style>

*{
  margin:0;
  padding:0;
  
}
body{
  background:gray;
}
.main-thankyou-section-outer{

}
.check {
  display: inline-block;
  transform: rotate(45deg);
  height: 24px;
  width: 12px;
  border-bottom:7px solid white;
  border-right: 7px solid white;
   
}

.check-wrapper {
    margin: 0px auto;
    background: lightgreen;
    padding: 10px;
    border-radius: 100%;
    height: 40px;
    width: 40px;
    display: flex;
    justify-content: center;
}

.main-thankyou-section {
    display: flex;
    justify-content: center;
    align-items: stretch;
    flex-direction: column;
    text-align: center;
    border: 2px solid black;
    width: 45%;
    max-width: 600px;
    aspect-ratio: 1/1;
    background: white;
    margin: auto;
    margin-top: 10%;
    padding: 30px;
    box-shadow: 3px 3px 3px 3px #00000061;
}



.main-thankyou-section > *{
      font-family:sans-serif;
    font-weight:bold;
}
.main-thankyou-head{
  text-transform:uppercase;
  font-family:sans-serif;
  font-size:3rem; 
  line-height:normal;
  margin-top:10px;
  
 }

.main-thankyou-order-ref{
   margin-top:10px;
}
.main-thankyou-order-ref span:nth-child(2){
  color:red;
}

.main-thank-you-subText{
  margin-top:10px;
}
.main-thank-you-subText1{
  margin-top:30px;
} 

.main-thank-you-subText2 a{
  text-decoration:none;
  color:lightblue;
}
.main-thank-you-subLinks{
  margin-top:100px;
}
.main-thank-you-subLinks > a{
  text-decoration:none;
  color:black;
  
  padding-left:2%;
  padding-right:2%
}




</style>




</head>

<body>

<div class="main-thankyou-section-outer">
  <div class="main-thankyou-section">
      <div class="check-wrapper">
        <div class="check">
        </div>
      </div>
      <h1 class="main-thankyou-head">
        thank you
      </h1>
      <div class="main-thankyou-order-ref">
        <span>Order Reference:</span>
        <span>{{$reference ?? ""}}</span>
      </div>
    <div class="main-thank-you-subText main-thank-you-subText1">
      It was pleasure doing business with you.
    </div>
    <div class="main-thank-you-subText main-thank-you-subText2">
      Click <a href="{{route('user_orders')}}"  >here</a> to see your order
    </div>
    <div class="main-thank-you-subText main-thank-you-subText3">
        Your Order confirmation has been sent to your email.
    </div>
    <div class="main-thank-you-subLinks">
      <a href="#">
          <i class="fab fa-facebook-f"></i>
        </a>
      <a href="#">
        <i class="fab fa-twitter"></i>
      </a>
      
      <a href="#">
       <i class="fab fa-pinterest"></i>
      </a>
      <a href="#">
         <i class="fa-regular fa-envelope"></i>
       </a>
        <a href="#">
          <i class="fab fa-whatsapp"></i>
        </a>
    </div>
  </div>
</div>



</body>
</html>