<?php

include_once "../pages/sources/functional.php";
//session_set_cookie_params(10800);
session_start();

$connect = new Connector();
$connect->start();

//Загруска данный о поколениях и юнитах из бызы---------------------------------------------------------------
//юниты соответствующие текущей сессии
$DtUnits = $connect->dataQuery("SELECT * FROM units LEFT JOIN base_data USING(id) WHERE id_session=(SELECT id FROM sessions WHERE pointer='".$_SESSION['pointer']."')");
$TbUnits = mysqli_fetch_all($DtUnits, MYSQLI_BOTH);

//id текущей сессии
$IdCurrSessInDB = $connect->dataQuery("SELECT id FROM sessions WHERE pointer='".$_SESSION['pointer']."'");
$IdCurrSessInDB = mysqli_fetch_all($IdCurrSessInDB, MYSQLI_BOTH)[0][0];

//максимальное значение в generation, для текущей сессии
$maxGen = mysqli_fetch_all($connect->dataQuery("SELECT MAX(generation) AS max_gen FROM units WHERE id_session=(SELECT id FROM sessions WHERE pointer='".$_SESSION['pointer']."')"), MYSQLI_BOTH)[0][0];
//-------------------------------------------------------------------------------------------------------------

//Editor-------------------------------------------------------------------------------------------------------
		$editor = new None();

		//$maxGen = mysqli_fetch_all($connect->dataQuery("SELECT MAX(generation) AS max_gen FROM units WHERE id_session=(SELECT id FROM sessions WHERE pointer='".$_SESSION['pointer']."')"), MYSQLI_BOTH)[0][0];

		$generations;

		for ($i = 0; $i <= $maxGen; $i++) { 
			$gen = new Div();
			$gen->id = "gen".$i;
			$gen->class = "generation";
			$generations[$i] = $gen;
		}

		$DataUnits = $connect->dataQuery("SELECT * FROM units WHERE id_session=(SELECT id FROM sessions WHERE pointer='".$_SESSION['pointer']."')");
		$TableUnits = mysqli_fetch_all($DataUnits, MYSQLI_BOTH);

		$siblings = [];

		for($i = 0; $i < mysqli_num_rows($DataUnits); $i++)
		{
			if($TableUnits[$i]["id_sibling"] != null)//юниты которые имеют отношение брат/сестра
			{
				$siblings[] = $TableUnits[$i];
			}
		}

		for($i = 0; $i < mysqli_num_rows($DataUnits); $i++)
		{
			if($TableUnits[$i]["id_sibling"] == null)//юниты которые имеют прямое отношение(не брат/сестра)
			{
				$unit = new Unit(mysqli_fetch_all($connect->dataQuery("SELECT idata FROM images WHERE id='".$TableUnits[$i]["id_image"]."'"))[0][0]);
				$unit->id = $TableUnits[$i]["id"];

				for ($j=0; $j < count($siblings); $j++) 
				{ 
					if($siblings[$j]["id_sibling"] == $TableUnits[$i]["id"])
					{
						$sibling = new Sibling(mysqli_fetch_all($connect->dataQuery("SELECT idata FROM images WHERE id='".$siblings[$j]["id_image"]."'"))[0][0]);
						$sibling->id = $siblings[$j]["id"];

						$unit->nodes->add($sibling);
					}
				}

				$generations[$TableUnits[$i]["generation"]]->nodes->add($unit);
			}
		}

		for ($i = $maxGen; $i >= 0; $i--)
		{ 
			$editor->nodes->add($generations[$i]);
		}

		$language = parse_ini_file("../pages/sources/language/".$_SESSION["lang"]."/lang.ini");

		$edit_panel = new DataPanel($language);
		$edit_panel->id = "edit_panel";
		$edit_panel->class = "edit_panel hide_edit_panel";

		$editor->nodes->add($edit_panel);
//-----------------------------------------------------------------------------------------------------------

//массив данных для передачи в js
$arr = [$TbUnits, $maxGen, $IdCurrSessInDB, $editor->getHtml()];

echo json_encode($arr);

$connect->close();

exit;
?>