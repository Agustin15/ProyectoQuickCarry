<?php


session_id("sessionFuncioQuick");
session_start();
session_destroy();
header('Location:login.html');

?>