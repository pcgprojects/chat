<?php
include("config/db.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$user = mb_strtoupper($_POST['user']);
	$message = mb_strtoupper($_POST['message']);
	 
	sendMessage($message,$user); 
	 
    /* Obtengo los valores del formulario */
    $rpta = [
            'id' => 1,
            'msg' => 'Mensaje enviado.'			
        ];
    echo json_encode($rpta);
}


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$date = $_GET['date'];
	
	$messages = getMessages($date);
	echo json_encode($messages);
}
?>