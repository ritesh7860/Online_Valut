<?php
require_once "db.php";
include_once 'NavBar.php';


extract($_REQUEST);
if (isset($logBtn)) {
  $qry = "SELECT email, name FROM regdata WHERE email='$umail' AND password='$pass'";
  $r = mysqli_query($link, $qry);
  $c = mysqli_num_rows($r);
  if ($c == 1) {
    $row = mysqli_fetch_assoc($r);
    $qry = "SELECT SUM(size) FROM updfiles WHERE email='$umail'";
    $r2 = mysqli_query($link, $qry);
    $a = mysqli_fetch_row($r2);
    session_start();
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $umail;
    $_SESSION['filesize'] = $a[0];
    header("location:Multimedia.php");
    exit;
  } else {
    $error = "Invalid email or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | FreeSpace</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('login-bg.jpg') no-repeat center center/cover;
      font-family: "Poppins", sans-serif;
      color: #fff;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.7);
      position: absolute;
      inset: 0;
      z-index: -1;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 18px;
      backdrop-filter: blur(12px);
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
      padding: 50px 40px;
      width: 100%;
      max-width: 420px;
      animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-card img {
      width: 90px;
      display: block;
      margin: 0 auto 15px;
      filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.3));
    }

    .login-card h2 {
      text-align: center;
      color: #a6dcef;
      font-size: 1.9rem;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .login-card p {
      text-align: center;
      color: #cfd8dc;
      margin-bottom: 25px;
      font-size: 0.95rem;
    }

    .form-control {
      background-color: transparent;
      border: 1px solid #4b5563;
      color: #e0e0e0;
      border-radius: 10px;
      padding: 12px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: #b0b0b0;
    }

    .form-control:focus {
      border-color: #88c0d0;
      box-shadow: 0 0 8px rgba(136, 192, 208, 0.5);
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
    }

    .btn-login {
      background: linear-gradient(135deg, #88c0d0, #5e81ac);
      color: #1b1b1b;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1rem;
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      transition: 0.3s;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #a6dcef, #81a1c1);
      color: #000;
    }

    .error-msg {
      color: #ffb3b3;
      text-align: center;
      font-weight: 500;
      margin-bottom: 10px;
    }

    .links {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .links a {
      color: #a6dcef;
      text-decoration: none;
      transition: color 0.3s;
    }

    .links a:hover {
      color: #81a1c1;
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 35px 25px;
      }
    }
  </style>

  <script>
    function validateForm() {
      let email = document.forms["frm1"]["umail"].value;
      let pass = document.forms["frm1"]["pass"].value;
      let valid = true;

      document.getElementById("emailError").innerHTML = "";
      document.getElementById("passError").innerHTML = "";

      if (email.trim() === "") {
        document.getElementById("emailError").innerHTML = " Enter Email";
        valid = false;
      }
      if (pass.trim() === "") {
        document.getElementById("passError").innerHTML = " Enter Password";
        valid = false;
      }

      return valid;
    }
  </script>
</head>

<body>
  <div class="overlay"></div>

  <div class="login-card">
    <img src="login icon.png" alt="Login Icon">
    <h2>Welcome Back</h2>
    <p>Access your FreeSpace account</p>
    <form name="frm1" method="post" onsubmit="return validateForm()">
      <div class="mb-3">
        <input type="email" class="form-control" name="umail" placeholder="Email">
        <small id="emailError" class="text-danger"></small>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" name="pass" placeholder="Password">
        <small id="passError" class="text-danger"></small>
      </div>


      <?php if (isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

      <button type="submit" name="logBtn" class="btn-login">Login</button>
    </form>

    <div class="links">
      <a href="#">Forgot Password?</a><br>
      Don’t have an account? <a href="FreeSpace.php">Sign Up</a>
    </div>
  </div>
</body>
</html>
