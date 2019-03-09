<?php

include_once "controls.php";
include_once "data_engine.php";

class CollectionStyles
{
	protected $html;

	public function add($url)
	{
		if(is_object($url)) 
		{
			$this->html .= "<span>Ощибка: функция add класса CollectionStyles не может принимать объекты.</span>";
		}
		else if(is_string($url))
		{
			$this->html .= "<link rel='stylesheet' type='text/css' href='".$url."'>";
		}
	}

	public function getHtml()
	{
		return $this->html;
	}
};

class CollectionScripts
{
	protected $html;

	public function add($url, $typeLoad)
	{
		if(is_object($url)) 
		{
			$this->html .= "<span>Ощибка: функция add класса CollectionScripts не может принимать объекты.</span>";
		}
		else if(is_string($url))
		{
			$this->html .= "<script src='".$url."' $typeLoad></script>";
		}
	}	

	public function getHtml()
	{
		return $this->html;
	}
};

class Styles
{
	public $nodes;

	public function __construct()
	{
		$this->nodes = new CollectionStyles();
	}

	public function getHtml()
	{
		return $this->nodes->getHtml();
	}
};

class Scripts
{
	public $nodes;

	public function __construct()
	{
		$this->nodes = new CollectionScripts();
	}

	public function getHtml()
	{
		return $this->nodes->getHtml();
	}
};

class Clear extends Div
{
	public function __construct()
	{
		parent::__construct();

		$this->class = "clear";
	}
};

class Session
{
	private $session;
	public $connect;
	private $post;
	private $lang;
	private $pointer;
	private $clef;

	public function __construct($sess, $pst)
	{
		$this->session = $sess;
		$this->post = $pst;

		$this->connect = new Connector();
	}
	
	public function getSession()
	{
		if (!isset($this->session["lang"])) 
		{
			if(isset($this->post["lang"]))
				$this->session["lang"] = $this->post["lang"];
			else
				$this->session["lang"] = "ru";
		}
		else
		{
			if(isset($this->post["lang"]))
			{
				if ($this->session["lang"] != $this->post["lang"])
				{
					$this->session["lang"] = $this->post["lang"];
				}
			}
		}

		if(isset($this->post["email"]) && isset($this->post["pass"]))
		{
			$this->session["pointer"] = $this->post["email"];
			$this->session["clef"] = $this->post["pass"];
		}

		return $this->session;
	}

	public function translate_value($pointer)
	{
		$value = parse_ini_file("language/".$this->session["lang"]."/lang.ini");
		return $value[$pointer];
	}

	public function registered($pntr, $clf)
	{
		$this->connect->start();
		$pointers = mysqli_num_rows($this->connect->dataQuery("SELECT * FROM sessions WHERE pointer='$pntr'"));
		$clefs = mysqli_num_rows($this->connect->dataQuery("SELECT * FROM signatures WHERE clef=MD5('$clf') AND id_session=(SELECT id FROM sessions WHERE pointer='$pntr')"));

		$this->connect->close();

		return $pointers > 0 && $clefs > 0;
	}

	public function exist_session($pntr)
	{	
		$this->connect->start();	
		$pointers = mysqli_num_rows($this->connect->dataQuery("SELECT * FROM sessions WHERE pointer='$pntr'"));

		$this->connect->close();
		return $pointers > 0;
	}

	public function exist_restoring($pntr)
	{		
		$this->connect->start();	

		$result = mysqli_num_rows($this->connect->dataQuery("SELECT * FROM tempkeys WHERE id_session=(SELECT id FROM sessions WHERE pointer='$pntr') AND 600 > (SELECT UNIX_TIMESTAMP(CURRENT_TIMESTAMP) - UNIX_TIMESTAMP((SELECT date_send FROM tempkeys WHERE id_session=(SELECT id FROM sessions WHERE pointer='$pntr'))))"));
		
		$this->connect->close();

		return $result > 0;
	}

	public function new_session($pntr, $clf)
	{
		$this->connect->start();	

		$this->connect->dataQuery("INSERT INTO sessions(pointer) VALUES ('$pntr')");
		$this->connect->dataQuery("INSERT INTO signatures(id_session, clef) VALUES ( (SELECT id FROM sessions WHERE pointer='$pntr'), MD5('$clf'))");
		$this->connect->dataQuery("INSERT INTO units(id_session, root, id_image, generation) VALUES ((SELECT id FROM sessions WHERE pointer='$pntr'), 1, (SELECT id FROM images WHERE iname='unknown'), 0)");

		$this->connect->close();
	}

	public function save_key($pntr, $key)
	{
		$this->connect->start();

		$this->connect->dataQuery("INSERT INTO tempkeys(id_session, current_key) VALUES ((SELECT id FROM sessions WHERE pointer='$pntr'), MD5($key))");

		$this->connect->close();
	}

	public function clear_keys($pntr)
	{
		$this->connect->start();

		$this->connect->dataQuery("DELETE FROM `tempkeys` WHERE id_session=(SELECT id FROM sessions WHERE pointer='$pntr')");

		$this->connect->close();
	}

	public function check_key($pntr, $key)
	{		
		$this->connect->start();

		$result = mysqli_num_rows($this->connect->dataQuery("SELECT * FROM `tempkeys` WHERE current_key=MD5('$key') AND id_session=(SELECT id FROM sessions WHERE pointer='$pntr')"));

		$this->connect->close();

		return $result > 0;
	}

	public function change_pass($pntr, $key)
	{
		$this->connect->start();

		$this->connect->dataQuery("UPDATE `signatures` SET clef=MD5('$key') WHERE id_session=(SELECT id FROM sessions WHERE pointer='$pntr');");

		$this->connect->close();
	}
};

?>