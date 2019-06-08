<?php

date_default_timezone_set("Asia/Calcutta");
session_start();
$link = mysqli_connect("localhost", "root", "","twitter");

  if (mysqli_connect_error($link)) {

      print_r(mysqli_connect_error());
      exit();
  }

  //session destruction if user logs out
  if(array_key_exists('function', $_GET))
  {
    if($_GET['function']=='logout'){
  session_unset();//or session_unset
  }
  }
function displayUsers() {
        
        global $link;
        
        $query = "SELECT * FROM users LIMIT 13";
        
        $result = mysqli_query($link, $query);
            
        while ($row = mysqli_fetch_assoc($result)) {
            
            echo "<p><a href='?page=publicprofile&userid=".$row['id']."'>".$row['email']."</a>";
            
        }
}
// recent tweets


function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }
//displays tweets

function displayTweets($x){
    
    global $link;
    $whereclause="";
    
    if($x=='public'){
       $whereclause="";
    }else if($x=='isfollowing'){
      $query='SELECT * FROM `follow` WHERE `follower`="'. mysqli_real_escape_string($link, $_SESSION['id']).'" ';
      $result=mysqli_query($link,$query);
      $whereclause="";
      while($row=mysqli_fetch_array($result)){
        if($whereclause ==""){
          $whereclause='WHERE';
        }else{
          $whereclause.=' OR';
        }
        $whereclause.=' userid ='.$row["isfollowing"].' ';
      }
        


    }else if($x=='yourtweets'){
        
        $whereclause='WHERE userid ='.$_SESSION["id"].' ';
    }else if($x=='search'){
        /*echo $_SESSION['id'];
        echo $_GET['q'];*/
        echo "<h4 class='mt-3 lead'>Showing results for: ".mysqli_real_escape_string($link, $_GET["q"])."</h4>";
        $whereclause='WHERE `tweet` like "%'.$_GET["q"].'%" ';
    }else if(is_numeric($x)){
         //echo $x;
         $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $x)." LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
            
            echo "<h3><strong>".mysqli_real_escape_string($link, $user['email'])."'s</strong> Tweets</h3><a href='chatrooms'><button class='btn btn-success d-flex justify-content-right'>CHAT</button></a></p>";
        $whereclause = 'WHERE userid = '. mysqli_real_escape_string($link, $x).' ';
    }

  
    $query='select * from  `tweets` '.$whereclause.'order by time desc limit 10';
    $result=mysqli_query($link,$query);
    if(mysqli_num_rows($result)<=0){
        echo "Sorry,no recents tweets.";
    }else{
        while($row=mysqli_fetch_assoc($result)){


            $r= $row['userid'];

               $query1='SELECT * FROM `users` WHERE `id`='.$r.' LIMIT 1';
          $result1=mysqli_query($link,$query1);
            if($result1){
                $row1=mysqli_fetch_assoc($result1);

                echo "<div class='dispdesign mt-4'><p><span class='font-weight-bold'><a href='?page=publicprofile&userid=".$row1['id']."'>".$row1['email']."</span><span class='text-muted '>  ".time_since(time() - strtotime($row['time']))."  ago<span></p>";
                 
                echo "<p>".$row['tweet']."</p>";
                
                echo "<a  class='togglefollower btn btn-outline-primary' data-userid='".$r."'>
                ";
                 if(array_key_exists("id",$_SESSION)){
            $queryfollow='SELECT * FROM `follow` WHERE `follower`="'.mysqli_real_escape_string($link, $_SESSION['id']).'"  AND `isfollowing`="'.mysqli_real_escape_string($link,$r).'"  LIMIT 1';
            $resultfollow = mysqli_query($link, $queryfollow);
                
                if (mysqli_num_rows($resultfollow) > 0){
                   
                    
                    echo "<i class='fas fa-user-minus mr-2' style='font-size:16px'></i>Unfollow";
                        
                }else{
                    echo "<i class='fas fa-user-plus  mr-2' style='font-size:16px'></i>Follow";
                }
                
 }else{
                       echo "<i class='fas fa-user-plus  mr-2' style='font-size:16px'></i>Follow";
                     
                 }
                echo "</a><hr></div>";

            }else{
                echo "not worked";
            }

        }
    }
    /*$query='select * from  `tweets`'.$where.'  order by time desc limit 1';
     $result=mysqli_query($link,$query);
    //$data=mysqli_fetch_assoc($result);

    if($result){
          while($row=mysqli_fetch_array($result)){
         echo $row['userid'];
          $tweetQuery='SELECT * FROM `users` WHERE `id`='.mysqli_real_escape_string($link,$row['userid']).'  LIMIT 1';
              $result1=mysqli_query($link,$tweetQuery);
            if($result1){
            echo "uder details retieved";
            $row1=mysqli_fetch_assoc($result);
            echo $row1['email'];
            }else{
            echo "inner query notworking";
            }
     }


    }else{
              echo "outer query not working.";
          }

    */
    
}



//search box
function searchTweets(){
    echo'<form class="form-inline formdesign mt-5">
  <div class="form-group mx-sm-2 mb-2">
  <input type="hidden" name="page"  value="search">
    <input type="text" name="q" class="form-control" id="search" placeholder="Search here">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>';
}


//write tweet
function displaytweetbox(){

    echo '
    <div class="alert alert-success" id="tweetsuccess">Your tweet is posted!</div>
     <div class="alert alert-danger" id="tweetfail"></div>
    <div class=" formdesign mt-5" id="tweetform">
    <div class="form-group mx-sm-2 mb-2">

    <textarea class="form-control" id="tweetarea" rows="3" placeholder="What&#884;s Happening?" maxlength="140" rows="18"></textarea>
  </div>
  
   <button  class="btn btn-primary ml-2" id="post">Post Tweet</button>
</div>
';
}


    ?>
