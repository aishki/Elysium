$(document).ready(function() {
    // Submit form asynchronously when "Apply" button is clicked
    $(document).on('click', '.applyTaskButton', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = {
            action: 'apply',
            jobID: $(this).siblings('input[name="jobID"]').val()
        };

        // Store reference to the clicked button
        var applyButton = $(this);

        // Log user's rank
        console.log('User Rank:', userRank);

        // Log the values of hidden inputs
        var jobID = $(this).siblings('input[name="jobID"]').val();
        var jobRank = $(this).siblings('input[name="jobRank"]').val();
        console.log('Job ID:', jobID);
        console.log('Job Rank:', jobRank);



        // Define the numeric values for ranks
        var rankValues = {
            'S': 5,
            'A': 4,
            'B': 3,
            'C': 2,
            'D': 1
        };

        // Check if user's rank meets job requirements
        if (rankValues[userRank] >= rankValues[jobRank]) {
            // Send AJAX request to tb_controller.php
            $.ajax({
                type: 'POST',
                url: '../tb_controller/tb_controller.php',
                data: formData,
                success: function(response) {
                    console.log('Response from server:', response); // Log the response
                    // Check the response from the server
                    if (response.status == 'success') {
                        // Application successful, display success message
                        alert('You have successfully applied for this job.');
                    } else {
                        alert('You have already applied for this job. Kindly wait for an update in the Jobs List on your Profile. The employer may also reach out to you for an interview or follow-up questions.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response (e.g., display error message)
                    alert('Error applying for the job. Please try again.');
                }
            });
        } else {
            // User's rank does not meet job requirements, display error message
            alert('You do not meet the rank requirements for this job.');
        }
    });
});

