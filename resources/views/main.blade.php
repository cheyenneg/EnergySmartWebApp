{{-- Javascript Section --}}
<!--This is for the main panel and compare savings displays-->
<style>
  .main_div
    {
      display:none;
    }

  .compareInfo
    {
      display:none;
    }
</style>

<?php

  $tip = session('tip'); // All tips aka tip_a
  $challenge = session('challenge');
  $chal_title = $challenge->title;
  $chal_text = $challenge->text;
  $cap = session('LB');
  $tipS = session('tipS');
  $usernamee = session('usere');
  $usernamep = session('userp');
  $escore = session('escore');
  $pscore = session('pscore');
  $user_Tip = session('userTip');
  $TipL = count($user_Tip);
  $exlinks = session('exlinks');
  $linkC = count($exlinks); // PHP array of exlink objects
  // Exlink data array creation is moved to the js section
  $chart_array = session('chartarray');
  $chart_a = session('chart_a');
  $chart_comp = session('chart_com');
  $chart_quarter = session('chart_quarter');
  $saving = session('saving');

?>

<!--Leaderboard crap-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
  var usere = new Array();
  var userp = new Array();
  //Score arrays
  var e_S = new Array();
  var p_S = new Array();
  //Tip arrays
  var pausecontent = new Array(); //pausecotent is the tiparray?
  var pausecontentid = new Array(); // using naming for pausecontent and giving it the tip id
  //User Tip arrays
  var userT = new Array();
  var user_tip_tid = new Array(); // t_id associated with the usertip
  //Exlink arrays
  var link = new Array();
  var linkD = new Array();
  var linkT = new Array();

  // I'm not sure why these aren't written in javascript
  <?php for($n = 0; $n < $linkC; $n++){ ?>
    link.push('<?php echo $exlinks[$n]->url; ?>');
    linkD.push('<?php echo $exlinks[$n]->description; ?>');
    linkT.push('<?php echo $exlinks[$n]->text; ?>');
    <?php }
  ?>

  <?php for($x = 0; $x < $tipS; $x++){ ?>
    pausecontent.push("<?php echo $tip[$x]->text; ?>");
    pausecontentid.push("<?php echo $tip[$x]->t_id; ?>");
  <?php } ?>

  <?php for($b = 0; $b < $TipL; $b++){ ?>
    userT.push('<?php echo $user_Tip[$b]->text; ?>');
    user_tip_tid.push('<?php echo $user_Tip[$b]->t_id; ?>');
  <?php } ?>

  <?php for($k = 0; $k < $cap; $k++){ ?>
    usere.push('<?php echo $usernamee[$k]; ?>');
    userp.push('<?php echo $usernamep[$k]; ?>');
    p_S.push('<?php echo $pscore[$k]; ?>');
    e_S.push('<?php echo $escore[$k]; ?>');
  <?php } ?>

  usere = usere.reverse();
  userp = userp.reverse();
  p_S = p_S.reverse();
  e_S = e_S.reverse();
//This is used to swap which tab is shown in the main panel

  function processTab()
    {
      var parameters = location.search.substring(1).split("&");

      var temp = parameters[0].split("=");
      tab = unescape(temp[1]);

      if(tab=="tips"||tab=="challenges"||tab=="myplan"||tab=="compare"||tab=="leaderboards"||tab=="resources")
      {
        openTab(tab);
      }
      else
      {
        openTab();
      }
    }

    function openTab(tab="compare")
    {
      document.getElementById(tab).click();
    }

    processTab();

  function showTab(element)
  {
    var prefix = "tab-";

    //Grabs all elements of class main_div and sets display to none
    var tabContents = document.getElementsByClassName("main_div");
    for (var i=0; i<tabContents.length; i++)
    {
      tabContents[i].style.display="none";
    }

    //removes previous active tag on last button, and sets active tag on clicked button
    var btns = document.getElementsByClassName("tablink");
    for (var i = 0; i < btns.length; i++)
    {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }

    //Grabs the correct main_div with the right Id and sets its display to block
    var tabContentIdToShow = prefix.concat(element.id);
    document.getElementById(tabContentIdToShow).style.display="block";
  }

    //This is used to swap which tab is shown in the compare savings panel
    function showCompareTab(element)
    {
      var prefix = "tab-";

      //Grabs all elements of class compareInfo and sets display to none
      var tabContents = document.getElementsByClassName("compareInfo");
      for (var i=0; i<tabContents.length; i++)
      {
        tabContents[i].style.display='none';
      }

      //Grabs the correct compareInfo with the right Id and sets its display to block
      var tabContentIdToShow = prefix.concat(element.id);
      document.getElementById(tabContentIdToShow).style.display="block";

      //removes previous active tag on last button, and sets active tag on clicked button
      var btns = document.getElementsByClassName("compare_tab");
      for (var i = 0; i < btns.length; i++)
      {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("compare_active");
          current[0].className = current[0].className.replace(" compare_active", "");
          this.className += " compare_active";
        });
      }
    }

  //Removes the black bar underneath some of the divs with a list seperated by said bar
  function removeBar(element, elementClass)
  {
    element.className= elementClass+" noBar";
  }

  //Creates the list of resources for the corresponding tab
  function createResources(element)
  {
    //adds the header to the tab
    document.getElementById("tab-resources").innerHTML="<h1>Resources</h1>";

    //total number of resources that are to be displayed
    var numResources = {{$linkC}};

    //dynamically creates list of resources
    for (var i = 0; i<numResources; i++)
    {
      //first resource doesn't need a break before it
      if(i==1)
      {
        //creates div container and sets its id and class
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        div.classList.add("resources_div");
        //adds html for the list
        //Needed:Link name, link address, and link description
        div.innerHTML = ""+linkT[i]+"<br><a href=url><font color=#10a8e9>"+link[i]+"</font></a><br><br><font color=#f79b2e>"+linkD[i]+"</font><br><br>";

        //if last resource: removes black bar underneath div
        if(i==numResources)
        {
          removeBar(div,"resources_div");
        }

        //adds div container to tab
        document.getElementById("tab-resources").appendChild(div);
      }
      //resource number is even, color gray
      else if(i%2==0)
      {
        //creates div container and sets its id and class
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        div.classList.add("resources_div");
        //adds html for the list
        //Needed:Link name, link address, and link description
        div.innerHTML = "<br>"+linkT[i]+"<br><a href=url><font color=#10a8e9>"+link[i]+"</font></a><br><br><font color=#808080>"+linkD[i]+"</font><br><br>";

        //if last resource: removes black bar underneath div
        if(i==numResources)
        {
          removeBar(div,"resources_div");
        }

        //adds div container to tab
        document.getElementById("tab-resources").appendChild(div);
      }
      //resource number is odd, color orange
      else
      {
        //creates div container and sets its id and class
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        div.classList.add("resources_div");
        //adds html for the list
        //Needed:Link name, link address, and link description
        div.innerHTML = "<br>"+linkT[i]+"<br><a href=url><font color=#10a8e9>"+link[i]+"</font></a><br><br><font color=#f79b2e>"+linkD[i]+"</font><br><br>";

        //if last resource: removes black bar underneath div
        if(i==numResources)
        {
          removeBar(div,"resources_div");
        }

        //adds div container to tab
        document.getElementById("tab-resources").appendChild(div);
      }
    }

    //calls show tab to display resources tab in main panel
    showTab(document.getElementById("resources"));
  }

  //Creates the list of tips for the corresponding tab
  function createTips(element)
  {

    //adds the header to the tab
    document.getElementById("tab-tips").innerHTML="<h1>Tips</h1>";

    //total number of tips that are to be displayed
    var numTips = {{$tipS}};

    //dynamically creates list of tips
    for (var i = 0; i<numTips; i++)
    {
      //tip number is even, color gray
      if(i%2==0)
      {

        //creates div container and sets its id
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        //adds html for the list
        //Needed:Tip description

        var tip = typeof pausecontent[i];
        div.innerHTML = "<table class=Tip style=color:#808080><tr><td><img src=/css/TipsIconGray.png height=50></td><td width=10></td><td width=700><form action = /long_tip method=get><p><p>"+ pausecontent[i] +"</p></p><button id=tipButtonGray name = t_id value = "+pausecontentid[i]+" type = submit>Add to myPlan</button></form></td></tr><tr><td></td></tr><tr><td></td><td></td><td></a></td></tr></table><br>";
        //adds div container to tab
        document.getElementById("tab-tips").appendChild(div);
      }
      //tip number is odd, color orange
      else
      {
        //creates div container and sets its id
        var prefix = "div_";
        var div = document.createElement("div");
        div.id  = prefix.concat(i);
        //adds html for the list
        //Needed:Tip description
        div.innerHTML = "<table class=Tip style=color:#f79b2e><tr><td><img src=/css/TipsIconOrange.png height=50></td><td width=10></td><td width=700><form action = /long_tip method=get><p>  <p>"+pausecontent[i]+"</p></p><button id=tipButtonOrange name = t_id value = "+pausecontentid[i]+" type = submit>Add to myPlan</button></form></td></tr><tr><td></td></tr><tr><td></td><td></td><td></td></tr></table><br>";
        //adds div container to tab
        document.getElementById("tab-tips").appendChild(div);
      }
    }

    //calls show tab to display tips tab in main panel
    showTab(document.getElementById("tips"));
  }

  //Creates the list of users for the energy leaderboard
  function createEnergyLeaderboard(element)
  {

    //adds the main header to the tab, button to switch leaderboards, and energy leaderboard header
    document.getElementById("tab-leaderboards").innerHTML="<h1>Leaderboards</h1><button class=leaderButton onclick=createParticipationLeaderboard(this)> By Participation </button><h3>Top 100 by Savings</h3>";

    //total number of users that are to be displayed
    var numUsers = {{ $cap }};


    //creates div container and sets its id and class
    var div = document.createElement("div");
    div.id="energyBoard";
    div.classList.add("leaderboard");

    //dynamically creates list of users and KWH savings
    for(var i=1;i<=numUsers;i++)
    {
      //first user doesn't need break line before it
      if(i==1)
      {
        //adds html to the list
        //Needed:User icon, username, KWH
        div.innerHTML = "<table class=leaderTable style=color:#f79b2e;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardOrange.png height=50 style=display:inline-block;></td><td color=black width=50px><font color=black>"+i+"</font></td><td><p>"+usere[i-1]+"</p></td><td width=300px>"+e_S[i-1]+" KWH</td></tr></table>";
      }
      //user number is even, color gray
      else if(i%2==0)
      {
        //adds html to the list
        //Needed:User icon, username, KWH
        div.innerHTML += "<hr color=black><table class=leaderTable style=color:#575252;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardGray.png height=50 style=display:inline-block;></td><td color=black width=50px><font color=black>"+i+"</font></td><td>"+usere[i-1]+"</td><td width=300px>"+e_S[i-1]+" KWH</td></tr></table>"
      }
      //user number is even, color orange
      else
      {
        //adds html to the list
        //Needed:User icon, username, KWH
        div.innerHTML += "<hr color=black><table class=leaderTable style=color:#f79b2e;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardOrange.png height=50 style=display:inline-block;></td><td width=50px><font color=black>"+i+"</font></td><td>"+usere[i-1]+"</td><td width=300px>"+e_S[i-1]+" KWH</td></tr></table>";
      }
    }

    //adds div container to tab
    document.getElementById("tab-leaderboards").appendChild(div);
    //calls show tab to display energy leaderboard in main panel
    showTab(document.getElementById("leaderboards"));
  }

  //Creates the list of users for the participation leaderboard
  function createParticipationLeaderboard(element)
  {
    //adds the main header to the tab, button to switch leaderboards, and participation leaderboard header
    document.getElementById("tab-leaderboards").innerHTML="<h1>Leaderboards</h1><button class=leaderButton onclick=createEnergyLeaderboard(this)> By Savings </button><h3>Top 100 by Participation</h3>";

    //total number of users that are to be displayed
    var numUsers = {{$cap}};

    //creates div container and sets its id and class
    var div = document.createElement("div");
    div.id="participationBoard";
    div.classList.add("leaderboard");

    //dynamically creates list of users and participation points
    for(var i=1;i<=numUsers;i++)
    {
      //first user doesn't need break line before it
      if(i==1)
      {
        //adds html to the list
        //Needed:User icon, username, user points
        div.innerHTML = "<table class=leaderTable style=color:#f79b2e;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardOrange.png height=50 style=display:inline-block;></td><td color=black width=50px><font color=black>"+i+"</font></td><td>"+userp[i-1]+"</td><td width=300px>"+p_S[i-1]+" points</td></tr></table>";
      }
      //user number is even, color gray
      else if(i%2==0)
      {
        //adds html to the list
        //Needed:User icon, username, user points
        div.innerHTML += "<hr color=black><table class=leaderTable style=color:#575252;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardGray.png height=50 style=display:inline-block;></td><td color=black width=50px><font color=black>"+i+"</font></td><td>"+userp[i-1]+"</td><td width=300px>"+p_S[i-1]+" points</td></tr></table>"
      }
      //user number is even, color orange
      else
      {
        //adds html to the list
        //Needed:User icon, username, user points
        div.innerHTML += "<hr color=black><table class=leaderTable style=color:#f79b2e;><tr><td width=100px style=color:black; padding-left:50px;><img src=/css/LeaderboardOrange.png height=50 style=display:inline-block;></td><td width=50px><font color=black>"+i+"</font></td><td>"+userp[i-1]+"</td><td width=300px>"+p_S[i-1]+" points</td></tr></table>";
      }
    }

    //adds div container to tab
    document.getElementById("tab-leaderboards").appendChild(div);
    //calls show tab to display paticipation leaderboard in main panel
    showTab(document.getElementById("leaderboards"));
  }

  //Creates the list of challenges for the corresponding tab
  function createChallenges(element)
  {
    // finds difference between start and end date of current challenge
    //Needed: start and end date of current challenge
    //var start = new Date("4/1/2018");
    //var end = new Date("4/30/2018");
    var start = new Date("{{$challenge->start_date}}");
    var end = new Date("{{$challenge->end_date}}");
    var diffDays = parseInt((end-start)/(1000*60*60*24))+1;

    //grabs today's date
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

    if(dd<10)
    {
      dd = '0'+dd;
    }

    if(mm<10)
    {
      mm='0'+mm;
    }

    //formats today's date and finds how many day have passed since start
    today=new Date(mm+'/'+dd+'/'+yyyy);
    var daysPassed = parseInt((today-start)/(1000*60*60*24));

    //finds days left in challenge
    var days = diffDays-daysPassed;

    //if days left is negative, set to 0
    if(days<0)
    {
      days=0;
    }

    //finds percent of day passed out of total
    var percent = (daysPassed/diffDays)*100;

    //if percent over 100, set to 100
    if(percent>100)
    {
      percent=100;
    }

    //adds the main header to the tab and current challenges header
    document.getElementById("tab-challenges").innerHTML="<h1>Challenges</h1><h3>Current Challenge</h3>";
    //creates div container and sets its id and class
    var current = document.createElement("div");
    current.id = "current";
    current.classList.add("challenges_div");
    //calls remove bar because bar isn't needed after div
    removeBar(current, "challenges_div");
    //adds html for the current challenge
    //Needed:Challenge title, end date, challenge description

    // Edited: Ryan 4/16/2018 for current challenge changes
    current.innerHTML="<table class=challengesTableTitle style=color:#c37a23;><tr><td width=700px>{{ $chal_title }}</td><td width=400px style=float:right;>End Date: {{ $challenge->end_date }}</td></tr></table><table class=challengesTableDesc style=color:#f79b2e;><tr><td>{{ $chal_text }}</td></tr></table><br><div class=progressBar><span style=width:"+percent+"%></span></div><h5 class=daysLeft>"+days+" days left</h5><br>";
    //adds div container to tab
    document.getElementById("tab-challenges").appendChild(current);

    //adds the past challenges header to the tab
    document.getElementById("tab-challenges").innerHTML +="<h3>Past Challenges</h3>";

    //total number of past challenges that are to be displayed
    var numChallenges = 6;

    //dynamically creates list of past challenges
    for (var i = 1; i<=numChallenges; i++)
    {
      //first challenge doesn't need a break before it
      if(i==1)
      {
        //creates div container and sets its id and class
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        div.classList.add("challenges_div");
        //adds html to the list
        //Needed:Challenge title, start date, end date, challenge description
        div.innerHTML = "<table class=challengesTableTitle style=color:#575252><tr><td width=700px>Challenge Title</td><td width=400px style=float:right;>12/12/2018-12/31/2018</td></tr></table><table class=challengesTableDesc style=color:#808080;><tr><td>{{ $chal_text }}</td></tr></table><br>";

        //if last challenge: removes black bar underneath div
        if(i==numChallenges)
        {
          removeBar(div,"challenges_div");
        }

        //adds div container to tab
        document.getElementById("tab-challenges").appendChild(div);
       }
      //any other challenge but the first needs a break before it
      else
      {
        //creates div container and sets its id and class
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        div.classList.add("challenges_div");
        //adds html to the list
        //Needed:Challenge title, start date, end date, challenge description
        div.innerHTML = "<br><table class=challengesTableTitle style=color:#575252><tr><td width=700px>Challenge Title</td><td width=400px style=float:right;>12/12/2018-12/31/2018</td></tr></table><table class=challengesTableDesc style=color:#808080;><tr><td>{{ $chal_text }}</td></tr></table><br>";

        //if last challenge: removes black bar underneath div
        if(i==numChallenges)
        {
          removeBar(div,"challenges_div");
        }

        //adds div container to tab
        document.getElementById("tab-challenges").appendChild(div);
      }
    }

    //calls show tab to display challenges tab in main panel
    showTab(document.getElementById("challenges"));
  }

  //Creates the current challenge div and list of tips of myPlan for the corresponding tab
  function createMyPlan(element)
  {
    // finds difference between start and end date of current challenge
    //Needed: start and end date of current challenge

    //var start = new Date("3/1/2018");
    //var end = new Date("3/31/2018");
    var start = new Date("{{$challenge->start_date}}");
    var end = new Date("{{$challenge->end_date}}");
    var diffDays = parseInt((end-start)/(1000*60*60*24))+1;

    //grabs today's date
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

    if(dd<10)
    {
      dd = '0'+dd;
    }

    if(mm<10)
    {
      mm='0'+mm;
    }

    //formats today's date and finds how many day have passed since start
    today=new Date(mm+'/'+dd+'/'+yyyy);
    var daysPassed = parseInt((today-start)/(1000*60*60*24));

    //finds days left in challenge
    var days = diffDays-daysPassed;

    //if days left is negative, set to 0
    if(days<0)
    {
      days=0;
    }

    //finds percent of day passed out of total
    var percent = (daysPassed/diffDays)*100;

    //if percent over 100, set to 100
    if(percent>100)
    {
      percent=100;
    }

    //adds the main header to the tab and current challenges header
    document.getElementById("tab-myplan").innerHTML="<h1>myPlan</h1><h3>Current Challenge</h3>";
    //creates div container and sets its id and class
    var current = document.createElement("div");
    current.id = "current";
    current.classList.add("challenges_div");
    //calls remove bar because bar isn't needed after div
    removeBar(current, "challenges_div");
    //adds html for the current challenge
    //Needed:Challenge title, end date, challenge description
    current.innerHTML="<table class=challengesTableTitle style=color:#c37a23;><tr><td width=700px>{{ $chal_title }}</td><td width=400px style=float:right;>End Date: {{ $challenge->end_date }}</td></tr></table><table class=challengesTableDesc style=color:#f79b2e;><tr><td>{{ $chal_text }}</td></tr></table><br><div class=progressBar><span style=width:"+percent+"%></span></div><h5 class=daysLeft>"+days+" days left</h5><br><form action = /updateScore method=get><button class=finishedButton>Finished</button></form><br>";
    //adds div container to tab
    document.getElementById("tab-myplan").appendChild(current);

    //adds the past challenges header to the tab
    document.getElementById("tab-myplan").innerHTML +="<h3>Your Tips</h3>";

    //total number of added tips that are to be displayed
    var numTips = {{$TipL}};

    //dynamically creates list of added tips
    for (var i = 0; i<numTips; i++)
    {
        //creates div container and sets its id
        var prefix = "div_";
        var div = document.createElement("div");
        div.id = prefix.concat(i);
        //adds html for the list
        //Needed:Tip description
        div.innerHTML = "<table class=Tip style=color:#808080><tr><td><img src=/css/TipsIconGray.png height=50></td><td width=10></td><td width=700>"+userT[i]+"</td></tr><tr><td></td></tr><tr><td></td><td></td><td><form action = /remove_tip method=get><button id=tipButtonGray name = 't_id' value = "+user_tip_tid[i]+">Remove from myPlan</button></form></td></tr></table><br>";
        //adds div container to tab
        document.getElementById("tab-myplan").appendChild(div);
    }

    //calls show tab to display myPlan tab in main panel
    showTab(document.getElementById("myplan"));
  }
</script>


{{-- HTML Section --}}


@extends('layout')

@section('title')

  Climate Smart Website Main Page

@endsection

@section('content')
<link href="{{asset('css/website_format.css')}}" rel="stylesheet"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
  <div class="banner">

    {{-- banner --}}
    @include('components.header')

  </div>
  <article class="body">
     <div>
        <table>
          <tr>
            <td>
              <button id="tips" class="tablink" onclick="createTips(this);">Tips</button>
            </td>
            <td>
              <button id="challenges" class="tablink" onclick="createChallenges(this)">Challenges</button>
            </td>
            <td>
              <button id="myplan" class="tablink" onclick="createMyPlan(this)">myPlan</button>
            </td>
            <td>
              <button id="compare" class="tablink active" onclick="showTab(this);showCompareTab(community);">Compare Energy</button>
            </td>
            <td>
              <button id="leaderboards" class="tablink" onclick="createEnergyLeaderboard(this)">Leaderboards</button>
            </td>
            <td>
              <button id="resources" class="tablink" onclick="createResources(this);">Resources</button>
            </td>
          </tr>
        </table>
      </div>
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
      <div id="cont">
        <div id="leftcont">
          <div class="energy_div" id="energy_div">
            <h1>ENERGY</h1>
            <h1 style="color:black;"> You have saved:
              <br>{{$saving}} KWH</h1>
          </div>
          <br />

          <div>
            <form action="/enterEnergy" method="get">
              {{ csrf_field() }}
            <button class="energy_button">Enter Energy Data</button>
          </form>
          </div>
          <br />

          <div class="spotlight_div">
            <h1>SPOTLIGHT</h1>
            <img src=/css/SpotlightPicExample.jpg width=90% height=60% style="padding-left:5%; padding-right:5%;">

            <?php
                  $handle = fopen('../public/css/spotlightContent.txt', "r");
                  $output = "";
                  if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                      $output .= $line;
                      $output .=  "</br>";
                    }
                    fclose($handle);
                  }
            ?>
            <label id="spotlight_label" for="display_text" ><?php echo $output; ?></label>
          </div>
          <br />
        </div>
          <br />
        <div id="rightcont">
          <div class="main_div" id="tab-tips">
          </div>
          <div class="main_div" id="tab-challenges">
          </div>
          <div class="main_div" id="tab-myplan">
          </div>
          <div class="main_div" id="tab-compare">
            <h1>Compare Savings</h1>
            <div class="comparecont">
              <div id="compareleftcont">
                <div class="comparetab">
                  <button class="compare_tab compare_active" id="community" onclick="showCompareTab(this)">Community Savings</button>
                  <button class="compare_tab" id="others" onclick="showCompareTab(this)">Compare Your Savings with Others</button>
                  <button class="compare_tab" id="month" onclick="showCompareTab(this)">Compare Your Savings by Month</button>
                  <button class="compare_tab" id="quarter" onclick="showCompareTab(this)">Compare Your Savings by Quarter</button>
                </div>
              </div>
              <div id="comparerightcont">
                <div class="compareInfo" id="tab-community">
                  <h1>Community Savings</h1>
                  <script type="text/javascript">
                  $('#tab-community').highcharts( <?php echo json_encode($chart_a) ?>)
                </script>
                </div>
                <div class="compareInfo" id="tab-others">
                  <h1>Compare Savings with Others</h1>
                  <script type="text/javascript">
                  $('#tab-others').highcharts( <?php echo json_encode($chart_comp) ?>)
                </script>
                </div>
                <div class="compareInfo" id="tab-month">
                  <h1>Compare Savings by Month</h1>
                  <script type="text/javascript">
                  $('#tab-month').highcharts( <?php echo json_encode($chart_array) ?>)
                </script>
                </div>
                <div class="compareInfo" id="tab-quarter">
                  <h1>Compare Savings by Quarter</h1>
                  <script type="text/javascript">
                  $('#tab-quarter').highcharts( <?php echo json_encode($chart_quarter) ?>)
                </script>
                </div>
              </div>
            </div>
          </div>
          <div class="main_div" id="tab-leaderboards">
          </div>
          <div class="main_div" id="tab-resources">
          </div>
          <br />
        </div>
      </div>

  <script type="text/javascript">
    function processTab()
    {
      var parameters = location.search.substring(1).split("&");

      var temp = parameters[0].split("=");
      tab = unescape(temp[1]);

      if(tab=="tips"||tab=="challenges"||tab=="myplan"||tab=="compare"||tab=="leaderboards"||tab=="resources")
      {
        openTab(tab);
      }
      else
      {
        openTab();
      }
    }

    function openTab(tab="compare")
    {
      document.getElementById(tab).click();
    }

    processTab();
  </script>

  </article>
</body>

<footer>
  <div class="SocialButtonDiv">

    {{-- social buttons --}}
    @include('components.share')

  </div>
</footer>

</html>
@endsection
