<head>
    <link rel="stylesheet" href="../../Assets/css/applicant.css">
</head>

<br> <br>

<div class="row">
    <div class="emp input-group">
        <label for="educ">Highest Educational Attainment</label>
        <input autocomplete="education" type="text" name="educ" id="educ" placeholder="Educational Attainment">
    </div>
</div>

<div class="row">
    <div class="emp input-group">
        <label for="gender">Gender</label>
        <input autocomplete="sex" type="text" name="gender" id="gender" placeholder="Gender"  >
    </div>

    <div class="emp input-group">
        <label for="marital_stat">Marital Status</label>
        <input autocomplete="marital-status" type="text" name="marital_stat" id="marital_stat" placeholder="Marital Status"  >
    </div>
</div>

<div class="row">
    <div class="emp input-group">
        <label for="DOB">Date of Birth</label>
        <input autocomplete="bday" type="date" name="DOB" id="DOB" placeholder="Date of Birth"  >
    </div>
    
    <div class="emp input-group">
        <label for="age">Age</label>
        <input autocomplete="age" type="text" name="age" id="age" placeholder="Age"  >
    </div>
</div>

<div class="row">
    <div class="emp input-group">
        <label for="addLine">Home Address</label>
        <input autocomplete="address-line1" type="text" name="addLine" id="addLine" placeholder="Address Line"  >
    </div>
    
    <div class="emp input-group">
        <label class= "empty_label" for="brgy">Barangay</label>
        <input autocomplete="address-level2" type="text" name="brgy" id="brgy" placeholder="Barangay"  >
    </div>

    <div class="emp input-group">
        <label class= "empty_label" for="city">City</label>
        <input autocomplete="address-level2" type="city" name="city" id="city" placeholder="City"  >
    </div>

    <div class="emp input-group">
        <label class= "empty_label" for="province">Province</label>
        <input autocomplete="address-level1" type="text" name="province" id="province" placeholder="Province"  >
    </div>
</div>

<div class="row">
    <div class="emp input-group file-container">
    Driver's License 
        <label for="file" class="file-upload-label"> 
            <div class="file-upload-design">
            <svg viewBox="0 0 640 512" height="1em">
                <path
                d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                ></path>
            </svg>
            <p>Drag and Drop</p>
            <p>or</p>
            <span class="browse-button">Browse file</span>
            </div>
            <input id="file" type="file" />
        </label>
    </div>
</div>
