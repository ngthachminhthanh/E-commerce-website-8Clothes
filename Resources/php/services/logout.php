<?php
session_start();
session_unset();
session_destroy();
// $delay = 0;
// header("Refresh: $delay;"); 
echo json_encode(['success' => true]);
exit();
?>