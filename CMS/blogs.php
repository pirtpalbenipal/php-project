<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/session.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!--<h1 class="display-1">No error</h1>-->
<!-- NAvgation -->
<div style="height: 4px; background:#00bfff;"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container "  >
		<a href="#" class="navbar-brand">pirtpal.com</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseid">
        <span class="navbar-toggler-icon"></span>
      </button>
		<div class="collapse navbar-collapse" id="navbarcollapseid">		
			<ul class="navbar-nav mr-auto"> <!-- mr margin right auto-->
			
           <li class="nav-item">
           	<a href="blogs.php" class="nav-link">Home</a>
           </li>
           <li class="nav-item">
           	<a href="#" class="nav-link">About us</a>
           </li>
           <li class="nav-item">
           	<a href="blogs.php" class="nav-link">Blogs</a>
           </li>
           <li class="nav-item">
           	<a href="#" class="nav-link">Contact us</a>
           </li>
           <li class="nav-item">
           	<a href="#" class="nav-link">Features</a>
           </li>
          
			
		</ul>
		<ul class="navbar-nav ml-auto">
      <form class="form-inline d-none d-sm-block" action="blogs.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          </div>
        </form>
			
		</ul>
		</div>
	</div>
</nav>
<!-- nav ends here-->

<div style="height: 4px; background:#00bfff;"></div>
<!-- head----->
<div class="container">
  <div class="row mt-4">
    <!-- main area-->

    <div class="col-sm-8">
      <h1>The Complete Responsive CMS Blog</h1>
          <h1 class="lead">The Complete blog by using PHP and bootstrap</h1>
         <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
        <?php
        if(isset($_GET["SearchButton"]))
        {
            $search = $_GET["search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $connect->prepare($sql);
            $stmt->bindValue(':search','%'.$search.'%');
            $stmt->execute();
        }// query when page =1 is active
        elseif (isset($_GET["page"])) 
        {
            $Page = $_GET["page"];
            if($Page==0||$Page<1)
            {
            $ShowPostFrom=0;
          }
          else{
            $ShowPostFrom=($Page*5)-5;
          }
            $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
            $stmt=$connect->query($sql);
          }// Query When Category is active in URL Tab
          elseif (isset($_GET["category"])) {
            $Category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
            $stmt=$connect->query($sql);
          }
          else
        { // by default search query
           $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
           $stmt=$connect->query($sql);
        }
        while ($DataRows=$stmt->fetch()) {
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $Admin           = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
        
        ?>
        <div class="card">
          <img src="upload/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
          <div class="card-body">
             <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted">Category: <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>

               <span style="float:right;" class="badge badge-dark text-light">Comments:
               <?php echo ApproveCommentsAccordingtoPost($PostId);?> </span>
               <hr>
               <p class="card-text"><?php if (strlen($PostDescription)>250) { $PostDescription = substr($PostDescription,0,250)."...";} echo htmlentities($PostDescription); ?></p>
               <a href="full_post.php?id=<?php echo htmlentities($PostId); ?>" style="float:right;">
                <span class="btn btn-info">Read More &rang;&rang; </span>
              </a>
            
          </div>
        </div>
        <br>
      <?php }?>
        <!-- Pagination algo  -- >
          <nav>
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
              <?php if( isset($Page) ) {
                if ( $Page>1 ) {?>
             <li class="page-item">
                 <a href="blogs.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            
            $sql           = "SELECT COUNT(*) FROM posts";
            $stmt          = $connect->query($sql);
            $RowPagination = $stmt->fetch();
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/5;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if( isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="blogs.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="blogs.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if ( isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="blogs.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
        </div>

        
    
      <!-- main area ends here-->

      <!-- side area-->

      <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">
              <img src="images/sideimage.jpeg" class="d-block img-fluid mb-3" alt="">
              <div class="text-center">
                <b>The future belongs to those who believe in the beauty of their dreams. Eleanor Roosevelt</b>
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-dark text-light">
              <h2 class="lead">Sign Up !</h2>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
              <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-primary text-light">
              <h2 class="lead">Categories</h2>
              </div>
              <div class="card-body">
                <?php
                
                $sql = "SELECT * FROM category ORDER BY id desc";
                $stmt = $connect->query($sql);
                while ($DataRows = $stmt->fetch()) {
                  $CategoryId = $DataRows["id"];
                  $CategoryName=$DataRows["title"];
                 ?>
                <a href="blogs.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
               <?php } ?>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-info text-white">
              <h2 class="lead"> Recent Posts</h2>
            </div>
            <div class="card-body">
              <?php
              
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= $connect->query($sql);
              while ($DataRows=$stmt->fetch()) {
                $Id     = $DataRows['id'];
                $Title  = $DataRows['title'];
                $DateTime = $DataRows['datetime'];
                $Image = $DataRows['image'];
              ?>
              <div class="media">
                <img src="upload/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="full_post.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                  <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
              </div>
              <hr>
              <?php } ?>
          
          </div>

        </div>
      <!--side area ends-->
      
    </div>
  </div>
</div>

<br>

<!-- footer starts here-->
 <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Theme By | Pirtpal Singh| <span id="year"></span> &copy; ----All right Reserved.</p>
          <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="http://pirtpal.com/" target="_blank"> This site is made using php,bootstrap and mysql. For more information you can contact pirtpal.bjf25@gamil.com</a></p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:4px; background:pink;"></div>
        <!--footer ends here-->








<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>