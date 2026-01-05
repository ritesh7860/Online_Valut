<?php
include_once 'NavBar.php';
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - FreeSpace</title>

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
    body {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(30, 30, 30, 0.7)), url('s2.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #f5f7fa;
      font-family: 'Poppins', cursive;
      min-height: 100vh;
    }

    .heading {
      text-align: center;
      margin-top: 80px;
    }

    .heading h1 {
      font-size: 48px;
      font-weight: 600;
      color: #ffffff;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
    }

    hr {
      width: 100px;
      border-top: 4px solid #17a2b8;
      margin: 20px auto;
    }

    .task {
      text-align: center;
      margin: 50px auto;
      max-width: 700px;
      font-size: 18px;
      line-height: 1.8;
      background: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .developer-title {
      text-align: center;
      margin-top: 60px;
      color: #b0bed3;
    }

    .developer-cards {
      margin-top: 40px;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      color: #fff;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
    }

    .card img {
      border-radius: 50%;
      height: 100px;
      width: 100px;
      object-fit: cover;
      margin: 20px auto 10px;
    }

    .card-body {
      text-align: center;
    }

    footer {
      text-align: center;
      color: #9caebf;
      margin-top: 60px;
      padding-bottom: 30px;
    }
  </style>
</head>

<body>
  <div class="container">

    <!-- Heading -->
    <div class="heading">
      <h1>Who Are We!</h1>
      <hr>
    </div>

    <!-- About Section -->
    <div class="task">
      <h4>1. FreeSpace helps you securely store your personal and important data.</h4>
      <h4>2. Access your data from anywhere, anytime.</h4>
      <h4>3. We ensure top-notch security and privacy for your information.</h4>
    </div>

    <!-- Developer Section -->
    <div class="developer-title">
      <h2>FreeSpace Developers</h2>
      <hr>
    </div>

    <div class="row developer-cards justify-content-center">
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <img src="priyanshu.jpg" alt="Priyanshu">
          <div class="card-body">
            <h5>Priyanshu Agnihotri</h5>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <img src="pranjul.jpeg" alt="Pranjul">
          <div class="card-body">
            <h5>Pranjul Shrivastava</h5>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="https://cdn-icons-png.flaticon.com/512/847/847969.png">
          <div class="card-body">
            <h5>Sahil Shrivastava</h5>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <img src="ritesh.jpeg" alt="Ritesh">
          <div class="card-body">
            <h5>Ritesh Singh</h5>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <p>© 2025 FreeSpace | All rights reserved.</p>
    </footer>

  </div>
</body>

</html>
