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


<body>
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
    <div class="login_div">
      <h1>LOGIN</h1>
      <div class="login_form_div">
      <form id="login" action="{{route('login')}}" method="POST">
          {{ csrf_field() }}
          <input type='hidden' name='submitted' id='submitted' value="1"/>

          <label id='login_labels' for='username'>Username</label>
          <input id='login_text_box' type='text' name='username' id='username'  required = 'True' maxlength="50" />
          <br />
          <br />
          <label id='login_labels' for='password' >Password</label>
          <input id='login_text_box' type='password' name='password' id='password' required = 'True' maxlength="50" />
          <br />
          <br />

          <a id='page_link' href="PUT LINK HERE">Forgot Password?</a>
          <label><input id='remember_me' type="checkbox" name="remember_me" value="remember_me" class="reply_btn" />Remember Me</label>
          <button id='login_button'/> Login</button>
          <br />
          <br />
          <hr>
          <br />

          <a id='page_link' href="/signup">New User?</a>
        </div>
      </form>
    </div>
    <br />

    <div class="about_div">

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
</body>
</html>



@endsection
