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
  <title>Contact Us | FreeSpace</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <style>
    /* Background and Base Layout */
    body {
      background: url('s2.jpg') center center / cover no-repeat fixed;
      color: #b0bed3;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      margin-top: 5%;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    /* Page Title */
    .page-title {
      text-align: center;
      font-size: 38px;
      font-weight: 500;
      font-family: cursive;
      margin-top: 80px;
      color: #d4e1f5;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
      animation: fadeInDown 1.2s ease;
    }

    /* Container for cards */
    .container-custom {
      flex: 1;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      align-items: flex-start;
      padding: 60px 8%;
      animation: fadeIn 2s ease;
    }

    /* Contact Cards */
    .contact-card {
      background: rgba(0, 0, 0, 0.6);
      border-radius: 12px;
      padding: 30px 35px;
      width: 320px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(6px);
      margin-bottom: 30px;
      transition: 0.3s ease;
      opacity: 0;
      transform: translateY(50px);
      animation: slideUp 1.2s ease forwards;
    }

    .contact-card:nth-child(1) {
      animation-delay: 0.3s;
    }

    .contact-card:nth-child(2) {
      animation-delay: 0.6s;
    }

    .contact-card:nth-child(3) {
      animation-delay: 0.9s;
    }

    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.7);
    }

    .contact-card h2 {
      color: #e5edff;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .contact-card hr {
      border: 1px solid rgba(255, 255, 255, 0.2);
      margin-bottom: 20px;
    }

    .contact-info {
      line-height: 1.8;
      font-size: 16px;
    }

    .social-icons img {
      margin-right: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    .social-icons img:hover {
      transform: scale(1.2);
    }

    /* Form elements */
    select,
    input[type="text"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: none;
      margin-top: 10px;
      margin-bottom: 15px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #d9e2f2;
    }

    select:focus,
    input[type="text"]:focus {
      outline: none;
      box-shadow: 0 0 8px #1cb0f6;
    }

    input[type="submit"] {
      background: linear-gradient(45deg, #00bfff, #007bff);
      border: none;
      padding: 8px 0;
      width: 100%;
      color: #fff;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: 0.3s;
    }

    input[type="submit"]:hover {
      background: linear-gradient(45deg, #0099ff, #00ccff);
      transform: scale(1.03);
    }

    /* Footer */
    footer {
      text-align: center;
      color: #9caebf;
      padding: 30px 0;
      font-size: 14px;
    }

    /* Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container-custom {
        flex-direction: column;
        align-items: center;
        padding: 40px 20px;
      }

      .page-title {
        font-size: 30px;
      }
    }
  </style>
</head>

<body>

  <div class="page-title">
    Have Some Questions?
  </div>

  <div class="container-custom">

    <!-- Contact Info -->
    <div class="contact-card">
      <h2>Contact Us</h2>
      <hr>
      <div class="contact-info">
        <p>📞 +512-9673-2345</p>
        <p>📞 +512-9873-0987</p>
        <div class="social-icons mt-2">
          <img src="facebook.png" width="25" height="25">
          <img src="twitter.png" width="25" height="25">
          <img src="linkedin.png" width="25" height="25">
        </div>
      </div>
    </div>

    <!-- Problem Form -->
    <div class="contact-card">
      <h2>Any Problem?</h2>
      <hr>
      <form>
        <select>
          <option value="">-- Select Issue --</option>
          <option>Privacy Issue</option>
          <option>Forgot Password</option>
          <option>Want To Leave Your Space</option>
        </select>
        <input type="submit" value="GO">
      </form>
    </div>

    <!-- Feedback Form -->
    <div class="contact-card">
      <h2>Feedback</h2>
      <hr>
      <form>
        <input type="text" name="ftext" placeholder="We appreciate your feedback...">
        <input type="submit" value="GO">
      </form>
    </div>

  </div>

  <footer>
    © <?php echo date('Y'); ?> FreeSpace. All Rights Reserved.
  </footer>

</body>

</html>
