var loadFile = function (event) {
    var image = document.getElementById("output");
    var image9 = document.getElementById("output_change");
    image.src = URL.createObjectURL(event.target.files[0]);
    image9.src = URL.createObjectURL(event.target.files[0]);
  };
  
function setupEventListeners() {
  // Stage buttons
  const stageButtons = document.querySelectorAll('.p_option'); // Select all buttons with class "stage"
  const stageDivs = document.querySelectorAll('.pOptionDiv'); // Select all divs with class "stage-div"

  // Add click event listener to each stage button
  stageButtons.forEach(function(button) {
      button.addEventListener('click', function() {
          // Remove active class from all buttons
          stageButtons.forEach(function(btn) {
              btn.classList.remove('active');
          });
          // Add active class to the clicked button
          button.classList.add('active');

          // Hide all divs
          stageDivs.forEach(function(div) {
              div.style.display = 'none';
          });

          // Display the corresponding div for the clicked button
          const correspondingDivId = button.dataset.correspondingDiv; // Get the corresponding div id from data attribute
          document.getElementById(correspondingDivId).style.display = 'flex';
          document.getElementById(correspondingDivId).style.width = '100%';

      });
  });
}

function setDefaultActiveButton() {
  // Set "Account details" button as active by default
  const accDeet = document.querySelector('.p_option[data-corresponding-div="pOption_3"]');
  accDeet.classList.add('active');
  
  // Display the corresponding div for the active button by default
  const accDeetDiv = document.getElementById('pOption_3');
  accDeetDiv.style.display = 'flex';
}

document.addEventListener("DOMContentLoaded", function() {
  setupEventListeners();
  setDefaultActiveButton();
});


// Employer sidebar


    // JS for view more sidebar in job list
    document.addEventListener('DOMContentLoaded', function () {
      // Event listener for the "View Applicants" links
      const viewApplicantsLink = document.querySelectorAll('.view-applicants-link');
      const sidebar = document.getElementById('vm-sidebar');
      const closeSidebarButton = sidebar.querySelector('.close-sidebar');
      const jobListCon = document.querySelector('.pOption_3');
  
      // Function to toggle sidebar position
      function toggleSidebar() {
          sidebar.classList.toggle('vm-open'); // Toggle the 'open' class on sidebar
  
          // Check if sidebar is open
          if (sidebar.classList.contains('vm-open')) {
              jobListCon.style.width = 'calc(100% - 400px)'; // Adjust width when sidebar is open
          } else {
              jobListCon.style.width = '100%'; // Reset width when sidebar is closed
              
              // Reset the job_ID parameter in the URL when the sidebar is closed
              history.pushState({}, document.title, window.location.pathname);
          }
      }
  
      // Event listener for the "View Applicants" links
      viewApplicantsLink.forEach(link => {
          link.addEventListener('click', function (event) {
              event.preventDefault();
              const job_ID = this.getAttribute('data-jobid');
              fetchApplicantsByJobId(job_ID);
              history.pushState({}, document.title, window.location.pathname + '?job_ID=' + job_ID);
              toggleSidebar(); // Toggle sidebar position
          });
      });
  
      // Event listener for the close button
      closeSidebarButton.addEventListener('click', function () {
          toggleSidebar(); // Toggle sidebar position
      });
  });
  
  function fetchApplicantsByJobId(job_ID) {
      // Make AJAX request to fetch applicants for the given job ID
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'fetch_applicants.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
          if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              displayApplicants(response);
          } else {
              console.error('Failed to fetch applicants: ' + xhr.status);
          }
      };
      xhr.send('job_ID=' + encodeURIComponent(job_ID));
  }

        function displayApplicants(applicants) {
        const applicantListContainer = document.getElementById('applicant-list-container');

            // Clear previous content
            applicantListContainer.innerHTML = '';
            // Display each applicant
            applicants.forEach(applicant => {
                const applicantContainer = document.createElement('div');
                applicantContainer.classList.add('applicant-container');

                const applicantBox = document.createElement('div');
                applicantBox.classList.add('applicant-box');

                const rankParagraph = document.createElement('h1');
                rankParagraph.textContent = `${applicant.user_level}`;
                rankParagraph.classList.add('applicant_level');


                const nameParagraph = document.createElement('p');
                nameParagraph.textContent = `${applicant.user_fname} ${applicant.user_lname}`;

                const credentialParagraph = document.createElement('p');
                credentialParagraph.textContent = `Credential: ${applicant.user_cred}`;

                const viewProfileButton = document.createElement('button');
                viewProfileButton.textContent = 'View Profile';

                const hrline = document.createElement('hr');
                
                const rowContainer = document.createElement('div');

                const approveButton = document.createElement('button');
                approveButton.textContent = 'Approve';
                const declineButton = document.createElement('button');
                declineButton.textContent = 'Decline';

                rankParagraph.classList.add('jobrow');

                // Append elements to applicant box
                applicantBox.appendChild(rankParagraph);
                applicantBox.appendChild(nameParagraph);
                applicantBox.appendChild(credentialParagraph);
                applicantBox.appendChild(viewProfileButton);
                applicantBox.appendChild(rowContainer);
                applicantBox.appendChild(approveButton);
                applicantBox.appendChild(declineButton);

                // Append applicant box to applicant container
                applicantContainer.appendChild(applicantBox);

                // Append applicant container to applicant list container
                applicantListContainer.appendChild(applicantContainer);
            });
        }

        // Event listener for the "Approve" buttons
        const approveButtons = document.querySelectorAll('.approve-button');
        approveButtons.forEach(button => {
            button.addEventListener('click', function () {
                const applicationID = this.dataset.applicationID;
                updateApplicationStatus(applicationID, 'Ongoing');
            });
        });

        // Event listener for the "Decline" buttons
        const declineButtons = document.querySelectorAll('.decline-button');
        declineButtons.forEach(button => {
            button.addEventListener('click', function () {
                const applicationID = this.dataset.applicationID;
                updateApplicationStatus(applicationID, 'Rejected');
            });
        });

        function updateApplicationStatus(applicationID, status) {
        // Make AJAX request to update application status
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Handle success response
                console.log('Application status updated successfully');
                // Reload the page or perform any other necessary actions
                location.reload(); // Reload the page
            } else {
                console.error('Failed to update application status: ' + xhr.status);
            }
        };
        xhr.send(`applicationID=${applicationID}&status=${status}`);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const jobDetailsContainer = document.getElementById('jobDetails');
  
      // Function to fetch job details asynchronously
      function fetchJobDetails(jobID) {
          fetch('fetch_jobdetails.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: 'job_ID=' + encodeURIComponent(jobID)
          })
          .then(response => response.json())
          .then(data => {
            // Truncate job status to 7 characters and add '...'
              const truncatedStatus = data.job_status.length > 7 ? data.job_status.slice(0, 7) + '...' : data.job_status;

              // Update job details container with the fetched data
              jobDetailsContainer.innerHTML = `
              <div class= "job_innerdata2">

              <div class="header">
                  <div>
                      <!-- Job Name -->
                      <h4 class="jobName">${data.jobName}</h4>
                      <h4 class="status">Rank: ${data.job_rank}</h4>
                  </div>

                  <div class="statusContainer">   
                      <h4 class="status">${truncatedStatus}</h4>
                      <p class="status">Status</p>
                  </div>
              </div>
              <hr>

              <div class="jobrow">                                        
                <div class="row1-data">
                    <!-- Salary -->
                    <p class="label">Job Description</p>
                    <p class="data">${data.jobDescription}</p>
                </div>
              </div>
              <hr>


              <div class="jobrow">                                        
                <div class="row1-data">
                  <!-- Salary -->
                  <p class="data">₱${data.remuneration}</p>
                  <p class="label">Expected Salary</p>
                </div>
              </div>


              <div class="jobrow">                                        
                  <div class="row1-data">
                      <!-- Deadline -->
                      <p class="data">${data.deadline}</p>
                      <p class="label">Deadline</p>
                  </div>
                  <div class="row1-data">
                      <!-- Date Posted -->
                      <p class="data">${data.dateAdded}</p>
                      <p class="label">Date Posted</p>
                  </div>
              </div>

              <button class="edit-button" style= "align-self: flex-end">
              <svg class="edit-svgIcon" viewBox="0 0 512 512">
                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
              </svg>
            </button>

            </div>`;
          
          })
          .catch(error => {
              console.error('Error fetching job details:', error);
          });
      }
  
      // Event listener for the view task links
      document.querySelectorAll('.view-applicants-link').forEach(link => {
          link.addEventListener('click', function (event) {
              event.preventDefault();
              const jobID = this.dataset.jobid;
              fetchJobDetails(jobID);
          });
      });
  });
  