<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The stylesheet below is for the search bar's magnifying glass -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
    <!-- Include jQuery library -->
    <script type="text/javascript" src="../resources/jquery-3.1.1.min.js"></script>
    <!-- Include custom JavaScript file -->
    <script type="text/javascript" src="./scripts/script.js"></script>
    <title>Admin Page</title>
</head>
<body>
    <?php
       // Include the file that connects to the database
       require "../connect.php";
       // Query to get all locations
       $locationsQuery = $db->query("SELECT name FROM locations");
    ?>
    <!-- Back to Landing Page button -->
    <div id="landingPageBtnContainer">
        <button id="landingPageBtn">
            <a href="../">Back to Landing Page</a>
        </button>
    </div>
    <!-- Page Title -->
    <h1 class="title">Admin Page</h1>
    <!-- Button to add new item -->
    <button type="button" id="plusButton"><img src="./Resources/plus.svg" alt="Add Object"></button>
    <hr>
    <!-- Dialog for adding new object -->
    <dialog id="addObject">
        <form id="createForm">
            <h1>Adding New Item</h1>
            <label for="name">Name:</label>
            <input name="name" class="inputBar" type="text" id="name" placeholder="Name">
            <br><br>
            <label for="currentLocation">Current Building:</label>
            <!-- Select dropdown for locations -->
            <select class="inputBar" name="currentLocation">
                <?php
                    // Loop through locations and create options
                    while ($location = $locationsQuery->fetch_assoc()) {
                        echo "<option value='".$location['name']."'>".$location['name']."</option>";
                    }
                ?>
            </select>
            <br><br>
            <label class="inputBar" for="priority">Priority:</label>
            <!-- Select dropdown for priority -->
            <select name="priority" id="priority">
                <option value="0">Low</option>
                <option value="1">High</option>
            </select>
            <br><br>
            <label for="imageLink">Image Link:</label>
            <input id="imageLink" type="text" class="inputBar" name="imageLink" placeholder="Submit image link here">
            <br><br>
            <!-- Submit and Cancel buttons -->
            <input class="addSubmitBtn" type="submit" id="createItemButton">
            <input class="cancelSubmitBtn" type="button" value="Cancel" id="cancelItemButton" onclick="closeCreate()">
        </form>
    </dialog>
    <!-- Dialog for deleting an object -->
    <dialog id="deleteObject">
        <div id="warning-prepend-container">
            <h1><i class="fa fa-exclamation-triangle"></i> Are you sure you want to Delete this item?</h1>
        </div>
        <div id="deleteOptions"></div>
    </dialog>
    <br>
    <!-- Buttons to switch between current and archive tables -->
    <div id="topButtons">
        <button type="button" id="currentTableButton">Current Items in Lost and Found</button>
        <button type="button" id="archiveTableButton">Archive</button>
    </div>
    <!-- Current Table (Initially Hidden) -->
    <div>
        <table id="currentTable">
            <!-- Table rows for current items -->
        </table>
    </div>
    <!-- Dialog for editing an object -->
    <dialog id="editObject">
        <form id='editForm'>
            <!-- Form fields for editing item details -->
        </form>
    </dialog>
    <!-- Archive Table (Initially Hidden) -->
    <div>
        <table id="archiveTable">
            <!-- Table rows for archived items -->
        </table>
    </div>
</body>
</html>
