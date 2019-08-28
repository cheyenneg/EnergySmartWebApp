{{-- HTML Section --}}


@extends('layout')

@section('title')

  Request Password Change

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
      <h1>Request Password Reset</h1>
      <div class="login_form_div">
      <form id='login' action='login.php' method='post' accept-charset='UTF-8'>
          <input type='hidden' name='submitted' id='submitted' value="1"/>

          <label id='send_pw_reset_labels' for='username'>Username</label>
          <input id='send_pw_reset_textbox' type='text' name='username' id='username'  maxlength="50" />
          <br />
          <br />
          <label id='send_pw_reset_labels' for='email' >Email</label>
          <input id='send_pw_reset_textbox' type='email' name='email' id='email' maxlength="50" />
          <br />
          <br />


          <button id='send_password_reset_button'/>Send Password Reset Email</button>
          <br />
          <br />

        </div>
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

#send_pw_reset_labels
{
  display:inline-block;
  width:200px;
  margin-right:20px;
  text-align: right;

}

#send_pw_reset_textbox
{
  width: 60%;
  padding-right: 35px;

}

#send_password_reset_button
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
