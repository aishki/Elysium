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

        // Get job rank
        var jobRank = $(this).closest('.jobContainer').find('.t-data .data:first').text().trim();
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
                url: '../tb_controller.php',
                data: formData,
                success: function(response) {
                    // Check the response from the server
                    if (response == 'success') {
                        // Application successful, display success message
                        alert('You have successfully applied for this job.');
                        location.reload();
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







// $(document).ready(function() {
//     // Function to fetch job listings based on sorting/filtering criteria
//     function fetchJobListings() {
//         var sortBy = $('#sortBy').val();
//         var filterByRank = $('#filterByRank').val();
//         var sortOrder = $('#sortOrder').val();

//         $.ajax({
//             type: 'POST',
//             url: '../tb_controller.php',
//             data: {
//                 action: 'fetchJobListings',
//                 sortBy: sortBy,
//                 filterByRank: filterByRank,
//                 sortOrder: sortOrder
//             },
//             success: function(response) {
//                 $('.jobList').html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error fetching job listings:', error);
//             }
//         });
//     }

//     // Event listener for sorting/filtering options
//     $('#sortBy, #filterByRank, #sortOrder').change(function() {
//         // Delay the function call using setTimeout to wait until all filters are changed
//         clearTimeout($(this).data('timeoutId'));
//         $(this).data('timeoutId', setTimeout(fetchJobListings, 300)); // Adjust delay time as needed
//     });

//     // Initial fetch of job listings
//     fetchJobListings();
// });
