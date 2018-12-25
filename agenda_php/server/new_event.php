<?php
require_once 'config.php';
;
// TODO Cambiar clave al publicar
new Query("localhost", "juanbosc_admin", "1234", "juanbosc_agenda_next_u");
;
$titulo = ModelBase::GetValue("titulo", null);
$start_date = ModelBase::GetValue("start_date", null);
$all_day = ModelBase::GetValue("allDay", FALSE);
$end_date = ModelBase::GetValue("end_date", NULL);
$end_hour = ModelBase::GetValue("end_hour", NULL);
$start_hour = ModelBase::GetValue("start_hour", NULL);
;
$all_day = ($all_day) ? true : false;
$send = (object) [];
if (! isset($_SESSION["user"])) {
    $send->msg = "Usuario no conectado";
    echo json_encode($send);
    Query::Close();
    die();
}
$user = $_SESSION["user"];
$data = [
    "event_title" => $titulo,
    "event_date_start" => $start_date,
    "event_all_day" => $all_day,
    "event_date_end" => $end_date,
    "event_hour_end" => $end_hour,
    "event_hour_start" => $start_hour,
    "user_id" => $user["user_id"]
];
$result = Query::Insert("events", $data);
if (! $result) {
    $send->msg = Query::error();
} else {
    $send->msg = "OK";
}
echo json_encode($send);
Query::Close();
die();
?>
