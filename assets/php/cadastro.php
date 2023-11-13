<?php
session_start();
header('Access-Control-Allow-Origin: *');

if (!isset($_SESSION['id'])) {
    // O usuário não está autenticado, redirecione para a página de login
    header("Location: https://oficinanetcar.000webhostapp.com/view/login.html#paralogin");
    exit();
}

$connect = new PDO("mysql:host=https://databases.000webhost.com/;dbname=id21539908_netcar", "id21539908_admin", "Pi_12345");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $userId = $_SESSION['id'];
    $query = "
 SELECT * FROM netcar_veic 
 WHERE user_id = '$userId'
 ORDER BY veicId DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $userId = $_SESSION['id'];
    $data = array(
        ':modelo1' => $received_data->modelo1,
        ':ano1' => $received_data->ano1,
        ':placa1' => $received_data->placa1,
        ':data1' => $received_data->data1,
        ':time1' => $received_data->time1,
        ':descricao' => $received_data->descricao,
        ':user_id' => $userId
    );

    $query = "
 INSERT INTO netcar_veic 
 (modelo1, ano1, placa1, data1, time1, descricao, user_id) 
 VALUES (:modelo1, :ano1, :placa1, :data1, :time1, :descricao, :user_id)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Agendamento realizado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'fetchSingle') {
    $userId = $_SESSION['id'];
    $query = "
 SELECT * FROM netcar_veic 
 WHERE user_id = '$userId'  
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data['veicId'] = $row['veicId'];
        $data['modelo1'] = $row['modelo1'];
        $data['ano1'] = $row['ano1'];
        $data['placa1'] = $row['placa1'];
        $data['data1'] = $row['data1'];
        $data['time1'] = $row['time1'];
        $data['descricao'] = $row['descricao'];
        $data['user_id'] = $row['user_id'];
    }

    echo json_encode($data);
}
if ($received_data->action == 'update') {
    $data = array(
        ':modelo1' => $received_data->modelo1,
        ':ano1' => $received_data->ano1,
        ':placa1' => $received_data->placa1,
        ':data1' => $received_data->data1,
        ':time1' => $received_data->time1,
        ':descricao' => $received_data->descricao,
        ':veicId' => $received_data->hiddenId
    );

    $query = "
 UPDATE netcar_veic 
 SET modelo1= :modelo1, 
 ano1 = :ano1,
 placa1 = :placa1,
 data1 = :data1,
 time1 = :time1, 
 descricao = :descricao 
 WHERE veicId = :veicId
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Agendamento alterado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'delete') {
    $query = "
 DELETE FROM netcar_veic 
 WHERE veicId = '" . $received_data->veicId . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Agendamento deletado'
    );

    echo json_encode($output);
}

?>
