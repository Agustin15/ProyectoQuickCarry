<?php

//cerrar session
session_id("sessionChofer");
session_start();
session_destroy();
header('Location: login.html');

?>