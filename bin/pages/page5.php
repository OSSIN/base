<?php

include_once "sources/functional.php";

class Page5 extends Page
{
	function __construct($lng)
	{
		//lng - переменная которая содержит данные вида: ru, en, kz
		//$this->language - результат функции parse_ini_file
		
		parent::__construct($lng);

		/*$singform = new SingForm($this->language);

		$divWrapper = new Div();
		$divWrapper->class = "wrapper wrapper_sing";
		$divWrapper->nodes->add($singform);

		$langSwitcher = new LanguageSwitch($lng);
		$langSwitcher->addLanguage("ru");
		$langSwitcher->addLanguage("en");
		$langSwitcher->addLanguage("kz");

		$aHelp = new A();
		$aHelp->href = "#";
		$aHelp->class = "help_button";
		$aHelp->nodes->add("?");*/

		//body
		$body = new Body();
		$body->nodes->addComment("Комментарий");
		/*$body->nodes->add($divWrapper);
		$body->nodes->add($langSwitcher);
		$body->nodes->add(new SocialPanel());
		$body->nodes->add($aHelp);*/

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
		$scripts->nodes->add("js/controls.js", "defer");

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