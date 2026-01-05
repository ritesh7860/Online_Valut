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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

  <style>
    body {
      background: radial-gradient(circle at top, #0a0a0a, #000);
      font-family: 'Poppins', sans-serif;
      color: #eaf1f9;
      min-height: auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
    }

    .main {
      height: calc(100vh - 80px);
      margin-top: 80px;
      padding-bottom: 30px;
      display: flex;
      flex-direction: column;
      place-items: center;
      justify-content: center;
      gap: 5rem;
    }

    .heading {
      text-align: center;
      font-size: 3rem;
      font-weight: 600;
      color: #b0bed3;
      padding-bottom: 20px;
      text-shadow: 0 0 10px rgba(0, 191, 255, 0.4);
    }

    .file-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      justify-content: center;
    }

    .file-tile {
      position: relative;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 16px;
      padding: 30px;
      width: 255px;
      height: 230px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #dfe7f3;
      cursor: pointer;
      transition: 0.3s;
      backdrop-filter: blur(10px);
      overflow: hidden;
    }

    .file-tile:hover {
      transform: scale(1.05);
      border-color: #00bfff;
      box-shadow: 0 0 15px rgba(0, 191, 255, 0.4);
    }

    .file-tile i {
      font-size: 48px;
      color: #cfe8ff;
      margin-bottom: 15px;
      transition: color 0.3s;
    }

    .file-tile:hover i {
      color: #00bfff;
    }

    .file-tile span {
      font-size: 18px;
      font-weight: 500;
      color: #eaf1f9;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.75);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      border-radius: 16px;
    }

    .file-tile:hover .overlay {
      opacity: 1;
    }

    .overlay button {
      background: linear-gradient(45deg, #007bff, #00bfff);
      border: none;
      color: #fff;
      border-radius: 8px;
      padding: 10px 15px;
      margin: 8px 0;
      cursor: pointer;
      width: 120px;
      transition: 0.3s;
      font-weight: 500;
    }

    .overlay button:hover {
      background: linear-gradient(45deg, #0099ff, #00ccff);
      transform: scale(1.05);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(6px);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: rgba(20, 20, 20, 0.9);
      padding: 30px;
      border-radius: 16px;
      width: 90%;
      max-width: 400px;
      color: #fff;
      box-shadow: 0 0 25px rgba(0, 191, 255, 0.5);
      animation: fadeInUp 0.5s ease;
    }

    .close-btn {
      float: right;
      font-size: 22px;
      cursor: pointer;
      color: #bbb;
    }

    .close-btn:hover {
      color: #fff;
    }

    input[type=file] {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      color: #fff;
      margin-top: 10px;
    }

    .btn {
      background: linear-gradient(45deg, #007bff, #00bfff);
      border: none;
      color: #fff;
      border-radius: 8px;
      padding: 10px 15px;
      margin-top: 15px;
      cursor: pointer;
      width: 100%;
      transition: 0.3s;
    }

    button:hover {
      background: linear-gradient(45deg, #0099ff, #00ccff);
    }

    @keyframes fadeInUp {
      from {
        transform: translateY(40px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      .main{
        height: auto;
        margin-top: 80px;
        gap: 1rem;
        padding-bottom: 20px;
      }
      .file-grid {
        flex-direction: column;
        align-items: center;
        width: 100%;
      }

      .file-tile {
        width: 80%;
      }

      .heading {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <div class="main">
    <div class="heading">Your Space — Choose File Type</div>

  <div class="file-grid">
    <div class="file-tile">
      <i class="fa-solid fa-image"></i>
      <span>Images</span>
      <div class="overlay">
        <button class="btn" onclick="openModal('image')">Upload</button>
        <button class="btn" onclick="viewFiles('image')">View</button>
      </div>
    </div>

    <div class="file-tile">
      <i class="fa-solid fa-video"></i>
      <span>Videos</span>
      <div class="overlay">
        <button class="btn" onclick="openModal('video')">Upload</button>
        <button class="btn" onclick="viewFiles('video')">View</button>
      </div>
    </div>

    <div class="file-tile">
      <i class="fa-solid fa-file"></i>
      <span>PDFs</span>
      <div class="overlay">
        <button class="btn" onclick="openModal('pdf')">Upload</button>
        <button class="btn" onclick="viewFiles('pdf')">View</button>
      </div>
    </div>

    <div class="file-tile">
      <i class="fa-solid fa-music"></i>
      <span>Music</span>
      <div class="overlay">
        <button class="btn" onclick="openModal('audio')">Upload</button>
        <button class="btn" onclick="viewFiles('audio')">View</button>
      </div>
    </div>
  </div>

  </div>
  <!-- Modal Upload -->
  <div id="uploadModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3 id="modalTitle">Upload File</h3>
      <form enctype="multipart/form-data" method="post" onsubmit="return validateFile()">
        <input type="hidden" id="fileType" name="fileType" value="">
        <input type="file" name="filename" id="fileInput" required>
        <button class="btn" type="submit" name="sub">Upload</button>
      </form>

      <div style="margin-top:10px; text-align:center;">
        <?php
        if (isset($_POST['sub'])) {
          $fileType = $_POST['fileType'];
          $ext = strtolower(pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION));

          // Allowed types
          $allowed = [
            'image' => ['jpg', 'jpeg', 'png', 'gif'],
            'video' => ['mp4', 'mkv', 'mov', 'avi', 'webm'],
            'audio' => ['mp3', 'wav', 'ogg'],
            'pdf'   => ['pdf']
          ];

          if (!in_array($ext, $allowed[$fileType])) {
            // echo "<span style='color:red;'>⚠️ Invalid file type for $fileType upload.</span>";
          } else {
            $tmpPath = $_FILES['filename']['tmp_name'];
            $finalPath = "uploaded data/" . basename($_FILES['filename']['name']);
            $t = $_SESSION['filesize'] ?? 0;
            $remsize = 52428800 - $t;
            if ($_FILES['filename']['size'] <= $remsize) {
              if ($_FILES['filename']['error'] == 0) {
                move_uploaded_file($tmpPath, $finalPath);
                $size = $_FILES['filename']['size'];
                $email = $_SESSION['email'];
                $qry = "INSERT INTO updfiles (email, filepath, filetype, size, date) VALUES ('$email', '$finalPath', '$fileType', '$size', CURDATE())";
                $r = mysqli_query($link, $qry);
                if ($r) echo "<span style='color:#00ff99;'>✅ File Uploaded Successfully!</span>";
                else echo "<span style='color:red;'>⚠️ Upload Failed.</span>";
              }
            } else {
              echo "<span style='color:orange;'>⚠️ File size exceeds remaining limit.</span>";
            }
            echo "<br><small style='color:#b0c7d1;'>Remaining space: " . round($remsize / (1024 * 1024), 2) . " MB</small>";
            mysqli_close($link);
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script>
    let selectedType = "";

    function openModal(type) {
      selectedType = type;
      document.getElementById("uploadModal").style.display = "flex";
      document.getElementById("fileType").value = type;
      document.getElementById("modalTitle").innerText = "Upload " + type.toUpperCase();
    }

    function closeModal() {
      document.getElementById("uploadModal").style.display = "none";
    }

    function viewFiles(type) {
      window.location.href = "ufiles.php?type=" + type;
    }

    function validateFile() {
      const fileInput = document.getElementById("fileInput");
      const file = fileInput.files[0];
      if (!file) return true;

      const ext = file.name.split('.').pop().toLowerCase();

      const allowed = {
        image: ['jpg', 'jpeg', 'png', 'gif'],
        video: ['mp4', 'mkv', 'mov', 'avi', 'webm'],
        audio: ['mp3', 'wav', 'ogg'],
        pdf: ['pdf']
      };

      if (!allowed[selectedType].includes(ext)) {
        alert("❌ Invalid file type! Please upload " + selectedType.toUpperCase() + " only");
        return false;
      }

      return true;
    }

    window.onclick = function(event) {
      const modal = document.getElementById("uploadModal");
      if (event.target === modal) modal.style.display = "none";
    }
  </script>

</body>

</html>