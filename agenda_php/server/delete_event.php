<?php
require_once 'config.php';
// TODO Cambiar clave al publicar
new Query("localhost", "juanbosc_admin", "1234", "juanbosc_agenda_next_u");
;
$id = ModelBase::GetValue("id", null);
;
$result = Query::Remove("events", "event_id", $id);

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
