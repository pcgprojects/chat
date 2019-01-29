<?php



function sendMessage($message,$user){
	$SERVERNAME = 'localhost';
	$USERNAME = 'root';
	$PASSWORD = 'admin';
	$DBNAME = 'chat';

	// Create connection
	$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO `chat`.`messages` (`message`, `user`) VALUES ('$message', '$user');";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}


function getMessages($date){
	$SERVERNAME = 'localhost';
	$USERNAME = 'root';
	$PASSWORD = 'admin';
	$DBNAME = 'chat';
	
	$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if (!$conn->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		exit();
	} 

	$sql = "SELECT message,user,time(messagedate) as fecha FROM messages where DATE_FORMAT(messagedate, '%d%m%Y')='$date';";
	$result = $conn->query($sql);
	$data = [];
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$data[] = [
				'message' =>  $row["message"],
				'user' => $row["user"],
				'fecha' =>  $row["fecha"],
			];
		}
	} else {
		return $data;
	}
	$conn->close();
	return $data;

}
//getMessages("29012019");
//sendMessage("Acz","R");
?>