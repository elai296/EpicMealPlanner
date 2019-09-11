<?php
require_once('functions.php');
require_once('db_connection.php');
set_exception_handler('error_handler');

startUp();

//calendar need the date, name/label, mealtime
$query = "SELECT `recipe`.`label` from `recipe` JOIN `meals` ON `meals`.`recipeId` = `recipe`.`id`";

$result = mysqli_query($conn, $query);



if (!$result) {
  throw new Exception(mysqli_connect_error());
} else if (!mysqli_num_rows($result) && !empty($_GET['id'])) {
  throw new Exception('Invalid ID: ' . $_GET['id']);
}

$output = [];
while ($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
};

print(json_encode($output));
?>
