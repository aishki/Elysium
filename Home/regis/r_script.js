// Event listener for the scroll event
window.addEventListener('scroll', function() {
    // Select the navbar element
    var navbar = document.querySelector('.navbar');

    // Check the scroll position
    if (window.scrollY > 0) {
        navbar.classList.add('scrolled2');
    } else {
        // Otherwise, remove the class
        navbar.classList.remove('scrolled2');
    }
});

function setupEventListeners() {
    // Access buttons Employer and Employee 1st child button
    const buyServicesBtn = document.getElementById('buyServicesBtn');
    const provideServicesBtn = document.getElementById('provideServicesBtn');
    const hideContainer = document.getElementById("hide_container");

    hideContainer.style.display = "none";

    buyServicesBtn.addEventListener('click', function() {
        setAccountType("Employer Account");
        // toggleFormSections(true);

        hideContainer.style.display = "block"; // Show the reminder
        buyServicesBtn.classList.add('active');
        provideServicesBtn.classList.remove('active');

        // Set the value of the hidden input field to "Employer"
        document.getElementById("access").value = "Employer";

        // Check if access works
        // console.log(document.getElementById("access").value);

    });

    provideServicesBtn.addEventListener('click', function() {
        setAccountType("Applicant Account");
        // toggleFormSections(false);

        hideContainer.style.display = "block"; // Show the reminder
        buyServicesBtn.classList.remove("active");
        provideServicesBtn.classList.add("active");

        // Set the value of the hidden input field to "Applicant"
        document.getElementById("access").value = "Applicant";

        //  Check if access works
        // console.log(document.getElementById("access").value);
    });

    // Stage buttons
    const stageButtons = document.querySelectorAll('.stage'); // Select all buttons with class "stage"
    const stageDivs = document.querySelectorAll('.stage-div'); // Select all divs with class "stage-div"

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
            document.getElementById(correspondingDivId).style.display = 'block';
        });
    });

    const companyType = document.getElementById('typ_comp');
    const personalType = document.getElementById('typ_pers');
    const empPersDeets = document.getElementById("pers_deets");
    const empCompDeets = document.getElementById("comp_deets");

    empPersDeets.style.display = "none";
    empCompDeets.style.display = "none";

    companyType.addEventListener('click', function() {
        // toggleFormSections(true);

        empPersDeets.style.display = "none";
        empCompDeets.style.display = "block";

        personalType.classList.remove("active");
        companyType.classList.add("active");

        // Set the value of the hidden input field to "Company"
        document.getElementById("emp_type").value = "Company";

        //  Check if emp_type works
        // console.log(document.getElementById("emp_type").value);
    });

    personalType.addEventListener('click', function() {
        // toggleFormSections(false);
        empPersDeets.style.display = "block";
        empCompDeets.style.display = "none";

        companyType.classList.remove("active");
        personalType.classList.add("active");

        // Set the value of the hidden input field to "Personal"
        document.getElementById("emp_type").value = "Personal";

        //  Check if emp_type works
        // console.log(document.getElementById("emp_type").value);
    });
}

function setAccountType(type) {
    document.getElementById("accountType").textContent = type;
}

function validateForm() {
    // Password matching validation
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var errorDiv = document.getElementById("passwordError");

    // Check if passwords match
    if (password !== confirmPassword) {
        errorDiv.style.display = "block";
        return false; // Passwords don't match, prevent form submission
    } else {
        errorDiv.style.display = "none";
        return true; // Passwords match, form submission allowed
    }

}

document.addEventListener("DOMContentLoaded", function() {
    setupEventListeners();
    setDefaultActiveButton();

    // Define nextButton
    const nextButton = document.getElementById('nextButton');
    nextButton.addEventListener('click', function() {
        // Get the selected account type
        const accountType = document.getElementById("accountType").textContent;

        // Show the corresponding buttons based on the account type
        if (accountType === "Employer Account") {
            showEmployerButtons();
            hideApplicantButtons();

        } else if (accountType === "Applicant Account") {
            showApplicantButtons();
            hideEmployerButtons();
        }

        // Hide the Next button after clicking
        nextButton.classList.add('hidden');

        // Proceed to the next visible stage button
        const currentButton = document.querySelector('.stage.active');
        let nextVisibleButton = currentButton.nextElementSibling;
        while (nextVisibleButton && nextVisibleButton.classList.contains('hidden')) {
            nextVisibleButton = nextVisibleButton.nextElementSibling;
        }
        if (nextVisibleButton) {
            nextVisibleButton.click();
            window.scrollTo(0, 0);
        }
    });

    // Define nextButton2 for all elements with class 'n_button.aft'
    const nextButtons2 = document.querySelectorAll('.n_button.aft');
    nextButtons2.forEach(function(nextButton2) { //i hate you sm
        nextButton2.addEventListener('click', function() {
            // go to fucking next visible stage button
            const currentButton = document.querySelector('.stage.active');
            let nextVisibleButton = currentButton.nextElementSibling;
            while (nextVisibleButton && nextVisibleButton.classList.contains('hidden')) {
                nextVisibleButton = nextVisibleButton.nextElementSibling;
            }
            if (nextVisibleButton) {
                nextVisibleButton.click();
                window.scrollTo(0, 0);
            }
        });
    });


// Select Options Click Events
    // Get all the select elements
    const selects = document.querySelectorAll('.select');

    // Add click event listener to each select element
    selects.forEach(function(select) {
        // Get the selectedOption and options elements
        const selectedOption = select.querySelector('.selectedOption');
        const options = select.querySelector('.options');
    
        // Add click event listener to the selectedOption
        selectedOption.addEventListener('click', function() {
        // Toggle the 'open' class on the select element
        select.classList.toggle('open');
        });
    
        // Add click event listener to each option element
        const optionLabels = options.querySelectorAll('label');
        optionLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            // When an option is clicked, close the select
            select.classList.remove('open');
        });
        });
    });
    
// Age Click Event listener
const ageError = document.getElementById('age_error');
const dobError = document.getElementById('dob_error');
const dobInput = document.getElementById('DOB');
const ageInput = document.getElementById('age');

ageInput.addEventListener('click', function() {
    // Check if the date of birth input is empty
    if (dobInput.value === "") {
        // If empty, display error message
        ageError.textContent = "This is system-generated. Input date of birth first.";
        ageError.style.display = "block";
    } else if (ageInput.value < 15) {
        ageError.textContent = "Please enter a valid date of birth.";
        ageError.style.display = "block";
    } else {
        ageError.textContent = "This is system-generated.";
        ageError.style.display = "block";
        ageError.style.color = "#8e8e8e";

    }
});


// Date of Birth Error Handling
    // Add event listener to the date of birth input
    dobInput.addEventListener('input', function() {
        // Clear the error message if it's currently displayed
        if (ageError.style.display === "block") {
            ageError.style.display = "none";
        }

        // Get the entered date of birth
        const dob = new Date(dobInput.value);
        // Calculate the age
        const age = calculateAge(dob);

        // Check if the date is beyond today's date
        if (dob > new Date()) {
            dobError.textContent = "Please enter a valid date of birth.";
            dobError.style.display = "block";
            return;
        }

        // Check if the age is less than 15
        if (age < 15) {
            dobError.textContent = "By law, the minimum age of work is 15 years old.";
            dobError.style.display = "block";
            return;
        }

        // Clear error message if date is valid
        dobError.style.display = "none";

        // Update the age input value
        ageInput.value = age;
    });


    // Employer Company Click Event listener
    const tinError = document.getElementById('tin_error');
    const ct_companyError = document.getElementById('ct_company_error');
    const ct_tinInput = document.getElementById('tin');
    const ct_companyInput = document.getElementById('company1');

    ct_companyInput.addEventListener('click', function() {
        // Check if the company input is empty
        if (ct_tinInput.value === "") {
            // If empty, display error message
            ct_companyError.textContent = "This is system-generated. Input TIN Number first";
            ct_companyError.style.display = "block";
        } else {
            ct_companyError.textContent = "This is system-generated.";
            ct_companyError.style.display = "block";
            ct_companyError.style.color = "#8e8e8e";
        }
    });
});



function showEmployerButtons() {
    const employerButtons = document.querySelectorAll('.stage.emp.hidden');
    employerButtons.forEach(button => button.classList.remove('hidden'));
}

function showApplicantButtons() {
    const applicantButtons = document.querySelectorAll('.stage.app.hidden');
    applicantButtons.forEach(button => button.classList.remove('hidden'));
}

function hideEmployerButtons(){
    const employerButtons = document.querySelectorAll('.stage.emp');
    employerButtons.forEach(button => button.classList.add('hidden'));
}

function hideApplicantButtons(){
    const applicantButtons = document.querySelectorAll('.stage.app');
    applicantButtons.forEach(button => button.classList.add('hidden'));
}

function setDefaultActiveButton() {
    // Check if the email exists parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has('email_exists')) {
        // Set "Account Type" button as active by default
        const accTypeBtn = document.querySelector('.stage:nth-child(1)');
        accTypeBtn.classList.add('active');
        
        // Display the corresponding div for the active button by default
        const accTypeDiv = document.getElementById('acc_type');
        accTypeDiv.style.display = 'block';
    }
}

// Function to calculate age based on date of birth
function calculateAge(dob) {
    const today = new Date();
    const dobYear = dob.getFullYear();
    const dobMonth = dob.getMonth();
    const dobDay = dob.getDate();
    const todayYear = today.getFullYear();
    const todayMonth = today.getMonth();
    const todayDay = today.getDate();

    let age = todayYear - dobYear;

    // Adjust age if birthday hasn't occurred yet this year
    if (todayMonth < dobMonth || (todayMonth === dobMonth && todayDay < dobDay)) {
        age--;
    }

    return age;
}


// Check Tin AJAX
$(document).ready(function(){
    $('#checkTinButton').click(function(){
        console.log("Button clicked"); // Check if the button click event is being triggered
        var tin = $('#tin').val();
        console.log("TIN number:", tin); // Check if the TIN number is being retrieved correctly
           
        // Make AJAX request to validate TIN number
        $.ajax({
            url: 'tin_validation.php',
            type: 'GET',
            data: { tin: tin },
            dataType: 'json',
            success: function(response) {
                if (response.valid) {
                    // If TIN is valid, update company name field
                    $('#company1').val(response.companyName);
                    // Hide any previous error messages
                    $('#tin_error').hide();
                } else {
                    // If TIN is not valid, clear company name field and show error message
                    $('#company1').val('');
                    $('#tin_error').text('This TIN number is not registered/invalid.').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Show error message if there's an error with the AJAX request
                $('#tin_error').text('Error validating TIN number').show();
            }
        });
    });
});