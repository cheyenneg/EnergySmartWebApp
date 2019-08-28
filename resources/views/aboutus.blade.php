{{-- HTML Section --}}


@extends('layout')

@section('title')

  Climate Smart Website About Us Page

@endsection

@section('content')
<html>
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div>
  <div class="banner">

    {{-- banner --}}
    @include('components.header')

  </div>



  <article class="body">
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

    <div class="aboutus_div">
      <h1>About Us<h1>
      <div class="aboutus_form_div">
        <div class="image_div">
        </div>
        <br />

    <?php
          $handle = fopen('../public/css/aboutContent.txt', "r");
          $output = "";
          if ($handle) {
            while (($line = fgets($handle)) !== false) {
              $output .= $line;
              $output .=  "</br>";
            }
            fclose($handle);
          }
    ?>
      <label id="about_test" for="display_text" ><?php echo $output; ?></label>
      <br />
      <br />
      </div>
    </div>
    <br />
    <br />

  <footer>
    <div class="social_button_div">

      {{-- social buttons --}}
      @include('components.share')


    </div>
  </footer>
    </article>
</html>



@endsection
