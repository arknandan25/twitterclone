<?php

include("functions.php");

include("views/header.php");
if(array_key_exists('page',$_GET)){
  if($_GET['page'] =='timeline'){
        if(array_key_exists("id",$_SESSION)){
    include "views/timeline.php";
  }else{
       echo "<div class='alert  alert-danger lead text-center'>Please login  to  view your timeline!</div>";
       
    }
  }

else if($_GET['page'] =='tweets'){
    if(array_key_exists("id",$_SESSION)){
    include "views/yourtweets.php";
    }else{
       echo "<div class='alert  alert-danger lead text-center'>Please login  to  view your recent tweets!</div>";
       
    }
  }
    else if($_GET['page'] =='search'){
    include "views/search.php";
  } else if($_GET['page'] =='searchprofile'){
    include "views/searchprofile.php";
  }  else if($_GET['page'] =='about'){
    include "views/about.html";
  } 
    else if($_GET['page'] =='publicprofile'){
        include "views/publicprofiles.php";
    }
}else{
  include("views/home.php");
}


include("views/footer.php");


?>
<script type="text/javascript" src="jquery.min.js"></script>
   <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
   <script src="jquery-ui/jquery-ui.js"></script>
