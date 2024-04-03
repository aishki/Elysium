//parallax effect
window.addEventListener('scroll', function() {
    var yPos = -window.scrollY / 2;
    var bg = document.querySelector('body');
    bg.style.backgroundPositionY = yPos + 'px';
});


function setupEventListeners() {
    // Access buttons
    const buyServicesBtn = document.getElementById('buyServicesBtn');
    const provideServicesBtn = document.getElementById('provideServicesBtn');

    buyServicesBtn.addEventListener('click', function() {
        buyServicesBtn.classList.add('active');
        provideServicesBtn.classList.remove('active');
    });

    provideServicesBtn.addEventListener('click', function() {
        provideServicesBtn.classList.add('active');
        buyServicesBtn.classList.remove('active');
    });
}

document.addEventListener("DOMContentLoaded", function() {
    setupEventListeners(); // Call the function to set up event listeners
    // Get the form fields for applicant
    var educField = document.getElementById('educ');
    var genderField = document.getElementById('gender');
    var maritalStatField = document.getElementById('marital_stat');
    var DOBField = document.getElementById('DOB');
    var ageField = document.getElementById('age');
    var addLineField = document.getElementById('addLine');
    var brgyField = document.getElementById('brgy');
    var cityField = document.getElementById('city');
    var provinceField = document.getElementById('province');

    // Get the form fields for Employer
    var companyField = document.getElementById('company');
    var occupationField = document.getElementById('occupation');
    var clientAddLineField = document.getElementById('client_addLine');
    var clientBrgyField = document.getElementById('client_brgy');
    var clientCityField = document.getElementById('client_city');
    var clientProvinceField = document.getElementById('client_province');

    const buyServicesBtn = document.getElementById("buyServicesBtn");
    const provideServicesBtn = document.getElementById("provideServicesBtn");

    const employerSection = document.getElementById("employerSection");
    const applicantSection = document.getElementById("applicantSection");

    const hideContainer = document.getElementById("hide_container");
    const accountTypeText = document.getElementById("accountType");

    hideContainer.style.display ="none";

    buyServicesBtn.addEventListener("click", function() {
        accountTypeText.textContent = "Employer Account";
        hideContainer.style.display = "block"; // Show the reminder

        employerSection.style.display = "block"; // Show the employer section
        applicantSection.style.display = "none"; // Hide the applicant section
    
                // Set required attribute for Employer fields
                companyField.required = true;
                occupationField.required = true;
                clientAddLineField.required = true;
                clientBrgyField.required = true;
                clientCityField.required = true;
                clientProvinceField.required = true;
        
                // Clear required attribute from applicant fields
                educField.required = false;
                genderField.required = false;
                maritalStatField.required = false;
                DOBField.required = false;
                ageField.required = false;
                addLineField.required = false;
                brgyField.required = false;
                cityField.required = false;
                provinceField.required = false;
    });

    provideServicesBtn.addEventListener("click", function() {
        accountTypeText.textContent = "Applicant Account";
        hideContainer.style.display = "block"; // Show the reminder

        applicantSection.style.display = "block"; // Show the applicant section
        employerSection.style.display = "none"; // Hide the employer section
    
        // Input equired attribute from applicant fields
        educField.required = true;
        genderField.required = true;
        maritalStatField.required = true;
        DOBField.required = true;
        ageField.required = true;
        addLineField.required = true;
        brgyField.required = true;
        cityField.required = true;
        provinceField.required = true;

        // Clear required attribute from Employer fields
        companyField.required = false;
        occupationField.required = false;
        clientAddLineField.required = false;
        clientBrgyField.required = false;
        clientCityField.required = false;
        clientProvinceField.required = false;
    });
});

function setAccess(buttonId) {
    // Set the value of the hidden input field to the ID of the clicked button
    document.getElementById('access').value = buttonId;

    //visual feedback
    const buttons = document.querySelectorAll('.access-option');
    buttons.forEach(function(button) {
        if (button.id === buttonId) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });
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
        return true; // Passwords match, allow form submission
    }
}