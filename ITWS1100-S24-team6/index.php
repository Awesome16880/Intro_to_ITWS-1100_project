<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RPI Lost & Found</title>
    <link rel="stylesheet" href="styles/style.css">
    <!-- The stylesheet below is for the search bar's magnifying glass -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <script type="text/javascript" src="./resources/jquery-3.1.1.min.js"></script>
</head>
<body>
<?php
    // Include the connection script
    require 'connect.php';

    // Query for recent finds with low priority
    $recent = $db->query("SELECT id, name, timeReported, imageLink FROM lost_items WHERE lost_items.priority = 0 AND lost_items.isFound = 0 ORDER BY lost_items.timeReported DESC LIMIT 5");
    
    // Query for priority finds
    $priority = $db->query("SELECT id, name, timeReported, imageLink FROM lost_items WHERE lost_items.priority = 1 AND lost_items.isFound = 0 ORDER BY lost_items.timeReported DESC LIMIT 5");
?>
<!-- Admin Login Button -->
<div id="adminButtonContainer">
    <button id="adminBtn">Admin Login</button>
</div>

<!-- Admin Login Dialog -->
<dialog id="adminLogin">
    <form id="loginForm" action="admin.php" method="post">
        <label>Username: 
            <input class="inputBar" name="username" type="text">
        </label>
        <br><br>
        <label>Password: 
            <input class="inputBar" name="password" type="password">
        </label>
        <br><br>
        <input id="loginButton" type="submit" value="Login" name="login">
    </form>
</dialog>

<!-- Title -->
<h1 class="title">Lost & Found @ RPI</h1>
<hr>
<br>

<!-- Search Bar -->
<div class="center">
    <i class="fa fa-search"></i>
    <form id="searchForm">
        <input type="text" id="search" name="search" placeholder=" Search For An Item">
    </form>
    <input type="button" id="filter" value="Filter">
    <button id="resetButton" onclick="reset()">Reset Search</button>
</div>

<!-- Filter Form Dialog -->
<dialog id="filterForm">
    <form id="filterFormPopup">
        <label for="Buildings">Building:</label>
        <select name="Buildings" id="buildings">
            <?php
                // Query to get buildings
                $sql = "SELECT name FROM locations";
                $result = $db->query($sql);

                // Add default option
                echo '<option value="">(Select an Option)</option>';

                if ($result->num_rows > 0) {
                    // Loop through results and create options
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                    }
                }
            ?>
        </select>
        <br><br>
        <label for="DateFrom">Date Item was Lost From:</label>
        <input name="DateFrom" type="date">
        <br><br>
        <label for="DateTo">Date Item was Lost To:</label>
        <input name="DateTo" type="date">
        <br><br>
        <input id="filterFormPopUpSubmit" type="submit" value="Submit">
    </form>
</dialog>

<!-- Container for search results -->
<div id="searchContainer"></div>
<br>

<!-- Columns for Recent Finds and Priority Finds -->
<div id="findColsContainer">
    <!-- Column for Recent Finds -->
    <div class="column" id="recentFinds">
        <h2 class="columnTitle">Recent Finds</h2>
        <?php
            $recentQuery = $db->prepare("SELECT name, room FROM location_items, locations WHERE location_items.item_id = ? AND location_items.location_name = locations.name;");
            // Loop through recent finds
            $recentRow = $recent->fetch_assoc();
            if (!$recentRow) {
                // If no recent finds, display message
                echo '<p class="missing">No Recent Data Found</p>';
            } else {
                do {
                    // Execute recent query
                    $recentQuery->bind_param("s", $recentRow["id"]);
                    $recentQuery->execute();
                    $recentResult = $recentQuery->get_result()->fetch_assoc();
                    $recentLocation = "Location: ".($recentResult != NULL ? $recentResult['name'] : "Unknown");
                    if ($recentResult != NULL && $recentResult['room'] != NULL) $recentLocation .= " ".$recentResult['room'];

                    // Display recent find
                    echo "<div class='item'>";
                    echo "<div class='imgWrapper'><img class='itemImg' alt=".$recentRow['name']." src='".$recentRow['imageLink']."'></div>";
                    echo "<div class='block'>";
                    echo "<p>Name: ".$recentRow['name']."</p>";
                    echo "<p>Time Found: ".date( 'm/d/y g:i A', strtotime($recentRow['timeReported']))."</p>";
                    echo "<p>".$recentLocation."</p>";
                    echo "</div>";
                    echo "</div>";
                } while ($recentRow = $recent->fetch_assoc());
            }
        ?>
    </div>

    <!-- Column for Priority Finds -->
    <div class="column" id="priorityFinds">
        <h2 class="columnTitle">Priority Finds</h2>
        <?php
            $query = $db->prepare("SELECT name, room FROM location_items, locations WHERE location_items.item_id = ? AND location_items.location_name = locations.name;");
            // Loop through priority finds
            $row = $priority->fetch_assoc();
            if (!$row) {
                // If no priority finds, display message
                echo '<p class="missing">No Priority Finds Data Found</p>';
            } else {
                do {
                    // Execute priority query
                    $query->bind_param("s", $row["id"]);
                    $query->execute();
                    $result = $query->get_result()->fetch_assoc();
                    $location = "Location: ".($result != NULL ? $result['name'] : "Unknown");
                    if ($result != NULL && $result['room'] != NULL) $location .= " ".$result['room'];

                    // Display priority find
                    echo "<div class='item'>";
                    echo "<div class='imgWrapper'><img class='itemImg' alt=".$row['name']." src='".$row['imageLink']."'></div>";
                    echo "<div class='block'>";
                    echo "<p>Name: ".$row['name']."</p>";
                    echo "<p>Time Found: ".date( 'm/d/y g:i A', strtotime($row['timeReported']))."</p>";
                    echo "<p>".$location."</p>";
                    echo "</div>";
                    echo "</div>";
                } while ($row = $priority->fetch_assoc());
            }
        ?>
    </div>
</div>

<!-- Include JavaScript file -->
<script src="scripts/script.js"></script>
</body>
</html>
