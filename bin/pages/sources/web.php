<?php

	abstract class Element
	{
		abstract public function getHtml();
	};

	class None extends Element
	{
		public $nodes;

		function __construct()
		{
			$this->nodes = new Nodes();
		}
		
		public function getHtml()
		{
			return $this->nodes->getHtml();
		}
	};

	abstract class Common extends Element
	{
		public $id;
		public $class;
		public $dir;
		public $lang;
		public $style;
		public $title;
		public $xml_lang;
		public $event;
		
		protected function commonAttrHtml()
		{
			return 	($this->id ? "id='$this->id' " : "").
					($this->class ? "class='$this->class' " : "").
					($this->dir ? "dir='$this->dir' " : "").
					($this->lang ? "lang='$this->lang' " : "").
					($this->xml_lang ? "xml:lang='$this->xml_lang' " : "").
					($this->title ? "title='$this->title' " : "").
					($this->style ? "style='$this->style' " : "").
					($this->event ? $this->event : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "id": return $this->id;
				case "class": return $this->class;
				case "dir": return $this->dir;
				case "lang": return $this->lang;
				case "style": return $this->style;
				case "title": return $this->title;
				case "xml_lang": return $this->xml_lang;
				case "event": return $this->event;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "id": $this->id = $value;
					break;
				case "class": $this->class = $value;
					break;
				case "dir": $this->dir = $value;
					break;
				case "lang": $this->lang = $value;
					break;
				case "style": $this->style = $value;
					break;
				case "title": $this->title = $value;
					break;
				case "xml_lang": $this->xml_lang = $value;
					break;
				case "event": $this->event = $value;
					break;
			}
		}
	};

	abstract class Block extends Common
	{
		public $nodes;

		function __construct()
		{
			$this->nodes = new Nodes();
		}
	};

	//tags: contenteditable, contextmenu, hidden
	trait Auxiliary
	{
		public $contenteditable;
		public $contextmenu;
		public $hidden;

		protected function auxilAttrHtml()
		{
			return 	($this->contenteditable ? "contenteditable='$this->contenteditable' " : "").
					($this->contextmenu ? "contextmenu='$this->contextmenu' " : "").
					($this->hidden ? "hidden " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "contenteditable": return $this->contenteditable;
				case "contextmenu": return $this->contextmenu;
				case "hidden": return $this->hidden;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "contenteditable": $this->contenteditable = $value;
					break;
				case "contextmenu": $this->contextmenu = $value;
					break;
				case "hidden": $this->hidden = $value;
					break;
			}
		}
	};

	//tags: height, width, align
	trait AttrGroup1
	{
		public $height;
		public $width;
		public $align;

		protected function attrG1Html()
		{
			return 	($this->height ? "height='$this->height' " : "").
					($this->width ? "width='$this->width' " : "").
					($this->align ? "align='$this->align' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "height": return $this->height;
				case "width": return $this->width;
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "height": $this->height = $value;
					break;
				case "width": $this->width = $value;
					break;
				case "align": $this->align = $value;
					break;
			}
		}
	};

	//tags: char, charoff
	trait AttrGroup2
	{
		public $char;
		public $charoff;

		protected function attrG2Html()
		{
			return 	($this->char ? "char='$this->char' " : "").
					($this->charoff ? "charoff='$this->charoff' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "char": return $this->char;
				case "charoff": return $this->charoff;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "char": $this->char = $value;
					break;
				case "charoff": $this->charoff = $value;
					break;
			}
		}
	};

	//tags: align, valign
	trait AttrGroup3
	{
		public $align;
		public $valign;

		protected function attrG3Html()
		{
			return 	($this->align ? "align='$this->align' " : "").
					($this->valign ? "valign='$this->valign' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
				case "valign": return $this->valign;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
				case "valign": $this->valign = $value;
					break;
			}
		}
	};

	//tags: hspace, vspace
	trait AttrGroup4
	{
		public $hspace;
		public $vspace;

		protected function attrG4Html()
		{
			return 	($this->hspace ? "hspace='$this->hspace' " : "").
					($this->vspace ? "vspace='$this->vspace' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "hspace": return $this->hspace;
				case "vspace": return $this->vspace;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "hspace": $this->hspace = $value;
					break;
				case "vspace": $this->vspace = $value;
					break;
			}
		}
	};

	//tags: type
	trait AttrGroup5
	{
		public $type;

		protected function attrG5Html()
		{
			return ($this->type ? "type='$this->type' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "type": return $this->type;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "type": $this->type = $value;
					break;
			}
		}
	};

	//tags: accesskey, tabindex
	trait AttrGroup6
	{
		public $accesskey;
		public $tabindex;

		protected function attrG6Html()
		{
			return 	($this->accesskey ? "accesskey='$this->accesskey' " : "").
					($this->tabindex ? "tabindex='$this->tabindex' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "accesskey": return $this->accesskey;
				case "tabindex": return $this->tabindex;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "accesskey": $this->accesskey = $value;
					break;
				case "tabindex": $this->tabindex = $value;
					break;
			}
		}
	};

	//tags: name
	trait AttrGroup7
	{
		public $name;

		protected function attrG7Html()
		{
			return ($this->name ? "name='$this->name' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "name": return $this->name;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "name": $this->name = $value;
					break;
			}
		}
	};

	//tags: align
	trait AttrGroup8
	{
		public $align;

		protected function attrG8Html()
		{
			return ($this->align ? "align='$this->align' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	//tags: form, disabled
	trait AttrGroup9
	{
		public $form;
		public $disabled;

		protected function attrG9Html()
		{
			return 	($this->form ? "form='$this->form' " : "").
					($this->disabled ? "disabled " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "form": return $this->form;
				case "disabled": return $this->disabled;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "form": $this->form = $value;
					break;
				case "disabled": $this->disabled = $value;
					break;
			}
		}
	};

	//tags: src
	trait AttrGroup10
	{
		public $src;

		protected function attrG10Html()
		{
			return ($this->src ? "src='$this->src' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "src": return $this->src;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "src": $this->src = $value;
					break;
			}
		}
	};

	//tags: contextmenu, hidden
	trait AttrGroup11
	{
		public $contextmenu;
		public $hidden;

		protected function attrG11Html()
		{
			return 	($this->contextmenu ? "contextmenu='$this->contextmenu' " : "").
					($this->hidden ? "hidden " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "contextmenu": return $this->contextmenu;
				case "hidden": return $this->hidden;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "contextmenu": $this->contextmenu = $value;
					break;
				case "hidden": $this->hidden = $value;
					break;
			}
		}
	};

	//tags: height, width, align
	trait AttrGroup12
	{
		public $height;
		public $width;
		public $align;

		protected function attrG12Html()
		{
			return 	($this->height ? "height='$this->height' " : "").
					($this->width ? "width='$this->width' " : "").
					($this->align ? "align='$this->align' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "height": return $this->height;
				case "width": return $this->width;
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "height": $this->height = $value;
					break;
				case "width": $this->width = $value;
					break;
				case "align": $this->align = $value;
					break;	
			}
		}
	};

	//tags: background, bgcolor
	trait AttrGroup13
	{
		public $background;
		public $bgcolor;

		protected function attrG13Html()
		{
			return 	($this->background ? "background='$this->background' " : "").
					($this->bgcolor ? "bgcolor='$this->bgcolor' " : "");
		}

		public function __get($property)
		{
			switch($property)
			{
				case "background": return $this->background;
				case "bgcolor": return $this->bgcolor;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "background": $this->background = $value;
					break;
				case "bgcolor": $this->bgcolor = $value;
					break;	
			}
		}
	};

	class Elements extends Element
	{
		protected $html;

		public function add($elem)
		{
			if(is_object($elem)) 
			{
				$this->html .= $elem->getHtml();
			}
			else if(is_string($elem))
			{
				$this->html .= $elem;
			}
		}

		public function getHtml()
		{
			return $this->html;
		}
	};

	class Nodes extends Elements
	{
		public function addComment($comment)
		{
			if(is_string($comment))
			{
				$this->html .= "<!-- $comment -->";
			}
		}
	};

	class MessageBox extends Element
	{
		protected $html;
		
		public function show($elem)
		{
			if(is_object($elem)) 
			{
				$this->html = "<div id='message_box' class='message_box message_box_hide'>
								<span id='message'>$elem->getHtml()</span>
								</div>";
			}
			else if(is_string($elem))
			{
				$this->html = "<div id='message_box' class='message_box message_box_hide'>
								<span id='message'>$elem</span>
								</div>";
			}
		}

		public function getHtml()
		{
			return $this->html;
		}
	};

	class Page
	{
		protected $doctype;
		public $meta;
		public $links;
		public $scriptsTop;
		public $scriptsBottom;
		public $nodes;
		public $messageBox;
		protected $title;
		protected $charset;
		protected $xml_lang;
		protected $xmlns;
		protected $manifest;
		protected $language;

		function __construct($lng)
		{
			$this->meta = new Elements();
			$this->links = new Elements();
			$this->scriptsTop = new Elements();
			$this->scriptsBottom = new Elements();
			$this->nodes = new Nodes();
			$this->messageBox = new MessageBox();
			$this->language = parse_ini_file("language/".$lng."/lang.ini");

			$script = new Script();
			$script->nodes->add("var lang = '$lng';");

			$this->nodes->add($script);
		}

		public function __get($property)
		{
			switch($property)
			{
				case "doctype": return $this->doctype;
				case "title": return $this->title;
				case "charset": return $this->charset;
				case "xml_lang": return $this->xml_lang;
				case "xmlns": return $this->xmlns;
				case "manifest": return $this->manifest;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "doctype": $this->doctype = $value;
					break;
				case "title": $this->title = $value;
					break;
				case "charset": $this->charset = $value;
					break; 
				case "xml_lang": $this->xml_lang = $value;
					break; 
				case "xmlns": $this->xmlns = $value;
					break; 
				case "manifest": $this->manifest = $value;
					break; 
			}
		}
	};

	class Meta extends Element
	{
		protected $charset;
		protected $content;
		protected $http_equiv;
		protected $name;

		public function getHtml()
		{
			return "<meta ". 
					($this->charset ? "charset='$this->charset' " : "").
					($this->content ? "content='$this->content' " : "").
					($this->http_equiv ? "http-equiv='$this->http_equiv' " : "").
					($this->name ? "name='$this->name' " : "").
					">";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "charset": return $this->charset;
				case "href": return $this->href;
				case "media": return $this->media;
				case "rel": return $this->rel;
				case "sizes": return $this->sizes;
				case "type": return $this->type;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "charset": $this->charset = $value;
					break;
				case "href": $this->href = $value;
					break;
				case "media": $this->media = $value;
					break;
				case "rel": $this->rel = $value;
					break;
				case "sizes": $this->sizes = $value;
					break;
				case "type": $this->type = $value;
					break;
			}
		}
	};

	class Link extends Element
	{
		protected $charset;
		protected $href;
		protected $media;
		protected $rel;
		protected $sizes;
		protected $type;

		public function getHtml()
		{
			return "<link ". 
					($this->charset ? "charset='$this->charset' " : "").
					($this->href ? "href='$this->href' " : "").
					($this->media ? "media='$this->media' " : "").
					($this->rel ? "rel='$this->rel' " : "").
					($this->sizes ? "sizes='$this->sizes' " : "").
					($this->type ? "type='$this->type' " : "").
					">";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "charset": return $this->charset;
				case "href": return $this->href;
				case "media": return $this->media;
				case "rel": return $this->rel;
				case "sizes": return $this->sizes;
				case "type": return $this->type;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "charset": $this->charset = $value;
					break;
				case "href": $this->href = $value;
					break;
				case "media": $this->media = $value;
					break;
				case "rel": $this->rel = $value;
					break;
				case "sizes": $this->sizes = $value;
					break;
				case "type": $this->type = $value;
					break;
			}
		}
	};

	//----------Script---------------
	//summary
	//Class implementing tag 'Script'
	//This class uniting two attributes('async', 'defer') of this tag in property 'typeload'
	//sammary
	class Script extends Block
	{
		protected $typeload;
		protected $language;
		protected $src;
		protected $type;

		public function getHtml()
		{
			return "<script ".
					($this->language ? "language='$this->language' " : "").
					($this->src ? "src='$this->src' " : "").
					($this->typeload ? $this->typeload." " : "").
					($this->type ? "type='$this->type' " : "").
					">{$this->nodes->getHtml()}</script>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "typeload": return $this->typeload;
				case "language": return $this->language;
				case "src": return $this->src;
				case "type": return $this->type;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "typeload": $this->typeload = $value;
					break; 
				case "language": $this->language = $value;
					break; 
				case "src": $this->src = $value;
					break; 
				case "type": $this->type = $value;
					break; 
			}
		}
	};

	class Body extends Block
	{
		public function getHtml()
		{
			return "<body ".
					$this->commonAttrHtml().
					">{$this->nodes->getHtml()}</body>";
		}
	};

	class A extends Block
	{
		use Auxiliary;
		use AttrGroup5;
		use AttrGroup6;
		use AttrGroup7;
		protected $coords;
		protected $download;
		protected $href;
		protected $hreflang;
		protected $rel;
		protected $rev;
		protected $shape;
		protected $target;

		public function getHtml()
		{
			return "<a ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					$this->attrG5Html().
					$this->attrG6Html().
					$this->attrG7Html().
					($this->coords ? "coords='$this->coords' " : "").
					($this->download ? "download " : "").
					($this->href ? "href='$this->href' " : "").
					($this->hreflang ? "hreflang='$this->hreflang' " : "").
					($this->rel ? "rel='$this->rel' " : ""). 
					($this->rev ? "rev='$this->rev' " : ""). 
					($this->shape ? "shape='$this->shape' " : ""). 
					($this->target ? "target='$this->target' " : ""). 		
					">{$this->nodes->getHtml()}</a>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "coords": return $this->coords;
				case "download": return $this->download;
				case "href": return $this->href;
				case "hreflang": return $this->hreflang;
				case "rel": return $this->rel;
				case "rev": return $this->rev;
				case "shape": return $this->shape;
				case "target": return $this->target;
				case "title": return $this->title;
				case "style": return $this->style;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "coords": $this->coords = $value;
					break; 
				case "download": $this->download = $value;
					break;
				case "href": $this->href = $value;
					break;
				case "hreflang": $this->hreflang = $value;
					break;
				case "rel": $this->rel = $value;
					break;
				case "rev": $this->rev = $value;
					break;
				case "shape": $this->shape = $value;
					break;
				case "target": $this->target = $value;
					break;
				case "title": $this->title = $value;
					break;
				case "style": $this->style = $value;
					break;
			}
		}
	};

	class Abbr extends Block
	{
		use Auxiliary;

		public function getHtml()
		{
			return "<abbr ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</abbr>";
		}
	};

	class Acronym extends Block
	{
		public function getHtml()
		{
			return "<acronym ".
					$this->commonAttrHtml().
					">{$this->nodes->getHtml()}</acronym>";
		}
	};

	class Address extends Block
	{
		use Auxiliary;
		
		public function getHtml()
		{
			return "<address ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</address>";
		}
	};

	class B extends Block
	{
		use Auxiliary;
		
		public function getHtml()
		{
			return "<b ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</b>";
		}
	};

	class Bdo extends Block
	{
		use Auxiliary;
				
		public function getHtml()
		{
			return "<bdo ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().					
					">{$this->nodes->getHtml()}</bdo>";
		}
	};

	class Big extends Block
	{
		protected $hidden;

		public function getHtml()
		{
			return "<big ".
					$this->commonAttrHtml().
					($this->hidden ? "hidden " : "").
					">{$this->nodes->getHtml()}</big>";
		}

		public function __get($property)
		{
			switch ($property)
			{
				case 'hidden': return $this->hidden;
			}
		}

		public function __set($property, $value)
		{
			switch ($property)
			{
				case 'hidden': $this->hidden = $value;
					break;
			}
		}
	};

	class Br extends Common
	{
		protected $clear;

		public function getHtml()
		{
			return "<br ".
					($this->clear ? "clear='$this->clear' " : "").
					$this->commonAttrHtml().
					">";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "clear": return $this->clear;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "clear": $this->clear = $value;
					break;
			}
		}
	};

	class Cite extends Block
	{
		use Auxiliary;

		public function getHtml()
		{
			return "<cite ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</cite>";
		}
	};

	class Code extends Block
	{
		use Auxiliary;

		public function getHtml()
		{
			return "<code ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</code>";
		}
	};

	class Applet extends Block
	{
		use AttrGroup1;
		use AttrGroup4;
		protected $alt;
		protected $archive;
		protected $code;
		protected $codebase;

		public function getHtml()
		{
			return "<applet ".
					$this->commonAttrHtml().
					$this->attrG1Html().
					$this->attrG4Html().
					($this->alt ? "alt='$this->alt' " : "").
					($this->archive ? "archive='$this->archive' " : "").
					($this->code ? "code='$this->code' " : "").
					($this->codebase ? "codebase='$this->codebase' " : "").
					">{$this->nodes->getHtml()}</applet>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "alt": return $this->alt;
				case "archive": return $this->archive;
				case "code": return $this->code;
				case "codebase": return $this->codebase;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "alt": $this->alt = $value;
					break;
				case "archive": $this->archive = $value;
					break;
				case "code": $this->code = $value;
					break;
				case "codebase": $this->codebase = $value;
					break;
			}
		}
	};

	class Form extends Block
	{
		use Auxiliary;
		use AttrGroup7;
		protected $accept_charset;
		protected $action;
		protected $autocomplete;
		protected $enctype;
		protected $method;
		protected $novalidate;
		protected $target;

		public function getHtml()
		{
			return "<form ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml.
					$this->attrG7Html().
					($this->accept_charset ? "accept-charset='$this->accept_charset' " : "").
					($this->action ? "action='$this->action' " : "").
					($this->autocomplete ? "autocomplete='$this->autocomplete' " : "").
					($this->enctype ? "enctype='$this->enctype' " : "").
					($this->method ? "method='$this->method' " : "").
					($this->novalidate ? "novalidate " : "").
					($this->target ? "target='$this->target' " : "").
					">{$this->nodes->getHtml()}</form>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "accept_charset": return $this->accept_charset;
				case "action": return $this->action;
				case "autocomplete": return $this->autocomplete;
				case "enctype": return $this->enctype;
				case "method": return $this->method;
				case "novalidate": return $this->novalidate;
				case "target": return $this->target;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "accept_charset": $this->accept_charset = $value;
					break;
				case "action": $this->action = $value;
					break;
				case "autocomplete": $this->autocomplete = $value;
					break;
				case "enctype": $this->enctype = $value;
					break;
				case "method": $this->method = $value;
					break;
				case "novalidate": $this->novalidate = $value;
					break;
				case "target": $this->target = $value;
					break;
			}
		}
	};

	class Input extends Block
	{
		use Auxiliary;
		use AttrGroup5;
		use AttrGroup6;
		use AttrGroup7;
		use AttrGroup8;
		use AttrGroup9;
		use AttrGroup10;
		protected $accept;
		protected $alt;
		protected $autocomplete;
		protected $autofocus;
		protected $border;
		protected $checked;
		protected $formaction;
		protected $formenctype;
		protected $formmethod;
		protected $formnovalidate;
		protected $formtarget;
		protected $list;
		protected $max;
		protected $maxlength;
		protected $min;
		protected $multiple;
		protected $pattern;
		protected $placeholder;
		protected $readonly;
		protected $required;
		protected $size;
		protected $step;
		protected $value;

		public function getHtml()
		{
			return "<input ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml.
					$this->attrG5Html().
					$this->attrG6Html().
					$this->attrG7Html().
					$this->attrG8Html().
					$this->attrG9Html().
					$this->attrG10Html().
					($this->accept ? "accept='$this->accept' " : "").
					($this->alt ? "alt='$this->alt' " : "").
					($this->autocomplete ? "autocomplete='$this->autocomplete' " : "").
					($this->autofocus ? "autofocus " : "").
					($this->border ? "border='$this->border' " : "").
					($this->checked ? "checked " : "").
					($this->formaction ? "formaction='$this->formaction' " : "").
					($this->formmethod ? "formmethod='$this->formmethod' " : "").
					($this->formnovalidate ? "formnovalidate='$this->formnovalidate' " : "").
					($this->formtarget ? "formtarget='$this->formtarget' " : "").
					($this->list ? "list='$this->list' " : "").
					($this->max ? "max='$this->max' " : "").
					($this->maxlength ? "maxlength='$this->maxlength' " : "").
					($this->min ? "min='$this->min' " : "").
					($this->multiple ? "multiple " : "").
					($this->pattern ? "pattern='$this->pattern' " : "").
					($this->placeholder ? "placeholder='$this->placeholder' " : "").
					($this->readonly ? "readonly " : "").
					($this->required ? "required " : "").
					($this->size ? "size='$this->size' " : "").
					($this->step ? "step='$this->step' " : "").
					($this->value ? "value='$this->value' " : "").
					">{$this->nodes->getHtml()}</input>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "accept": return $this->accept;
				case "alt": return $this->alt;
				case "autocomplete": return $this->autocomplete;
				case "autofocus": return $this->autofocus;
				case "border": return $this->border;
				case "checked": return $this->checked;
				case "formaction": return $this->formaction;
				case "formmethod": return $this->formmethod;
				case "formnovalidate": return $this->formnovalidate;
				case "formtarget": return $this->formtarget;
				case "list": return $this->list;
				case "max": return $this->max;
				case "maxlength": return $this->maxlength;
				case "min": return $this->min;
				case "multiple": return $this->multiple;
				case "pattern": return $this->pattern;
				case "placeholder": return $this->placeholder;
				case "readonly": return $this->readonly;
				case "required": return $this->required;
				case "size": return $this->size;
				case "step": return $this->step;
				case "value": return $this->value;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "accept": $this->accept = $value;
					break;
				case "alt": $this->alt = $value;
					break;
				case "autocomplete": $this->autocomplete = $value;
					break;
				case "autofocus": $this->autofocus = $value;
					break;
				case "border": $this->border = $value;
					break;
				case "checked": $this->checked = $value;
					break;
				case "formaction": $this->formaction = $value;
					break;
				case "formmethod": $this->formmethod = $value;
					break;
				case "formnovalidate": $this->formnovalidate = $value;
					break;
				case "formtarget": $this->formtarget = $value;
					break;
				case "list": $this->list = $value;
					break;
				case "max": $this->max = $value;
					break;
				case "maxlength": $this->maxlength = $value;
					break;
				case "min": $this->min = $value;
					break;
				case "multiple": $this->multiple = $value;
					break;
				case "pattern": $this->pattern = $value;
					break;
				case "placeholder": $this->placeholder = $value;
					break;
				case "readonly": $this->readonly = $value;
					break;
				case "required": $this->required = $value;
					break;
				case "size": $this->size = $value;
					break;
				case "step": $this->step = $value;
					break;
				case "value": $this->value = $value;
					break;
			}
		}
	};

	class Div extends Block
	{
		use AttrGroup8;

		public function getHtml()
		{
			return "<div ".
					$this->commonAttrHtml().
					$this->attrG8Html().
					">{$this->nodes->getHtml()}</div>";
		}
	};

	class Span extends Block
	{
		use Auxiliary;

		public function getHtml()
		{
			return "<span ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</span>";
		}
	}

	class Img extends Common
	{
		use AttrGroup4;
		use AttrGroup10;
		use AttrGroup11;
		use AttrGroup12;
		protected $src_base64;
		protected $alt;
		protected $border;
		protected $ismap;
		protected $longdesc;
		protected $lowsrc;
		protected $usemap;

		public function getHtml()
		{
			return "<img ".
					$this->commonAttrHtml().
					$this->attrG4Html().
					$this->attrG10Html().
					$this->attrG11Html().
					$this->attrG12Html().
					($this->src_base64 ? "src='data:image/jpg;base64,$this->src_base64' " : "").
					($this->alt ? "alt='$this->alt' " : "").
					($this->border ? "border='$this->border' " : "").
					($this->ismap ? "ismap " : "").
					($this->longdesc ? "longdesc='$this->longdesc' " : "").
					($this->lowsrc ? "lowsrc='$this->lowsrc' " : "").
					($this->usemap ? "usemap='$this->usemap' " : "").
					$this->commonAttrHtml().
					">";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "src_base64": return $this->src_base64;
				case "alt": return $this->alt;
				case "border": return $this->border;
				case "ismap": return $this->ismap;
				case "longdesc": return $this->longdesc;
				case "lowsrc": return $this->lowsrc;
				case "usemap": return $this->usemap;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "src_base64": $this->src_base64 = base64_encode($value);
					break;
				case "alt": $this->alt = $value;
					break;
				case "border": $this->border = $value;
					break;
				case "ismap": $this->ismap = $value;
					break;
				case "longdesc": $this->longdesc = $value;
					break;
				case "lowsrc": $this->lowsrc = $value;
					break;
				case "usemap": $this->usemap = $value;
					break;
			}
		}
	};

	class I extends Block
	{
		use Auxiliary;

		public function getHtml()
		{
			return "<i ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					">{$this->nodes->getHtml()}</i>";
		}
	};

	class P extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<p ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</p>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H1 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h1 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h1>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H2 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h2 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h2>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H3 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h3 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h3>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H4 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h4 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h4>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H5 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h5 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h5>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class H6 extends Block
	{
		use Auxiliary;
		public $align;

		public function getHtml()
		{
			return "<h6 ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->align ? "align='$this->align' " : "").
					">{$this->nodes->getHtml()}</h6>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
			}
		}
	};

	class UL extends Block
	{
		use Auxiliary;
		public $type;

		public function getHtml()
		{
			return "<ul ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->type ? "type='$this->type' " : "").
					">{$this->nodes->getHtml()}</ul>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "type": return $this->type;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "type": $this->type = $value;
					break;
			}
		}
	};

	class Li extends Block
	{
		use Auxiliary;
		public $type;
		public $value;

		public function getHtml()
		{
			return "<ul ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					($this->type ? "type='$this->type' " : "").
					($this->value ? "value='$this->value' " : "").
					">{$this->nodes->getHtml()}</ul>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "type": return $this->type;
				case "value": return $this->value;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "type": $this->type = $value;
					break;
				case "value": $this->value = $value;
					break;
			}
		}
	};

	class Table extends Block
	{
		use Auxiliary;
		use AttrGroup1;
		use AttrGroup13;
		public $border;
		public $bordercolor;
		public $summary;
		public $cellpadding;
		public $cellspacing;
		public $cols;
		public $frame;
		public $rules;

		public function getHtml()
		{
			return "<table ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					$this->attrG1Html().
					$this->attrG13Html().
					($this->border ? "border='$this->border' " : "").
					($this->bordercolor ? "bordercolor='$this->bordercolor' " : "").
					($this->summary ? "summary='$this->summary' " : "").
					($this->cellpadding ? "cellpadding='$this->cellpadding' " : "").
					($this->cellspacing ? "cellspacing='$this->cellspacing' " : "").
					($this->cols ? "cols='$this->cols' " : "").
					($this->frame ? "frame='$this->frame' " : "").
					($this->rules ? "rules='$this->rules' " : "").
					">{$this->nodes->getHtml()}</table>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "border": return $this->border;
				case "bordercolor": return $this->bordercolor;
				case "summary": return $this->summary;
				case "cellpadding": return $this->cellpadding;
				case "cellspacing": return $this->cellspacing;
				case "cols": return $this->cols;
				case "frame": return $this->frame;
				case "rules": return $this->value;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "border": $this->border = $value;
					break;
				case "bordercolor": $this->bordercolor = $value;
					break;
				case "summary": $this->summary = $value;
					break;
				case "cellpadding": $this->cellpadding = $value;
					break;
				case "cellspacing": $this->type = $value;
					break;
				case "cols": $this->cols = $value;
					break;
				case "frame": $this->frame = $value;
					break;
				case "rules": $this->rules = $value;
					break;
			}
		}
	};

	class Td extends Block//реализован не полностью
	{
		use Auxiliary;
		use AttrGroup1;
		public $abbr;

		public function getHtml()
		{
			return "<td ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					$this->attrG1Html().
					($this->abbr ? "abbr='$this->abbr' " : "").
					">{$this->nodes->getHtml()}</td>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "abbr": return $this->abbr;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "abbr": $this->abbr = $value;
					break;
			}
		}
	};

	class Tr extends Block
	{
		use Auxiliary;
		use AttrGroup2;
		use AttrGroup3;			
		use AttrGroup13;
		public $align;
		public $valign;

		public function getHtml()
		{
			return "<tr ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml().
					$this->attrG2Html().
					$this->attrG3Html().
					$this->attrG13Html().
					($this->align ? "align='$this->align' " : "").
					($this->valign ? "valign='$this->valign' " : "").
					">{$this->nodes->getHtml()}</tr>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "align": return $this->align;
				case "valign": return $this->valign;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "align": $this->align = $value;
					break;
				case "valign": $this->valign = $value;
					break;
			}
		}
	};

	class Button extends Block
	{
		use Auxiliary;
		use AttrGroup5;
		use AttrGroup6;
		use AttrGroup7;
		use AttrGroup9;
		protected $autofocus;
		protected $formaction;
		protected $formenctype;
		protected $formmethod;
		protected $formnovalidate;
		protected $formtarget;
		protected $value;

		public function getHtml()
		{
			return "<button ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml.
					$this->attrG5Html().
					$this->attrG6Html().
					$this->attrG7Html().
					$this->attrG9Html().
					($this->autofocus ? "autofocus " : "").
					($this->formaction ? "formaction='$this->formaction' " : "").
					($this->formenctype ? "formenctype='$this->formenctype' " : "").
					($this->formmethod ? "formmethod='$this->formmethod' " : "").
					($this->formnovalidate ? "formnovalidate='$this->formnovalidate' " : "").
					($this->formtarget ? "formtarget='$this->formtarget' " : "").
					($this->value ? "value='$this->value' " : "").
					">{$this->nodes->getHtml()}</button>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "autofocus": return $this->autofocus;
				case "formaction": return $this->formaction;
				case "formenctype": return $this->formenctype;
				case "formmethod": return $this->formmethod;
				case "formnovalidate": return $this->formnovalidate;
				case "formtarget": return $this->formtarget;
				case "value": return $this->value;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "autofocus": $this->autofocus = $value;
					break;
				case "formaction": $this->formaction = $value;
					break;
				case "formenctype": $this->formenctype = $value;
					break;
				case "formmethod": $this->formmethod = $value;
					break;
				case "formnovalidate": $this->formnovalidate = $value;
					break;
				case "formtarget": $this->formtarget = $value;
					break;
				case "value": $this->value = $value;
					break;
			}
		}
	};

	class Label extends Block
	{
		use Auxiliary;
		protected $accesskey;
		protected $for;

		public function getHtml()
		{
			return "<label ".
					$this->commonAttrHtml().
					$this->auxilAttrHtml.
					($this->accesskey ? "accesskey='$this->accesskey' " : "").
					($this->for ? "for='$this->for' " : "").
					">{$this->nodes->getHtml()}</label>";
		}

		public function __get($property)
		{
			switch($property)
			{
				case "accesskey": return $this->accesskey;
				case "for": return $this->for;
			}
		}

		public function __set($property, $value)
		{
			switch($property)
			{
				case "accesskey": $this->accesskey = $value;
					break;
				case "for": $this->for = $value;
					break;
			}
		}
	};
?>