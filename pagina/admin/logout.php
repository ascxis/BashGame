<?php
session_start();

session_unset();

session_destroy();

header("Location: /pagina/index.php");
exit;
