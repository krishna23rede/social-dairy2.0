<!-- 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/aside.css">
    <link rel="stylesheet" href="partials/post.css">
  </head>
  <body>
    <img src="imgs/Background.png" class="background" alt="">
   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html> -->






<?php
      include "partials/dbconnect.php";
      include "partials/asidebar.php";
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POST</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="Css/post.css">
  <link rel="stylesheet" href="Css/search.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>
   

<img src="imgs/Background.png" class="background" alt="">


<!-- SEARCH RESULTS -->
<div class="container my-3">

<?php
$noResults = true;
$searchresult = $_GET['search'];
$sql = "SELECT * FROM `post` WHERE MATCH (`post_desc`) AGAINST ('$searchresult' WITH QUERY EXPANSION)";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $desc = $row['post_desc'];
    $post_img=$row['post_img'];
    $id = $row['post_id'];
    $url = "post.php?post_id=".$id;
    $noResults = false;
    echo '
        <div class="post container">
    <!-- POST HEADING -->
    <div class="comment-post-head">
      <div class="comment-icon">
     <img src="imgs/Ellipse 3.png" alt="" height="50em" />
      </div>
      <div class="comment-name">
        <h1>Tony Bhai</h1>
        <p>'.$desc.'</p>
      </div>

    </div>

    <!-- video  -->
    <div class="videos" style="display:flex;
    justify-content:center;
    align-items:center";>
   
    <img src="data:image/jpeg;base64,'. base64_encode($post_img) .'" alt=""/>
    </div>
    <div class="icons">
    <i class="fa fa-share-square-o share" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
      <p class="comment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a comment</p>

      <p class="posted">Posted 4h ago</p>
      </div>
      ';       
}
if($noResults){
    echo '
    <div class="p-4 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-7 fw-bold">No Results Found</h1>
      <p class="col-md-8 fs-4">
      Suggestions: <ul>
      <li> Make sure that all words are spelled correctly. </li>
      <li> Try different keywords. </li>
      <li> Try more general keywords. </li>
      <li> Try fewer keywords.</li>
      </p>
    </div>
  </div>
   '; 
}
?>
 
<?php
// MAKE A COMMENT
     $method =  $_SERVER['REQUEST_METHOD'];
     if($method=='POST'){
         $desc=$_POST['desc'];
         $sql="INSERT INTO `comments` (`comment_id`, `comment_content`, `post_id`, `comment_time`, `comment_by`) VALUES 
         (NULL, '.$desc.', '$id', current_timestamp(), '4')";
         $result = mysqli_query($conn, $sql);
     }
   
   ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Type your comment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">
          <form action="<?php $_SERVER['REQUEST_URI']?>" method="post">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">DESCRIPTION</label>
                <input type="text" class="form-control" id="desc" name="desc">
              </div>
              <button type="submit" class="btn btn-primary">Post</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- COMMENTS -->
    <div class="comments">
        <h5 id="thecomment" onclick="toggleBox()">Comments</h1>
        <div class="outer-comment" id="outer-comment">
      <?php
        
  
      $id=$_GET['post_id'];
      $sql = "SELECT * FROM `comments` WHERE post_id=$id";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $comment_by=$row['comment_by'];
        $comment_content=$row['comment_content'];
      
echo '
        <hr>
          <div class="comment-post-head2">
          <div class="comment-self">
            <div class="comment-icon">
              <img src="imgs/watch.png" alt="" height="50em" />
            </div>
            <div class="comment-name">
              <h1>'. $comment_by.'</h1>
              <p>'.$comment_content.'</p>
             </div>
             </div>
             </div>
       ';
      }
        ?>
         </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script>
  // Get the button and count elements
  const likeButton = document.getElementById('like-button');
  const likeCount = document.getElementById('like-count');

  // Set the initial count
  let count = 0;

  // When the button is clicked, update the count and display it
  likeButton.addEventListener('click', () => {
    count++;
    likeCount.textContent = count;
  });
</script>
<script>
  function toggleBox() {
    var box = document.getElementById("outer-comment");
    if (box.style.display === "none") {
      box.style.display = "block";
    } else {
      box.style.display = "none";
    }
  }
</script>

</html>