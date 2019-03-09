<?php

include_once "bin/document.php";

session_start();

$index = new Session($_SESSION, $_POST);
$_SESSION = $index->getSession();

$page1 = new Page1($_SESSION["lang"]);
$page1->messageBox->show($index->translate_value("WELCOME"));
$page4 = new Page4($_SESSION["lang"]);

/*if(isset($_GET["x"]))
{
	Document::getInstance()->Add(new Page3($_SESSION["lang"],true));
}*/

//Changing password
if(isset($_POST["restpass"]) && isset($_POST["confrestpass"]))
{
	if($_POST["restpass"] == $_POST["confrestpass"])
	{
		$index->change_pass($_SESSION["restemail"], $_POST["restpass"]);//changing password
		$page1->messageBox->show($index->translate_value("PASS_CHANGED"));
	}
	else
	{
		$page4->messageBox->show($index->translate_value("INVALID_EM_OR_PASS"));
		Document::getInstance()->Add($page4);
	}
}

//Sending email and receiving verification key to email
if(isset($_POST["restemail"]))
{
	if($index->exist_session($_POST["restemail"]))
	{
		$key = rand(1000, 9999);
		
		if( mail($_POST["restemail"], $index->translate_value("CAPTION_RECOV_PASS"), $key, "From: base@gmail.com") )
		{
			$index->clear_keys($_POST['restemail']);//delete old keys
			$index->save_key($_POST['restemail'], $key);//save current key
			Document::getInstance()->Add(new Page3($_SESSION["lang"], true));
			unset($_SESSION["restemail"]);//delete data email which for there was a recovery, if it exist
			$_SESSION["restemail"] = $_POST["restemail"];//save email which for there is a recovery
		}
		else
		{
			$page1->messageBox->show($index->translate_value("ERROR_SMTP"));
		}
	}
	else
	{
		$page3 = new Page3($_SESSION["lang"], false);
		$page3->messageBox->show($index->translate_value("UNDEF_EMAIL"));
		Document::getInstance()->Add($page3);
	}
}
//--------------------------------------

//Sending verification key
if(isset($_POST["verkey"]))
{
	if($index->exist_restoring($_SESSION["restemail"]))//check timestamp
	{
		if($index->check_key($_SESSION["restemail"], $_POST["verkey"]))
		{
			Document::getInstance()->Add(new Page4($_SESSION["lang"]));			
		}
		else
		{
			$page3 = new Page3($_SESSION["lang"], true);
			$page3->messageBox->show($index->translate_value("INVALID_KEY"));
			Document::getInstance()->Add($page3);
		}
		
	}
	else
	{
		$page1->messageBox->show($index->translate_value("INVALID_KEY"));
	}
}
//--------------------------------------

//Click on the button "Forgot password?"
if(isset($_POST["forgot"]))
{
	Document::getInstance()->Add(new Page3($_SESSION["lang"], false));
}

//Authentication
if(isset($_SESSION["pointer"]) && isset($_SESSION["clef"]) )
{
	if ($index->registered($_SESSION["pointer"], $_SESSION["clef"]))
	{
		header("Location: profile");
	}
	else
	{
		unset($_SESSION["pointer"]);
		unset($_SESSION["clef"]);
		$page1->messageBox->show($index->translate_value("INVALID_EM_OR_PASS"));
	}
}
else 
{
	if(isset($_POST["email"]) && isset($_POST["pass"]))
	{
		if ($index->registered($_POST["email"], $_POST["pass"]))
		{
			$index1 = new Session($_SESSION, $_POST);
			$_SESSION = $index1->getSession();

			header("Location: profile.php");
		}
		else
		{
			$page1->messageBox->show($index->translate_value("INVALID_EM_OR_PASS"));
		}
	}
	//Registration
	else if(isset($_POST["regemail"]) && isset($_POST["regpass"]) && isset($_POST["confpass"]))
	{
		if(!($index->exist_session($_POST["regemail"])))
		{
			if($_POST["regpass"] == $_POST["confpass"])
			{
				$index->new_session($_POST['regemail'], $_POST['regpass']);
				$page1->messageBox->show($_POST["regemail"]." ".$index->translate_value("REGISTR_SUCCES"));
			}
			else
			{
				$page1->messageBox->show($index->translate_value("PASS_NO_MATCH"));
			}
		}
		else
		{
			$page1->messageBox->show($index->translate_value("USER_ALREDY_EXIST"));
			Document::getInstance()->Add($page1);
		}
	}
}

Document::getInstance()->Add($page1);

?>

