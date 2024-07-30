<?php
  $pageTitle = 'View Images';
  $pageDesc = 'On this page we will be able to view the images that we have uploaded';
  include './inc/header.php';
 
  require "DATABASE_JS";


  include 'inc/footer.php';

  $stmt = $conn->prepare('select profile_image from clients');
  $stmt->execute();
  $imagelist = $stmt->fetchAll();
?>
  <section class="view-masthead">
    <div>
      <h1>View Images</h1>
    </div>
    
    
  </section>
  <section class="image-row row">
    
    
<?php
  foreach($imagelist as $image) {

 ?>
    <div class="col-sm-12 col-md-3 col-lg-3"> 
      <img src="<?=$image['image']?>" alt="<?=$image['name'] ?>" class="img-fluid" >
      <p><?php echo $image["name"]; 
    

      ?></p>

    </div>
<?php
}
?>

  </section>



