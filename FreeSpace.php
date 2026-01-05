<?php
include_once 'NavBar.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
extract($_REQUEST);

if (isset($btn)) {
  $link = mysqli_connect("localhost", "root", "", "freespace");
  if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  // Check if email already exists
  $check = mysqli_query($link, "SELECT * FROM regdata WHERE email='$mail'");
  if (mysqli_num_rows($check) > 0) {
    $error1 = "⚠️ This email is already registered.";
  } else {
    $qry = "INSERT INTO regdata (name, email, password) VALUES ('$fnm', '$mail', '$pwd1')";
    $r = mysqli_query($link, $qry);

    if ($r) {
      $error = "✅ Your account has been created successfully!";
    } else {
      $error1 = "⚠️ Error: Try again later.";
    }
  }

  mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FreeSpace | Create Account</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

  <!-- JS Validation -->
  <script type="text/javascript">
    function f() {
      let result = true;
      let name = document.frm.fnm.value.trim();
      let email = document.frm.mail.value.trim();
      let pwd = document.frm.pwd1.value.trim();

      document.getElementById('nm1').innerHTML = "";
      document.getElementById('mL').innerHTML = "";
      document.getElementById('pw').innerHTML = "";

      if (name === "") {
        document.getElementById('nm1').innerHTML = "* Please enter your name";
        result = false;
      }
      if (email === "") {
        document.getElementById('mL').innerHTML = "* Please enter your email";
        result = false;
      }
      if (pwd === "") {
        document.getElementById('pw').innerHTML = "* Please enter your password";
        result = false;
      }
      return result;
    }
  </script>

  <style>
    body {
      background: url('login-bg.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
      color: #f5f7fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }
    .overlay {
      background: rgba(34, 33, 33, 0.7);
      position: absolute;
      inset: 0;
      z-index: -1;
    }

    main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 15px;
    }

    /* Fade-in and scale animation */
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .register-card {
      background: rgba(0, 0, 0, 0.75);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 16px;
      padding: 40px 45px;
      width: 100%;
      max-width: 420px;
      backdrop-filter: blur(8px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
      text-align: left;
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards;
    }

    .register-card h2 {
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
      color: #ffffff;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.05);
      border: 1px solid #3b444b;
      color: #f5f7fa;
      font-size: 15px;
      padding: 10px 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      color: #fff;
      border-color: #1cb0f6;
      box-shadow: 0 0 10px rgba(28, 176, 246, 0.5);
      background-color: rgba(255, 255, 255, 0.1);
    }

    .form-control::placeholder {
      color: #bbb;
    }

    .error-text {
      color: #fc8d8dff;
      font-size: 14px;
      margin-top: 5px;
    }

    .btn-create {
      background: linear-gradient(45deg, #00bfff, #007bff);
      border: none;
      color: #fff;
      font-size: 17px;
      font-weight: 500;
      padding: 10px 0;
      border-radius: 8px;
      margin-top: 20px;
      transition: all 0.3s ease;
      width: 100%;
      box-shadow: 0 0 10px rgba(0, 191, 255, 0.4);
    }

    .btn-create:hover {
      background: linear-gradient(45deg, #0099ff, #00ccff);
      transform: translateY(-2px) scale(1.03);
      box-shadow: 0 0 15px rgba(0, 191, 255, 0.6);
    }

    .login-link {
      text-align: center;
      margin-top: 18px;
      font-size: 15px;
      color: #d0e2f5;
      opacity: 0;
      animation: fadeInUp 0.8s ease 0.3s forwards;
    }

    .login-link a {
      color: #1cb0f6;
      text-decoration: none;
      font-weight: 500;
    }

    .error-msg {
      color:limegreen; 
      font-size:17px;
      text-align: center;
      font-weight: 500;
      margin-bottom: 10px;
      margin-top: 10px;
    }
      .error-msg1 {
      color:#ffb3b3; 
      font-size:17px;
      text-align: center;
      font-weight: 500;
      margin-bottom: 10px;
      margin-top: 10px;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      color: #9caebf;
      margin-top: 40px;
      padding-bottom: 30px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .register-card {
        padding: 30px 25px;
        width: 100%;
        max-width: 90%;
      }
    }
  </style>
</head>

<body>
    <div class="overlay"></div>

  <main>
    <div class="register-card">
      <h2>Create Your Own Space</h2>
      <form method="post" name="frm" onsubmit="return f()">
        <div class="form-group">
          <label for="fnm">Full Name</label>
          <input type="text" class="form-control" name="fnm" placeholder="Enter your full name">
          <span id="nm1" class="error-text"></span>
        </div>

        <div class="form-group">
          <label for="mail">Email Address</label>
          <input type="email" class="form-control" name="mail" placeholder="Enter your email">
          <span id="mL" class="error-text"></span>
        </div>

        <div class="form-group">
          <label for="pwd1">Password</label>
          <input type="password" class="form-control" name="pwd1" placeholder="Create password">
          <span id="pw" class="error-text"></span>
        </div>

        <button type="submit" name="btn" class="btn-create">Create Account</button>
        <?php if (isset($error)) echo "<div class='error-msg'>$error</div>"; ?>
        <?php if (isset($error1)) echo "<div class='error-msg1'>$error1</div>"; ?>

        <div class="login-link">
          Already have an account? <a href="login.php">Login here</a>
        </div>
      </form>
    </div>
  </main>

</body>

</html>
