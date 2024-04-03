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
        <label for="license">Driver's License</label>
        <input autocomplete="license" type="file" name="license" id="license" accept=".png, .jpeg, .jpg, .pdf">
    </div>
</div>
