<?php
session_start();       
require_once 'model/Usuarios.php';
$con = new Usuarios('chat', 'localhost', 'root', '');
$id = $_GET['id'];
$con->deletar($_SESSION['id_user'], $id);

