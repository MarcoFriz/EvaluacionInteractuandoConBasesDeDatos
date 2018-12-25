<?php
/**
 * ¿para que pidieron esto si no hay una página de creación de usuarios?
 */

require_once 'config.php';

new Query("localhost", "juanbosc_admin", "1234", "juanbosc_agenda_next_u");

$name = ModelBase::GetValue("username", "");
$pass = ModelBase::GetValue("password", "");
$data = [
    "user_name" => $name,
    "user_password" => $pass
];

$send = (object) [];
$result = Query::Insert("users", $data);
if (! $result) {
    $send->msg = Query::error();
} else {
    $send->msg = "OK";
}
echo json_encode($send);
Query::Close();
die();

?>
