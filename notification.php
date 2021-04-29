<?php

// Heroku puede loguear error_log
$body = file_get_contents('php://input');
error_log($body);

?>
