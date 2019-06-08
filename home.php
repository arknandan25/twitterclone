<div class="container mainContainer">

    <div class="row">
  <div class="col-md-8 mb-5 mt-4">

        <h2>Recent tweets <i class='fas fa-comments ml-3' style='font-size:26px'></i></h2>

        <?php displayTweets('public'); ?>

        </div>
  <div class="col-md-4 mt-4">
<h2>Search Tweets <i class="fa fa-search ml-2" style="font-size:26px"></i></h2>
        <?php searchTweets(); ?>

      <hr>
<h3>Write a post<i class="fas fa-pen ml-3" style="font-size:26px"></i></h3>
      <?php displaytweetbox(); ?>

        </div>
</div>

</div>
