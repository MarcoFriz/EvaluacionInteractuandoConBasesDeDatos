<?php
ini_set('display_errors', 'On');

require_once 'Query.php';
require_once 'ModelBase.php';

new Query("localhost", "juanbosc_general", "la_clave_general", "juanbosc_agenda_next_u");

$name = ModelBase::GetValue("username", "");
$pass = ModelBase::GetValue("password", "");
$user = Query::Search("users", "user_name", $name)->fetch_assoc();
$send = (object) [];
;
header('Content-Type: application/json');
if (! $user) {
    $send->msg = "Nombre o contraseña incorrectos";
} else if (! password_verify($pass, $user["user_password"])) {
    // $send->msg = "Nombre o contraseña incorrectos";
    $send->msg = password_hash($pass, PASSWORD_DEFAULT);
} else {
    $send->msg = "OK";
    session_start();
    $_SESSION["user"] = $user;
}
echo json_encode($send);
Query::Close();
die();

?>
