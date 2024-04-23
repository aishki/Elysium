<div class="pOptionDiv pOption_2" id="pOption_2" style="display: none;">
    <div class="u_account">
        <span class="u_acc">Modify Account</span> <br>
        <span class="u_info">Update your account photo and details here</span>

        <div class="p_info_container">
            <div class="mod">
                <form action="../upload.php" class="profile_upload" method="post" enctype="multipart/form-data">
                    <div class="profile-pic">
                        <label class="-label" for="file">
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                        </label>
                        <input id="file" type="file" name="file" onchange="loadFile(event)" />
                        <img src="<?php echo $profile_pic_src; ?>" id="output_change" class="logo_img" width="200" />
                    </div>

                    <div class="prof">
                        <div class="user">
                            <?php 
                                // Output the applicant's first name and last name
                                echo "<p class=\"u_name\">" . $user_fn . " " . $user_ln . " " . $user_sufx_display . "</p>";
                            ?>
                            <span class="u_info">Employer Account</span>
                        </div>

                        <button type="submit" id="uploadPhotoButton" class="task-button" name="submit">
                            <span class="button-content">Upload Photo</span>
                        </button>
                    </div>
                </form>
            </div> <!-- end mod -->
        </div>

        <hr class="p_hr">

        <div class="mod_details">
            <div class="ad_acc">Modify Details</div>

            <form id="modifyForm" action="../p_update/save_changes.php" method="post">
                <div class="row">
                    <div class="input-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="fname" value="<?php echo $user_fn; ?>" />
                    </div>

                    <div class="input-group">
                        <label for="lastName">Surname</label>
                        <input type="text" name="lname" value="<?php echo $user_ln; ?>" />
                    </div>

                    <div class="input-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="sufx" value="<?php echo empty($user_sufx) ? 'N/A' : $user_sufx; ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $user_email; ?>">
                    </div>

                    <div class="input-group">
                        <label for="contact">Contact Number</label>
                        <input type="text" name="contact" value="<?php echo $user_contact; ?>">
                    </div>

                    <div class="input-group">
                        <label for="employerType">Employer Type</label>
                        <input type="text" name="employerType" value="<?php echo $user_acc_type; ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="<?php echo $user_addL . ', ' . $user_brgy . ', ' . $user_city . ', ' . $user_prov; ?>">
                    </div>
                </div>

                <button id="saveChangesButton" class="task-button" style= "width:200px; float: right;" onclick="saveChanges()">
                    <span class="button-content">Save Changes</span>
                </button>
            </form>
        </div> <!-- end Modify Details -->
    </div> 
</div>  <!--end pOption -->