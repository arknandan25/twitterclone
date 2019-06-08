<?php

include("functions.php");
$error='';
if(array_key_exists('action', $_GET)){
    if ($_GET['action'] == "loginSignup") {
      //echo "received data in action.php";
     if ($_POST['email']=='') {

           $error = "An email address is required.";

       }
       if ($_POST['password']=='') {

           $error = "A password is required";

       }
       if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

           $error = "Please enter a valid email address.";

}

       if ($error != "") {

           echo $error;
           exit();

       }

       //signup validation
     if ($_POST['loginActive'] == "0") {
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
           $result = mysqli_query($link, $query);
           if (mysqli_num_rows($result) > 0)
               $error = "That email address is already taken.";
           else {

               $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."')";

                                            if (mysqli_query($link, $query)) {
                                            $_SESSION['id'] = mysqli_insert_id($link);

                                            /* $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                                            mysqli_query($link, $query);
                                            */
                                           echo 1;
                                            //echo $_SESSION['id'];
                                            }else {

                                            $error = "Couldn't create user - please try again later";

                                            }


               }

           }//end of signup validation
           else{
             $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

          $result = mysqli_query($link, $query);

          $row = mysqli_fetch_assoc($result);

                            if ($row['password'] == $_POST['password']) {
                            //if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {
                            /* $query="INSERT INTO `user_activity`(`email`,`status`) VALUES('". mysqli_real_escape_string($link, $_POST['email'])."','active')";
                            if(mysqli_query($link,$query)){
                            echo "inserted";
                            }else{
                            echo "not";
                            }*/
                            $_SESSION['id'] = $row['id'];

                            // echo $_SESSION['id'];

                            echo 1;
                            } else {
                            $error = "Could not find that username/password combination. Please try again.";

                            }
}//end of login validation

if ($error != "") {

    echo $error;
    exit();

}

}//login/signup if


if($_GET['action'] == "togglefollower"){
  //echo $_SESSION['id'];
  if($_SESSION['id']){
      if($_SESSION["id"] == $_POST["userid"]){
          echo -1;//user cannot follow himself
      }else{
          
          $query='SELECT * FROM `follow` WHERE `follower`="'.mysqli_real_escape_string($link, $_SESSION["id"]).'"  AND `isfollowing`="'.mysqli_real_escape_string($link, $_POST["userid"]).'"  AND "'.mysqli_real_escape_string($link, $_SESSION["id"]).'" <> "'.mysqli_real_escape_string($link, $_POST["userid"]).'" LIMIT 1';
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0){//already following so we unfollow the guy..
    $row = mysqli_fetch_assoc($result);
    mysqli_query($link,'DELETE FROM `follow` WHERE `id`="'.mysqli_real_escape_string($link,$row["id"]).'" LIMIT 1');
    echo 1;
}else{
    mysqli_query($link,'INSERT INTO `follow`(`follower`,`isfollowing`)  VALUES("'.mysqli_real_escape_string($link, $_SESSION["id"]).'" , "'.mysqli_real_escape_string($link, $_POST["userid"]).'") ');
    echo 2;//no entry already present so the current session user becomes the follower
}

      }
      
      

}else {
  echo 0;//user not logged in so  prevent from following
}
}//end of toggler


    if($_GET['action'] == "postTweet"){
        
        //echo $_POST['tweetdata'];
        if(array_key_exists("id",$_SESSION)){
        if(!$_POST['tweetdata']){
            echo "Empty tweet,Type content again!";
        }else{
            //echo $_POST['imagename'];
             //$image=$_FILES['image']['name'];
               // echo $_FILES['image'];
             $query='INSERT INTO `tweets`(`tweet`,`time`,`userid`) VALUES("'.mysqli_real_escape_string($link, $_POST["tweetdata"]).'"  , NOW() ,  "'.mysqli_real_escape_string($link, $_SESSION["id"]).'"                  )';
            $result = mysqli_query($link, $query);
            echo 1;
        }
           
        }else{
            echo "Login First!";
        }
    }//end of post tweet


}//array_key_exists if
