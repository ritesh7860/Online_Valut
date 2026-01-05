<?php
include_once 'NavBar.php';
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About | freeSpace</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('s2.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: "Poppins", sans-serif;
      color: #d9e4f0;
      margin-top: 3%;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.7);
      min-height: 100vh;
      padding: 60px 15px;
    }

    .content-box {
      max-width: 900px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.08);
      padding: 40px 50px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    }

    h1 {
      color: #b0bed3;
      font-size: 2.3rem;
      text-align: center;
      margin-bottom: 20px;
      font-weight: 500;
      font-family: "Cursive", sans-serif;
    }

    hr {
      border-top: 2px solid #8899aa;
      width: 60%;
      margin: 20px auto 40px auto;
    }

    p {
      color: #d0d7e2;
      line-height: 1.7;
      font-size: 1rem;
    }

    h3 {
      color: #c8d8e8;
      margin-top: 30px;
      font-size: 1.5rem;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .content-box {
        padding: 25px 20px;
      }

      h1 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>
  <div class="overlay">
    <div class="content-box">
      <h1>About freeSpace</h1>
      <hr>

      <p>
        Welcome to <strong>freeSpace</strong> — a platform built to simplify digital access and collaboration.
        We’re dedicated to offering a clean, secure, and user-friendly experience for everyone.
      </p>

      <h3>Our Mission</h3>
      <p>
        Our mission is to empower individuals and teams by providing a reliable online environment
        where they can store, share, and manage data safely. We focus on privacy, accessibility, and seamless usability.
      </p>

      <h3>Our Vision</h3>
      <p>
        We envision a digital world where technology enhances productivity without compromising personal privacy.
        Through innovation and transparency, freeSpace aims to become a trusted digital companion.
      </p>

      <h3>Why Choose Us?</h3>
      <p>
        ✓ Simple and intuitive interface<br>
        ✓ Secure and privacy-focused<br>
        ✓ Regular updates and improvements<br>
        ✓ Responsive support and community engagement
      </p>

      <p>
        Thank you for being part of the freeSpace community — your trust inspires us to build a better online experience every day.
      </p>
    </div>
  </div>
</body>
</html>
