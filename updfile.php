<?php
include_once 'NavBar.php';
require_once "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FreeSpace | File Manager</title>

  <!-- Bootstrap 5 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

  <!-- Animate on Scroll -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

  <style>
    body {
      background: url('globe.png') center center / cover no-repeat fixed;
      font-family: 'Poppins', sans-serif;
      color: #eaf1f9;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
    }

    .heading {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 600;
      color: #b0bed3;
      margin-bottom: 40px;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
      animation: fadeInDown 1s ease-in-out;
    }

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

    .upload-card {
      background: rgba(0, 0, 0, 0.65);
      border-radius: 16px;
      padding: 40px 35px;
      max-width: 420px;
      width: 100%;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 35px rgba(0, 0, 0, 0.6);
      animation: fadeInUp 1s ease-in-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    label {
      font-weight: 500;
      color: #cfd9e5;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      border-radius: 8px;
      padding: 10px;
      transition: 0.3s ease;
    }

    .form-control:focus {
      border-color: #00bfff;
      box-shadow: 0 0 10px rgba(0, 191, 255, 0.5);
      background: rgba(255, 255, 255, 0.1);
    }

    .btn-upload {
      width: 100%;
      background: linear-gradient(45deg, #007bff, #00bfff);
      border: none;
      color: #fff;
      font-size: 17px;
      font-weight: 500;
      border-radius: 8px;
      padding: 10px 0;
      margin-top: 15px;
      transition: 0.3s;
    }

    .btn-upload:hover {
      transform: scale(1.03);
      background: linear-gradient(45deg, #00aaff, #0099ff);
    }

    .rocket {
      width: 130px;
      animation: float 3s ease-in-out infinite;
      display: block;
      margin: 0 auto 20px auto;
    }

    @keyframes float {
      0% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0);
      }
    }

    .status {
      text-align: center;
      margin-top: 15px;
      font-size: 15px;
    }

    @media (max-width: 768px) {
      .upload-card {
        margin: 20px;
        padding: 30px;
      }

      .heading {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <div class="heading animate__animated animate__fadeInDown">
    Go To Your Space
  </div>

  <div class="upload-card animate__animated animate__fadeInUp">
    <a href="ufiles.php">
      <img src="rocket.png" alt="Rocket" class="rocket">
    </a>
    <form enctype="multipart/form-data" method="post">
      <div class="mb-3">
        <label for="myfile" class="form-label">Select File</label>
        <input type="file" class="form-control" id="myfile" name="filename" required>
      </div>
      <button type="submit" name="sub" class="btn-upload">Upload File</button>
    </form>

    <div class="status">
      <?php
      extract($_REQUEST);
      if (isset($sub)) {

        $tmpPath = $_FILES['filename']['tmp_name'];
        $finalPath = "uploaded data/" . $_FILES['filename']['name'];
        $t = $_SESSION['filesize'] ?? 0;
        $remsize = 52428800 - $t;

        if ($_FILES['filename']['size'] <= $remsize) {
          if ($_FILES['filename']['error'] == 0) {
            move_uploaded_file($tmpPath, $finalPath);
            $imgpath = $finalPath;
            $size = $_FILES['filename']['size'];

            $qry = "INSERT INTO updfiles (email, filepath, size, date) VALUES ('$_SESSION[email]', '$imgpath', '$size', CURDATE())";
            $r = mysqli_query($link, $qry);

            if ($r) {
              echo "<span style='color:#00ff99;'>✅ File Uploaded Successfully!</span>";
            } else {
              echo "<span style='color:red;'>⚠️ Upload Failed. Try again later.</span>";
            }
          }
        } else {
          echo "<span style='color:orange;'>⚠️ File size exceeds remaining limit.</span>";
        }

        echo "<br><small style='color:#b0c7d1;'>Remaining space: " . round($remsize / 1024, 2) . " KB</small>";

        mysqli_close($link);
      }
      ?>
    </div>
  </div>

</body>

</html>
