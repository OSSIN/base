<?php

include_once "sources/functional.php";

class Page4 extends Page
{
	function __construct($lng)
	{
		//lng - переменная которая содержит данные вида: ru, en, kz
		//$this->language - результат функции parse_ini_file		
		parent::__construct($lng);		

		$h1 = new H1();
		$h1->nodes->add($this->language["CAPTION_RECOV_PASS"]);

		$span1 = new Span();
		$span1->nodes->add($this->language["DEFINIC_NEW_PASS"]);

		//form1___________________________________________
		$input1 = new Input();
		$input1->type = "password";
		$input1->name = "restpass";
		$input1->placeholder = $this->language["ENT_PASS"];

		$input2 = new Input();
		$input2->type = "password";
		$input2->name = "confrestpass";
		$input2->placeholder = $this->language["CON_PASS"];

		$input3 = new Input();
		$input3->type = "submit";
		$input3->name = "singin";
		$input3->value = $this->language["SAVE_PASS"];

		$form1 = new Form();
		$form1->method = "post";
		$form1->id = "singin";
		$form1->class = "shown_form";
		$form1->event = "onsubmit=\"empty(this);return false;\"";
		$form1->nodes->add($input1);
		$form1->nodes->add($input2);
		$form1->nodes->add($input3);	

		$span2 = new Span();
		$span2->nodes->add($this->language["DESCRIP_NEW_PASS"]);

		$divWrap = new Div();
		$divWrap->class = "wrapper wrapper_send";
		$divWrap->nodes->add($h1);
		$divWrap->nodes->add($span1);
		$divWrap->nodes->add($form1);
		$divWrap->nodes->add($span2);

		$btnBack = new ClearPost("back", "icon-left button_back", "");

		//body
		$body = new Body();
		$body->nodes->addComment("Комментарий");
		$body->nodes->add($divWrap);
		$body->nodes->add($btnBack);

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
		$scripts->nodes->add("js/script.js", "defer");

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