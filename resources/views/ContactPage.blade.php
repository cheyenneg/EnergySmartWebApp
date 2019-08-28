{{-- HTML Section --}}
@extends('layout')

@section('title')

  Climate Smart Contact Information Page

@endsection

@section('content')
{{-- Link for the page style sheet --}}
<html>
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
{{-- Link for the Google Maps API --}}
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <div class="banner">

    {{-- banner --}}
    @include('components.header')

  </div>
  <div>
    <table>
      <tr>
        <td>
          <a href="main?tab=tips"><button class="tablink">Tips</button></a>
        </td>
        <td>
          <a href="main?tab=challenges"><button class="tablink">Challenges</button></a>
        </td>
        <td>
          <a href="main?tab=myplan"><button class="tablink">myPlan</button></a>
        </td>
        <td>
          <a href="main?tab=compare"><button class="tablink">Compare Energy</button></a>
        </td>
        <td>
          <a href="main?tab=leaderboards"><button class="tablink">Leaderboards</button></a>
        </td>
        <td>
          <a href="main?tab=resources"><button class="tablink">Resources</button></a>
        </td>
      </tr>
    </table>
  </div>
  <br />
  <br />

<article class="body">
  <div class="contact_div">
    <h1>Climate Smart Missoula Contact Information</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10910.536855913108!2d-113.99543539999998!3d46.87057040000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x275bf657f2cf813c!2sClimate+Smart+Missoula!5e0!3m2!1sen!2sus!4v1518474001676"
                  height="300" frameborder="0" style="border:10" allowfullscreen>
    </iframe>
    <div class="contact_info_div">

      <?php
            $handle = fopen('../public/css/contactContent.txt', "r");
            $output = "";
            $count = 1;
            $phone = "";
            $email = "";
            $website ="";
            $address = "";
            if ($handle) {
              while (($line = fgets($handle)) !== false) {
                if($count == 1){
                  $phone = $line;
                }
                else if($count == 2){
                  $email = $line;
                }
                else if($count ==3){
                  $website = $line;
                }
                else if($count ==4 ){
                  $address = $line;
                }
                $count++;
              }
              fclose($handle);
            }
      ?>
      <label id="contact_text" for="display_text" ><?php echo $phone; ?></label>
      <br />
      <br />
      <label id="contact_text" for="display_text"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></label>
      <br />
      <br />
      <label id="contact_text" for="display_text" ><a href="<?php echo $website;?>"><?php echo $website; ?></a></label>
      <br / >
      <br />
      <label id="contact_text" for="display_text" ><?php echo $address; ?></label>


      <!--
      <ul>
        <li>Telephone #: (406) 926-2847</li>
        <li>Website      :<a href="www.missoulaclimate.org">missoulaclimate.org</a></li>
        <li>Email        :  TBD</li>
        <li>Address      : Florence Bldg N. Higgins Ave.<br />
          &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Missoula Mt 59802</li>
      </ul>
    -->

    </div>
</div>
  <br />
  <br />
  <br />

</article>

<footer>
  <div class="social_button_div">

    {{-- social buttons --}}
    @include('components.share')


  </div>
</footer>
</html>



@endsection

<style>
/* Contact Page */

.contact_div
{
    width: 60%;
    height:68vh;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding-bottom: 10px;
    border-radius: 8px;
    background-color: rgb(247, 155, 46);
    color: white;
    margin:0 auto;
}

.contact_info_div
{
  width: 40%;
  height: 175px;
  border-color: white;
  border-radius: 8px;
  border-style: ridge;
  margin-top: 30px;
  margin-bottom: 50px;
  text-align: justify;
  font-size: 24px;
  padding-left: 15px;
}
</style>
