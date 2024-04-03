<?php

require_once '../ProfileModel.php';

// $sql = "SELECT * FROM (
//     SELECT 
//         applicant_ID AS id,
//         'applicant' AS user_type, 
//         user_fname AS first_name, 
//         user_lname AS last_name,
//     FROM applicant
//     UNION 
//     SELECT 
//         client_ID AS id,
//         'Employer' AS user_type, 
//         client_fname AS first_name, 
//         client_lname AS last_name,
//     FROM employer
// ) AS users ";


$getPetitionTable = new ProfileModel();
$result = $getPetitionTable->getPetitionTable();

?>

<div class="list-container">
    <div class="list-box-container">
        <?php   
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    // Determine the action endpoint for each petition based on its ID
                    $confirmDeleteAction = "../ProfileController.php?action=confirmDelete&reqID=" . $row['req_ID'];
                    $cancelPetitionAction = "../ProfileController.php?action=cancelPetition&reqID=" . $row['req_ID'];
        ?>
        <div class="petition list-box">
            <div>
                <img src="../../Assets/default_profile.jpg" alt="Profile Picture" class="profile-pic">
            </div>
            <div class="list-box-text">
                <div class="list-item-title">
                    <span><?= htmlspecialchars($row["req_name"] ?? '') ?></span>
                    <span><?= htmlspecialchars($row["first_name"]) ?></span>
                    <span><?= htmlspecialchars($row["last_name"]) ?></span>
                </div>
                <div class="list-item-subtitle">
                    <span><?= htmlspecialchars($accountType) ?></span>
                </div>
                <div class="list-item-functionality"></div>
            </div>
            <div class="list-box-buttons">
                <div class="delete-button">
                    <form action="<?= $confirmDeleteAction ?>" method="POST">
                    <div class="delete-button">                            
                        <div class="deleteButtonContainer">
                            <input type="hidden" name="accountType" value="<?= $accountType ?>">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="submit" value="Confirm Delete"/>
                        </div>
                    </div>
                    </form>
                </div>
                
                <div class="cancel-button">
                    <form action="<?= $cancelPetitionAction ?>" method="POST">
                    <div class="cancel-button">                            
                        <div class="cancelled deleteButtonContainer">
                            <input type="hidden" name="accountType" value="<?= $accountType ?>">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="submit" value="Cancel Petition"/>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
                }
            } else {
                echo '<p>No accounts found.</p>';
            }
        ?>
    </div>
</div>




