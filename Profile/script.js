function checkPasswordMatch() {
    // For Confirm Password
    var password = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var errorDiv = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        errorDiv.style.display = "block";
        return false; // Passwords don't match, prevent form submission
    } else {
        errorDiv.style.display = "none";
        return true; // Passwords match, allow form submission
    }
}

document.getElementById("deleteButton").addEventListener("click", function() {
    // Ask for confirmation
    var confirmDeletion = confirm("Are you sure you want to delete your account? This action cannot be undone.");
    
    // If the user confirms deletion
    if (confirmDeletion) {
        console.log("Delete button clicked");
        // Send AJAX request to upload deletion request to the Petition table
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../ProfileController.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // multipart/form-data for file uploads
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log("Response from server:", xhr.responseText);
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Show response message
                } else {
                    alert("Error: " + xhr.statusText); // Show error message
                }
            }
        };
        xhr.send("submitDeletionRequest=1"); // Send the action parameter
        console.log("Data sent in AJAX request:", "submitDeletionRequest=1");
    } else {
        // If the user cancels deletion
        console.log("Deletion cancelled");
    }
});


// Make tabs clickable
$(document).ready(function() {
    // Set profile tab as active by default
    $(".tab").removeClass("active");
    $(".tab:first").addClass("active");

    // Show profile container by default
    $(".profile-container").show();

    // Tab click functionality
    $(".tab").click(function() {
        var containerToShow = $(this).data("container");
        $(document).ready();

        // Remove active class from all tabs
        $(".tab").removeClass("active");
        // Add active class to the clicked tab
        $(this).addClass("active");
        
        // Hide all content containers
        $(".js-container > div").hide(); // Updated class to js-container
        // Show the content container corresponding to the clicked tab
        $("." + containerToShow).show();
    });
});

// JS for view more sidebar in job list
document.addEventListener('DOMContentLoaded', function () {
    const viewApplicantsLink = document.querySelectorAll('.view-applicants-link');
    const sidebar = document.getElementById('vm-sidebar');
    const closeSidebarButton = sidebar.querySelector('.close-sidebar');

    // Event listener for the "View Applicants" link
    viewApplicantsLink.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            sidebar.style.left = '0';
        });
    });

    // Event listener for the close button
    closeSidebarButton.addEventListener('click', function () {
        sidebar.style.left = '-500px';
    });
});