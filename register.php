
<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="mdbfolder/mdb.min.css">
<style>
  .header {
    background-color: black !important;
  }
  .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.02);
    transition: transform 0.2s;
  }
  .star-rating {
    color: gold;
  }
  .card-img {
    height: 200px;
  }
  .services {
    background-color: white; 
    background-repeat: no-repeat; 
    background-size: cover;
  }
  @media (min-width: 1200px) {
    .services {
      padding-top: 150px !important; 
    }
  }
  @media (max-width: 768px) {
    .services {
      padding-top: 100px; 
    }
  }
</style>

<body class="index-page">

<?php include "includes/topnav.php"; ?>

  <main class="main">
    <section class="services section">
      <div class="container">
        <div class="row">
          <!-- Add Login Form Here -->
          <div class="col-md-6 offset-md-3 mt-5 mb-5">
            <!-- Material form login -->
            <div class="card">
              <h2 class="card-header info-color white-text text-center py-4">
                <strong>Sign Up</strong>
              </h2>

              <!--Card content-->
              <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form style="color: #757575;" action="#!">

                <div class="md-form mt-2">
                  <label for="materialLoginFormPassword">Fullname</label>
                    <input type="text" id="materialLoginFormPassword" class="form-control" name="fullname">
                  </div>

                  <div class="md-form mb-2">
                  <label for="materialLoginFormEmail">E-mail</label>
                    <input type="email" id="materialLoginFormEmail" class="form-control" name="email">
                   
                  </div>

                  <div class="md-form mb-2">
                  <label for="materialLoginFormPassword">Birthday</label>
                    <input type="date" id="materialLoginFormPassword" class="form-control" name="bday">
                  </div>

                  
                  <div class="md-form mb-2">
                  <label for="materialLoginFormPassword">Password</label>
                    <input type="password" id="materialLoginFormPassword" class="form-control" name="pswd">
                  </div>

                  
                  <div class="md-form mb-2">
                  <label for="materialLoginFormPassword">Confirm Password</label>
                    <input type="password" id="materialLoginFormPassword" class="form-control" name="cpswd">
                  </div>

                  <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Signup</button>

                  <p>Already have an account?
                    <a href="get-started" >Signin</a>
                  </p>
                </form>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="mdbfolder/mdb.umd.min.js"></script>
</body>
</html>
