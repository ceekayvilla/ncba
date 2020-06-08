<?php
const ROOT = '../';
include_once(ROOT.'config/constants.php');
unset($_SESSION);
session_destroy();
header('Location:'.BASE_URL);

?>