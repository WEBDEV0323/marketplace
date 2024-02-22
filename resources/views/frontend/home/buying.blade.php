

@extends('layouts.frontend.master')
@section('title', 'Buying -The Marketplace')
@section('banner')
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<style>

.bye_sec_all_css {
  /* margin-left: 28%;
  margin-right: 28%; */
  margin: auto;
  margin-top: 5%;
  width: 50%;

  text-align: left;
}
.Buy_css {
  text-align: center;
  font-size: xx-large;
  font-weight: bolder;
  font-family: system-ui;
  padding-bottom: 10%;
}

.types {
  font-size: medium;
  width: 100%;
}
.accordion-button {
  margin-left: auto;
}
.buy_section_page .accordion-button,
.buy_section_page .accordion-button:not(.collapsed) {
  margin-bottom: 20px;
  background-color: gainsboro;
  transform: unset;
  display: flex;
  justify-content: flex-end;
  flex-direction: row-reverse;
}
/* try */
.buy_section_page .accordion-button:not(.collapsed)::before {
  background-image: none;
  content: "-";
  transform: unset;
  /* margin-right: 0.5rem; */
  order: 1;
}

.buy_section_page .accordion-button.collapsed::before {
  background-image: none;
  content: "+";
  /* margin-right: 0.5rem; */
  order: 1;
}

.buy_section_page .accordion-button:not(.collapsed)::after {
  background-image: none;
  display: none;
}

.buy_section_page .accordion-button.collapsed::after {
  background-image: none;
  display: none;
}

.ttp {
  /* font-family: serif; */
  font-size: large;
  font-weight: bolder;
  color: black;
}
.ttp :not(.collapsed) {
  color: black;
}
.nkey .accordion-item {
  border: 0px;
}
.tps {
  margin-left: 10px;
}
.bye_sec_all_css .accordion-button-icon {
  margin-left: 10px;
}
@media (max-width: 800px) {
  .bye_sec_all_css {
    width: 80%;
  }
}


</style>

<div class="inner-banner shop6">
            
    <h1 class="page-title">Buying</h1>
    <br><br><br>
</div>


<main class="faq-page-section">

    
<div class="bye_sec_all_css buy_section_page">
      <!-- <div class="Buy_css">Buying</div> -->
<div class="nkey">
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
          <button class="accordion-button ttp" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
            <span class="me-2"></span>
            <span class="accordion-button-icon ">How is the payment taken?</span>
          </button>
          
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body ">
            <h class="ttype">
            Wheather you are interested as one of our softwares already created or in
            need of your own bespoke software created. please get in touch via
            'contact us' section and we will be more than happy you a consultation to
            ensure this is the best option for you and answer any question you may
            have </h>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
          <button class="accordion-button collapsed ttp" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
            <span class="me-2"></span>
            <span class="accordion-button-icon ">How is the payment taken?</span>
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
          <div class="accordion-body">
           <h>  Wheather you are interested as one of our softwares already created or in
      need of your own bespoke software created. please get in touch via
      'contact us' section and we will be more than happy you a consultation to
      ensure this is the best option for you and answer any question you may
      have     </h>     </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
          <button class="accordion-button ttp collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
            <span class="me-2"></span>
            <span class="accordion-button-icon ">How is the payment taken?</span>
          </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
          <div class="accordion-body">
            Wheather you are interested as one of our softwares already created or in
            need of your own bespoke software created. please get in touch via
            'contact us' section and we will be more than happy you a consultation to
            ensure this is the best option for you and answer any question you may
            have          </div>
        </div>
      </div>
    </div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingfour">
          <button class="accordion-button ttp" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefour" aria-expanded="true" aria-controls="panelsStayOpen-collapsefour">
            <span class="me-2"></span>
            <span class="accordion-button-icon ">How is the payment taken?</span>
          </button>
        </h2>
        <div id="panelsStayOpen-collapsefour" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingfour">
          <div class="accordion-body">
            Wheather you are interested as one of our softwares already created or in
            need of your own bespoke software created. please get in touch via
            'contact us' section and we will be more than happy you a consultation to
            ensure this is the best option for you and answer any question you may
            have
          </div>
        </div>
      </div>
      
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingfive">
          <button class="accordion-button collapsed ttp" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefive" aria-expanded="false" aria-controls="panelsStayOpen-collapsefive">
            <span class="me-2"></span>
            <span class="accordion-button-icon ">How is the payment taken?</span>
          </button>
        </h2>
        <div id="panelsStayOpen-collapsefive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingfive">
          <div class="accordion-body">
            Wheather you are interested as one of our softwares already created or in
      need of your own bespoke software created. please get in touch via
      'contact us' section and we will be more than happy you a consultation to
      ensure this is the best option for you and answer any question you may
      have          </div>
        </div>
      </div>
    
    </div>

</main>
@endsection