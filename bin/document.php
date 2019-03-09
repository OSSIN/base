<?php

include "pages/page1.php";
include "pages/page2.php";
include "pages/page3.php";
include "pages/page4.php";
include "pages/page5.php";

class Document
{
	private static $methodcalled = false;
	private static $instance;  // экземпляр объекта
    private function __construct(){ /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
    private function __clone()    { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    private function __wakeup()   { /* ... @return Singleton */ }  // Защищаем от создания через unserialize
    public static function getInstance() {    // Возвращает единственный экземпляр класса. @return Singleton
        if ( empty(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

	public function Add($page)
	{
		if ( !(self::$methodcalled) ) 
		{
			echo "<!DOCTYPE $page->doctype>
			<html ".
			($page->xml_lang ? "xml:lang='$page->xml_lang' " : "").
			($page->xmlns ? "xmlns='$page->xmlns' " : "").
			($page->manifest ? "manifest='$page->manifest' " : "").">
			 <head>
			  <title>$page->title</title>
			  {$page->meta->getHtml()}
			  {$page->links->getHtml()}
			 </head>
			 {$page->scriptsTop->getHtml()}
			 {$page->messageBox->getHtml()}
			 {$page->nodes->getHtml()}
			 {$page->scriptsBottom->getHtml()}
			</html>";

			self::$methodcalled = true;
		}
	}
};


?>