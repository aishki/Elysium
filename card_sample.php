<?php
session_start();
error_reporting(E_ALL); 
// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../../Home/log-in/log-in.php");
    exit();
}

// Retrieve user information from session
$currentEmail = $_SESSION['user_info']['email'];
$access = $_SESSION['user_info']['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sample</title>
  </head>

  <style>
    :root {
      --surface-color: #fff;
      --curve: 40;
    }

    body {
      font-family: "Noto Sans JP", sans-serif;
      background-color:  #483d8b;
    }

    .TB_container {
    width: 80%;
    margin: 0 auto;
    }

    .TB_listContainer{
    position: absolute;
    width: 80%;
    height: 100vh;
    overflow: hidden; /* Hide any content that overflows the container */
    }

    .TB_header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-container {
        flex-grow: 1; /* Welcome message takes up remaining space */
    }

    .welcome{
        font-size: 40px;
    }

    .task-button {
      position: relative;
      overflow: hidden;
      width: 150px;
      height: 3rem;
      padding: 0 2rem;
      border-radius: 10px;
      background: rgb(50,23,77);
      background-size: 400%;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .task-button:hover::before {
      transform: scaleX(1);
    }

    .button-content {
      position: relative;
      z-index: 1;
    }

    .task-button::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      transform: scaleX(0);
      transform-origin: 0 50%;
      width: 100%;
      height: inherit;
      border-radius: inherit;
      background: linear-gradient(
        82.3deg,
        rgba(150, 93, 233, 1) 10.8%,
        rgba(99, 88, 238, 1) 94.3%
      );
      transition: all 0.475s;
    }


    .apply-button {
      position: relative;
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 7px 30px;
      border-color: transparent;
      font-size: 14px;
      background-color: inherit;
      border-radius: 10px;
      font-weight: 600;
      color: rgba(115, 91, 209, 0.789);
      box-shadow: 0 0 0 2px rgba(115, 91, 209, 0.789);
      cursor: pointer;
      overflow: hidden;
      transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }
      .apply-button .circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        background-color: rgba(115, 91, 209, 0.789);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
      }
        .apply-button:hover .circle {
          width: 220px;
          height: 220px;
          opacity: 1;
        }
      .apply-button:hover {
        box-shadow: 0 0 0 12px transparent;
        color: #ffffff;
        border-radius: 12px;
        padding: 10px 30px;
      }
      .apply-button:active {
        scale: 0.95;
        box-shadow: 0 0 0 4px rgba(115, 91, 209, 0.789);
      }
      .apply-button .text {
        position: relative;
        z-index: 1;
        transform: translateX(-12px);
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
      }
        .apply-button:hover .text {
          transform: translateX(12px);
        }


    .apply-button svg {
      position: absolute;
      width: 18px;
      fill: rgba(115, 91, 209, 0.789);
      z-index: 9;
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }
      .apply-button:hover svg {
        fill: #ffffff;
      }
      .apply-button .arr-1 {
        right: 16px;
      }
      .apply-button .arr-2 {
        left: -25%; 
      }
        .apply-button:hover .arr-1 {
          right: -25%;
        }
        .apply-button:hover .arr-2 {
          left: 16px;
        }

    /* For Display */
    .TB_listContainer{
      position: absolute;

      width: 80%;
      height: 100vh;
      overflow: hidden; /* Hide any content that overflows the container */
    }

    .TB_inner_container {
      /* background: linear-gradient(148deg, rgba(217, 217, 217, 0.05) 0%, rgba(217, 217, 217, 0) 100%); */
      display: flex;
      flex-wrap: wrap;

      gap: 10px;
      align-items: flex-start;
      justify-content: flex-start; /* Center flex items horizontally */
      padding: 50px;
      
      width: 100%;
      height: 100%;
      overflow-y: scroll; /* Enable vertical scrolling */
    }


    /* Hide scrollbar for Chrome, Safari, and Opera */
    .TB_inner_container::-webkit-scrollbar {
      width: 0;
    }

    /* Hide scrollbar for IE, Edge, and Firefox */
    .TB_inner_container {
      scrollbar-width: none;
    }

    .jobContainer{
      width: 30%;
      height: 400px;
      font-family: 'Karla', sans-serif;

      /* background: linear-gradient(270deg, #221A41 0%, rgba(34, 26, 65, 0) 100%); */
      /* background-color: #ffffff;
      box-shadow: 0px 1px 20px 5px rgba(181, 178, 187, 0.2) inset;
      box-shadow: 0px 1px 20px 5px rgba(115, 78, 191, 0.20) inset; */
      /* border-radius: 10px; */
      /* backdrop-filter: blur(20px); */

      display: flex;
      flex-direction: column;
      margin-bottom: 20px; /* Adjust margin as needed */
    }

    .job_innerdata{
      display: flex;
      justify-content: space-between;
      flex-direction: column;

      width: 100%;
      height: 100%;
      padding: 0 10px 0 0;

      flex-grow: 1; /* Fill remaining space */
      gap: 10px;
    }

    .footer{
      /* background: rgb(74, 65, 110); */
      display: flex;
      align-items: center;
      justify-content: flex-end;

    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      /* gap: 2rem; */
      /* margin: 4rem 5vw; */
      padding: 0;
      list-style-type: none;
    }

    .card {
      position: relative;
      display: block;
      width: 100%;
      height: 400px;
      border-radius: calc(var(--curve) * 1px);
      text-decoration: none;
      background-size: cover;

      /* background-color: #5e2c93; */
      /* background-image: url("Assets/S-Rank.jpg"); */
      /* background-repeat: no-repeat; */
      /* background-attachment: fixed; */
      background-position: top;
      color: #d7bdca;

      overflow:hidden;
    }

    .d3-2{
      height: 350px;
      overflow: hidden;
      box-sizing: border-box;
      width: 100%;
      top: 0;
    }

    .d4{
      position: relative;
      max-height: 100%;
      overflow: auto;
    }
      /*Scrollbars*/
      .d4::-webkit-scrollbar{
        width: 10px;
      }
      .d4::-webkit-scrollbar-thumb{
        background: rgb(207, 159, 255);
      }

    .body-container {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      flex-grow: 1; /* Body content takes up remaining space */
      padding: 0 50px;
    }
      .body-container h3 .label{
        color: #d7bdca;
        font-weight: 700;
        margin: 0;
        padding: 0;
      }

    .xtraDeets{
      display: flex;
      flex-direction: column;
      padding-bottom: 100px;
    }
      .xtraDeets p{
        margin: 0;
      }

    .row2{
      display: flex;
      align-items: center;
      margin: 12px 0 0;
      
    }
    .column{
      display: flex;
      width: fit-content;
      flex-direction: column;
    }

    .employer-details{
      max-width: 600px;
    }
      .employer-details .label{
        font-weight: 700;
      }

      .employer-details .data{
        font-weight: 500;
      }

    .t-data{
      width: 100%;
      /* background-color: rgba(147,112,219, 0.6); */
      background: rgba(115, 91, 209, 0.789);
      color: rgba(255,255,255,0.789);
      border-radius: 10px;
      backdrop-filter: blur(20px);
      padding: 10px 0;
      margin: 10px 0;
      display: flex;
      justify-content: center;
      align-items:center;
    }

      .t-data p{
        margin: 0;
        padding: 0 10px;
      }
      .t-data .label{
        font-size: 12px;
        margin-bottom: 20px;
      }
      .t-data .data{
        font-size: 12px;
        font-weight: 700;
      }

    .card__overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1;
      background-color: var(--surface-color);
      opacity: 0.9;
      transform: translateY(100%);
      transition: transform 0.2s ease-in-out;
    }

    .card:hover .card__header {
      transform: translateY(0);
    }

    .card:hover .card__header-text {
      white-space: normal; /* Allow text wrap */
    }

    .card:hover .card__description {
      height: calc(
        100% - 250px
      ); /* Adjust height based on description height */
    }

    .card:hover .jobName {
      font-size: 30px;
    }
    
    .card:hover .card__overlay {
      transform: translateY(0%); /*negative = more up*/
      opacity: 1;

      position: relative;
      top: 0;
    }

    .card__header {
      width: calc(100% - 3.9em); /*minus padding*/
      position: relative;
      display: flex;
      align-items: center;
      gap: 2em;
      padding: 2em;
      background-color: var(--surface-color);
      transform: translateY(-99%);
      transition: transform 0.2s ease-in-out, height 0.2s ease-in-out; 
    }

    .Hhr{
      opacity: 0.8;
      width: 80%;
      margin: 0 auto;
    }
    .Bhr{
      opacity: 0.5;
      width: 100%;
      margin: 0 auto;
    }

    .card__arc {
      width: 100px;
      height: 99px;
      position: absolute;
      bottom: 100%;

      right: 0;
      z-index: 1;
    }

    .card__arc path {
      border-width: 0;
      fill: var(--surface-color);
      d: path("M 50 100 c 22 0 50 -22 50 -50 v 50 Z");
    }

    .rank__box {
      flex-shrink: 0;
      background: rgba(115, 91, 209, 0.789);
      border-radius: 10px;
      width: 50px;
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #ffff;
    }

    .jobName {
      font-size: 1em;
      margin: 0 0 0.3em;
      overflow: hidden; /* Hide any overflowing text */
      text-overflow: ellipsis; /* Display ellipsis (...) for overflowed text */
      /* max-width: calc(100%-1px); */
      color: #6a515e;
    }

    .card__header-text {
      white-space: nowrap;
      width: 100%;
      overflow: hidden; /* Hide any overflowing text */
    }

    .card__status {
      font-size: 0.8em;
      color: #d7bdca;
    }

    .card__description {
      height: 250px;
      margin: 0;
      color: #d7bdca;
      font-family: "Montserrat", sans-serif;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 4;
    }

    .card__description p {
      padding: 0;
    }

    /* Add Task Form */
    .form-container {
        width: 400px;
        /* background: linear-gradient(270deg, #221A41 0%, rgba(34, 26, 65, 0) 100%); */
        background-color: #221A41;
        box-shadow: 0px 1px 20px 5px rgba(115, 78, 191, 0.20) inset;
        border-radius: 10px;
        backdrop-filter: blur(20px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 40px;
        color: #ffffff;

        /* Other styles */
        position: fixed; /* Fixed positioning to overlay the page */
        top: 50%; /* Position at the vertical center */
        left: 50%; /* Position at the horizontal center */
        transform: translate(-50%, -50%); /* Center the form */
        z-index: 1000; /* Ensure the form is on top of other content */
    }

    .form-content {
        height: 500px;
        overflow: auto;
        display: flex;
        flex-direction: column;
        position: relative;
        padding: 10px;
    }
      .form-content .date{
        margin: 20px 0;
      }
          /* Scrollbars */
      /* width */
      .form-content::-webkit-scrollbar {
          width: 10px;
      }
        
      /* Track */
      .form-content::-webkit-scrollbar-track {
          box-shadow: inset 0 0 5px rgb(235, 123, 19); 
          margin-right: 5px;
          border-radius: 10px;
      }

      /* Handle */
      .form-content::-webkit-scrollbar-thumb {
          background: rgb(207, 159, 255);
          border-radius: 10px;
      }

      /* Handle on hover */
      .form-content ::-webkit-scrollbar-thumb:hover {
          background: #b30000; 
      }

      .form-content h2{
          font-size: 25px;
          margin: 0;
          padding: 10px;
          text-align: center;
      }

      .form-content hr{
        opacity: 0.8;
        width: 98%;
        margin: 0 auto;
      }

    span .date{
        font-weight: 600;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .input-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .input-group input, textarea, select{
        width: 100%;
        height: 30px;
        padding: 0 15px;
        border: 2px solid #734EBF;
        border-radius: 10px;
        background-color: #d1c5f9;
        color: #221A41;
        box-sizing: border-box; 
        margin-bottom: 5px;
    }

    .input-group textarea{
        min-height: 85px;
        max-width: 100%;
        padding: 15px;
        font-family: 'Montserrat', sans-serif;
    }

    .close-button {
        position: absolute;
        top: 0;
        right: 0;
        background: none;
        border: none;
        color: #ffffff;
        font-size: 20px;
        cursor: pointer;
    }

    .close-button:hover {
        color: #ff0000; /* Change color on hover if desired */
    }

    .button-container input[type=submit] {
        width: 150px;
        height: 40px;
        background: linear-gradient(92deg, rgba(115, 78, 191, 0.75) 0%, rgba(72, 44, 244, 0.75) 100%);
        border: 3px solid transparent;
        border-radius: 30px;
        color: #ffffff;
        font-size: 15px; 
        font-weight: bold;
        cursor: pointer;
        outline: none;
    }

    .button-container input[type=submit]:hover {
        background: linear-gradient(92deg, rgba(115, 78, 191, 1) 0%, rgba(72, 44, 244, 1) 100%);
    }

    .button-container {
        width: 100%; 
        padding: 20px 0;
        text-align: right; /* Align button to the right */
    }

/* End of Task Form */
  </style>

  <body>
    <div class="TB_container">

      <div class="TB_header">
          <div class="welcome-container">
              <p class="welcome">Welcome, <?php echo $_SESSION['user_info']['first_name'] . ' ' . $_SESSION['user_info']['last_name']; ?>!</p>
          </div>
  
          <!-- Add Task only for Employer -->
          <?php if ($access == 'Employer'): ?> 
          <div class="addButton-container">
              <button id="addTaskButton" class="task-button">
                <span class="button-content">Add Task</span>
              </button>
          </div>
          <?php endif; ?>
      </div>
  
      <div class="TB_listContainer">
          <div class="TB_inner_container">
  
            <!-- Sorting and filtering options -->
              <!-- <div>
                  <label for="sortBy">Sort by:</label>
                  <select id="sortBy">
                      <option value="jobName">Job Name</option>
                      <option value="salary">Salary</option>
                      <option value="deadline">Deadline</option>
                      <option value="dateAdded">Date Added</option>
                  </select>
  
                  <label for="filterByRank">Filter by Rank:</label>
                  <select id="filterByRank">
                      <option value="">All Ranks</option>
                      <option value="S">S-Rank</option>
                      <option value="A">A-Rank</option>
                      <option value="B">B-Rank</option>
                      <option value="C">C-Rank</option>
                      <option value="D">D-Rank</option>
                  </select>
  
                  <label for="sortOrder">Sort Order:</label>
                  <select id="sortOrder">
                      <option value="ASC">Ascending</option>
                      <option value="DESC">Descending</option>
                  </select>
  
                  <button id="sortButton" class= "task-button">Sort</button>
              </div> -->
          <!-- <div class = "grid"> -->

              <?php
                  // Establish a connection to the database
                  include 'db_connection.php';
  
                  // Fetch jobs from the database along with employer information
                  $sql = "SELECT job.*, employer.client_fname, employer.client_lname, employer.client_organization, employer.client_occupation
                          FROM job 
                          INNER JOIN employer ON job.client_ID = employer.client_ID";
                  $result = $conn->query($sql);
  
                  if ($result->num_rows > 0) {
                      // Output data of each row
                      while ($row = $result->fetch_assoc()) {
                        // Define the background image URL based on job rank
                        $background_image_url = '';
                        switch ($row["job_rank"]) {
                            case 'S':
                                $background_image_url = 'Assets/S-Rank.jpg';
                                break;
                            case 'A':
                                $background_image_url = 'Assets/A-Rank.jpg';
                                break;
                            case 'B':
                                $background_image_url = 'Assets/B-Rank.jpg';
                                break;
                            case 'C':
                                $background_image_url = 'Assets/C-Rank.jpg';
                                break;
                            case 'D':
                                $background_image_url = 'Assets/D-Rank.jpg';
                                break;
                            default:
                                // Default background image if job rank doesn't match any case
                                $background_image_url = 'default-image.jpg';
                                break;
                        }
                  echo  '<div class="jobContainer">                                                                           ';
                  echo  '   <div class= "job_innerdata">                                                                      ';

                  echo  '     <ul class="cards">                                                                              ';
                  echo  '       <li>                                                                                          ';
                  echo  '         <a href="" class="card" style="background-image: url(\'' . $background_image_url . '\');">  ';
 
                  echo  '           <div class="card__overlay">                                                               ';
                  echo  '             <div class="card__header">                                                              ';

                  echo  '               <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">                            ';
                  echo  '                 <!--curvy arc-->                                                                    ';
                  echo  '                 <path />                                                                            ';
                  echo  '               </svg>                                                                                ';

                  echo  '               <div class="rank__box">                                                               ';
                  echo  '                 <h1>'.$row["job_rank"].'</h1>                                                       ';
                  echo  '               </div>                                                                                ';

                  echo  '               <div class="card__header-text">                                                       ';
                  echo  '                 <h3 class="jobName">                                                                ';
                  echo                     $row["jobName"]                                                                     ;
                  echo  '                 </h3>                                                                               ';
                  echo  '                 <span class="card__status"> Status: ' . $row["job_status"]. '</span>                ';
                  echo  '               </div>                                                                                ';

                  echo  '             </div>                                                                                  '; //ends card__header
                  echo  '             <hr class="Hhr">                                                                        ';

                  echo  '   <div class="d3-2">                                                                                ';
                  echo  '   <div class="d4">                                                                                  ';
                  echo  '    <div class="body-container">                                                                     ';
                  echo  '             <div class="card__description">                                                         ';
                  echo  '               <h3 class="label">Job Description:</h3>                                               ';
                  echo                 $row["jobDescription"]                                                                  ;
                  echo  '             </div>                                                                                  ';
                  
                  echo  '    <div class="xtraDeets">                                                                          ';
                  echo  '      <div class="t-data">                                                                           ';
                  echo  '        <div class="row2">                                                                           ';

                  echo  '         <div class="column">                                                                        ';
                  echo  '           <p class="data"> ₱' . $row["remuneration"] . '</p>                                        ';
                  echo  '           <p class= "label">Salary</p>                                                    ';
                  echo  '         </div>                                                                                      ';

                  echo  '         <div class="column">                                                                        ';
                  echo  '           <p class="data">' . date('d-M-y', strtotime($row["dateAdded"])) . '</p>                                             ';
                  echo  '           <p class= "label">Date Added </p>                                                         ';
                  echo  '         </div>                                                                                      ';
                  
                  echo  '         <div class="column">                                                                        ';
                  echo  '           <p class="data">' . date('d-M-y', strtotime($row["deadline"])) . '</p>                                             ';
                  echo  '           <p class= "label"> Deadline </p>                                                          ';
                  echo  '         </div>                                                                                      ';
                  echo  '        </div>                                                                                       '; //end of row2
                  echo  '     </div>                                                                                          ';
                  
                  echo  '     <hr class="Bhr">                                                                                ';
                              
                  echo  '       <div class="employer-details">                                                                ';
                  echo  '         <h3>Employer Details </h3>                                                                  ';
                  echo  '           <p class= "label"> Client Name: <span class="data">' . $row["client_fname"] . ' ' . $row["client_lname"] . '</span></p>';
                  echo  '           <p class= "label"> Occupation: <span class="data">' . $row["client_occupation"] . '</span></p>                         ';
                  echo  '           <p class= "label"> Company/Organization: <span class="data">' . $row["client_organization"]  . '</span></p>            ';
                  echo  '           <br> <br>                                                                  ';
                  echo  '       </div>                                                                         ';
                  
                  echo '    <div class= "footer">                                                           ';
                  echo '<!-- Apply Task only for applicant -->                                                 ';
                      if ($access == 'Applicant') {
                          echo '<div class="applyButton-container">';
                          echo '<form class="applyForm" method="POST" action="../tb_controller.php">           ';
                          echo '<input type="hidden" name="action" value="apply">                              ';
                          echo '<input type="hidden" name="jobID" value="' . $row["job_ID"] . '">              ';
                          echo '<button type="submit" class="applyTaskButton apply-button">                    ';
                          echo '  <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">    ';
                          echo '    <path                                                                         ';
                          echo '      d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"';
                          echo '    ></path> ';
                          echo '  </svg> ';
                          echo '<span class="text">Apply Task</span> ';
                          echo '  <span class="circle"></span> ';
                          echo '    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">';
                          echo '      <path';
                          echo '        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"';
                          echo '      ></path>';
                          echo '    </svg>';


                          echo '</button>  ';
                          
                          
                          echo '</form>                                                                        ';
                          echo '</div>                                                                         ';
                      }
                      
                      if (isset($_GET['success']) && $_GET['success'] == 1) {
                          echo '<script>alert("You have successfully applied for this job. Kindly wait for the employer to contact you for possible follow-up questions/interview.");</script>';
                      }
                  echo '      </div>                                                                            '; //end of footer

                  echo  '  </div>                                                                              '; //end of xtraDeets
                                                                                                    
                  echo  '  </div>                                                                              '; //end body-container
                  echo  '  </div>                                                                              '; //end d3-2
                  echo  '  </div>                                                                              '; //end d4
                          
                  echo  '           </div>                                                                     '; //ends card__overlay
                  echo  '         </a>                                                                         ';
                  echo  '       </li>                                                                          ';
                  echo  '     </ul>                                                                            ';
                
    
                                                                                                
                echo '    </div>                                                                              ';
                echo '</div>                                                                                  ';                        
                }                                                                              
                } else {                                                                               
                echo "0 results"                                                                               ;
                }    
                
                // Close the connection
                $conn->close();
                  
                  ?>        <br><br><br> <br><br><br>
          <!-- </div> -->
  
          </div>
      </div>
  </div>
  
  
  <div id="addTaskForm" class="form-container" style="display: none;">
        <form class="form-content" id="taskBoardForm" method="POST" action="../tb_controller.php">
            <input type="hidden" name="action" value="create"> <!-- Hidden input to indicate action -->

            <h2>
                Create Task
                <button id="closeFormButton" class="close-button">X</button>
            </h2>

            <hr>
        
            <p class= "date"><b>Date Today:</b> 
            <span id="currentDate"></span></p>

        
            <div class="row">
                <div class="input-group">
                    <label for="jobName">Job Name</label>
                    <input autocomplete="jobName" type="text" name="jobName" id="jobName" placeholder="Walking a Dog" maxlength="34" required>
                    <div id="charLimitWarning1" style="font-size: 12px; color: red; display: none;">Maximum characters reached</div>
                </div>

                <div class="input-group">
                    <label for="rank">Rank</label>
                        <select id="rank" name="rank" required>
                            <option value="" disabled selected>--Select Rank--</option>
                            <option value="S">S</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                </div>
            </div>

            <div class="input-group">
                <label for="jobDescription">Job Description</label>
                <textarea id="jobDescription" name="jobDescription" placeholder="Describe the job..." maxlength="100" required></textarea>
                <div id="charLimitWarning2" style="font-size: 12px; color: red; display: none;">Maximum characters reached</div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="salary">Salary</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter salary" required>
                </div>
                <div class="input-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" required>
                    <div id="deadlineError" class="error-message" style="font-size: 12px; color: red; display: none;"></div>
                </div>
            </div>

            <div class="button-container">
                <input id="submitButton" type="submit" value="Submit">
            </div>
        </form>
    </div>

<script>
    var userRank = '<?php echo $_SESSION["user_info"]["userLevel"]; ?>';

    // Function to show/hide add task form
    document.getElementById("addTaskButton").addEventListener("click", function() {
        document.getElementById("addTaskForm").style.display = "block";
    });

    // Event listener to the "X" button to close the form
    document.getElementById("closeFormButton").addEventListener("click", function() {
        document.getElementById("addTaskForm").style.display = "none";
    });

    // Get the current date
    var currentDate = new Date();

    // Format the date
    var formattedDate = currentDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    
    // Set the formatted date to the element with id="currentDate"
    document.getElementById("currentDate").innerText = formattedDate;

    // Event listener to the submit button to validate the deadline
    document.getElementById("submitButton").addEventListener("click", function(event) {
        var deadline = document.getElementById("deadline").value;
        var currentDate = new Date();
        var threeDaysLater = new Date(currentDate.getTime() + 3 * 24 * 60 * 60 * 1000); // Calculate three days later

        // Check if the deadline is before today's date
        if (new Date(deadline) < currentDate) {
            event.preventDefault();
            document.getElementById("deadlineError").innerText = "Date must not precede the current date.";
            document.getElementById("deadlineError").style.display = "block";
            return;
        }

        if (new Date(deadline) < threeDaysLater) {
            event.preventDefault(); // Prevent form submission
            document.getElementById("deadlineError").innerText = "Deadline should be at least 3 days from today.";
            document.getElementById("deadlineError").style.display = "block"; // Show error message
            return;
        }

        // Check if the deadline exceeds the maximum allowed date (25 years from now)
        var maxDeadlineDate = new Date(currentDate.getFullYear() + 25, currentDate.getMonth(), currentDate.getDate());
        if (new Date(deadline) > maxDeadlineDate) {
            event.preventDefault();
            document.getElementById("deadlineError").innerText = "Deadline should only be at most 25 years from now.";
            document.getElementById("deadlineError").style.display = "block";
            return;
        }

        // Reset error message if all conditions are met
        document.getElementById("deadlineError").innerText = "";
        document.getElementById("deadlineError").style.display = "none";
    });

    document.getElementById('jobName').addEventListener('input', function() {
            var input = this.value;
            var maxLength = 34;

            if (input.length == maxLength) {
                document.getElementById('charLimitWarning1').style.display = 'block';
            } else {
                document.getElementById('charLimitWarning1').style.display = 'none';
            }
        }); 

    document.getElementById('jobDescription').addEventListener('input', function() {
        var textarea = this.value;
        var maxLength = 100;

        if (textarea.length == maxLength) {
            document.getElementById('charLimitWarning2').style.display = 'block';
        } else {
            document.getElementById('charLimitWarning2').style.display = 'none';
        }
        }); 
</script> 
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>