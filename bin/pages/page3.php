<?php

include_once "sources/functional.php";

class Page3 extends Page
{
	function __construct($lng, $condition)
	{
		//lng - переменная которая содержит данные вида: ru, en, kz
		//$this->language - результат функции parse_ini_file		
		parent::__construct($lng);	

		$h1 = new H1();
		$h1->nodes->add($this->language["CAPTION_RECOV_PASS"]);

		$span1 = new Span();

		$input1 = new Input();
		$input1->class = "forgot_email";

		$input2 = new Input();
		$input2->type = "submit";
		$input2->class = "forgot_submit";

		$form1 = new Form();
		$form1->method = "post";
		$form1->class = "show_form";
		$form1->event = "onsubmit=\"empty(this);return false;\"";

		$span2 = new Span();

		//Code received-------------------------------------------
		if($condition)
		{	
			$span1->nodes->add($this->language["DEFINIC_ENT_KEY"]);

			//form1___________________________________________
			$input1->type = "text";
			$input1->name = "verkey";			
			$input1->placeholder = $this->language["ENT_KEY"];

			$input2->name = "sendkey";
			$input2->value = $this->language["SEND"];

			$form1->nodes->add($input1);
			$form1->nodes->add($input2);
			$form1->nodes->add(new Clear());
			//_________________________________________________		

			$span2->nodes->add($this->language["DESCRIP_ENT_KEY"]);
		}
		//Code unreceived-------------------------------------------
		else
		{			
			$span1->nodes->add($this->language["DEFINIC_RECOV_PASS"]);

			//form1___________________________________________
			$input1->type = "email";
			$input1->name = "restemail";			
			$input1->placeholder = $this->language["ENT_EMAIL"];

			$input2->name = "sendemail";
			$input2->value = $this->language["SEND"];

			$form1->nodes->add($input1);
			$form1->nodes->add($input2);
			$form1->nodes->add(new Clear());
			//_________________________________________________		

			$span2->nodes->add($this->language["DESCRIP_RECOV_PASS"]);
		}

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