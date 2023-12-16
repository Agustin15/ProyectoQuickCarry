<?php

session_id("sessionCrecom");
session_start();
session_destroy();
header('Location:login.html');

?>