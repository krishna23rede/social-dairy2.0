<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASIDEBAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="Css/asidebar.css" />
  </head>
  <body>
<!-- Navvbarr -->
<div class="head">
      <img src="imgs/Navbar.png" alt="" />
    </div>

	<!-- ASide bar -->
    <aside id="myAside">
      <div class="logo" style="margin-top: -45px; margin-left: 50px">
        <img src="imgs/Logo.png" alt="" />
      </div>

      <div class="aside-list">
        <ul>
          <li>
            <a href="home.php"><i class="fa fa-3 fa-home" aria-hidden="true"></i>HOME</a>
          </li>
          <li>
            <a href="explore.php"><i class="fa fa-3 fa-compass" aria-hidden="true"></i>EXPLORE</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-3 fa-comments" aria-hidden="true"></i>MESSAGE</a>
          </li>
        </ul>
      </div>
        
<?php

    if(isset($_SESSION['loggedin'])){      
      echo'<footer>
        <h5>Welcome <br>'.$_SESSION['user_email'].'</b></h5>

        <button class="Btn">
  
        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
        
        <div class="text"><a id="logout" href="partials/logout.php">Logout</a></div>
        
        </button>
        
        
        
        
        </footer>';
      }
      else {
        echo '<button class="button"> <a href="login.php">LOGIN</a>
        </button>';
      }
      ?>
    </aside>
    
	<!-- Search Bar -->
     <div class="search-bar">
     <form action="/social-dairy/search.php" method="get" >
      <input type="text" name="search" id="search" placeholder="Search..." />
      <button><i class="fa fa-search" type="submit" aria-hidden="true"></i></button>
      </form>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>  </body>
</html>
</html>
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