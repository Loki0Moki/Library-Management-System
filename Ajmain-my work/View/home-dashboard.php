<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('Location: ../View/login.php');
    exit();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
    session_unset();
    session_destroy();
    header('Location: ../View/login.php');
    exit();
}
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Home Dashboard</title>
  <link rel="stylesheet" href="../Assets/dashboard.css" />
</head>
<body>
  <a href="../Controller/logout.php" style="position:absolute; top:10px; right:10px;">Logout</a>
  <h1>Home Dashboard</h1>
  <div class="widget" onclick="showDetails('Analytics Overview')" tabindex="0" role="button" onkeypress="if(event.key==='Enter'){showDetails('Analytics Overview')}">
    <h3>Analytics Overview</h3>
    <p>Key stats summary</p>
  </div>
  <div class="widget" onclick="showDetails('Quick Actions')" tabindex="0" role="button" onkeypress="if(event.key==='Enter'){showDetails('Quick Actions')}">
    <h3>Quick Actions</h3>
    <p>Access frequent tasks</p>
  </div>
  <script src="../Assets/dashboard.js"></script>
</body>
</html>
