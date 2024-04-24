<?php
// Start the session
session_start();

// // Check if the user is already logged in
// if (isset($_SESSION['user_info'])) {
//     // If logged in, redirect to the home page
//     header("Location: ../default/home.php");
//     exit(); // Stop further execution
// }

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="Assets/css/navbar.css">
    <link rel="stylesheet" href="Assets/css/index.css">
</head>

<?php
include("navbar/check.php");
$access = isset($_SESSION['access']) ? $_SESSION['access'] : "";
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);
?>



<body class="default">
    <nav class="navbar">
        <div class="logo">
            <img src="Assets/logo.png" alt="Logo">
        </div>

        <!-- dfgdfg -->

        <div class="nav-links">
            <a href="Home/default/home.php" class="nav-item <?php echo ($current_page == 'home.php') ? 'login' : ''; ?>">Home</a>
            <a href="About/abt/about.php" class="nav-item">About</a>
            <a href="Task_Board/tb/taskboard.php" class="nav-item <?php echo ($current_page == 'taskboard.php') ? 'login' : ''; ?>">Task Board</a>
            <a href="Event/e_con/events.php" class="nav-item">Events</a>

            <?php if ($access == "") : ?>
                <a href="Home/log-in/log-in.php" class="nav-item <?php echo ($current_page == 'log-in.php') ? 'login' : 'login'; ?>">Log-in</a>
            <?php else : ?>
                <?php if ($access == "Employer") : ?>
                    <a href="Profile/Employer/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
                <?php elseif ($access == "Applicant") : ?>
                    <a href="Profile/Applicant/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
                <?php elseif ($access == "Admin") : ?>
                    <a href="Profile/Admin/profile.php" class="nav-item <?php echo ($current_page == 'profile.php') ? 'login' : ''; ?>">Profile</a>
                <?php else :
                    echo $access;
                endif; ?>
            <?php endif; ?>
        </div>
    </nav>

    <div class="part d1">
        <p>Elevate Your Career to </p>
        <h1>Elysium</h1>

        <p class="sub">Where Dreams Meet Opportunities!</p>
    </div>

    <div class="part d2">
        <p>Key Features</p>

        <div class="flex">
            <div class="e-card playing">
                <div class="image"></div>

                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>

                <div class="infotop">

                    <svg fill="#ffffff" class="icon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 442.548 442.548" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path d="M415.264,168.488L382.837,48.455c-0.996-3.667-2.532-7.13-4.381-10.391c2.745-3.927,4.381-8.685,4.381-13.839 C382.837,10.843,371.985,0,358.612,0H81.106c-13.38,0-24.219,10.848-24.219,24.225c0,6.695,2.708,12.752,7.107,17.141 c-1.806,3.198-3.299,6.604-4.272,10.197L27.299,171.596c-4.389,16.251,1.987,29.967,14.479,33.234v237.717h361.037V200.933 C413.891,196.735,419.39,183.796,415.264,168.488z M311.258,68.569l27.398,101.416c0.421,1.579,1.051,3.092,1.652,4.61 c-12.236,20.033-30.014,28.733-49.385,23.915c-17.005-4.219-28.87-17.269-29.127-26.525V73.243c0-1.598-0.241-3.139-0.477-4.673 H311.258z M103.908,173.098l28.234-104.529h47.541c-0.241,1.535-0.476,3.075-0.476,4.673V173.84l-0.061-0.03 c-11.304,21.382-28.776,30.925-47.913,26.17c-15.863-3.934-26.922-16.183-26.922-24.706h-1.193 C103.371,174.54,103.705,173.845,103.908,173.098z M300.752,417.874H105.97v-77.91h34.955c3.35-7.561,10.891-12.849,19.699-12.849 c8.794,0,16.345,5.288,19.689,12.849h71.141c1-10.977,10.128-19.601,21.367-19.601c11.229,0,20.361,8.624,21.356,19.601h6.578 v77.91H300.752z M146.076,311.915c0-8.384,6.807-15.188,15.195-15.188s15.189,6.805,15.189,15.188c0,8.396-6.801,15.2-15.189,15.2 S146.076,320.311,146.076,311.915z M258.272,305.163c0-8.384,6.802-15.191,15.189-15.191c8.39,0,15.192,6.808,15.192,15.191 c0,8.393-6.803,15.2-15.192,15.2C265.074,320.363,258.272,313.556,258.272,305.163z M384.119,423.85h-23.893V266.213H85.977V423.85 h-25.5V205.851l5.489,0.106c12.99,0.263,26.539-9.498,33.877-23.064c4.192,10.142,15.936,19.68,29.899,23.145 c2.726,0.675,6.534,1.337,11,1.337c11.003,0,25.98-4.047,38.511-21.787c0.236,16.906,14.052,24.52,31.12,24.52h20.256 c14.72,0,26.972-10.235,30.244-23.953c6.029,8.292,16.558,15.436,28.558,18.408c2.917,0.727,7.004,1.434,11.781,1.434 c12.088,0,28.635-4.578,42.273-24.818c7.483,12.832,20.562,21.91,33.108,21.665l7.526-0.146V423.85z"></path>
                            </g>
                        </g>
                    </svg><br>
                    Freelance Marketplace
                    <br>
                    <div class="name">Post or Apply freelance work </div>
                </div>
            </div>

            <div class="e-card playing">
                <div class="image"></div>

                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>

                <div class="infotop">

                    <svg class="icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: #ffffff;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M259.993,460.958c14.498,14.498,75.487-23.002,89.985-37.492l59.598-59.606l-52.494-52.485l-59.597,59.597 C282.996,385.462,245.504,446.46,259.993,460.958z"></path>
                                <path class="st0" d="M493.251,227.7c-14.498-14.49-37.996-14.49-52.485,0l-71.68,71.678l52.494,52.486l71.671-71.68 C507.741,265.695,507.741,242.198,493.251,227.7z M399.586,308.882l-9.008-8.999l50.18-50.18l8.991,8.99L399.586,308.882z"></path>
                                <path class="st0" d="M374.714,448.193c-14.071,14.055-67.572,51.008-104.791,51.008c-0.008,0,0,0-0.008,0 c-17.47,0-28.484-7.351-34.648-13.516c-44.758-44.775,36.604-138.56,37.492-139.439l4.123-4.124 c-3.944-4.354-5.644-10.348-5.644-22.302c0-8.836,0-25.256,0-40.403c11.364-12.619,15.497-11.048,25.103-60.596 c19.433,0,18.178-25.248,27.34-47.644c7.479-18.238,1.212-25.632-5.072-28.655c5.14-66.463,5.14-112.236-70.296-126.435 c-27.349-23.438-68.606-15.48-88.158-11.57c-19.536,3.911-37.159,0-37.159,0l3.355,31.49 C97.74,70.339,112.05,116.112,107.44,142.923c-5.994,3.27-11.407,10.809-4.269,28.254c9.17,22.396,7.906,47.644,27.339,47.644 c9.614,49.548,13.747,47.976,25.111,60.596c0,15.148,0,31.567,0,40.403c0,25.248-8.58,25.684-28.134,36.612 c-47.14,26.35-108.572,41.659-119.571,124.01C5.902,495.504,92.378,511.948,213.434,512 c121.04-0.052,207.524-16.496,205.518-31.558c-3.168-23.702-10.648-41.547-20.68-55.806L374.714,448.193z"></path>
                            </g>
                        </g>
                    </svg><br>
                    Registration
                    <br>
                    <div class="name"> Click <a href="Home/regis/register.php">here</a> to register! </div>
                </div>
            </div>

            <div class="e-card playing">
                <div class="image"></div>

                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>

                <div class="infotop">

                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M11 20H19C20.1046 20 21 19.1046 21 18V6C21 4.89543 20.1046 4 19 4H11M3 12H14M14 12L11 15M14 12L11 9" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <br>
                    Log-in
                    <br>
                    <div class="name"> Click <a href="Home/log-in/log-in.php">here</a> to log-in! </div>
                </div>
            </div>

            <div class="e-card playing">
                <div class="image"></div>

                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>

                <div class="infotop">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="icon">
                        <path fill="currentColor" d="M19.4133 4.89862L14.5863 2.17544C12.9911 1.27485 11.0089 1.27485 9.41368 2.17544L4.58674
                4.89862C2.99153 5.7992 2 7.47596 2 9.2763V14.7235C2 16.5238 2.99153 18.2014 4.58674 19.1012L9.41368
                21.8252C10.2079 22.2734 11.105 22.5 12.0046 22.5C12.6952 22.5 13.3874 22.3657 14.0349 22.0954C14.2204
                22.018 14.4059 21.9273 14.5872 21.8252L19.4141 19.1012C19.9765 18.7831 20.4655 18.3728 20.8651
                17.8825C21.597 16.9894 22 15.8671 22 14.7243V9.27713C22 7.47678 21.0085 5.7992 19.4133 4.89862ZM4.10784
                14.7235V9.2763C4.10784 8.20928 4.6955 7.21559 5.64066 6.68166L10.4676 3.95848C10.9398 3.69152 11.4701
                3.55804 11.9996 3.55804C12.5291 3.55804 13.0594 3.69152 13.5324 3.95848L18.3593 6.68166C19.3045 7.21476
                19.8922 8.20928 19.8922 9.2763V9.75997C19.1426 9.60836 18.377 9.53091 17.6022 9.53091C14.7929 9.53091
                12.1041 10.5501 10.0309 12.3999C8.36735 13.8847 7.21142 15.8012 6.68783 17.9081L5.63981 17.3165C4.69466
                16.7834 4.10699 15.7897 4.10699 14.7235H4.10784ZM10.4676 20.0413L8.60933 18.9924C8.94996 17.0479 9.94402
                15.2665 11.4515 13.921C13.1353 12.4181 15.3198 11.5908 17.6022 11.5908C18.3804 11.5908 19.1477 11.6864
                19.8922 11.8742V14.7235C19.8922 15.2278 19.7589 15.7254 19.5119 16.1662C18.7615 15.3596 17.6806 14.8528
                16.4783 14.8528C14.2136 14.8528 12.3781 16.6466 12.3781 18.8598C12.3781 19.3937 12.4861 19.9021 12.68
                20.3676C11.9347 20.5316 11.1396 20.4203 10.4684 20.0413H10.4676Z"></path>
                    </svg><br>
                    User Profile
                    <br>
                    <div class="name"> Monitor and view your posted or applied job listings. </div>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
    // Add an event listener for the scroll event
    window.addEventListener('scroll', function() {
        // Select the navbar element
        var navbar = document.querySelector('.navbar');

        // Calculate 40% of the viewport height
        var threshold = window.innerHeight * .9;

        // Check the scroll position
        if (window.scrollY > threshold) {
            navbar.classList.add('scrolled');
        } else {
            // Otherwise, remove the class
            navbar.classList.remove('scrolled');
        }
    });
</script>

</html>