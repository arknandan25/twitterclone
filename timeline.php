<div class="container mainContainer">

    <div class="row">
  <div class="col-md-8 mt-4">

        <h2 class="mb-4">Tweets for you<i class='fas fa-comments ml-3' style='font-size:26px'></i></h2>

        <?php displayTweets('isfollowing'); ?>

        </div>
  <div class="col-md-4 mt-4">
<h2>Search Profiles<i class="fa fa-search ml-2" style="font-size:26px"></i></h2>
        <?php searchTweets(); ?>

      <hr>
<h3>Write a post <i class="fas fa-pen ml-3" style="font-size:26px"></i></h3>
      <?php displaytweetbox(); ?>

        </div>
</div>

</div>
