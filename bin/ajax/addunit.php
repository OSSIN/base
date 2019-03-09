<?php

include_once "../pages/sources/functional.php";
session_start();

$connect = new Connector();
$connect->start();

$id_unit = $_POST['id_unit'];

$id_session = $_POST['id_session'];

$generation = +$_POST['generation'] + 1;

$field;
if($_POST['btn_id'] == "btn_add_father") 
{
	$gender = 1;
	$field = "id_father";
}
if($_POST['btn_id'] == "btn_add_mother") 
{
	$gender = 0;
	$field = "id_mother";
}

$connect->dataQuery("INSERT INTO units(id_session, root, id_image, generation, gender) VALUES ($id_session, 0, 1, $generation, $gender)");

$lastId = mysqli_fetch_all($connect->dataQuery("SELECT MAX(id) AS last_id FROM units WHERE id_session=$id_session"), MYSQLI_BOTH)[0][0];

$connect->dataQuery("UPDATE units SET ".$field."=$lastId WHERE id=$id_unit");

$connect->close();

echo json_encode($lastId);//возврашает id добавленного родителя

exit;
?>