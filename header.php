<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script type="text/javascript" src="jquery.min.js"></script>
    <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="jquery-ui/jquery-ui.js"></script>
      <style type="text/css">
      /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  margin-bottom: 60px; /* Margin bottom by footer height */
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 60px; /* Vertically center the text there */
  background-color: #f5f5f5;
}

#signin_button{
  margin-right: 20px;
}
          #header{
              float: left;
          }
          #viewstrength{
              float: right;
              padding-top: 15px;
              padding-left: 17px;
          }

          #loginalert{
           display: none;
          }
          .display-top{

              background-color: none;
          }
          .design{
              background-color: none;
              min-height:10vh;
              transition: all 6s ease-in-out;
              padding-left: 5px;

          }
          .dispdesign:hover{
              background-color: #F5F8FA;
              border: 2px solid #F5F8FA;
              border-radius: 2px;
              padding-left: 15px;
          }
          .hero:hover{
              color: red;

          }
          textarea {
    resize: none;
}
           #adderror{
           display: none;
               margin-bottom: 0;
          }
          #tweetsuccess{
              display: none;
          }
          #tweetfail{
               display: none;
          }
          #img{
              margin: 0 auto;
          }

      </style>
    <title>
        
        Twitter clone</title>
      <link rel="icon" href="views/img/_65QFl7B.png" type="image/png">

  </head>
  <body>
      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.3"></script>

      <div id='adderror' class="alert alert-danger alert-dismissible text-center lead">
    
      </div>
     
      <!-- NAVBAR-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://localhost:8080/twitter3">Twitter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">

      </span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item">
        <a class="nav-link" href="?page=timeline">Your Timeline</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="?page=tweets">Your Tweets</a>
      </li>
         <li class="nav-item">
        <a class="nav-link " href="?page=publicprofile">Public Profile</a>
      </li>
          <li class="nav-item">
        <a class="nav-link " href="?page=about">About</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
       
       
               
      <?php

         if(array_key_exists("id",$_SESSION)){ ?>
         <a  class="btn btn-outline-success" href="index.php?function=logout">logout</a>
         <?php } else { ?>
       <button class="btn btn-outline-success my-2 my-sm-0"  data-toggle="modal" data-target="#exampleModal">Login/Signup</button>
     <?php } ?>


      </div>
  </div>
</nav>
