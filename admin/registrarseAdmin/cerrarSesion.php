<?php

//cerrar session 
session_start();
session_destroy();
header('Location:  http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/login.html');

?>