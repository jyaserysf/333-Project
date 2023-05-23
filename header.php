
<?php session_start(); ?>
    <nav class="navbar navbar-expand-lg  sticky-top" >
        <div class="container-fluid mx-5 my-3">
            <a class="navbar-brand me-4 ms-4 " href="#">
                <img src="" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                <span>SurveySphere </span>
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-50 me-auto mb-2 mb-lg-0 d-flex ">
              <li class="nav-item me-5 ms-4">
                <a class="nav-link " aria-current="page" href="homepage.php">Home</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="explorepage2.php">Student</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="explorepage2.php">Work</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
              
            </form>
            <?php 
              if (isset($_SESSION['user'])) {
                echo " 
                <a href='#' onclick='logout()'> <button class='btn me-2' id='headLogin'> <i class='fa fa-sign-out'> </i> Logout </button></a>
                <a href='Profile.php'><button class='btn  me-2' id='headRegister'> Profile </button></a>";
              }else{
                    echo "
                    <a href='Login.php'><button class='btn me-2' id='headLogin'> Login </button></a>
                    <a href='Login.php'><button class='btn  me-2' id='headRegister'> Register </button></a>";
                }
            ?>
            <script>
                function logout() {
                    // Send an AJAX request to the server to destroy the session
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'logout.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        // Redirect the user to the login page
                        window.location.href = 'homepage.php';
                    };
                    xhr.send();
                }
            </script>
            
          </div>
        </div>
      </nav>
    
