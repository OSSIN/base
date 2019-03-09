<?php

include_once "web.php";

class LanguageSwitch extends Form
{
	protected $lg;

	public function __construct($lg)
	{
		parent::__construct();

		$span = new Span();
		$span->class = "lang_face";
		$span->nodes->add($lg);
		
		$this->lg = $lg;
		$this->class = "language_switch";
		$this->method = "post";
		$this->nodes->add($span);
	}

	public function addLanguage($lang)
	{
		$submit = new Input();
		$submit->id = "lang_".$lang;
		$submit->name = "lang";
		$submit->type = "submit";
		$submit->value = $lang;

		if ($lang == $this->lg)
			$submit->class = "lang_switch lang_switch_activ";
		else
			$submit->class = "lang_switch ";

		$this->nodes->add($submit);
	}
};

class SingForm extends Div
{
	//$language хранит результат парсинга ini-файла
	protected $language;

	public function __construct($lg)
	{
		parent::__construct();
		$this->language = $lg;

		$this->Initialization();
	}

	private function Initialization()
	{
		$aLogo = new A();
		$aLogo->class = "logo";
		$aLogo->href = "#";
		$aLogo->nodes->add("StoryTree");

		$spanSingup = new Span();
		$spanSingup->class = "trans shown_form";
		$spanSingup->id = "transup";
		$spanSingup->nodes->add($this->language["SING_UP"]); 

		$spanSingin = new Span();
		$spanSingin->class = "trans hiden_form";
		$spanSingin->id = "transin";
		$spanSingin->nodes->add($this->language["SING_IN"]); 

		//form1___________________________________________
		$input1 = new Input();
		$input1->type = "email";
		$input1->name = "email";
		$input1->placeholder = $this->language["ENT_EMAIL"];

		$input2 = new Input();
		$input2->type = "password";
		$input2->name = "pass";
		$input2->placeholder = $this->language["ENT_PASS"];

		$input3 = new Input();
		$input3->type = "submit";
		$input3->name = "singin";
		$input3->value = $this->language["SING_IN_BTN"];

		$form1 = new Form();
		$form1->method = "post";
		$form1->id = "singin";
		$form1->class = "shown_form";
		$form1->event = "onsubmit=\"empty(this);return false;\"";
		$form1->nodes->add($input1);
		$form1->nodes->add($input2);
		$form1->nodes->add($input3);
		//_________________________________________________

		//form2___________________________________________
		$input4 = new Input();
		$input4->type = "email";
		$input4->name = "regemail";
		$input4->placeholder = $this->language["ENT_EMAIL"];

		$input5 = new Input();
		$input5->type = "password";
		$input5->name = "regpass";
		$input5->placeholder = $this->language["ENT_PASS"];

		$input6 = new Input();
		$input6->type = "password";
		$input6->name = "confpass";
		$input6->placeholder = $this->language["CON_PASS"];

		$input7 = new Input();
		$input7->type = "submit";
		$input7->name = "singup";
		$input7->value = $this->language["SING_UP_BTN"];

		$form2 = new Form();
		$form2->method = "post";
		$form2->id = "singup";
		$form2->class = "hiden_form";
		$form2->event = "onsubmit=\"empty(this);return false;\"";
		$form2->nodes->add($input4);
		$form2->nodes->add($input5);
		$form2->nodes->add($input6);
		$form2->nodes->add($input7);
		//_________________________________________________

		$btn_forgot = new ButtonPost("forgot", "button_forgot", "", $this->language["LINK_FORGOTPASS"]);
		$btn_forgot->id = "forgot";
		$btn_forgot->class = "shown_form";

		$this->class = "sing_form";
		$this->nodes->add($aLogo);
		$this->nodes->add($spanSingin);
		$this->nodes->add($spanSingup);
		$this->nodes->add($form1);
		$this->nodes->add($form2);
		$this->nodes->add($btn_forgot);
	}
};

class SocialPanel extends Div
{
	public function __construct()
	{
		parent::__construct();

		$this->Initialization();
	}

	private function Initialization()
	{
		$i_vk = new I();
		$i_vk->class = "socialicon icon-vk";

		$a_vk = new A();
		$a_vk->href = "vk.com";
		$a_vk->nodes->add($i_vk);

		$i_ok = new I();
		$i_ok->class = "socialicon icon-ok";

		$a_ok = new A();
		$a_ok->href = "#";
		$a_ok->nodes->add($i_ok);

		$i_insta = new I();
		$i_insta->class = "socialicon icon-insta";

		$a_insta = new A();
		$a_insta->href = "#";
		$a_insta->nodes->add($i_insta);

		$this->class = "socialblock";
		$this->nodes->add($a_vk);
		$this->nodes->add($a_ok);
		$this->nodes->add($a_insta);
	}
};

class ButtonPost extends Form
{

	public function __construct($name, $class, $action, $value)
	{
		parent::__construct();

		$submit = new Input();
		$submit->name = $name;
		$submit->class = $class;
		$submit->type = "submit";
		$submit->value = $value;

		$this->method = "post";
		$this->action = $action;
		$this->nodes->add($submit);
	}
};

class ClearPost extends Form
{

	public function __construct($name, $class, $value)
	{
		parent::__construct();

		$btnBack = new Span();
		$btnBack->id = $name;
		$btnBack->class = $class;
		$btnBack->event = "onclick = 'document.getElementById(\"form_$name\").submit();'";
		$btnBack->value = $value;

		$this->id = "form_".$name;
		$this->method = "post";
		$this->nodes->add($btnBack);
	}
};

class Unit extends Div
{
	private $image;

	public function __construct($photo)
	{
		parent::__construct();

		$image = new Img();
		$image->src_base64 = $photo;

		$frame = new Div();
		$frame->class = "unit_frame";
		$frame->nodes->add($image);

		$button = new Div();
		$button->class = "unit_btn";
		
		$this->class = "unit unit_hide";
		$this->nodes->add($frame);
		$this->nodes->add($button);
	}

	public function __get($property)
	{
		switch ($property) {
			case 'image': return $this->image->src_base64;
		}
	}

	public function __set($property, $value)
	{
		switch ($property) {
			case 'image': $this->image->src_base64 = $value;
				break;
		}
	}
};

class Sibling extends Div
{
	private $image;

	public function __construct($photo)
	{
		parent::__construct();

		$image = new Img();
		$image->src_base64 = $photo;

		$this->class = "sibling sibling_hide";
		$this->nodes->add($image);
	}

	public function __get($property)
	{
		switch ($property) {
			case 'image': return $this->image->src_base64;
		}
	}

	public function __set($property, $value)
	{
		switch ($property) {
			case 'image': $this->image->src_base64 = $value;
				break;
		}
	}
};

class ButtonFileSelection extends Div
{
	function __construct()
	{
		parent::__construct();

		$button = new Button();
		$button->id = "buttonfs";
		$button->class = "buttonFS";

		$input = new Input();
		$input->type = "file";
		$input->id = "inputfs";
		$input->class = "inputFS";

		$this->class = "buttonFileSelection";
		$this->nodes->add($button);
		$this->nodes->add($input);
	}
}

class EditAndViewForm extends Form
{
	//$language хранит результат парсинга ini-файла
	protected $language;

	function __construct($lg)
	{
		parent::__construct();
		$this->language = $lg;

		$this->Initialization();
	}

	function Initialization()
	{
		$input_fname = new Input();
		$input_fname->type = "text";
		$input_fname->id = "input_fname";
		$input_fname->class = "fields";
		$input_fname->placeholder = $this->language["FNAME"];

		$input_lname = new Input();
		$input_lname->type = "text";
		$input_lname->id = "input_lname";
		$input_lname->class = "fields";
		$input_lname->placeholder = $this->language["LNAME"];

		$input_patron = new Input();
		$input_patron->type = "text";
		$input_patron->id = "input_patron";
		$input_patron->class = "fields";
		$input_patron->placeholder = $this->language["PATRONAME"];

		$wrapperFullName = new Div();
		$wrapperFullName->nodes->add($input_lname);
		$wrapperFullName->nodes->add($input_fname);		
		$wrapperFullName->nodes->add($input_patron);

		$label_birthday = new Label();
		$label_birthday->id = "label_birthday";
		$label_birthday->class = "label";
		$label_birthday->for = "input_birthday";
		$label_birthday->nodes->add($this->language["BIRTHDAY"]);

		$input_birthday = new Input();
		$input_birthday->type = "date";
		$input_birthday->id = "input_birthday";
		$input_birthday->class = "fields fields_date";

		$wrapperBirthday = new Div();
		$wrapperBirthday->class = "wrapperDate";
		$wrapperBirthday->nodes->add($label_birthday);
		$wrapperBirthday->nodes->add($input_birthday);

		$label_retired = new Label();
		$label_retired->id = "label_retired";
		$label_retired->class = "label";
		$label_retired->for = "input_retired";
		$label_retired->nodes->add($this->language["RETIRED"]);

		$input_retired = new Input();
		$input_retired->type = "date";
		$input_retired->id = "input_retired";
		$input_retired->class = "fields fields_date";

		$wrapperRetired = new Div();
		$wrapperRetired->class = "wrapperDate";
		$wrapperRetired->nodes->add($label_retired);
		$wrapperRetired->nodes->add($input_retired);

		$this->nodes->add($wrapperFullName);
		$this->nodes->add($wrapperBirthday);
		$this->nodes->add($wrapperRetired);
	}
}

class DataPanel extends Div
{
	//$language хранит результат парсинга ini-файла
	protected $language;

	function __construct($lg)
	{
		parent::__construct();
		$this->language = $lg;

		$this->Initialization();
	}

	function Initialization()
	{
		$btn_close = new Div();
		$btn_close->id = "btn_close";
		$btn_close->class = "btn_close";

		$photo = new Img();
		$photo->id = "unit_photo";
		$photo->class = "unit_photo";

		$btnPhoto = new ButtonFileSelection();

		$form = new EditAndViewForm($this->language);
		$form->class = "edit_view_form";

		$btnAddFather = new Button();
		$btnAddFather->id = "btn_add_father";
		$btnAddFather->class = "btn_add";
		$btnAddFather->nodes->add($this->language["ADDFATHER"]);

		$btnAddMother = new Button();
		$btnAddMother->id = "btn_add_mother";
		$btnAddMother->class = "btn_add";
		$btnAddMother->nodes->add($this->language["ADDMOTHER"]);

		$btnAddBrother = new Button();
		$btnAddBrother->id = "btn_add_brother";
		$btnAddBrother->class = "btn_add";
		$btnAddBrother->nodes->add($this->language["ADDBROTHER"]);

		$btnAddSister = new Button();
		$btnAddSister->id = "btn_add_sister";
		$btnAddSister->class = "btn_add";
		$btnAddSister->nodes->add($this->language["ADDSISTER"]);

		$this->nodes->add($btn_close);
		$this->nodes->add($photo);
		$this->nodes->add($btnPhoto);
		$this->nodes->add($form);
		$this->nodes->add($btnAddFather);
		$this->nodes->add($btnAddMother);
		$this->nodes->add($btnAddBrother);
		$this->nodes->add($btnAddSister);
	}
}

?>