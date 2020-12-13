<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: /');
  exit;
}

print_r("<pre>" . print_r($_SESSION, 4) . "</pre>");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Certificate | Technoforum</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- TailWind CSS -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="/">Techno Forum</a></h1>
      <!-- <a href="/" class="logo mr-auto"><img src="/assets/img/favicon.png" alt="" class="img-fluid"></a> -->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!-- <li class="active"><a href="index.html">Home</a></li> -->
          <li><a href="/projects">Projects</a></li>
          <li><a href="/events">Events</a></li>
          <li><a href="/news-and-announcements">News & Announcements</a></li>
          <li><a href="/team">Team</a></li>
          <li><a href="/alumni">Alumni</a></li>
          <li><a href="/contact">Contact</a></li>
          <li><a href="/about">About</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Generate Certificate</li>
        </ol>
        <h2>Generate Certificate</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Project Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="footer-newsletter container">

        <div class="portfolio-description pt-0">

          <div class="row justify-content-center">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
              <form method="POST" id="generateCertificateForm">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="awardedTo">Awarded to</label>
                    <input type="text" class="form-control" name="awardedTo" id="awardedTo" placeholder="Enter the Awardee's Name" value="Test">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" name="position" id="position" placeholder="Enter the Position" value="Test">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="competitionName">Competition Name</label>
                    <input type="text" class="form-control" name="competitionName" id="competitionName" placeholder="Enter the Competition Name" value="Test">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="certificateId">Certificate ID</label>
                    <input type="text" class="form-control" name="certificateId" id="certificateId" placeholder="Enter the Certificate Id" value="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="competitionDate">Competition Date</label>
                    <input type="date" class="form-control" name="competitionDate" id="competitionDate" placeholder="Enter the Competition Date" value="">
                  </div>
                </div>
                <input type="hidden" name="action" value="generateCertificate">
                <button type="submit" class="btn btn-primary btn-block" id="generateCertificate">Generate Certificate</button>
              </form>
            </div>
            <div class="col-md-2">

            </div>
            <div class="mt-4">
              <a id="certificateImageUrl" download>
                <img width="450" id="certificateImage" src="/assets/img/empty_certificate.svg" class="img-fluid">
                <div class="logs" style="font-size: larger;">

                </div>
              </a>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Project Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Join our newsletter to recieve latest updates directly in your Inbox.</p>
            <form action="" method="post">
              <input type="email" name="email">
              <input type="submit" value="Subscribe" placeholder="Enter your Email">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Techno forum</h3>
            <p>
              Technoforum Society<br>
              BIAS, Bhimtal, Nanital 263136<br>
              Uttarakhand <br><br>
              <strong>Phone:</strong> +91 9876543210<br>
              <strong>Email:</strong> techno@birlainstitute.co.in<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Projects</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Events</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Team</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contact us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Fields</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Competitive Coding</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Robotics</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Internet of Things</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Cyber Security</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Technoforum is a professional , non-profit , Technical Society of Birla Institute of Applied Sciences , Bhimtal. First established in 2007 , with a view to enlarge the activities to advance the cause of technological education in the
              institute. Techno-Forum has an active membership of more than 200 in the institute itself.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Technoforum</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="/team">TF Web Dev Team</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>
  <script src="/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/vendor/venobox/venobox.min.js"></script>
  <script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <script type="text/javascript">

    $("#generateCertificate").on('click', (function(event) {
      event.preventDefault();

        let fd = new FormData(document.querySelector('#generateCertificateForm'));
        $.ajax({
          url: "make.php",
          type: "POST",
          data: fd,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {},
          success: function(data) {
            if(data.status == 'success') {
              $('#certificateImage').attr('width',  '850');
              $('#certificateImage').attr('src',  '/certificate/certificates/' + data.image);
              $('#certificateImageUrl').attr('href',  '/certificate/certificates/' + data.image);
              $('.logs').html(``);
            } else {
              $('#certificateImage').attr('width',  '450');
              $('#certificateImage').attr('src',  '/assets/img/empty.svg');
              $('.logs').html(`<h1 class="text-bold text-danger text-center">This Certificate ID already exists.</h1>`);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });
    }));
  </script>

</body>

</html>
