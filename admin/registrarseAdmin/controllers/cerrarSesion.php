<?php

//cerrar session

session_id("sessionAdmin");
session_start();
session_destroy();
header('Location:login.html');

?>