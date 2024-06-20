<?php
require_once("config.php");

$providerId = $_GET['provider_id'];

$sql = "SELECT * FROM  me_licenses_list WHERE provider_id = $providerId";

$result = $conn->query($sql);
$filteredData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $state_id = $row['state'];
					 // Fetch the state name based on the state_id
					 $state_name_query = mysqli_query($conn, "SELECT * FROM me_states WHERE id = '" . $row['state'] . "'");
					 $state_name_result = mysqli_fetch_assoc($state_name_query);
					 $state_name = isset($state_name_result['id']) ? $state_name_result['name'] : '';
					 $row['state_name']=$state_name ;
        $filteredData[] = $row;
    }
}

// Return the filtered data as JSON response
// header('Content-Type: application/json');
echo json_encode($filteredData);
?>
