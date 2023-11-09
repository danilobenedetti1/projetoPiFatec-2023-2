<?php

header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id21179013_fatec", "id21179013_admin", "Pi_12345");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
    $userId = $_SESSION['id'];
	$query = "
    SELECT * FROM netcar_veic 
	WHERE WHERE user_id = '$userId' 
	ORDER BY id DESC
	";
}
else
{
	$query = "
    SELECT * FROM netcar_veic 
	ORDER BY id DESC
	";
}

$statement = $connect->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>
