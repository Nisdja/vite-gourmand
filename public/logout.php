<?php

require_once "../app/helpers/session.php";

session_destroy();

header("Location: login.php");

exit();