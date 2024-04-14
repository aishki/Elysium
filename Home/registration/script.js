function setupEventListeners() {
    // Access buttons
    const buyServicesBtn = document.getElementById('buyServicesBtn');
    const provideServicesBtn = document.getElementById('provideServicesBtn');
    const hideContainer = document.getElementById("hide_container");

    hideContainer.style.display = "none";

    buyServicesBtn.addEventListener('click', function() {
        setAccountType("Employer Account");
        toggleFormSections(true);

        hideContainer.style.display = "block"; // Show the reminder
        buyServicesBtn.classList.add('active');
        provideServicesBtn.classList.remove('active');
    });

    provideServicesBtn.addEventListener('click', function() {
        setAccountType("Applicant Account");
        toggleFormSections(false);

        hideContainer.style.display = "block"; // Show the reminder
        buyServicesBtn.classList.remove("active");
        provideServicesBtn.classList.add("active");
    });

    // Access the Submit button
    const submitButton = document.getElementById('submitButton');

    // Add event listener to the Submit button
    submitButton.addEventListener('click', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Check if a radio button is selected
        var companyRadio = document.getElementById('typ_comp');
        var personalRadio = document.getElementById('typ_pers');
        
        if (!companyRadio.checked && !personalRadio.checked) {
            // If neither radio button is checked, prevent form submission
            alert('Please select an account type.');
            return; // Return to stop further execution
        }

        // Check if form validation passes
        if (!validateForm()) {
            // If validation fails, display the alert and prevent form submission
            alert('Please make sure all fields are filled correctly.');
            return; // Return to stop further execution
        }

        // If validation passes and a radio button is selected, submit the form
        document.getElementById('registrationForm').submit();
    });
}

function setAccountType(type) {
    document.getElementById("accountType").textContent = type;
}

function toggleFormSections(isEmployer) {
    const employerSection = document.getElementById("employerSection");
    const applicantSection = document.getElementById("applicantSection");
    const companyType = document.querySelector('.company_type');
    const personalType = document.querySelector('.personal_type');
    const companyRadio = document.getElementById('typ_comp');
    const personalRadio = document.getElementById('typ_pers');


    if (isEmployer) {
        employerSection.style.display = "block";
        applicantSection.style.display = "none";
        setRequiredAttributes(["company", "occupation", "client_addLine", "client_brgy", "client_city", "client_province"], true);
        setRequiredAttributes(["educ", "gender", "marital_stat", "DOB", "age", "addLine", "brgy", "city", "province"], false);
    } else {
        employerSection.style.display = "none";
        applicantSection.style.display = "block";
        setRequiredAttributes(["company", "occupation", "client_addLine", "client_brgy", "client_city", "client_province"], false);
        setRequiredAttributes(["educ", "gender", "marital_stat", "DOB", "age", "addLine", "brgy", "city", "province"], true);
    }

    // Adjust required attributes for Employer type based on the Company or Personal radio selection
    if (isEmployer) {
        if (companyRadio.checked) {
            companyType.style.display = 'block';
            personalType.style.display = 'none';
            setRequiredAttributes(["tin", "company1"], true);

        } else if (personalRadio.checked){
            companyType.style.display = 'none';
            personalType.style.display = 'block';
            setRequiredAttributes(["tin", "company1"], false);
        }
    }
}

function setRequiredAttributes(ids, required) {
    ids.forEach(function(id) {
        document.getElementById(id).required = required;
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
        return true; // Passwords match, form submission allowed
    }
}

document.addEventListener("DOMContentLoaded", function() {
    setupEventListeners(); // Call the function to set up event listeners
});
