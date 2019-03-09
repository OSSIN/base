var Language = 
{
	'ru' : 
	{
		'ALL_FIELDS_FULL' : 'Все поля должны быть заполнены',
		'PASS_NOT_MATCH' : 'Введеные пароли не совпадают'
	},
	'en' : 
	{
		'ALL_FIELDS_FULL' : 'All fields must be filled',
		'PASS_NOT_MATCH' : 'Entered passwords do not match'
	},
	'kz' : 
	{
		'ALL_FIELDS_FULL' : 'Барлық өрістер толтырылуы керек',
		'PASS_NOT_MATCH' : 'Енгізілген құпия сөздер сәйкес келмейді'
	}
};

function message_show_hide()
{
	if(document.getElementById('message_box'))
	{
		message_box.classList.toggle("message_box_hide");
		message_box.classList.toggle("message_box_show");
	}
}

function message_show()
{
	if(document.getElementById('message_box'))
	{
		if(message_box.classList.contains('message_box_show'))
		{
			if(message_box.classList.contains('message_box_hide'))
			{
				message_box.classList.remove("message_box_hide");
			}
		}
		else
		{
			message_box.classList.add("message_box_show");
			if(message_box.classList.contains('message_box_hide'))
			{
				message_box.classList.remove("message_box_hide");
			}
		}		
	}
}

function message_hide()
{
	if(document.getElementById('message_box'))
	{
		if(message_box.classList.contains('message_box_hide'))
		{
			if(message_box.classList.contains('message_box_show'))
			{
				message_box.classList.remove("message_box_show");
			}
		}
		else
		{
			message_box.classList.add("message_box_hide");
			if(message_box.classList.contains('message_box_show'))
			{
				message_box.classList.remove("message_box_show");
			}
		}
	}
}

function notEmpty(f)
{
	var is = true;
	for (var i = 0; i < f.childNodes.length; i++) 
		if(f.childNodes[i].type != "submit")
			if(f.childNodes[i].value == ""){ 
				is = false;
			}

	return is;
}

function empty(f)
{
	if(!notEmpty(f))
	{
		message.innerHTML = Language[lang]['ALL_FIELDS_FULL'];
		message_show();
		setTimeout(message_hide, 5000);
	}
	else
	{
		if (match(f))
		{
			f.submit();
		}
		else
		{
			message.innerHTML = Language[lang]['PASS_NOT_MATCH'];
			message_show();
			setTimeout(message_hide, 5000);
		}
	}
}

function match(f)
{
	var is = true;
	var value;
	for (var i = 0; i < f.childNodes.length; i++) 
	{
		if(f.childNodes[i].type == "password"){
			value = value ? value : f.childNodes[i].value;
			if(f.childNodes[i].value != value){ 
				is = false;
			}
		}
	}

	return is;
}

window.onload = function()
{
	message_show_hide();

	setTimeout(message_show_hide, 5000);
}