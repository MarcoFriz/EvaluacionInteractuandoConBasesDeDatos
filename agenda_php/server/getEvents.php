<?php
require_once 'config.php';
;
// TODO Cambiar clave al publicar
new Query("localhost", "juanbosc_admin", "1234", "juanbosc_agenda_next_u");

$send = (object) [];
if (! isset($_SESSION["user"])) {
    $send->msg = "Usuario no conectado";
    echo json_encode($send);
    Query::Close();
    die();
}
$user = $_SESSION["user"];
$result = Query::Search("events", "user_id", $user["user_id"]);
if (Query::error()) {
    $send->msg = Query::error();
    echo json_encode($send);
    Query::Close();
    die();
}

$eventos = Query::ConvertInAssocMultyDimensionalArray($result);
$send->msg = "OK";
$send->eventos = [];
foreach ($eventos as $evento) {
    $event = (object) [];
    $event->id = $evento["event_id"];
    $event->title = $evento["event_title"];
    $event->allDay = $evento["event_all_day"] ? true : false;
    $event->start = $evento["event_date_start"] . "T" . $evento["event_hour_start"];
    $event->end = $evento["event_date_end"] . "T" . $evento["event_hour_end"];
    $send->eventos[] = $event;
}
echo json_encode($send);
Query::Close();
?>
