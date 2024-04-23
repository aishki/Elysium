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
      const viewApplicantsLink = document.querySelectorAll('.view-applicants-link');
      const sidebar = document.getElementById('vm-sidebar');
      const closeSidebarButton = sidebar.querySelector('.close-sidebar');
      const jobListCon = document.querySelector('.pOption_3');
      
    // Function to toggle sidebar position
    function toggleSidebar() {
        sidebar.classList.add('vm-open'); // Toggle the 'open' class on sidebar

        // Check if sidebar is open
        if (sidebar.classList.contains('vm-open')) {
            jobListCon.style.width = 'calc(100% - 400px)'; // Adjust width when sidebar is open

            // Get the latest job ID from the dataset
            const job_ID = document.querySelector('.view-applicants-link.active').dataset.job_ID;
            
            // Update the URL with the latest job ID
            history.pushState({}, document.title, window.location.pathname + '?job_ID=' + job_ID);
            console.log('job_ID');

        } else {
            jobListCon.style.width = '100%'; // Reset width when sidebar is closed
            
            // Reset the job_ID parameter in the URL when the sidebar is closed
            history.pushState({}, document.title, window.location.pathname);
            sidebar.classList.remove('vm-open'); // Toggle the 'open' class on sidebar

        }

    }
    
      // Event listener for the "View Applicants" links
      viewApplicantsLink.forEach(link => {
          link.addEventListener('click', function (event) {
              event.preventDefault();
              const job_ID = this.dataset.job_ID;
              fetchApplicantsByJobId(job_ID); 
              history.pushState({}, document.title, window.location.pathname + '?job_ID=' + job_ID);
              toggleSidebar(); // Toggle sidebar position              
              var_dump($_GET);
          });
      });
  
      // Event listener for the close button
      closeSidebarButton.addEventListener('click', function () {
          toggleSidebar(); // Toggle sidebar position
      });
});
  

        function fetchApplicantsByJobId(job_ID) { // Corrected function name
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

