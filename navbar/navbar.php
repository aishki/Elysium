<?php 
    include("check.php");   
    $access = isset($_SESSION['access']) ? $_SESSION['access'] : "";
    // Get the current page URL
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="logo">
        <img src="../../Assets/logo.png" alt="Logo">  
    </div>

    <!-- dfgdfg -->
    
    <div class="nav-links">
        <a href="../../Home/default/home.php" class="nav-item <?php echo ($current_page == 'home.php') ? 'login' : ''; ?>">Home</a>
        <a href="#" class="nav-item">About</a>
        <a href="../../Task_Board/TB/taskboard.php" class="nav-item <?php echo ($current_page == 'taskboard.php') ? 'login' : ''; ?>">Task Board</a>
        <a href="#" class="nav-item">Events</a>

        <?php if ($access == ""): ?>
            <a href="../log-in/log-in.php" class="nav-item <?php echo ($current_page == 'log-in.php') ? 'login' : 'login'; ?>">Log-in</a>
        <?php else: ?>
            <?php if ($access == "Employer") : ?>
                <a href="../../Profile/Employer/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
            <?php elseif ($access == "Applicant"): ?>
                <a href="../../Profile/Applicant/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
            <?php elseif ($access == "Admin"): ?>
                <a href="../../Profile/Admin/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
            <?php else: 
                echo $access;
            endif; ?>
        <?php endif; ?>
    </div>
</nav>
