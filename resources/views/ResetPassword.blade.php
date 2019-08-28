{{-- HTML Section --}}


@extends('layout')

@section('title')

  Change Passowrd

@endsection

@section('content')
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div class="flex_container">
    <div class="banner">
      {{-- banner --}}
      @include('components.header')
    </div>
    <article class="body">
      <div class="login_div">
        <h1>Reset Password</h1>
        <div class="login_form_div">
        <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
          <input type='hidden' name='submitted' id='submitted' value="1"/>
          <label id='pw_reset_labels' for='new_password'>Enter New Password</label>
          <input id='pw_reset_textbox' type='text' name='new_password' id='new_password'  maxlength="50" />
          <br />
          <br />
          <label id='pw_reset_labels' for='password_checker' >Re-Enter Password</label>
          <input id='pw_reset_textbox' type='password_checker' name='password_checker' id='password_checker' maxlength="50" />
          <br />
          <br />
          <button id='password_reset_button'/>Reset Password</button>
          <br />
          <br />
        </form> 
      </div>
    </article>
  </div>
  <footer>
  <div class="social_button_div">
    {{-- social buttons --}}
    @include('components.share')
  </div>
  </footer>
</html>

@endsection

<style>
  #pw_reset_labels
  {
    display:inline-block;
    width:200px;
    margin-right:20px;
    text-align: right;
  }

  #pw_reset_textbox
  {
    width: 60%;
    padding-right: 15px;
  }

  #password_reset_button
  {
    display: inline-block;
    margin:auto;
    padding: 1% 5%;
    font-size: 20;
    border-radius: 8px;
    border: 0;
    background-color: #cccccc;
  }

  .social_button_div
  {
    width: auto;
    height: auto;
  }
</style>
