{{-- HTML Section --}}


@extends('layout')

@section('title')

  404 Error

@endsection

@section('content')
<html>
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div class="flex-container">
  <header>
  </header>
  <br />
  <br />

  <article class="body">
    <div class="signup_div">



      <div class="basic_info_div">
        <br />
        <br />
        <br />

        <h1>404 Error : Could not find page</h1>
        
        <br />
        <br />
        <br />
      </div>
<
    </div>
    <br />
    <br />


  <footer>
    <div class="SocialButtonDiv">

      {{-- social buttons --}}
      @include('components.share')


    </div>
  </footer>
  </html>



@endsection
