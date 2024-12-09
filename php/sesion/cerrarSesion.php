<?php
session_start();

// Destruimos la sesión
session_destroy();

// Redirigimos al usuario a la página de inicio de sesión o a otra página deseada
header('Location: .../index.html');
exit;
?>