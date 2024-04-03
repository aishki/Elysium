<?php 

require_once '../ProfileModel.php';

$getAccountTables = new ProfileModel();

$result = $getAccountTables->getAccountTables();

?>


<div class="list-container">
    <div class="list-box-container">

        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    $accountType = $row["user_type"];

                    echo '
                    <div class="account list-box">

                        <div>
                            <img src="../../Assets/default_profile.jpg" alt="Profile Picture" class="profile-pic">
                        </div>

                        <div class="list-box-text">
                        
                            <div class="list-item-title">
                                <span> ' . htmlspecialchars($row["first_name"]) . ' </span>
                                <span> ' . htmlspecialchars($row["last_name"]) . ' </span>
                            </div>

                            <div class="list-item-subtitle">
                                <span> ' . htmlspecialchars($row["user_type"]) . ' </span>
                            </div>

                            <div class="list-item-functionality">
                                <a class="list-box-text-link" href="profile_accountSelected.php?id=<?php //echo $id; ?>&accountType=<?php //echo $accountType; ?>">View</a>
                            </div>

                        </div>

                    </div>
                    ';
                } 
            } else {
                    echo '<span>No accounts found.</spam>';

            }
        ?>

    </div>
</div>