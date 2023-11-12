<?php
session_start();
header('Access-Control-Allow-Origin: *');

if (!isset($_SESSION['id'])) {
    // O usuário não está autenticado, redirecione para a página de login
    header("Location: https://dbrzumbi.000webhostapp.com/NETCAR/view/cadastrar.html#paralogin");
    exit();
}

$connect = new PDO("mysql:host=localhost;dbname=id21179013_fatec", "id21179013_admin", "Pi_12345");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
    $userId = $_SESSION['id'];
	$query = "
    SELECT modelo1, ano1, placa1, data1, time1, descricao
	FROM netcar_veic 
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
