<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <footer class="footer mt-5">
      <div class="container">
        <span class="text-dark text-center">&copy;Ark Nandan-Web Developer</span>
          <div class="fb-like" data-href="localhost:8080/twitter3/" data-width="" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
          <a href="https://www.linkedin.com/in/arknandan-singh-chauhan/" ><i class="fa fa-linkedin ml-4" style="font-size:28px;color:red"></i></a>
     <a href="https://github.com/arknandan25" class=" ml-4"><i class="fa fa-github" style="font-size:28px;color:red"></i></a>
     
    <a href=" https://www.reddit.com/user/tech_ark" class=" ml-4"><i class="fa fa-reddit" style="font-size:28px;color:red"></i></a>
      </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Modaltitle">Welcome to Twitter! Login Here.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div  class=" alert alert-danger " id="loginalert"></div>
        <form id="enter_form">

            <input  type='hidden' id='toggler' value="1">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name='email'>

              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name='password'>
                <div id="passvalidator">
                <label class="text-muted mt-3">Password Strength</label>
                <progress max="100" min="0" id="strength"  ></progress>
                <div id="viewstrength" ></div>
                </div>

              </div>

</form>


      </div>
      <div class="modal-footer">

       <a href='#' id='signin_button'>Sign Up</a>
        <button type="button" class="btn btn-success" id="submit_button" >Login</button>
      </div>
    </div>
  </div>

 <script type="text/javascript" src="jquery.min.js"></script>
    <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="jquery-ui/jquery-ui.js"></script>


<script type="text/javascript">
// for the login signup ajax
$("#submit_button").click(function() {

       $.ajax({
         type: "POST",
         url: "actions.php?action=loginSignup",
         data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#toggler").val(),
         success: function(result) {
          if (result == "1") {

                 window.location.assign("http://localhost:8080/twitter3/");

             } else {

                 $("#loginalert").html(result).show();

             }
        //$("#loginalert").html(result).show();

           }
         })

 })


 //for the follow button
    $(".togglefollower").click(function(){
var id=$(this).attr("data-userid");
//alert(id);       // alert($(this).attr("data-userid"));
          $.ajax({
            method: "POST",
            url: "actions.php?action=togglefollower",
           data:"userid="+id,
            success: function(result) {

              if(result=='1' ){
                  $("a[data-userId='" + id + "']").html("<i class='fas fa-user-plus  mr-2' style='font-size:16px'></i>Follow");
              }

               else if(result=='2'){
                 $("a[data-userId='" + id + "']").html("<i class='fas fa-user-minus mr-2' style='font-size:16px'></i>Unfollow");
               }else if(result=='3'){
                   alert("Sorry,you can't follow yourself");
               }else if(result=='-1'){
               
               $("#adderror").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Cannot follow yourself!</p>').show();
               }else{
                /* $('#exampleModal').modal(options);
                 $("#loginalert").html(<p>Please Login first</p>).show();
*/
//alert("not logged in");
$("#adderror").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Please login first!</p>').show();
//$('#exampleModal').modal();
                   //alert("please login first");
               }







}
        })
    });

$("#post").click(function(){
   // alert($("#tweetarea").val());
   
      $.ajax({//"email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#toggler").val()
            method: "POST",
          cache: true,
            url: "actions.php?action=postTweet",
           data:"tweetdata="+$("#tweetarea").val(),
            success: function(result) {
            
                //alert(result);

            if( result =='0' ){
/*$("#adderror").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Please login first!</p>').show();*/
                 $("#tweetfail").html(result).show();
                  $("#tweetsuccess").hide();
            
            }else if( result =='1'){
                
                $("#tweetsuccess").show();
                  $("#tweetfail").hide();
               
                //e.preventDefault();
            }else{
                
                  $("#tweetfail").html(result).show();
                  $("#tweetsuccess").hide();
                
                 //e.preventDefault();
            }
        
        }  
      })
    // location.reload();
    //e.preventDefault();
});

/*    if(typeof jQuery=="undefined"){
        alert(" jquery not working");

    }else{
        alert("jQuery working");
    }
*/

  document.getElementById("passvalidator").style.display="none";
    //modal togggler
$("#signin_button").click(function(){
    //for  the sign up  modal
    if($("#toggler").val()=="1"){
      $("#toggler").val(0);
        $("#Modaltitle").html("Welcome to Twitter! Signup Here.");
        $("#submit_button").html("Sign Up");
     $("#signin_button").html("Login");
         document.getElementById("passvalidator").style.display="block";
        $('#enter_form').trigger("reset");



    }
    //for  the login modal
    else{
         $("#toggler").val(1);
        $("#Modaltitle").html("Welcome to Twitter! Login Here.");
        $("#submit_button").html("Login");
     $("#signin_button").html("Signup");
        document.getElementById("passvalidator").style.display="none";
        $('#enter_form').trigger("reset");
    }

});

//password validation using regex
    var pass=document.getElementById("password");
    pass.addEventListener('keyup',function(){
        checkpassword(pass.value);
    });
   function checkpassword(password){
       var strengthbar=document.getElementById("strength");
       var  strength=0;
       if(password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/))
           {
               strength+=1;
           }
       if(password.match(/[~<>?]+/))
           {
               strength+=1;
           }
        if(password.match(/[!@#$%^&*()]+/))
           {
               strength+=1;
           }
       if(password.length>7){
           strength+=1;
       }
       switch(strength){
           case 0:strengthbar.value=20;
               document.getElementById("viewstrength").innerHTML="Weak";
               document.getElementById("viewstrength").style.color="red";

               break;
           case 1:strengthbar.value=40;
               document.getElementById("viewstrength").innerHTML="Weak";
               document.getElementById("viewstrength").style.color="red";
               break;
           case 2:strengthbar.value=60;
               document.getElementById("viewstrength").innerHTML="Medium";
               document.getElementById("viewstrength").style.color="orange";
               break;
           case 3: strengthbar.value=80;
               document.getElementById("viewstrength").innerHTML="Strong";
               document.getElementById("viewstrength").style.color="green";
               break;
           case 4:strengthbar.value=100;
               document.getElementById("viewstrength").innerHTML="Very Strong";
               document.getElementById("viewstrength").style.color="green";
               break;
       }
   }




   //for the follow button
  /*  $(".togglefollower").click(function(){

       // alert($(this).attr("data-userid"));
          $.ajax({
            method: "POST",
            url: "actions.php?action=togglefollower",
           data:"userid="+$(this).attr("data-userid"),
            success: function(result) {

                alert(result);


            }

        })
    });

*/

</script>

</body>
</html>
