<?php
session_start();
include_once 'NavBar.php';

$link = mysqli_connect("localhost", "root", "", "freespace");
if (!$link) die("Database connection failed!");

$email = $_SESSION['email'] ?? '';
if (!$email) {
    header("Location: login.php");
    exit;
}

// Get user info
$userQuery = "SELECT * FROM regdata WHERE email='$email'";
$userResult = mysqli_query($link, $userQuery);
$user = mysqli_fetch_assoc($userResult);

// Get file sizes
$fileQuery = "SELECT SUM(size) AS used FROM updfiles WHERE email='$email'";
$fileResult = mysqli_query($link, $fileQuery);
$fileData = mysqli_fetch_assoc($fileResult);

$totalSpace = 52428800; // 50MB
$usedSpace = $fileData['used'] ?? 0;
$freeSpace = $totalSpace - $usedSpace;
$usedPercent = round(($usedSpace / $totalSpace) * 100, 2);

// Update Name
if (isset($_POST['updateName'])) {
    $newName = mysqli_real_escape_string($link, $_POST['newName']);
    mysqli_query($link, "UPDATE regdata SET name='$newName' WHERE email='$email'");
    $_SESSION['name'] = $newName;
    echo "<script>alert('Name updated successfully!'); window.location.href='dashboard.php';</script>";
}

// Update Password
if (isset($_POST['updatePassword'])) {
    $newPass = mysqli_real_escape_string($link, $_POST['newPassword']);
    mysqli_query($link, "UPDATE regdata SET password='$newPass' WHERE email='$email'");
    echo "<script>alert('Password updated successfully!'); window.location.href='dashboard.php';</script>";
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FreeSpace | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #0a0a0a, #000);
            font-family: 'Poppins', sans-serif;
            color: #eaf1f9;
            margin: 0;
            padding-top: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            padding: 40px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 8px 30px rgba(0, 191, 255, 0.2);
            animation: fadeInUp 0.8s ease;
        }

        h2 {
            text-align: center;
            color: #00bfff;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .storage-box {
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
        }

        .progress-bar {
            height: 20px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress {
            height: 100%;
            width: <?= $usedPercent ?>%;
            background: linear-gradient(45deg, #00bfff, #007bff);
            transition: width 0.5s ease;
        }

        .info {
            margin-top: 10px;
            font-size: 15px;
        }

        .account-settings {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
        }

        .card h3 {
            color: #00bfff;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
        }

        input::placeholder {
            color: #aaa;
        }

        button {
            background: linear-gradient(45deg, #00bfff, #007bff);
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, #0099ff, #00ccff);
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

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 25px;
                width: 95%;
            }
        }
    </style>
</head>

<body>

    <div class="dashboard-container">
        <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>

        <!-- STORAGE INFO -->
        <div class="storage-box">
            <h3>Storage Overview</h3>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <div class="info">
                <p><b>Total:</b> <?= round($totalSpace / (1024 * 1024), 2) ?> MB</p>
                <p><b>Used:</b> <?= round($usedSpace / (1024 * 1024), 2) ?> MB (<?= $usedPercent ?>%)</p>
                <p><b>Free:</b> <?= round($freeSpace / (1024 * 1024), 2) ?> MB</p>
            </div>
        </div>

        <!-- ACCOUNT SETTINGS -->
        <div class="account-settings">
            <div class="card">
                <h3><i class="fa-solid fa-user"></i> Update Name</h3>
                <form method="post">
                    <input type="text" name="newName" placeholder="Enter new name" required>
                    <button type="submit" name="updateName">Update Name</button>
                </form>
            </div>

            <div class="card">
                <h3><i class="fa-solid fa-lock"></i> Change Password</h3>
                <form method="post">
                    <input type="password" name="newPassword" placeholder="Enter new password" required>
                    <button type="submit" name="updatePassword">Update Password</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
