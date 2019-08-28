
{{-- HTML Section --}}

@extends('layout')

@section('title')

  Climate Smart Website Admin Page

@endsection

@section('content')
<html>
<script type="text/javascript">
  function showTab(element)
  {
    var prefix = "tab_";

    var tabContents = document.getElementsByClassName("admin_page_content_div");

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

  <?php

    // Separating out the admin_data so i don't have to rewrite the blade data
    $challenges = $admin_data['challenges'];
    $exlinks = $admin_data['exlinks'];
    $tips = $admin_data['tips'];

  ?>
  <style>

    table.datatbl {
      border-spacing:0;
      border-collapse: collapse;
      width: 100%;
      padding-left: 10px;
    }
    th {
      background-color: rgb(247, 155, 46);
    }
    th, td {
      text-align: left;
      border-bottom: 1px solid #ddd;
      padding: 7.5px;
    }
    tr{
      border-bottom: 1px solid black;
    }

  </style>

<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />

<div class="banner">
  <div class="flex_container">
    <header>
      <nav role="navigation">
        <div id="ham_menu">
          <!--
          A fake / hidden checkbox is used as click reciever,
          so you can use the :checked selector on it.
          -->
          <input type="checkbox" />

          <!--
          spans act as hamburger items
          -->
          <span></span>
          <span></span>
          <span></span>

          <ul id="menu">
            <a href="{{ route('logout') }}"><li>Sign Out</li></a>
          </ul>
        </div>
      </nav>
    </header>
  </div>
</div><!--end header-->

<body>
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
          <button class="profile_tab" id="reports" onclick="showTab(this)">Reports</button>
          <button class="profile_tab" id="tips" onclick="showTab(this)">Tips</button>
          <button class="profile_tab" id="challenges" onclick="showTab(this)">Challenges</button>
          <button class="profile_tab" id="external_links" onclick="showTab(this)">External Resources</button>
          <button class="profile_tab active" id="page_content" onclick="showTab(this)">Page Content (About Us, etc)</button>
          <button class="profile_tab" id="spotlight" onclick="showTab(this)">Spotlight</button>
        </div>
      </div>

<!-- Being Page Content Section -->

      <div class="admin_page_content_div" id="tab_page_content">
      <form method="get">
          <h1> About Us <h1>

            <?php
            $file = '../public/css/aboutContent.txt';
            // Open the file to get existing content
            $current = file_get_contents($file);
            ?>

            @if (session('status'))
              {{session('status')}}
            @endif

            <label id="instruction_label">Edit the information to the displayed on the "About Us" Page below</label>
            <textarea id="admin_about_content_textbox" name="admin_about_content_textbox" rows="50"><?php echo $current ?></textarea>
            <br />

            <button id="admin_button" onclick="alertRenew();" action="<?php
              if (isset($_GET['admin_about_content_textbox'])){
                $updated = $_GET['admin_about_content_textbox'];
              }
              else
              {
                $updated = $current;
              }
              file_put_contents($file, $updated);
              echo "<script>alert('Please refresh your browser to see changes.');</script>";
             ?>">Save</button>
             <br />
             <br />
             <br />

             <h1>Contact Us<h1>
               <label id="instruction_label">Edit the information to the displayed on the "Contact Us" Page below</label>

               <?php
               $contactFile = '../public/css/contactContent.txt';
               $handle = fopen('../public/css/contactContent.txt', "r");
               $output = "";
               $count = 1;
               $phone = "";
               $email = "";
               $website ="";
               $address = "";

               //gets individual lines and assigns them to appropratie textboxes
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
              <br />
              <br />
              <label id="content_label">Phone</label>
              <input id="admin_contact_content_textbox_phone" name="admin_contact_content_textbox_phone" type="text" value="<?php echo $phone ?>">
              <br />
              <br />
              <label id="content_label">Email</label>
              <input id="admin_contact_content_textbox_email" name="admin_contact_content_textbox_email" type="text" value="<?php echo $email?>">
              <br />
              <br />
              <label id="content_label">Website</label>
              <input id="admin_contact_content_textbox_website" name="admin_contact_content_textbox_website" type="text" value="<?php echo $website ?>">
              <br />
              <br />
              <label id="content_label">Address</label>
              <input id="admin_contact_content_textbox_address" name="admin_contact_content_textbox_address" type="text" value="<?php echo $address ?>">

              <button id="admin_button" onclick="alertRenew();" action="<?php
                //gets all the informatio from the textboxes
                 if (isset($_GET['admin_contact_content_textbox_phone'])){
                     $updatedC = $_GET['admin_contact_content_textbox_phone'] . PHP_EOL;
                   }
                   if (isset($_GET['admin_contact_content_textbox_email'])){
                     $updatedC .= $_GET['admin_contact_content_textbox_email'] . PHP_EOL;
                   }
                   if (isset($_GET['admin_contact_content_textbox_website'])){
                     $updatedC .= $_GET['admin_contact_content_textbox_website'] . PHP_EOL;
                   }
                   if (isset($_GET['admin_contact_content_textbox_address'])){
                     $updatedC .= $_GET['admin_contact_content_textbox_address'] . PHP_EOL;
                   }
                   else
                   {
                     //if textboxes are unset get normal info that was in flile previously
                     $updatedC = $phone;
                     $updatedC .= $email;
                     $updatedC .= $website;
                     $updatedC .= $address;
                   }

                   //write updated information to file
                   file_put_contents($contactFile, $updatedC);
                   echo "<script> alert('Please refresh your browser to see changes.'); return false; </script>";

                  ?>">Save</button>
                  <br />
                  <br />

                </form>
              </div>

<!-- Begin Tips Section -->
<!-- TODO: Work on deleting a tip properly and formatt the searched tips better-->

    <div class="admin_page_content_div" id="tab_tips">
      <h1>Tips<h1>
        <form action = "{{route('add_tip')}}" method="post">
        {{ csrf_field() }}
          <label id="content_label">Add a Tip</label>
          <br />
          <br />
          <label id="tip_label">Title: </label>
          <input id="admin_tip_textbox" name="title" type="text" required="true" />
          <br />
          <br />
          <label id="tip_label">Tip Text: </label>
          <input id="admin_tip_textbox_description" name="text" type="text" required="true" />
          <button id="admin_button">Add Tip</button>
          <br />
          <br />
          <br />
          <br />
        </form>
        <label id="content_label">Delete a Tip</label>
        <br />
        <br />
        <form action="{{route('delete_tip')}}" method="post">
          {{ csrf_field() }}
          <div class="admin_tips_restults">
            @if ($tips)
              <table class="datatbl">
                <tr>
                  <th>Title</th>
                  <th>Text</th>
                  <th>Category ID</th>
                  <th>Select</th>
                </tr>
                @foreach($tips as $tip)
                  <tr>
                    <td>{{ $tip->title}}</td>
                    <td>{{ $tip->text}}</td>
                    <td>{{ $tip->cat_id}}</td>
                    <td>
                      <input type="hidden" name="tip_title" value="{{ $tip->title }}" />
                      <input type="radio" name="tip_radio" value="{{ $tip->t_id }}" />
                    </td>
                  </tr>
                @endforeach
              </table>
            @endif
          </div>
          <br /><br />
          <button id="admin_button">Delete</button>
        </form>
    </div>

<!-- Start Challenges Section -->
<!-- TODO: 1: Fix startdate/enddate inserts or add a proper date picker -->

    <div class="admin_page_content_div" id="tab_challenges">
      <h1>Challenges<h1>
        <form action ="{{route('add_challenge')}}" method="post">
        {{ csrf_field() }}
          <label id="content_label">Add a Challenge</label>
          <br />
          <br />
          <label id="challenge_label">Title: </label>
          <input id="admin_challenge_textbox" name="title" type="text" required="true" />
          <br />
          <br />
          <label id="challenge_label">Description: </label>
          <input id="admin_challenge_textbox_description" name="text" type="text" required="true" />
          <br />
          <br />
          <label id="challenges_label">Start Date: </label>
          <input id="admin_challenge_textbox_date" name="start_date" type="date" required="true" />
          <label id="challenges_label">End Date: </label>
          <input id="admin_challenge_textbox_date" name="end_date" type="date" required="true" />
          <br />
          <br />
          <label id="challenges_label">Value: </label>
          <input id="admin_challenge_textbox_date" name="value" type="text" required="true" />
          <br />
          <br />
          <button id="admin_button" name="add_challenge">Add Challenge</button>
          <br />
          <br />
        </form>

        <label id="content_label">Delete a Challenge</label>
        <br />
        <br />
        <form action="{{route('delete_challenge')}}" method="post">
          {{ csrf_field() }}
          <div class="admin_challenge_results">
            @if ($challenges)
              <table class="datatbl">
                <tr>
                  <th>Title</th>
                  <th>Text</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Value</th>
                  <th>Select</th>
                </tr>
                @foreach ($challenges as $challenge)
                  <tr>
                    <td>{{ $challenge->title }}</td>
                    <td>{{ $challenge->text }}</td>
                    <td>{{ $challenge->start_date }}</td>
                    <td>{{ $challenge->end_date }}</td>
                    <td>{{ $challenge->value }}</td>
                    <td>
                      <input type="hidden" name="challenge_title" value="{{ $challenge->title }}" />
                      <input type="radio" name="challenge_radio" value="{{ $challenge->c_id}} " />
                    </td>
                  </tr>
                @endforeach
              </table>
            @endif
            </div>
            <br /><br />

            <button id="admin_button">Delete</button>
            <br /><br />
          </form>
        <!-- Select current challenge -->
        <label id="content_label">Select Current Challenge</label>
        <br /><br />

          <form action="{{ route('select_challenge')}}" method="post">
            {{ csrf_field() }}
            <div class="admin_challenge_results">
              @if ($challenges)
                <table class="datatbl">
                  <tr>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Value</th>
                    <th>Select</th>
                  </tr>
                  @foreach ($challenges as $challenge)
                    <tr>
                      <td>{{ $challenge->title }}</td>
                      <td>{{ $challenge->text }}</td>
                      <td>{{ $challenge->value }}</td>

                      <td>
                        <input type="hidden" name="sel_challenge_title" value="{{ $challenge->title }}" />
                        <input type="radio" name="select_challenge_radio" value="{{ $challenge->c_id}} " @if ($challenge->current_challenge) checked @endif>
                      </td>
                    </tr>
                  @endforeach
                </table>
              @endif

              <br /><br />
              <button id="admin_button">Select</button>
            </div>
          </form>
          <br /><br />
    </div>

<!-- Begin External Resources Section -->

    <div class="admin_page_content_div" id="tab_external_links">
      <h1>External Resources<h1>
        <form action="{{route('add_ex_link')}}" method="post">
          {{ csrf_field() }}
          <label id="content_label">Add a Resource</label>
          <br />
          <br />
          <label id="resource_label">Title: </label>
          <input id="admin_rescource_textbox" name="text" type="text" required="true" />
          <br />
          <br />
          <label id="resource_label">Description: </label>
          <input id="admin_rescource_textbox_description" name="description" type="text" required="true" />
          <br />
          <br />
          <label id="resource_label">Link: </label>
          <input id="admin_rescource_textbox" name="url" type="text" required="true" />
          <br />
          <br />
          <button id="admin_button">Add Resource</button>
          <br />
          <br />
        </form>

        <label id="content_label">Delete a Resource</label>
        <br />
        <br />
        <label id="content_label">Select from table to delete</label>
        <form action="{{route('delete_ex_link')}}" method="post">
          {{ csrf_field() }}
          <div class="admin_resources_results">
            @if ($exlinks)

              <table>
                <tr>
                  <th>Title</th>
                  <th>Text</th>
                  <th>URL</th>
                  <th>Select</th>
                </tr>

                @foreach ($exlinks as $exlink)
                  <tr>
                    <td>{{ $exlink->text }}</td>
                    <td>{{ $exlink->description }}</td>
                    <td>{{ $exlink->url }}</td>
                    <td>
                      <input type="hidden" name="exlink_title" value="{{ $exlink->text }}" />
                      <input type="radio" name="ex_link_radio" value="{{ $exlink->el_id }}" />
                    </td>
                  </tr>
                @endforeach
              </table>
            @endif
          </div>
          <br />
          <br />
          <button id="admin_button">Delete</button>
        </form>
      </div>

<!-- Start Reports Section -->
    <div class="admin_page_content_div" id="tab_reports">
      <h1>Reports<h1>
        <br  />
        <button id="report_button"><a href="datatable">Reporting</a></button>
        <br  />
    </div>

    <script>
    function alertRenew()
    {
      alert("Please refresh your page to see the changes.");
      return false;
    }
    </script>
<!-- End Reports Section-->
<!-- start spotlight section-->


<div class="admin_page_content_div" id="tab_spotlight">
    <form method="get">
      <h1>Spotlight<h1>

    <?php
    $file = '../public/css/spotlightContent.txt';
    // Open the file to get existing content
    $current = file_get_contents($file);
    ?>

    @if (session('status'))
      {{session('status')}}
    @endif

    <label id="instruction_label">Edit the information to the displayed on the spotlight section of the main page below</label>
    <textarea id="admin_spotlight_textbox" name="admin_spotlight_textbox" rows="50"><?php echo $current ?></textarea>
    <br />

    <button id="admin_button" onclick="alertRenew();" action="<?php
      if (isset($_GET['admin_spotlight_textbox'])){
        $updatedSpot = $_GET['admin_spotlight_textbox'] . PHP_EOL;
      }
      else
      {
        $updatedSpot = $current;
      }
      file_put_contents($file, $updatedSpot);
      echo "<script>alert('Please refresh your browser to see changes.');</script>";
     ?>">Save</button>
     <br/>

     <h1>Change Spotlight Image<h1>

      <input id="spotlight_image_file" type="file">
      <br />

     <button id="admin_button" onclick="" action="
          ">Save Picture</button>

   </form>
     <br />
</div>
</div>

<!--End spotlight section-->

  </body>

  <script type="text/javascript">
    function processTab()
    {
      var parameters = location.search.substring(1).split("&");

      var temp = parameters[0].split("=");
      tab = unescape(temp[1]);

      if(tab=="reports"||tab=="tips"||tab=="challenges"||tab=="external_links"||tab=="page_content"||tab=="spotlight")
      {
        openTab(tab);
      }
      else
      {
        openTab();
      }
    }

    function openTab(tab="page_content")
    {
      document.getElementById(tab).click();
    }

    processTab();
  </script>
  </html>
@endsection

  <style>

  a
  {
    text-decoration: none;
    color: #232323;


    transition: color 0.3s ease;
  }

  a:hover
  {
    color: rgb(247, 155, 46);
  }

  #ham_menu
  {
    display: block;
    position: relative;
    top: 20px;
    left: 95%;
    width: 0px;

    z-index: 1;

    -webkit-user-select: none;
    user-select: none;
  }

  #ham_menu input
  {
    display: block;
    width: 40px;
    height: 32px;
    position: absolute;
    top: -7px;
    left: -5px;

    cursor: pointer;

    opacity: 0; /* hide this */
    z-index: 2; /* and place it over the hamburger */

    -webkit-touch-callout: none;
  }

  /*
   * actual hamburger symbol
   */
  #ham_menu span
  {
    display: block;
    width: 33px;
    height: 4px;
    margin-bottom: 5px;
    position: relative;

    background: black;
    border-radius: 3px;

    z-index: 1;

    transform-origin: 4px 0px;

    transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                opacity 0.55s ease;
  }

  #ham_menu span:first-child
  {
    transform-origin: 0% 0%;
  }

  #ham_menu span:nth-last-child(2)
  {
    transform-origin: 0% 100%;
  }

  /*
   * Transform the hamburger slices into an x when the menu is missing
   */
  #ham_menu input:checked ~ span
  {
    opacity: 1;
    transform: rotate(45deg) translate(-2px, -1px);
    background: #232323;
  }

  /*
   * hide middle bar when turn into cross
   */
  #ham_menu input:checked ~ span:nth-last-child(3)
  {
    opacity: 0;
    transform: rotate(0deg) scale(0.2, 0.2);
  }

  /*
   * rotate last bar to be x
   */
  #ham_menu input:checked ~ span:nth-last-child(2)
  {
    transform: rotate(-45deg) translate(0, -1px);
  }

  /*
   * Position actual menu it in the top right
   */
  #menu
  {
    position: absolute;
    width: 100px;
    margin: -100px 0 0 -150px;
    padding: 50px;
    padding-top: 125px;
    overflow:hidden;

    background: #ededed;
    list-style-type: none;
    -webkit-font-smoothing: antialiased;
    /* to stop flickering of text in safari */

    transform-origin: 0% 0%;
    transform: translatey(-100%);

    transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
  }

  #menu li
  {
    padding: 10px 0;
    font-size: 22px;
    overflow:hidden;
  }

  /*
   * show from top
   */
  #ham_menu input:checked ~ ul
  {
    transform: none;
  }
  </style>
