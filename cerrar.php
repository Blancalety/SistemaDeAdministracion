<?php

// session_name('user_session');
session_start();
session_destroy();
header("Location: productos.php");

?>