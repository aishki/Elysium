<!-- First div for profile details -->
<div class="details">
                                    <div>
                                        <table>
                                            <tr>
                                                <td class="title" rowspan="5"><img src="../../Assets/default_profile.jpg" alt="Profile Picture" class="profile-pic"></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="title">Name</td>
                                                <td class="bfont"><?php echo $accountData['first_name'] . ' ' . $accountData['last_name']; ?></td>           
                                            </tr>
                                            
                                            <tr>
                                                <td></td>
                                                <td class="title">Account Type</td>
                                                <td class="data"><?php echo $accountType; ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td></td>
                                                <td class="title">Gender</td>
                                                <td class="data"><?php echo $accountData['gender']; ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="title">Age</td>
                                                <td class="data"><?php echo $accountData['age']; ?></td>
                                            </tr> -->
                                        </table>
                                    </div>

                                    <!-- Second div with additional user details -->
                                    <div class="additional-details">
                                        <table>
                                            <tr>
                                                <td class="add-deets" colspan= "2" >Work Information</td>
                                            </tr>
                                            <tr>
                                                <td class="title">Work Address</td>
                                                <td class="data"><?php echo $accountData['addLine'] . ', ' . $accountData['brgy'] . ', ' . $accountData['city'] . ', ' . $accountData['province'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Organization</td>
                                                <td class="data"><?php echo $accountData['org']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Occupation</td>
                                                <td class="data"><?php echo $accountData['occ']; ?></td>
                                            </tr>

                                        </table>
                                    </div> 
</div>  <!-- End details -->