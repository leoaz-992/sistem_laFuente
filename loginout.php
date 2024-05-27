<?php
require_once("config/redireccion.php");
session_start();

session_unset();

session_destroy();

redirigirA('loginForm');
