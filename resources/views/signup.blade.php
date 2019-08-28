{{-- HTML Section --}}


@extends('layout')

@section('title')

  Climate Smart Website Landing Page

@endsection

@section('content')
<html>
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="flex_container">
  <header>
  </header>
</div>
  <br />
  <br />

  <article class="body">
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
    <div class="signup_div">
      <form action = "/sign" method="post">
        {{ csrf_field() }}
  <!-- begin basic info section **************************************-->
      <label id="signup_heading_label1" for="basic_info">Basic Info</label>

      <div class="basic_info_div">
  <!-- Testing form input-->
          <label id="required_field_label" for="required_field_label">required = *</label>
          <br />
          <br />

          <label id='signup_labels' for='f_name'>First Name *</label>
          <input id='signup_textbox' type='text' name='f_name' maxlength="50" required="true"/>
          <br />
          <br />

          <label id='signup_labels' for='l_name'>Last Name *</label>
          <input id='signup_textbox' type='text' name='l_name' maxlength="50" required="true"/>
          <br />
          <br />

          <label id='signup_labels' for='username'>Username *</label>
          <input id='signup_textbox' type='text' name='username' maxlength="50" required="true"/>
          <br />
          <br />

          <label id='signup_labels' for='email'>Email Address *</label>
          <input id='signup_textbox' type='text' name='email' maxlength="100" required="true"/>
          <br />
          <br />

          <label id='signup_labels' for='password1'>Password *</label>
          <input id='signup_textbox' type='text' name='password1' maxlength="50" required="true"/>
          <br />
          <br />

          <label id='signup_labels' for='password2'>Re enter Password *</label>
          <input id='signup_textbox' type='text' name='password2' maxlength="50" required="true"/>
          <br />
          <br />

          <!--
          <label id='signup_labels' for='password2'>Type Password Again *</label>
          <input id='signup_textbox' type='text' name='password2' maxlength="100" required="true"/>
          <br />
          <br />
          -->
      </div>
<!-- end basic info section********************************************-->


<!-- begin household info section **************************************-->
      <label id="signup_heading_label2" for="basic_info">Household Info</label>
      <div class="household_info_div">

        <label id="required_field_label" for="required_field_label">required = *</label>
        <br />
        <br />

        <label id='signup_labels' for='energy_provider'>Energy Provider</label>
        <input id='signup_textbox' type='text' name='energy_provider' maxlength="100" />
        <br />
        <br />

<!--radio_buttons-->

        <label id='radio_button_labels' for='rent_or_own' required="true">Do you rent or own? *</label>

        <span style="white-space: nowrap; display: inline-block;">
        <input id='radio_button' type='radio' name='rent_or_own' value="rent" required="true">Rent<br>
        </span>

        <span style="white-space: nowrap; display: inline-block;">
        <input id='radio_button' type='radio' name='rent_or_own' value="own" required="true">Own<br>
        </span>
        <br />
        <br />



        <label id='signup_labels' for='sqft'>How large is your home in square feet?</label>
        <input id='signup_textbox' type='number' name='sqft' maxlength="10" />
        <br />
        <br />

        <label id='signup_labels' for='house_hold_size'>How many people live in your house?</label>
        <input id='signup_textbox' type='text' name='house_hold_size' maxlength="10" />
        <br />
        <br />

        <label id='signup_labels' for='time_in_home'>How many years have you lived in this home?</label>
        <input id='signup_textbox' type='text' name='time_in_home' maxlength="10" />
        <br />
        <br />



      </div>
<!-- end household info section********************************************-->



<!-- begin personal info section **************************************-->
      <label id="signup_heading_label3" for="personal_info">Personal Info</label>
      <div class="personal_info_div">

        <br />
        <label id='signup_labels' for='age'>Age</label>
        <input id='signup_textbox' type='text' name='age' maxlength="10" />
        <br />
        <br />

        <label id='signup_labels' for='workplace'>Where do you work?</label>
        <input id='signup_textbox' type='text' name='workplace' maxlength="50" />
        <br />
        <br />

        <label id='signup_labels' for='profile_icon'>Choose your profile icon*</label>
        <br />
        <br />


<!-- USER ICON LABELS-->
        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="green-earth" required="true" />
          <img src="/css/green-earth.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="green-energy" required="true" />
          <img src="/css/green-energy.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="green-energy2" required="true" />
          <img src="/css/green-energy2.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="home" required="true" />
          <img src="/css/home.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="house" required="true" />
          <img src="/css/house.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="idea" required="true" />
          <img src="/css/idea.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="lightning" required="true" />
          <img src="/css/lightning.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="power-button" required="true" />
          <img src="/css/power-button.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="renewable-energy" required="true" />
          <img src="/css/renewable-energy.png" />
        </label>

        <label class="user_icon_class">
          <input type="radio" name="user_icon" value="sprout" required="true" />
          <img src="/css/sprout.png" />
        </label>
        <br />
        <br />


      </div>
<!-- end personal info section********************************************-->

<!-- begin conservation info section **************************************-->
      <label id="signup_heading_label2" for="personal_info">Conservation Info</label>
      <div class="conservation_info_div">

        <label id="required_field_label" for="required_field_label">required = *</label>
        <br />
        <br />

<!--Radio Buttons-->
        <label id='radio_button_labels' for='alternative_energy'>Do you have an alternative energy source? *</label>

        <span style="white-space: nowrap; display: inline-block;">
          <input id='radio_button' type='radio' name='alt' value="yes" required="true" />Yes<br />
        </span>

        <span style="white-space: nowrap; display: inline-block;">
          <input id='radio_button' type='radio' name='alt' value="no" required="true" />No<br />
        </span>
        <br />
        <br />

        <label id='signup_labels' for='alt_source'>If yes, what source and size?</label>
        <input id='signup_textbox' type='text' name='alt_source' maxlength="50" />
        <br />
        <br />
        <br />

        <button id="submit_button"  type = 'submit'>Sign Up</button>
        </form>
        <br />
        <br />
      </div>
<!-- end conservation info section********************************************-->

    </div>
    <br />
    <br />


  <footer>
    <div class="social_button_div">

      {{-- social buttons --}}
      @include('components.share')

    </div>
  </footer>
  </html>
@endsection
