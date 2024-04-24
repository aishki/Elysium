<?php
include("check.php");
$access = isset($_SESSION['access']) ? $_SESSION['access'] : "";
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);

// Profile Picture
$user_role = isset($_SESSION['user_info']['user_type']) ? $_SESSION['user_info']['user_type'] : '';
$user_id = isset($_SESSION['user_info']['ID']) ? $_SESSION['user_info']['ID'] : '';
$user_ln = isset($_SESSION['user_info']['last_name']) ? $_SESSION['user_info']['last_name'] : '';


// Define target directory based on user role
if ($user_role == "Employer") {
    $target_dir = "../../Uploads/Employer/";
} elseif ($user_role == "Applicant") {
    $target_dir = "../../Uploads/Applicant/";
} else {
    // Default target directory if role is not defined or invalid
    $target_dir = "Uploads/";
}

// Define target file name including user ID, last name, and suffix
$target_file = $target_dir . $user_id . '_' . $user_ln . "_pp.jpg"; // Assuming profile pictures are always JPEG format

// Check if the file exists
if (file_exists($target_file)) {
    $profile_pic_src = $target_file;
} else {
    $profile_pic_src = "../../Assets/default_profile.jpg"; // Default profile picture path
}
?>

<!-- <link rel="stylesheet" href="../Assets/css/navbar_v2.css"> -->

<nav class="navbar">
    <section>
        <div class="logo">
            <a id="profileLink" href="#">
                <img src="<?php echo $profile_pic_src; ?>" id="output" width="150" style="border-radius: 50%;" />
            </a>
        </div>

        <a href="../../Home/default/dashboard.php" title="Dashboard" class="nav_label <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <svg fill="inherit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" id="dashboard" class="nav_icon glyph" stroke="#000000" height="20" width="18" s>
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_nav_iconCarrier">
                    <rect x="2" y="2" width="9" height="11" rx="2"></rect>
                    <rect x="13" y="2" width="9" height="7" rx="2"></rect>
                    <rect x="2" y="15" width="9" height="7" rx="2"></rect>
                    <rect x="13" y="11" width="9" height="11" rx="2"></rect>
                </g>
            </svg>
            <!-- <span class="nav_title">Dashboard</span> -->
        </a>

        <a href="../../Task_Board/tb/taskboard.php" title="Taskboard" class="nav_label<?php echo ($current_page == 'taskboard.php') ? ' active' : ''; ?>">
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="inherit" height="18" width="20">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <style type="text/css">
                        .st0 {
                            fill: inherit;
                        }
                    </style>
                    <g>
                        <path class="st0" d="M470.537,137.504H41.471C18.565,137.504,0,156.077,0,178.976v56.797l211.507,44.607V252.1h87.772v28.28 L512,235.489v-56.513C512,156.077,493.435,137.504,470.537,137.504z"></path>
                        <path class="st0" d="M299.279,369.129h-87.772v-57.017L14.633,273.012V439.81c0,22.898,18.557,41.47,41.455,41.47h399.824 c22.898,0,41.463-18.572,41.463-41.47V272.721l-198.096,39.39V369.129z"></path>
                        <rect x="233.452" y="274.044" class="st0" width="43.882" height="73.132"></rect>
                        <path class="st0" d="M193.786,72.206c0.008-1.703,0.638-3.057,1.75-4.208c1.127-1.103,2.49-1.718,4.176-1.734h112.577 c1.686,0.016,3.058,0.631,4.185,1.734c1.103,1.151,1.726,2.505,1.733,4.208v29.627h35.546V72.206 c0.008-11.41-4.665-21.875-12.143-29.329c-7.446-7.485-17.934-12.166-29.321-12.158H199.712 c-11.394-0.008-21.875,4.673-29.32,12.158c-7.47,7.454-12.158,17.918-12.135,29.329v29.627h35.529V72.206z"></path>
                    </g>
                </g>
            </svg>
            <!-- <span class="nav_title">Taskboard</span> -->
        </a>

        <a href="../../Event/e_con/events.php" title="Events" class="nav_label <?php echo ($current_page == 'events.php') ? 'active' : ''; ?>">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 452.986 452.986" xml:space="preserve" fill="inherit">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <g>
                                <path style="fill:inherit;" d="M404.344,0H48.642C21.894,0,0,21.873,0,48.664v355.681c0,26.726,21.894,48.642,48.642,48.642 h355.702c26.726,0,48.642-21.916,48.642-48.642V48.664C452.986,21.873,431.07,0,404.344,0z M148.429,33.629h156.043v40.337 H148.429V33.629z M410.902,406.372H42.041v-293.88h368.86V406.372z"></path>
                                <rect x="79.273" y="246.23" style="fill:inherit;" width="48.642" height="48.664"></rect>
                                <rect x="79.273" y="323.26" style="fill:inherit;" width="48.642" height="48.642"></rect>
                                <rect x="160.853" y="169.223" style="fill:inherit;" width="48.621" height="48.642"></rect>
                                <rect x="160.853" y="246.23" style="fill:inherit;" width="48.621" height="48.664"></rect>
                                <rect x="160.853" y="323.26" style="fill:inherit;" width="48.621" height="48.642"></rect>
                                <rect x="242.369" y="169.223" style="fill:inherit;" width="48.664" height="48.642"></rect>
                                <rect x="242.369" y="246.23" style="fill:inherit;" width="48.664" height="48.664"></rect>
                                <rect x="242.369" y="323.26" style="fill:inherit;" width="48.664" height="48.642"></rect>
                                <rect x="323.907" y="169.223" style="fill:inherit;" width="48.664" height="48.642"></rect>
                                <rect x="323.907" y="246.23" style="fill:inherit;" width="48.664" height="48.664"></rect>
                            </g>
                        </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                        <g> </g>
                    </g>
                </g>
            </svg>
            <!-- <span class="nav_title">Dashboard</span> -->
        </a>

        <a href="../../About/abt/about.php" title="About" class="nav_label <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
            <svg viewBox="0 0 24 24" fill="inherit" xmlns="http://www.w3.org/2000/svg" height="20" width="18">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75ZM12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z" fill="inherit"></path>
                </g>
            </svg>
            <!-- <span class="nav_title">Dashboard</span> -->
        </a>

        <!-- For Profile -->
        <?php if ($access == "") : ?>
            <a href="../log-in/log-in.php" class="nav_label">
                <img src="../../Assets/icons/profile_icon.svg" alt="Log-in" class="nav_icon">
                <span class="nav_title">Log-in</span>
            </a>
        <?php else : ?>
            <?php if ($access == "Employer") : ?>
                <a href="../../Profile/Employer/profile.php" title="Profile" class="nav_label <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                    <svg fill="inherit" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg" height="18" width="20">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                        </g>
                    </svg>
                    <!-- <span class="nav_title">Profile</span> -->
                </a>
            <?php elseif ($access == "Applicant") : ?>
                <a href="../../Profile/Applicant/profile.php" title="Profile" class="nav_label <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                    <svg fill="inherit" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg" height="18" width="20">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                        </g>
                    </svg>
                    <!-- <span class="nav_title">Profile</span> -->
                </a>
            <?php elseif ($access == "Admin") : ?>
                <a href="../../Profile/Admin/profile.php" title="Profile" class="nav_label">
                    <img src="../../Assets/icons/profile_icon.svg" alt="Profile" class="nav_icon">
                    <!-- <span class="nav_title">Profile</span> -->
                </a>
            <?php else :
                echo $access;
            endif; ?>
        <?php endif; ?>
    </section>
</nav>

<script>
    document.getElementById("output").addEventListener("click", function() {
        <?php if ($access == "Employer") : ?>
            window.location.href = "../../Profile/Employer/profile.php";
        <?php elseif ($access == "Applicant") : ?>
            window.location.href = "../../Profile/Applicant/profile.php";
        <?php endif; ?>
    });
</script>