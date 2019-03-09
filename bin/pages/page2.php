<?php

include_once "sources/functional.php";

class Page2 extends Page
{
	function __construct($lng)
	{
		parent::__construct($lng);

		$this->Initialization();
	}

	private function Initialization()
	{
		//span
		$aLogo = new A();
		$aLogo->class = "logo_mini";
		$aLogo->href = "#";
		$aLogo->nodes->add("StoryTree");

		$btn_exit = new ButtonPost("exit", "button_exit", "", $this->language["BTN_EXIT"]);
		$btn_exit->class = "exit";

		$subRPanel = new Div();
		$subRPanel->class = "sub_right_panel";
		$subRPanel->nodes->add($btn_exit);
		
		$panel = new Div();
		$panel->class = "manag_panel";
		$panel->nodes->add($aLogo);
		$panel->nodes->add($subRPanel);

		//Editor------------------------------------------------
		$editor = new Div();
		$editor->id = "editor";
		$editor->class = "editor";
		//содержимое editor формируется файлом dataofunits.php через ajax
		//------------------------------------------------------

		//body
		$body = new Body();
		$body->nodes->addComment("Комментарий");
		$body->nodes->add($panel);
		$body->nodes->add($editor);

		//meta1
		$meta1 = new Meta();
		$meta1->charset = "utf-8";
		
		//icon
		$icon = new Link();
		$icon->href = "img/favicon.ico";
		$icon->rel = "shortcut icon";

		$fontLobsterMontserrat = new Link();
		$fontLobsterMontserrat->href = "https://fonts.googleapis.com/css?family=Lobster|Montserrat:300";
		$fontLobsterMontserrat->rel = "stylesheet";

		$styles = new Styles();
		$styles->nodes->add("css/main.css");
		$styles->nodes->add("css/controls.css");
		$styles->nodes->add("css/glyphs.css");

		$scripts = new Scripts();
		$scripts->nodes->add("js/jquery.js", "defer");
		$scripts->nodes->add("js/script.js", "defer");
		$scripts->nodes->add("js/controls.js", "defer");
		$scripts->nodes->add("js/editor.js", "defer");

		//Page1
		$this->doctype = "Html";
		//$this->manifest = "22.cache";
		$this->xml_lang = "en";
		$this->xmlns = "http://www.w3.org/1999/xhtml" ;
		$this->title = "StoryTree";
		$this->meta->add($meta1);
		$this->links->add($fontLobsterMontserrat);
		$this->links->add($styles);
		$this->links->add($icon);
		$this->scriptsBottom->add($scripts);
		$this->nodes->add($body);
	}
};

?>