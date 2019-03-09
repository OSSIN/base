<?php

include_once "bin/document.php";

session_start();

$rows;

if(isset($_POST["exit"]))
{
	unset($_SESSION["pointer"]);
	unset($_SESSION["clef"]);

	//header("Location: /");
	header("Location: /base");
}
else
{
	if(isset($_POST["blob"]))
	{
		$connect = new Connector();
		$connect->start();

		$link = mysqli_connect("localhost", "root", "", "db");

		$imageData = addslashes(file_get_contents('img/unknown.png'));

		$sql = "INSERT INTO images(iname, idata) VALUES ('unknown','{$imageData}')";
		mysqli_query($link, $sql);
		
		
		$sql = "SELECT idata FROM images WHERE iname='unknown'";
		$result = mysqli_query($link, $sql);
		$rows = mysqli_fetch_all($result);
		/*header("Content-type: image/png");
		echo $rows[0][0];*/
		$img = new Img();
		//$img->src = base64_encode($rows[0][0]);
		$img->src_base64 = $rows[0][0];
		echo $img->getHtml();
		//echo "<img src='data:image/jpg;base64,". base64_encode($rows[0][0])."' alt='imagename'>";
		mysqli_close($link);
	}
	else
	Document::getInstance()->Add(new Page2($_SESSION["lang"]));
}


?>

