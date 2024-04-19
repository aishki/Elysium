<!-- Personal Information -->
<div class= "pers_info stage-div" id="pers_info" style="display: none;">
    <h2> Personal Information</h2>
    <hr class= hrStg>

    <div class="row">
        <div class="select gender-buttons">
            <label class= "lm" for="gender">Gender</label>

            <div class="selectedOption"
                data-default-gender="Select Gender"
                data-female="Female"
                data-male="Male"
                data-non-binary="Non-Binary"
                data-other-gender="Other"
                data-pns="Prefer Not to Say">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                    <path
                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                        fill= "rgb(255,255,255)" 
                        ></path>
                </svg>
            </div>

            <div class="options">
                <div title="Select Gender">
                    <input id="gender-all" name="gender" type="radio" checked />
                    <label class="option" for="gender-all" data-txt="Select Gender"></label>
                </div>

                <div title="Female">
                    <input id="gender-female" name="gender" value= "Female" type="radio" />
                    <label class="option" for="gender-female" data-txt="Female"></label>
                </div>

                <div title="Male">
                    <input id="gender-male" name="gender" value= "Male" type="radio" />
                    <label class="option" for="gender-male" data-txt="Male"></label>
                </div>

                <div title="Non-Binary">
                    <input id="gender-non-binary" name="gender"value= "Non-Binary"  type="radio" />
                    <label class="option" for="gender-non-binary" data-txt="Non-Binary"></label>
                </div>

                <div title="Other">
                    <input id="gender-other" name="gender" value= "Other" type="radio" />
                    <label class="option" for="gender-other" data-txt="Other"></label>
                </div>

                <div title="PNS">
                    <input id="gender-pns" name="gender" value= "Prefer Not to Say" type="radio" />
                    <label class="option" for="gender-pns" data-txt="Prefer Not to Say"></label>
                </div>
            </div>
        </div>


        <div class="select mstat-buttons">
            <label class= "lm" for="marital_stat">Civil Status</label>

            <div class="selectedOption"
                data-default-mstat="Select Civil Status"
                data-single="Single"
                data-married="Married"
                data-sepdiv="Separated/Divorced"
                data-widowed="Widowed"
                data-other-mstat="Other">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                    <path
                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                        fill= "rgb(255,255,255)" 
                    ></path>
                </svg>
            </div>

            <div class="options">
                <div title="Select Civil Status">
                    <input id="mstat-all" name="marital_stat" type="radio" checked />
                    <label class="option" for="mstat-all" data-txt="Select Civil Status"></label>
                </div>

                <div title="Single">
                    <input id="mstat-single" name="marital_stat" value= "Single" type="radio" />
                    <label class="option" for="mstat-single" data-txt="Single"></label>
                </div>

                <div title="Married">
                    <input id="mstat-married" name="marital_stat" value= "Married" type="radio" />
                    <label class="option" for="mstat-married" data-txt="Married"></label>
                </div>

                <div title="Separated/Divorced">
                    <input id="mstat-sepdiv" name="marital_stat" value="Separated/Divorced" type="radio" />
                    <label class="option" for="mstat-sepdiv" data-txt="Separated/Divorced"></label>
                </div>

                <div title="Widowed">
                    <input id="mstat-widowed" name="marital_stat" value="Widowed" type="radio" />
                    <label class="option" for="mstat-widowed" data-txt="Widowed"></label>
                </div>

                <div title="Other">
                    <input id="mstat-other" name="marital_stat" value="Other" type="radio" />
                    <label class="option" for="mstat-other" data-txt="Other"></label>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 22px;">
        <div class="emp input-group">
            <label for="DOB">Date of Birth</label>
            <input autocomplete="bday" type="date" name="DOB" id="DOB" placeholder="Date of Birth"  >
            <div id="dob_error" class="error-message" style="font-size: 12px; color: red; display: none;"></div>
        </div>
        
        <div class="emp input-group">
            <label for="age">Age</label>
            <input autocomplete="age" type="text" name="age" id="age" placeholder="Age" readonly>
            <div id="age_error" class="error-message" style="font-size: 12px; color: red; display: none;"></div>
        </div>
    </div>

    <div class ="row">
        <div class="select edu-buttons">
            <label class="lm" for="edu_attainment">Highest Educational Attainment</label>

            <div class="selectedOption"
                data-default-edu="Select Highest Educational Attainment"
                data-elementary="Elementary Graduate"
                data-highschool="High School Graduate"
                data-vocational-undergrad="Vocational Undergraduate"
                data-vocational-grad="Vocational Graduate"
                data-college-undergrad="College Undergraduate"
                data-college="College Graduate"
                data-masteral="Masteral Post Graduate Level"
                data-doctorate="Doctorate Degree"
                data-other-edu="Other">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                    <path
                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                        fill="rgb(255,255,255)" 
                    ></path>
                </svg>
            </div>

            <div class="options">
                <div title="Select Highest Educational Attainment">
                    <input id="edu-all" name="edu_attainment" value= "N/A" type="radio" checked />
                    <label class="option" for="edu-all" data-txt="Select Highest Educational Attainment"></label>
                </div>

                <div title="Elementary Graduate">
                    <input id="edu-elementary" name="edu_attainment" value= "Elementary Graduate" type="radio" />
                    <label class="option" for="edu-elementary" data-txt="Elementary Graduate"></label>
                </div>

                <div title="High School Graduate">
                    <input id="edu-highschool" name="edu_attainment" value= "High School Graduate" type="radio" />
                    <label class="option" for="edu-highschool" data-txt="High School Graduate"></label>
                </div>

                <div title="Vocational Undergraduate">
                    <input id="edu-vocational-undergrad" name="edu_attainment" value= "Vocational Undergraduate" type="radio" />
                    <label class="option" for="edu-vocational-undergrad" data-txt="Vocational Undergraduate"></label>
                </div>

                <div title="Vocational Graduate">
                    <input id="edu-vocational-grad" name="edu_attainment" value= "Vocational Graduate" type="radio" />
                    <label class="option" for="edu-vocational-grad" data-txt="Vocational Graduate"></label>
                </div>

                <div title="College Undergraduate">
                    <input id="edu-college-undergrad" name="edu_attainment" value= "College Undergraduate" type="radio" />
                    <label class="option" for="edu-college-undergrad" data-txt="College Undergraduate"></label>
                </div>

                <div title="College Graduate">
                    <input id="edu-college" name="edu_attainment" value= "College Graduate" type="radio" />
                    <label class="option" for="edu-college" data-txt="College Graduate"></label>
                </div>

                <div title="Masteral Post Graduate Level">
                    <input id="edu-masteral" name="edu_attainment" value= "Masteral Post Graduate Level" type="radio" />
                    <label class="option" for="edu-masteral" data-txt="Masteral Post Graduate Level"></label>
                </div>

                <div title="Doctorate Degree">
                    <input id="edu-doctorate" name="edu_attainment" value= "Doctorate Degree" type="radio" />
                    <label class="option" for="edu-doctorate" data-txt="Doctorate Degree"></label>
                </div>

                <div title="Other">
                    <input id="edu-other" name="edu_attainment" value= "Other"type="radio" />
                    <label class="option" for="edu-other" data-txt="Other"></label>
                </div>
            </div>
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

    <div class="s_container">
        <button id="submitButton" class= "s_button" type="submit">Submit</button>
    </div>
</div>
