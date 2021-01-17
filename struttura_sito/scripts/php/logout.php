<?php

session_start();
session_unset();
session_destroy();

header("location: ../../pages/php/home.php");
