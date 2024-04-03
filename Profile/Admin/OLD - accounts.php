<?php 
include '../../db_connection.php';

$sql = "SELECT * FROM (
    SELECT 
        applicant_ID AS id,
        user_email AS email, 
        user_pwd AS password, 
        'applicant' AS user_type, 
        user_fname AS first_name, 
        user_lname AS last_name,
        user_gender AS gender,
        user_age AS age,
        NULL AS org,
        NULL AS occ,
        user_addressLine AS addLine, 
        user_barangay AS brgy, 
        user_city AS city, 
        user_province AS province, 
        user_educ AS educ,
        user_mstat AS mstat,
        user_dob AS dob,
        user_CV AS docs 
    FROM applicant
    UNION 
    SELECT 
        client_ID AS id,
        client_email AS email, 
        client_pwd AS password, 
        'Employer' AS user_type, 
        client_fname AS first_name, 
        client_lname AS last_name,
        NULL AS gender,
        NULL AS age,
        client_organization AS org,
        client_occupation AS occ,
        client_addressLine AS addLine, 
        client_barangay AS brgy, 
        client_city AS city, 
        client_province AS province,
        NULL AS educ,
        NULL AS mstat,
        NULL AS dob,
        NULL AS docs
    FROM employer
) AS users";

?>


<div class="list-container">
    <div class="list-box-container">
        <?php   
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    $accountType = $row["user_type"];

                    echo    '            <div class="account list-box">                                                                             ';
                    echo    '                <div>                                                                                                  ';
                    echo    '                   <a class="accountLink" href="profile_accountSelected.php?id=' . $id . '&accountType=' . $accountType . '"';                                    ;
                    echo    '                   <table>                                                                                             ';
                    echo    '                       <tr>                                                                                            ';
                    echo    '                            <td class="title" rowspan="5">                                                             ';
                    echo    '                           <img src="../../Assets/default_profile.jpg" alt="Profile Picture" class="profile-pic">      ';
                    echo    '                            </td>                                                                                      ';
                    echo    '                        </tr>                                                                                          ';
                    echo    '                        <tr>                                                                                           ';
                    echo    '                            <td></td>                                                                                  ';                       
                    echo    '                            <td class="bfont">' . htmlspecialchars($row["first_name"]) . ' ' . $row['last_name'];
                    echo    '                            </td>                                                                                      ';
                    echo    '                        </tr>                                                                                          ';
                    echo    '                        <tr>                                                                                           ';
                    echo    '                            <td></td>';
                    echo    '                            <td class="data">' . htmlspecialchars($row["user_type"]);
                    echo    '                        </tr> ';
                    echo    '                    </table>';
                    echo    '                    </a>                                                                                       ';
                    echo    '                </div>';
                    echo    '            </div>';
                }
            } else {
                echo '<p>No accounts found.</p>';

            }
        
        ?>
    </div>