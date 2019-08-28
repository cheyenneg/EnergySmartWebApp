{{-- HTML Section --}}

@extends('layout')

@section('title')

Climate Smart Website Profile Page

@endsection

@section('content')
<html>

<!--
  TODO: Edit Energy_Provider once DB is updated
  TODO: Edit user_Icon once DB is updated
-->

<style>
  .profile_info {
    display:none;
  }

  .energy_input {
    width: 100px;
  }

  table.datatbl {
    border-spacing:0;
    border-collapse: collapse;
    width: 90%;
  }
  table.datatbl th {
    background-color: rgb(247, 155, 46);
  }
  table.datatbl th {
    text-align: left;
    border-bottom: 1px solid #ddd;
    padding: 7.5px;
  }
  table.datatbl td {
    text-align: left;
    border-bottom: 1px solid #ddd;
    padding: 7.5px;
  }
  table.datatbl tr{
    border-bottom: 1px solid black;
  }


</style>

<?php

  // Splitting user_data so I don't have to redo the whole view
  $user = $user_data['user'];
  $home = $user_data['home'];
  $energy = $user_data['energy'];

?>
<script type="text/javascript">
    function showTab(element)
    {
      var prefix = "tab_";

      //var tabContents = document.getElementsByClassName("admin_page_content_div");
      var tabContents = document.getElementsByClassName("profile_info");
      for (var i=0; i<tabContents.length; i++)
      {
        tabContents[i].style.display="none";
      }

      var tabContentIdToShow = prefix.concat(element.id);
      document.getElementById(tabContentIdToShow).style.display="block";

      //removes previous active tag on last button, and sets active tag on clicked button
      var btns = document.getElementsByClassName("profile_tab");
      for (var i = 0; i < btns.length; i++)
      {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
        });
      }
    }

  </script>

  <link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

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

    <div id="cont_2">

      <div id="left_cont_2">
        <div class="tab">
          <button class="profile_tab active" id="basic" onclick="showTab(this)">Basic Info</button>
          <button class="profile_tab" id="household" onclick="showTab(this)">Household Info</button>
          <button class="profile_tab" id="personal" onclick="showTab(this)">Personal Info</button>
          <button class="profile_tab" id="conservation" onclick="showTab(this)">Conservation Info</button>
          <button class="profile_tab" id="energy" onclick="showTab(this)">Energy Info</button>
        </div>
      </div>
      <div id="right_cont_2">

<!-- Start Basic Info Section-->
        <div class="profile_info" id="tab_basic">
          <div class="container">
          </div>
          <h1>Basic Info</h1>
          <button class="edit_link" id="edit_basic" onclick="showTab(this)"><u>Edit</u></button>

          <table class="profile_info_info">
            <tr>
              <td><b>First Name:</b></td>
              <td>{{ $user->f_name }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>Last Name:</b></td>
              <td>{{ $user->l_name }}</td>
            </tr>
            <tr height="25px"><td></td><td></td>
            </tr>
            <tr>
              <td><b>Email Address:</b></td>
              <td>{{ $user->email }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>Username:</b></td>
              <td>{{ $user->user_name }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><button id="change_password" onclick="change_password(this)">Change Your Password?</button></td>
            </tr>
          </table>
        </div>

<!-- Start Household Info Section -->

        <div class="profile_info" id="tab_household">

          <h1>Household Info</h1>
          <button class="edit_link" id="edit_house_hold" onclick="showTab(this)"><u>Edit</u></button>

          <table class="profile_info_info">
            <tr>
              <td><b>Energy Provider:</b></td>
              <td>{{ $user->Energy_Provider }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>Do you rent or own?</b></td>
<!-- Could change this to be uppercase in the DB? Or leave as is-->
              <td>{{ ucwords($home->rent_or_own) }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>How large is your home in sq feet?</b></td>
              <td>{{ $home->sq_footage }} sq/ft</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>How many people live in your house?</b></td>
              <td>{{ $home->inhabitants }} inhabitants</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>How many years have you lived in this home?</b></td>
              <td>{{ $home->years }} year(s)</td>
            </tr>
          </table>
        </div>

<!-- Start Personal Info Section -->
<!-- TODO: make this functional with selecting icons -->

        <div class="profile_info" id="tab_personal">
          <h1>Personal Info</h1>
          <button class="edit_link" id="edit_personal" onclick="showTab(this)"><u>Edit</u></button>

          <table class="profile_info_info">
            <tr>
              <td><b>Age:</b></td>
              <td>{{ $user->age }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>Where do you work?</b></td>
              <td>{{ $user->workplace }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>

            <tr>
              <td><b>Profile Icon:</b></td>
              <td><img src="/css/{{ $user->user_Icon }}.png" height="200"></td>
            </tr>
          </table>
        </div>

<!-- Start Conservation Info Section -->

        <div class="profile_info" id="tab_conservation">
          <h1>Conservation Info</h1>
          <button class="edit_link" id="edit_conservation" onclick="showTab(this)"><u>Edit</u></button>

          <table class="profile_info_info">
            <tr>
              <td width="40%"><b>Do you have an alternative energy source?</b></td>
              <td width="60%">{{ ucwords($user->alternative) }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
            <tr>
              <td><b>If yes, what source and size?</b></td>
              <td>{{ $user->alt_descr }}</td>
            </tr>
            <tr height="25px"><td></td><td></td></tr>
          </table>
        </div>

<!-- Start of Energy Info Section -->

        <div class="profile_info" id="tab_energy">
          <h1>Energy Data</h1>
          <button class="edit_link" id="edit_energy" onclick="showTab(this)"><u>Edit</u></button>

          <table class="datatbl">
            <tr>
              <th>Start</th>
              <th>End</th>
              <th>KWH</th>
              <th>Therms</th>
              <th>Cost</th>
            </tr>
            @if($energy)
              @foreach($energy as $energy_entry)
              <tr>
                <td>{{ date('m-d-y', strtotime($energy_entry->start_date)) }}</td>
                <td>{{ date('m-d-y', strtotime($energy_entry->end_date)) }}</td>
                <td>{{ $energy_entry->kwh }}</td>
                <td>{{ $energy_entry->therms }}</td>
                <td>${{ $energy_entry->cost }}</td>

              </tr>
              @endforeach
            @else
              <tr>
                <td><b>No Energy Data</b></td>
              </tr>
            @endif
          </table>
        </div>

<!-- Start of Edit Divs -->

<!-- Start of Edit Basic Info -->

        <div class="profile_info" id="tab_edit_basic">
          <h1>Edit Basic Info</h1>
          <button class="edit_link" id="basic" onclick="showTab(this)""><u>Back</u></button>
          <form action="{{ route('edit_basic_info') }}" method="post">
            {{ csrf_field() }}
            <table class="profile_info_info">
              <tr>
                <td><b>First Name:</b></td>
                <td><input type="text" name="f_name" maxlength="50" value="{{ $user->f_name }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Last Name:</b></td>
                <td><input type="text" name="l_name" maxlength="50" value="{{ $user->l_name }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Email Address:</b></td>
                <td><input type="text" name="email" maxlength="100" value="{{ $user->email }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Username:</b></td>
                <td><input type="text" name="user_name" maxlength="100" value="{{ $user->user_name }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
            </table>
            <button class="profile_submit">Submit</button>
          </form>
        </div>

<!-- Start of Edit Household Info -->
<!-- TODO: Get house info to work -->

        <div class="profile_info" id="tab_edit_house_hold">
          <h1>Edit Household Info</h1>
          <button class="edit_link" id="household" onclick="showTab(this)"><u>Back</u></button>

          <form action="{{ route('edit_house_hold_info')}}" method="post">
            {{ csrf_field() }}
            <table class="profile_info_info">
              <tr>
                <td><b>Energy Provider:</b></td>
                <td><input type="text" name="energy_provider" maxlength="100" value="{{ $user->Energy_Provider }}"></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Do you rent or own?</b></td>
                <td>
<!-- TODO: IS THIS OKAY TO DO??? Seems to work-->
<!-- embedded if statement for radio buttons-->
                    <span style="white-space: nowrap; display: inline-block;">
                      <input id="radio_button" type="radio" name="rent_or_own" value="rent"  @if($home->rent_or_own == 'rent') checked @endif />Rent<br />
                    </span>
                    <span style="white-space: nowrap; display: inline-block;">
                      <input id="radio_button" type="radio" name="rent_or_own" value="own" @if($home->rent_or_own == 'own') checked @endif />Own<br />
                    </span>

                </td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>How large is your home in sq feet?</b></td>
                <td><input type="number" name="sq_footage" maxlength="10" value="{{ $home->sq_footage }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>How many people live in your house?</b></td>
                <td><input type="number" name="inhabitants" maxlength="10" value="{{ $home->inhabitants }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>How many years have you lived in this home?</b></td>
                <td><input type="number" name="years" maxlength="10" value="{{ $home->years }}"></td>
              </tr>
            </table>
            <button class="profile_submit">Submit</button>
          </form>
        </div>

<!-- Start of Edit Personal Info -->

        <div class="profile_info" id="tab_edit_personal">
          <h1>Edit Personal Info</h1>
          <button class=edit_link id="personal" onclick="showTab(this)"><u>Back</u></button>
          <form action="{{ route('edit_personal_info') }}" method="post">
            {{ csrf_field() }}
            <table class="profile_info_info">
              <tr>
                <td><b>Age:</b></td>
                <td><input type="number" name="age" maxlength="10" value="{{ $user->age }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Where do you work?</b></td>
                <td><input type="text" name="workplace" maxlength="50" value="{{ $user->workplace }}" required="true" /></td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>Profile Icon:</b></td>
                <td>
<!-- More awful imbedded if statements :(-->
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="green-earth" @if($user->user_Icon == 'green-earth') checked @endif />
                    <img src="/css/green-earth.png">
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="green-energy" @if($user->user_Icon == 'green-energy') checked @endif />
                    <img src="/css/green-energy.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="green-energy2" @if($user->user_Icon == 'green-energy2') checked @endif />
                    <img src="/css/green-energy2.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="home" @if($user->user_Icon == 'home') checked @endif />
                    <img src="/css/home.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="house" @if($user->user_Icon == 'house') checked @endif />
                    <img src="/css/house.png">
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="idea" @if($user->user_Icon == 'idea') checked @endif />
                    <img src="/css/idea.png">
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="lightning" @if($user->user_Icon == 'lightning') checked @endif />
                    <img src="/css/lightning.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="power-button" @if($user->user_Icon == 'power-button') checked @endif />
                    <img src="/css/power-button.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="renewable-energy" @if($user->user_Icon == 'renewable-energy') checked @endif />
                    <img src="/css/renewable-energy.png" />
                  </label>
                  <label class="user_Icon_class">
                    <input type="radio" name="user_Icon" value="sprout" @if($user->user_Icon == 'sprout') checked @endif />
                    <img src="/css/sprout.png" />
                  </label>
                </td>
              </tr>
            </table>
             <button class="profile_submit">Submit</button>
          </form>
        </div>

<!-- Start of Edit Conservation Info -->
<!-- TODO: Figure out, or have someone figure out why the text area centers the text. Halp Breanna-->
        <div class="profile_info" id="tab_edit_conservation">
          <h1>Edit Conservation Info</h1>
          <button class="edit_link" id="conservation" onclick="showTab(this)"><u>Back</u></button>

          <form action="{{ route('edit_conservation_info') }}" method="post">
            {{ csrf_field() }}
            <table class="profile_info_info">
<!-- Another imbedded if statement Fix this -->
              <tr>
                <td width=40%><b>Do you have an alternative energy source?</b></td>
                <td width=60%>
                  <span style="white-space: nowrap; display: inline-block;">
                    <input id="radio_button" type="radio" name="alternative" value="yes" @if($user->alternative == 'yes') checked @endif />
                    Yes<br>
                  </span>
                  <span style="white-space: nowrap; display: inline-block;">
                    <input id="radio_button" type="radio" name="alternative" value="no" @if($user->alternative == 'no') checked @endif />No<br />
                  </span>
                </td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
              <tr>
                <td><b>If yes, what source and size?</b></td>
                <td>
                  <textarea rows="15" cols="50" style="resize:none;" name="alt_descr" maxlength="100">
                    {{ $user->alt_descr }}
                  </textarea>
                </td>
              </tr>
              <tr height="25px"><td></td><td></td></tr>
            </table>
            <button class="profile_submit">Submit</button>
          </form>
        </div>
        <div class = "profile_info" id = "tab_edit_energy">
          <h1>Edit Energy Data</h1>
          <button class="edit_link" id="energy" onclick="showTab(this)"><u>Back</u></button>
          <table class = "datatbl">
            <tr>
              <th>Start</th>
              <th>End</th>
              <th>KWH</th>
              <th>Therms</th>
              <th>Cost</th>
              <th>Submit</th>
            </tr>
             @if($energy)
              @foreach($energy as $energy_entry)
                <tr>
                  <form action="{{ route('edit_energy_entry') }}" method="post">
                    {{ csrf_field() }}
                    <td>
                      <input type="hidden" name="e_id" value="{{ $energy_entry->e_id }}" />
                      <input class="energy_input" type="text" name="start_date" value="{{ date('m-d-y', strtotime($energy_entry->start_date)) }}" />
                    </td>
                    <td><input class="energy_input" type="text" name="end_date" value="{{ date('m-d-y', strtotime($energy_entry->end_date)) }}" required="true" /></td>
                    <td><input class="energy_input" type="text" name="kwh" value="{{ $energy_entry->kwh }}" required="true" /></td>
                    <td><input class="energy_input" type="text" name="therms" value="{{ $energy_entry->therms }}" required="true" /></td>
                    <td><input class="energy_input" type="text" name="cost" value="{{ $energy_entry->cost }}" required="true" /></td>
                    <td><button>Edit</button></td>
                  </form>
                </tr>
              @endforeach
             @else
              <tr>
                <td><b>No Energy Data</b></td>
              </tr>
             @endif
          </table>
          <a href="/enterEnergy"><button class="profile_energy">Enter New Energy Data</button></a>
        </div>
      </div>
    </div>
    <br />
  </article>
</body>

<script type="text/javascript">
  function processTab()
  {
    var parameters = location.search.substring(1).split("&");

    var temp = parameters[0].split("=");
    tab = unescape(temp[1]);

    if(tab=="basic"||tab=="household"||tab=="personal"||tab=="conservation"||tab=="energy")
    {
      openTab(tab);
    }
    else
    {
      openTab();
    }
  }

  function openTab(tab="basic")
  {
    document.getElementById(tab).click();
  }

  processTab();
</script>

<footer>
  <div class="social_button_div">

    {{-- social buttons --}}
    @include('components.share')

  </div>
</footer>
</html>
@endsection
