<?php
// Include the file that connects to the database
global $result;
require "../connect.php";

// Get search, building, dateFrom, and dateTo from POST data
$search = $_POST['search'];
$building = $_POST['Buildings'];
$dateFrom = $_POST['DateFrom'];
$dateTo = $_POST['DateTo'];

// Initial query to select items
$query = "SELECT * FROM lost_items, location_items, locations 
          WHERE location_items.item_id = lost_items.id 
          AND location_items.location_name = locations.name 
          AND lost_items.isFound = 0";

// Add conditions based on filters
if ($building) {
    // Filter by building
    $query .= " AND id IN (SELECT item_id FROM location_items WHERE location_name = '".$building."')";
}
if ($search) {
    // Filter by search keyword
    $query .= " AND lost_items.name LIKE '%".$search."%'";
}
if ($dateFrom) {
    // Filter by start date
    $query .= " AND lost_items.timeReported >= '".$dateFrom."'";
}
if ($dateTo) {
    // Filter by end date
    $query .= " AND lost_items.timeReported <= '".$dateTo."'";
}

// Execute the query
$result = $db->query($query);

// Loop through the results and display items
while($row = $result->fetch_assoc()) {
    $searchLocation = $row['location_name'];
    echo "<div class='item'>";
    echo "<div class='imgWrapper'><img class='itemImg' alt=".$row['name']." src='".$row['imageLink']."'></div>";
    echo "<div class='block'>";
    echo "<p>Name: ".$row['name']."</p>";
    echo "<p>Time Found: ".date( 'm/d/y g:i A', strtotime($row['timeReported']))."</p>";
    echo "<p>".$row['location_name']." ".$row['room']."</p>";
    echo "</div>";
    echo "</div>";
}
?>
