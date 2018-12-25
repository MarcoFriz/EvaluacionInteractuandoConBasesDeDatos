<?php
require_once 'config.php';
;
// TODO Cambiar clave al publicar
new Query("localhost", "juanbosc_admin", "1324", "juanbosc_agenda_next_u");
;
$id = ModelBase::GetValue("id", null);
$start_date = ModelBase::GetValue("start_date", null);
$end_date = ModelBase::GetValue("end_date", NULL);
$start_hour = ModelBase::GetValue("start_hour", NULL);
$end_hour = ModelBase::GetValue("end_hour", NULL);
$data = [
    "event_date_start" => $start_date,
    "event_date_end" => $end_date,
    "event_hour_start" => $start_hour,
    "event_hour_end" => $end_hour
];
$result = Query::Update("events", "event_id", $id, $data);

$send = (object) [];
if (! $result) {
    $send->msg = Query::error();
} else {
    $send->msg = "OK";
}
echo json_encode($send);
Query::Close();
die();

?>

