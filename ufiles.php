<?php
session_start();
include_once 'NavBar.php';
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Uploads | FreeSpace</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #000 url('sky.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
            padding-top: 90px;
            margin: 0;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeIn 1.2s ease-in-out;
        }

        .file-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            padding: 0 5%;
        }

        .file-card {
            position: relative;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            overflow: hidden;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeUp 0.8s ease-in-out;
        }

        .file-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.8);
        }

        .file-card img,
        .file-card video,
        .file-card audio,
        .file-card iframe {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #111;
        }

        .file-card p {
            margin-top: 10px;
            font-weight: 500;
            font-size: 15px;
            color: #f0f0f0;
            word-break: break-word;
            padding-bottom: 15px;
        }

        /* Hover Overlay */
        .file-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: opacity 0.3s ease;
        }

        .file-card:hover .file-overlay {
            opacity: 1;
        }

        .file-btn {
            background-color: #0d6efd;
            border: none;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 14px;
        }

        .file-btn:hover {
            background-color: #0b5ed7;
        }

        .file-btn.delete {
            background-color: #dc3545;
        }

        .file-btn.delete:hover {
            background-color: #bb2d3b;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

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

        /* Responsive */
        @media (max-width: 600px) {

            .file-card img,
            .file-card video {
                height: 140px;
            }

            .file-btn {
                padding: 6px 10px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>Welcome to Your Uploads</h2>
            <p>Hover over a file to view, download, or delete it.</p>
        </div>

        <div class="file-gallery">
            <?php

            $email = $_SESSION['email'] ?? '';
            if ($email) {
                // $qry = "SELECT * FROM updfiles WHERE email='$email'";
                // $result = mysqli_query($link, $qry);

                $type = $_GET['type'] ?? ''; // Get file type from URL (e.g. image, video, pdf, audio)

                if ($type) {
                    $qry = "SELECT * FROM updfiles WHERE email='$email' AND filetype='$type'";
                } else {
                    $qry = "SELECT * FROM updfiles WHERE email='$email'";
                }

                $result = mysqli_query($link, $qry);

                if (mysqli_num_rows($result) > 0) {
                    while ($file = mysqli_fetch_assoc($result)) {
                        $filepath = $file['filepath'];
                        $filename = basename($filepath);
                        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

                        // Preview based on file type
                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                            $preview = "<img src='$filepath' alt='Image'>";
                        } elseif (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                            $preview = "<video src='$filepath' controls></video>";
                        } elseif ($ext === 'pdf') {
                            $preview = "<iframe src='$filepath' frameborder='0'></iframe>";
                        } elseif (in_array($ext, ['mp3', 'wav'])) {
                            $preview = "<audio controls><source src='$filepath'></audio>";
                        } else {
                            $preview = "<div style='height:180px;display:flex;align-items:center;justify-content:center;background:#111;'>Unknown file</div>";
                        }

                        echo "
                        <div class='file-card'>
                            $preview
                            <div class='file-overlay'>
                                <button class='file-btn' onclick=\"viewFile('$filepath')\">View</button>
                                <a href='$filepath' download class='file-btn'>Download</a>
                                <form method='post' style='display:inline;' onsubmit='return confirm('Do you really want to delete this file?');'>
                                    <input type='hidden' name='delete_file' value='$filepath'>
                                    <button type='submit' class='file-btn delete'>Delete</button>
                                </form>
                            </div>
                            <p>$filename</p>
                        </div>
                        ";
                    }
                } else {
                    echo "<p style='text-align:center; color:#ccc;'>No files uploaded yet.</p>";
                }
            } else {
                echo "<p style='text-align:center; color:#ccc;'>Please log in to view your files.</p>";
            }

           // Delete functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_file'])) {
    $deleteFile = $_POST['delete_file'];

    // Delete record from database
    $delQry = "DELETE FROM updfiles WHERE email='$email' AND filepath='$deleteFile'";
    mysqli_query($link, $delQry);

    // Delete physical file
    if (file_exists($deleteFile)) {
        unlink($deleteFile);
    }

    // Redirect to refresh page after deletion
    $type = $_GET['type'] ?? '';
    echo "<script>
        alert('File deleted successfully!');
        window.location.href = 'ufiles.php?type=' + '$type';
    </script>";
}
            ?>
        </div>
    </div>

    <script>
        function viewFile(path) {
            const ext = path.split('.').pop().toLowerCase();
            let content = '';

            if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                content = `<img src="${path}" style="width:100%;border-radius:10px;">`;
            } else if (['mp4', 'webm', 'ogg'].includes(ext)) {
                content = `<video controls style="width:100%;border-radius:10px;"><source src="${path}"></video>`;
            } else if (ext === 'pdf') {
                content = `<iframe src="${path}" style="width:100%;height:80vh;border:none;"></iframe>`;
            } else if (['mp3', 'wav'].includes(ext)) {
                content = `<audio controls style="width:100%;"><source src="${path}"></audio>`;
            } else {
                content = `<p>Preview not available</p>`;
            }

            const modalWindow = window.open('', '_blank', 'width=800,height=600');
            modalWindow.document.write(`
                <html>
                <head><title>Preview</title></head>
                <body style="margin:0;background:#000;display:flex;align-items:center;justify-content:center;">${content}</body>
                </html>
            `);
        }
    </script>

</body>

</html>