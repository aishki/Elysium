<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_info'])) {
    // If logged in, redirect to the home page
    header("Location: ../Task_Board/tb/taskboard.php");
    exit(); // Stop further execution
}

// Check if email exists and set $email_exists flag
$email_exists = isset($_GET['email_exists']) && $_GET['email_exists'] === 'true';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registration Page</title>
    <link rel="stylesheet" href="../../Assets/css/navbar.css">
    <link rel="stylesheet" href="../../Assets/css/gen.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="default">
    <?php include '../../navbar/navbar.php'; ?>

    <div class= "cntr">
        <div class= "hdr">
           <h2 class= "h2title">Register New Account</h2>
           <h5 class= "h5sub">Already have an account? <a href="../log-in/log-in.php">Log In</a></h5>
        </div>

        <div class="regis_container">       
            <!-- Left Side -->
            <div class = "r-left-nav">
                <div class= r-stage>
                    <button class="stage" data-corresponding-div="acc_type"> Account Type</button>
                    <button class="stage" data-corresponding-div="gen_info"> General Information</button>

                    <!-- For Employer -->
                    <button class="stage emp hidden" data-corresponding-div="emp_deets"> Employer Details </button>                 

                    <!-- For Applicant -->
                    <button class="stage app hidden" data-corresponding-div="pers_info"> Personal Information</button>
                </div>
            </div>

            <!-- Right Side -->
            <form class= "regisForm" id="registrationForm" method="POST" action="../r_controller/r_controller.php" onsubmit="return validateForm()">

                <div class= "acc_type stage-div" id="acc_type" style="display: none;">
                    <h2> Account Type </h2>

                    <div class="access-options">
                        <button type="button" class="access-option buy-services"     id="buyServicesBtn">
                            <svg id='Bossy_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                                <g transform="matrix(0.4 0 0 0.4 12 12)" >
                                <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(-24.75, -25)" d="M 20.5 0 L 18.375 3.9257812 L 14 1 L 15.714844 7 L 25.285156 7 L 27 1 L 22.626953 3.9277344 L 20.5 0 z M 15.736328 9 C 15.589328 9.46 15.5 9.944125 15.5 10.453125 C 15.5 13.210125 17.743 15.453125 20.5 15.453125 C 23.257 15.453125 25.5 13.210125 25.5 10.453125 C 25.5 9.944125 25.410672 9.46 25.263672 9 L 15.736328 9 z M 23.917969 17 L 21.871094 20.683594 L 24 31.03125 L 20.892578 33.955078 L 20.892578 34 L 20.869141 33.978516 L 20.845703 34 L 20.845703 33.955078 L 17.738281 31.03125 L 20.078125 20.712891 L 18.050781 17.091797 C 17.214781 17.168797 16.443469 17.287125 15.730469 17.453125 C 15.715469 17.456125 15.690687 17.459891 15.679688 17.462891 C 15.663687 17.466891 15.650766 17.470609 15.634766 17.474609 C 15.628766 17.475609 15.621234 17.476516 15.615234 17.478516 C 6.2532344 19.667516 2.5914688 26.096938 1.6054688 29.710938 C 1.1754688 31.288937 2.1094531 32.934906 3.6894531 33.378906 C 3.9534531 33.452906 4.2250469 33.490234 4.4980469 33.490234 C 5.8280469 33.490234 7.0167187 32.594453 7.3867188 31.314453 C 7.4387187 31.135453 8.6485469 27.138844 13.310547 24.589844 C 12.485547 26.023844 12 27.699 12 29.5 C 12 32.31 13.163 34.826406 15 36.566406 L 15 47.5 C 15 48.881 16.119 50 17.5 50 C 18.881 50 20 48.881 20 47.5 L 20 39 C 20 38.448 20.448 38 21 38 C 21.552 38 22 38.448 22 39 L 22 47.5 C 22 48.881 23.119 50 24.5 50 C 25.881 50 27 48.881 27 47.5 L 27 36.566406 C 28.837 34.827406 30 32.31 30 29.5 C 30 26.982 29.065781 24.7 27.550781 23 L 40 23 C 41.657 23 43 21.657 43 20 L 46.5 20 C 47.328 20 48 19.328 48 18.5 C 48 17.672 47.328 17 46.5 17 L 40 17 L 23.917969 17 z" stroke-linecap="round" />
                                </g>
                            </svg>
                            I want to buy services
                        </button>
                        
                        <button type="button" class="access-option provide-services" id="provideServicesBtn">
                            <svg id='Taxi_Wave_Businessman_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect   fill= '#000000' stroke='none'/>
                                <g transform="matrix(0.83 0 0 0.83 12 12)" >
                                <g style="" >
                                <g transform="matrix(1 0 0 1 0.02 0.39)" >
                                <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" translate(-12.02, -12.39)" d="M 11.38 18.5 C 11.38 17.119288125423015 12.499288125423018 16 13.88 16 L 14.120000000000001 16 C 14.259777743191206 16.00010342272309 14.374623969744247 15.889674358729781 14.38 15.75 L 14.38 10.64 C 14.38 10.363857625084604 14.603857625084604 10.14 14.88 10.14 C 15.156142374915397 10.14 15.38 10.363857625084604 15.38 10.64 L 15.38 14.5 C 15.382991154212965 14.8453323938268 15.52759276128304 15.174301049911222 15.780000000000001 15.41 C 15.373340958816495 15.84170065236488 15.13859813257311 16.407217461042126 15.12 17 L 15.12 17.5 L 13.88 17.5 C 13.327715250169208 17.5 12.88 17.947715250169207 12.88 18.5 L 12.88 22.5 C 12.88 23.052284749830793 13.327715250169208 23.5 13.88 23.5 L 20.880000000000003 23.5 C 21.432284749830796 23.5 21.880000000000003 23.052284749830793 21.880000000000003 22.5 L 21.880000000000003 18.5 C 21.880000000000003 17.947715250169207 21.432284749830796 17.5 20.880000000000003 17.5 L 19.62 17.5 L 19.62 17 C 19.619003089052732 16.65252068347752 19.53681787353828 16.310082285500638 19.380000000000003 16 C 19.07063800084619 15.380770891109428 18.496717087016272 14.935614284869555 17.820000000000004 14.79 C 17.850496401690574 14.695805518716499 17.870615648659353 14.598562491700724 17.880000000000003 14.5 L 17.880000000000003 10.89 C 17.880000000000003 8.680861000676828 16.089138999323175 6.890000000000001 13.880000000000003 6.890000000000001 L 9.880000000000003 6.890000000000001 L 4.680000000000002 1.6900000000000004 C 4.08898049103104 1.1392822791417565 3.167980556010518 1.15553224816529 2.5967564020879044 1.7267564020879038 C 2.0255322481652906 2.2979805560105175 2.009282279141757 3.2189804910310396 2.5600000000000014 3.8100000000000014 L 8.38 9.62 L 8.38 22.5 C 8.38 23.052284749830793 8.827715250169208 23.5 9.38 23.5 L 11.23 23.5 C 11.30832778956935 23.498500595395 11.381803802574392 23.46176258889248 11.43 23.4 C 11.465590279897311 23.33098485310929 11.465590279897311 23.24901514689071 11.43 23.18 C 11.369391411641066 22.958445403194894 11.339115411174244 22.729693399667788 11.34 22.5 Z M 18.12 17 L 18.12 17.5 L 16.62 17.5 L 16.62 17 C 16.625471866593934 16.58417402110323 16.964138021991154 16.249963999329655 17.380000000000003 16.25 C 17.790303064007855 16.255471192248542 18.12003647622542 16.589660461387968 18.12 17 Z" stroke-linecap="round" />
                                </g>
                                <g transform="matrix(1 0 0 1 -0.62 -9)" >
                                <circle style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="2.5" />
                                </g>
                                </g>
                                </g>
                            </svg>
                            I want to provide services
                        </button>
                        <!-- Hidden input field to store the selected option -->
                        <input type="hidden" id="access" name="access" value="">
                    </div>

                    <div class="hide" id="hide_container">
                        <hr class= "divider">
                        <br><br>

                        <div class="reminder" id="reminder">
                            <i>Reminder</i>: You have chosen to create an <b id="accountType">Account Type</b>
                        </div>

                        <div class="reminder-subtext">
                            We urge you to carefully confirm your desired account type. <br>
                            Changes will not be possible after creation.
                        </div>
                        <br><br>
                        <hr class= "divider">

                        <div class= "n_container">
                            <!-- Next button -->
                            <button type="button" id="nextButton" class="n_button hidden">Next</button>
                        </div> 
                    </div>
                </div>

<!-- Gen Info Regis working <3 -->
                <div class= "gen_info stage-div" id="gen_info" style="display: none;">
                    <h2> General Information </h2>
                    <hr class= hrStg>

                    <div class="row">
                        <div class="input-group">
                            <label for="firstName">First Name</label>
                            <input autocomplete="given-name" type="text" name="fname" id="firstName" placeholder="First Name" required>
                        </div>

                        <div class="input-group">
                            <label for="lastName">Last Name</label>
                            <input autocomplete="family-name" type="text" name="lname" id="lastName" placeholder="Last Name" required>
                        </div>

                        <div class="select name-suffix-buttons">
                            <label class="lm" for="name-suffix">Suffix</label>

                            <div class="selectedOption"
                                data-default-suffix="N/A"
                                data-jr="Jr."
                                data-sr="Sr."
                                data-ii="II"
                                data-iii="III"
                                data-iv="IV">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                                        fill="rgb(255,255,255)">
                                    </path>
                                </svg>
                            </div>

                            <div class="options">
                                <div title="Select Suffix">
                                    <input id="name-suffix-none" name="suffix" type="radio" value= "N/A" checked />
                                    <label class="option" for="name-suffix-none" data-txt="N/A"></label>
                                </div>

                                <div title="Jr.">
                                    <input id="name-suffix-jr" name="suffix" value= "Jr." type="radio" />
                                    <label class="option" for="name-suffix-jr" data-txt="Jr."></label>
                                </div>

                                <div title="Sr.">
                                    <input id="name-suffix-sr" name="suffix" value= "Sr."  type="radio" />
                                    <label class="option" for="name-suffix-sr" data-txt="Sr."></label>
                                </div>

                                <div title="II">
                                    <input id="name-suffix-ii" name="suffix" value= "II"  type="radio" />
                                    <label class="option" for="name-suffix-ii" data-txt="II"></label>
                                </div>

                                <div title="III">
                                    <input id="name-suffix-iii" name="suffix" value= "III"  type="radio" />
                                    <label class="option" for="name-suffix-iii" data-txt="III"></label>
                                </div>

                                <div title="IV">
                                    <input id="name-suffix-iv" name="suffix" value= "IV"  type="radio" />
                                    <label class="option" for="name-suffix-iv" data-txt="IV"></label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input autocomplete="email" type="email" name="email" id="email" placeholder="sample@gmail.com" required>
                            <div id="emailError" class="error-message" style="display: none;">Email is already registered.</div>
                        </div>

                        <div class="input-group">
                            <label for="contactNumber">Contact Number</label>
                            <input autocomplete="tel" type="tel" name="contactNumber" id="contactNumber" placeholder="Contact Number" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" name="pwd" id="password" placeholder="Password" required oninput="validateForm()">
                        </div>
                        <div class="input-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required oninput="validateForm()">
                            <div id="passwordError" class="error-message">Passwords do not match</div>
                        </div>
                    </div>

                    <div class= "n_container">
                        <!-- Next button -->
                        <button type="button" id="nextButton" class="n_button aft hidden">Next</button>
                    </div> 
                </div>


            <!-- For Employers -->
                <div class= "employer_div">
                    <?php include 'r_emp.php'; ?>
                </div>
                

                <!-- FUCKING WORKS YEY -->
            <!-- For Applicants -->
                <div class= "applicant_div">
                    <?php include 'r_app.php'; ?>
                </div>
            </form>

        </div>

        <?php
        // Check if email exists and display error message and set active state for general information stage button
        if ($email_exists) {
            // Set active state for general information stage button
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    const genInfoBtn = document.querySelector(".stage:nth-child(2)");';
            echo '    genInfoBtn.classList.add("active");';
            echo '    const genInfoDiv = document.getElementById("gen_info");';
            echo '    genInfoDiv.style.display = "block";';
            
            echo '    var EmailerrorDiv = document.getElementById("emailError");';
            echo '    EmailerrorDiv.style.display = "block";';
            echo '});';
            echo '</script>';
        }
        ?>
        
    </div> <!-- end ctnr-->

    <script src="r_script.js"></script>
</body>
</html>