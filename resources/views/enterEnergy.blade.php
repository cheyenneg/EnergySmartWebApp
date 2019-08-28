{{-- HTML Section --}}


@extends('layout')

@section('title')

  Climate Smart Website Landing Page

@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>

$(window).load(function () {
    $('.popup').click(function(){
       $('.hover').show();
    });

    $('.hover').click(function(){
        $('.hover').hide();
        $alert("hello1");
    });

    $('.CloseButton').click(function(){
        $('.hover').hide();
        $alert("hello2");
    });
});

</script>


@section('content')
<html>
  <link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div class="banner">

    {{-- banner --}}
    @include('components.header')

  </div>

  <!-- pop up window for information; hidden -->
  <div class="hover">
    <span class="helper"></span>
    <div>
      <div class="CloseButton">X</div>
      <p>Info on how to find bill and how to find elements on the bill</p>
    </div>
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
<!-- Error Div -->
    <div id="error_div">
      @if ($errors->any())
        <br />
        @foreach ($errors->all() as $error)
          <b>{{ $error }}</b><br />
        @endforeach
        <br />
      @endif
      @if(session('status'))
        <br />
        <h3>{{ session('status') }}</h3>
        <br />
      @endif
    </div>
    <div class="maual_energy_entry_div">
      <h1>Enter Energy Data</h1>
      <a class="popup">Click here for help finding your energy bill</a>
      <br />
      <div class="energy_entry_form_div">
        <form name = "energy" action="/energy" method="post">
          {{ csrf_field() }}
          <label id='energy_entry_label' for='start_date'>Period Start Date:</label>
          <input id='energy_entry_textbox' type='date' name='start_date' id='month'  maxlength="50" required="true" placeholder="MM/DD/YYYY"/>
          <br />
          <br />
          <br />

          <label id='energy_entry_label' for='end_date'>Period Start End:</label>
          <input id='energy_entry_textbox' type='date' name='end_date' id='month'  maxlength="50" required="true" placeholder="MM/DD/YYYY"/>
          <br />
          <br />
          <br />

          <label id='energy_entry_label' for='kwh'>Kilowatt Hours:</label>
          <input id='energy_entry_textbox' name='kwh' id='kilowatt_hours'  maxlength="50" placeholder="00.0" required="true"/>
          <br />
          <br />

          <label id='energy_entry_label' for='therms'>Therms of Natural Gas:</label>
          <input id='energy_entry_textbox' name='therms' id='Therms'  maxlength="50" placeholder="00.00"required="true"/>
          <br />
          <br />

          <label id='energy_entry_label' for='cost'>Total Cost:</label>
          <input id='energy_entry_textbox' name='cost' id='month'  maxlength="50" required="true" placeholder="00.00"/>
          <br />
          <br />
          <button id='submit_button'/> Submit</button>

          <br />
          <br />
        </form>
      </div>
    </div>
    <br />
    <br />
  </div>
  </div>
  </article>


  <footer>
     <div class="social_button_div">

        {{-- social buttons --}}
        @include('components.share')

    </div>
  </footer>
</html>

@endsection
