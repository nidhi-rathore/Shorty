<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./assets/css/guest.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <?php
  include('./env.php');
  require('./admin/dBconn/database.php');

  $new_url = "";
  if (isset($_GET)) {
    $database = new Database();
    $db = $database->connect();

    foreach ($_GET as $key => $val) {
      $u = mysqli_real_escape_string($db, $key);
      $new_url = str_replace('/', '', $u);

    }

    $sql = "SELECT * from links WHERE shortenLink='" . $new_url . "'";
    $result = mysqli_query($db, $sql);


    if (mysqli_num_rows($result) > 0) {
      mysqli_query($db, "UPDATE total_clicks SET total_clicks = total_clicks+1 WHERE id=1");
      $row = mysqli_fetch_assoc($result);
      header("Location:" . $row['originalLink']);
    }
  }

  if (isset($_POST['submit'])) {
    $database = new Database();
    $db = $database->connect();

    $uno = "shorty";
    $username = "shorty";
    $linkIsFor = "guestUser";
    $originalLink = $_POST['originalLink'];
    $shortenLink = $_POST['shortenLink'];
    // $originalLink = $_POST['originalLink'];
    // $shortenLink = $_POST['shortenLink'];
    $shortenLink = explode(" ", $shortenLink);
    $shortenLink = join("_", $shortenLink);
    $finalLink = $env_domain . $shortenLink;
    if (filter_var($originalLink, FILTER_VALIDATE_URL)) {
      $query = "SELECT * from links WHERE shortenLink='" . $shortenLink . "'";
      $result = mysqli_query($db, $query);
      $count_rows = mysqli_num_rows($result);
      if ($count_rows > 0) {


        echo "  <script>
                              $(document).ready(function(){
                                  swal('Custom Name Not Available !!','','error');
                              });
                          </script>";


      } else {

        $query = "SELECT * FROM links WHERE uniqueNo='shorty' AND originalLink='" . $originalLink . "'";



        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        $count_rows = mysqli_num_rows($result);
        // echo "<br><br><br><br><br><br>adegsrdhgfjhgdgrearwethjyfgytrtwyjygj.".$query;
  

        $sql = "INSERT INTO `links` (`uniqueNo`,`linkIsFor`, `originalLink`, `shortenLink`) VALUES ('$uno','$linkIsFor', '$originalLink', '$shortenLink')";
        $result = mysqli_query($db, $sql);
        if ($result) {

          echo '<script>
              $(document).ready(function(){
                
              let generateShorty = document.querySelector("#generateShorty");
              let full_shortlink = "' . $env_domain . '";
              generateShorty.innerHTML = `

              <form class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                <input type="text" id="shortInput" disabled class="form-control" value="' . $finalLink . '" value=""/>
                <input class="btn btn-primary" type="button" onclick="copy()" id="copyBtn" value="Copy">
              </form>
                `;

                  let originalLink = document.querySelector("#originalLink").value;

                  var formData = new FormData();
                  formData.append("originalLink", originalLink);
  
});
</script>';


        } else {
          echo "  <script>
                                          $(document).ready(function(){
                                              swal('Try Again !!','','error');
                                          });
                                     </script>";


        }




      }









    } else {
      echo "  <script>
                          $(document).ready(function(){
                              swal('Enter Valid URL !!','','info');
                          });
                      </script>";


    }



    // echo "<br><br><br><br><br><br><br>eqfwgretgfnerwqedgnretrqthdgjrwteqwrhdgtehryw".$result;
  

  }
  ?>

  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <!-- importing the SEO FROM SEO.PHP FILE -->
  <?php include './includes/seo.php'; ?>

  <!-- Bootsrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <!-- Favicons -->
  <link href="./assets/img/logo.webp" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="./assets/css/shorty.css" rel="stylesheet" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <!-- =======================================================
  * Template Name: Logis - v1.1.0
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>

  </style>

</head>
<?php
// require('./admin/dBconn/database.php');
$database = new Database();
$db = $database->connect();
// echo "aefgsrdhtfjgk,hfrtwerfhjkgfdf".$db;
$random = bin2hex(random_bytes(3));
// $random = '209b01';

$sql = "SELECT * from links WHERE shortenLink='" . $random . "'";
$result = mysqli_query($db, $sql);
$rows = mysqli_num_rows($result);

$avail;
if ($rows == 0) {
  $avail = $random;

} else {
  $avail = bin2hex(random_bytes(3));
  ;
}
// echo $avail;



?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<body>

  <!-- importing the HEADER FROM HEADER PHP FILE -->
  <?php include './includes/header.php'; ?>


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6  order-lg-1 d-flex flex-column justify-content-center mt-0">
          <h2 data-aos="fade-up" class="m-t-p1">Shorty</h2>
          <div>
            <form id="formresp" class="form-search align-items-stretch mb-3 d-flex flex-column" method="POST"
              data-aos="fade-up" data-aos-delay="200">

              <h2 data-aos="fade-up" class="fs-2 my-2 aos-init aos-animate text-gray">Custom Link
              </h2>
              <hr class="text-gray">
              <div class="inputIconContainer" id="linkIcon">
                <label for="originalLink" class="sr-only-labels">Enter your original link: </label>
                <i class="bi bi-link-45deg"></i>
                <input type="text" id="originalLink" class="form-control mb-3 mt-3 fontSize9rem" placeholder="Your Link"
                  id="originalLink" name="originalLink"
                  onkeydown="if(event.keyCode === 13) { event.preventDefault(); generateCustomShorty(); }" />
              </div>

              <div class="inputIconContainer pl-0">
                <i class="bi bi-browser-chrome"></i>
                <span class="form-group mt-3 mb-4" id="formSpan">
                  <label for="shortenLink">
                    <p class="m-0 text-555 fw-900">
                      <?php echo $env_domain ?>
                    </p>
                  </label>
                  <span><input type="text" id="shortenLink" class="form-control m-0 p-0 fontSize9rem border-0"
                      placeholder="Custom Name" required id="shortenLink" name="shortenLink"
                      onkeydown="if(event.keyCode === 13) { event.preventDefault(); generateCustomShorty(); }" /></span>
                </span>

              </div>
              <div class="d-flex justify-content-between" id="buttonresp">
                <button type="button" class="btn btn-primary" id="generateRandom">Random Number</button>
                <button type="button" role="button" aria-describedby="Click this button to shorten your link"
                  class="btn btn-primary" name="" onclick="generateCustomShorty()" class="btn-get-started">Shorten
                  Link</button>


              </div>
            </form>
          </div>


          <div id="generateShorty"></div>


          <div class="row gy-4  h-0" data-aos="fade-up" data-aos-delay="400">
            <div class="col-lg-3 col-6">

            </div>
            <div class="col-lg-3 col-6">
            </div>

            <div class="col-lg-3 col-6">
            </div>
            <div class="col-lg-3 col-6">
            </div>
            <!-- End Stats Item -->
          </div>
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0 vert-move mobile-size m-t-p20" />

        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- importing the FOOTER CODE FROM FOOTER PHP FILE -->
  <?php include './includes/footer.php'; ?>


  <!-- importing the CHATBOX && SCROLL BUTTON FROM COMMON PHP FILE -->
  <?php include './includes/chatbotsidebar.php'; ?>

  <div id="preloader"></div>
  <!-- *************************** Generate Random Number   *****************************  -->

  <script>
    document.querySelector('#generateRandom').addEventListener('click', function () {
      var randNum = Array.from({ length: 6 }, () => Math.floor(Math.random() * 16).toString(16)).join('');
      // console.log(randNum);
      document.querySelector('#shortenLink').value = randNum;
    });
  </script>


  <!-- *************************** Block SpecialChar   *****************************  -->
  <script>
    $("#shortenLink").on("input", function () {
      var c = this.selectionStart,
        r = /[^a-z0-9 ]/gi,
        v = $(this).val();
      if (r.test(v)) {
        $(this).val(v.replace(r, ""));
        c--;
      }
      this.setSelectionRange(c, c);

    });
  </script>
  <!-- *************************** Block SpecialChar Ends  *****************************  -->

  <!-- *************************** Generate Random Number ends  *****************************  -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/shorty.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>

</body>

</html>