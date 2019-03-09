//html элемент - далее "нода"
var data, units, shown_space = [], gen_space = [];
var id_cur_node, cur_unit, count_shown;

$(document).ready(function(){
	$.ajax(
	    {
			url: './bin/ajax/dataofunits.php', 
			type: 'POST', 
			dataType: 'json', 
			      
			error: function(req, text, error){
				alert("Ошивка получения данных о юнитах. php: dataofunits.php | js: editor.js "+ text + ' | ' + error);
			},
			success: function(json){ 
				data = json//получили данные о юнитах и id сессии
				units = get_units(data[0])//сохраняем в переменную units только данные о юнитах

				editor.innerHTML = data[3];

				refreshShownSpace();
				updateShownSpace();
				load(data, units);				      
			}
		});
});

window.onresize = function()
{	
	load(data, units);
	edit_panel.classList.remove('show_edit_panel');
	edit_panel.classList.add('hide_edit_panel');	
}

window.onscroll = function() 
{
	edit_panel.classList.remove('show_edit_panel');
	edit_panel.classList.add('hide_edit_panel');
}

editor.onclick = function(e)
{
	if((e.target.id == 'editor') || (e.target.id.substring(0, 3) == 'gen'))
	{
		edit_panel.classList.remove('show_edit_panel');
		edit_panel.classList.add('hide_edit_panel');
	}
}

function btn_add_Onclick(e)
{
	$.ajax(
	    {
			url: './bin/ajax/addunit.php', 
			type: 'POST', 
			dataType: 'json', 
			data: {
				id_unit: id_cur_node,
				id_session: cur_unit.id_session,
				generation: cur_unit.generation,
				btn_id: e.target.id
			},      
			error: function(req, text, error){
				alert("Ошибка добавления юнита-родителя"+ text + ' | ' + error);
			},
			success: function(json){ 

				$.ajax(
				    {
						url: './bin/ajax/dataofunits.php', 
						type: 'POST', 
						dataType: 'json', 
						      
						error: function(req, text, error){
							alert("Ошивка получения данных о юнитах. php: dataofunits.php | js: editor.js "+ text + ' | ' + error);
						},
						success: function(json){ 
							data = json//получили данные о юнитах и id сессии
							units = get_units(data[0])//сохраняем в переменную units только данные о юнитах

							editor.innerHTML = data[3];

							updateShownSpace();
							load(data, units);		

							console.log(id_cur_node);
							unit_click.apply(document.getElementById(id_cur_node).childNodes[0]);			      
						}
					});		      
			}
	});

}

function unit_btn_Onclick()
{
	if(edit_panel.classList.contains('show_edit_panel'))
	{
		edit_panel.classList.remove('show_edit_panel');
		edit_panel.classList.add('hide_edit_panel');

		setTimeout(editpanel_show, 300);
	}
	else
	{
		editpanel_show();
	}
	
	cur_unit = units[this.parentNode.id];//текущий юнит

	id_cur_node = this.parentNode.id;//id текущего ноды
	cur_node = this;

	img_cur_unit = this.previousSibling.childNodes[0];
	unit_photo.setAttribute('src', img_cur_unit.getAttribute('src'));

	input_fname.value = cur_unit.f_name;
	input_lname.value = cur_unit.l_name;
	input_patron.value = cur_unit.patron;

	input_birthday.value = cur_unit.birthday;

	if(input_retired.value == "")
	{
		input_retired.style.display = "none";
		label_retired.style.display = "none";
	}
	else
	{
		input_retired.value = cur_unit.retired;
	}

	//Активность кнопок для добавления радителей
	btn_add_father.disabled = false;//активируем обе кнопки
	btn_add_mother.disabled = false;

	if(cur_unit.id_father != null)//если данные уже есть то кнопка не активна
	{
		btn_add_father.disabled = true;
	}

	if(cur_unit.id_mother != null)//если данные уже есть то кнопка не активна
	{
		btn_add_mother.disabled = true;
	}
	//-----------------------------------------
}

function onfocus()
{
	input_retired.style.display = "block";
	label_retired.style.display = "block";
}

function editpanel_show()
{
	edit_panel.classList.add('show_edit_panel');
	edit_panel.classList.remove('hide_edit_panel');
}

function btn_close_Onclick()
{
	edit_panel.classList.remove('show_edit_panel');
	edit_panel.classList.add('hide_edit_panel');
}

function unit_click(e)
{
	for(var i = 0; i < data[0].length; i++)
	{
		unit_html = document.getElementById(data[0][i]['id']);
		unit_hide(unit_html);
		unit_html.classList.remove('relation_f');
		unit_html.classList.remove('relation_m');
	}

	if(units[this.parentNode.id].id_father != null || units[this.parentNode.id].id_mother != null)
	{
		next_gen = +units[this.parentNode.id].generation + 1;

		for(var i = next_gen; i < shown_space.length; i++)
		{
			shown_space[i] = [];
		}
	}	
	
	if(units[this.parentNode.id].id_father != null)
	{
		shown_space[next_gen].push(units[this.parentNode.id].id_father);
	}
	
	if(units[this.parentNode.id].id_mother != null)
	{
		shown_space[next_gen].push(units[this.parentNode.id].id_mother);
	}

	for(var i = 0; i < shown_space.length; i++)
	{
		for(var j = 0; j < shown_space[i].length; j++)
		{
			unit_html = document.getElementById(shown_space[i][j]);
			unit_show(unit_html);

			if(shown_space[i+1])
			{
				for(var g = 0; g < shown_space[i+1].length; g++)
				{
					if(shown_space[i+1][g] == units[shown_space[i][j]].id_father)
					{
						unit_html.classList.add('relation_f');
					}

					if(shown_space[i+1][g] == units[shown_space[i][j]].id_mother)
					{
						unit_html.classList.add('relation_m');
					}
				}
			}
		}
	}	

	count_shown = 0;
	gens = document.getElementsByClassName('generation');

	for(var i = 0; i < gens.length; i++)
	{
		if(gens[i].clientHeight > 0)
		{
			count_shown++;
		}
	}

	if( ( count_shown*150) > document.documentElement.clientHeight)
	{
		editor.style.height = (count_shown*150) + 50 + 'px';
	}
}

function updateShownSpace()
{
	shown_space.push(gen_space);
	for(var i = 0; i <= data[1]; i++)//цикл для покалений
	{
		shown_space.push(gen_space);
		var gen = find_by('generation', i, data[0]);//все юниты в текущем покалении
		for(var j = 0; j < gen.length; j++)
		{
			if(gen[j]['root'] == '1')//корневой юнит, сам пользователь
			{
				shown_space[0].push(gen[j]['id']);
			}
		}
	}
}

function refreshShownSpace()
{
	count_shown = 0;
	shown_space = [];
}

function load(data, units)
{
	var width = editor.clientWidth;
	var location;
	var unit_html;
	var split = 20;

	//shown_space = [];
	//shown_space.push(gen_space);
	for(var i = 0; i <= data[1]; i++)//цикл для покалений
	{
		//shown_space.push(gen_space);
		var gen = find_by('generation', i, data[0]);//все юниты в текущем покалении
		for(var j = 0; j < gen.length; j++)
		{
			if(gen[j]['root'] == '1')//корневой юнит, сам пользователь
			{
				//shown_space[0].push(gen[j]['id']);
				unit_html = document.getElementById(gen[j]['id']);
				unit_dispose(unit_html, (width/2 - unit_width(unit_html)/2) );
				unit_show(unit_html);
			}

			if(gen[j]['id_sibling'] == null)//юниты которые имеют прямое отношение(не брат/сестра)
				{
					if(gen[j]['id_father'] != null)
					{
						unit_html = document.getElementById(gen[j]['id_father']);
						unit_dispose(unit_html, units[gen[j]['id']].left - (unit_width(unit_html)/2 + split));

					}

					if(gen[j]['id_mother'] != null)
					{
						unit_html = document.getElementById(gen[j]['id_mother']);
						unit_dispose(unit_html, units[gen[j]['id']].left + (unit_width(unit_html)/2 + split));					
					}
				}
		}
	}

	var buttons = document.getElementsByClassName('unit_btn');
	for(var i = 0; i < buttons.length; i++)
	{
		buttons[i].addEventListener('click', unit_btn_Onclick);
	}

	//DataPanel----------------------------------------------------------------
	var fields = document.getElementsByClassName('fields');
	for(var i = 0; i < fields.length; i++)
	{
		if(fields[i].type == "date")
		{
			fields[i].addEventListener("focus", onfocus, true);
		}
	}

	btn_add_father.addEventListener("click", btn_add_Onclick);
	btn_add_mother.addEventListener("click", btn_add_Onclick);
	btn_add_brother.addEventListener("click", btn_add_Onclick);
	btn_add_sister.addEventListener("click", btn_add_Onclick);

	btn_close.addEventListener("click", btn_close_Onclick);
	//-------------------------------------------------------------------------
};



function unit_width(unit)
{
	var style = window.getComputedStyle(unit);
    return style.getPropertyValue('width').replace('px', '');
}

function unit_dispose(unit_html, left)
{
	units[unit_html.id].left = left;
	unit_html.style.left = units[unit_html.id].left + 'px';
	unit_html.childNodes[0].addEventListener("click", unit_click);
}

function unit_hide(unit_html)
{
	unit_html.classList.remove('unit_show');
	unit_html.classList.add('unit_hide');
	unit_html.parentNode.classList.remove('gen_show');
	unit_html.parentNode.classList.add('gen_hide');
}

function unit_show(unit_html)
{
	unit_html.classList.add('unit_show');
	unit_html.classList.remove('unit_hide');
	unit_html.parentNode.classList.add('gen_show');
	unit_html.parentNode.classList.remove('gen_hide');
}

function objlength(obj)
{
  var i = 0;
  for ( var p in obj ) i++;
  return i;
}

Array.prototype.unset = function(value) 
{
    if(this.indexOf(value) != -1) 
    {
        this.splice(this.indexOf(value), 1);
    }   
}

Array.prototype.contains = function(elem) {
   return this.indexOf(elem) != -1;
}

//функция поиска юнитов по указаному полю в field, значение в котором должно совпадать с criterion
function find_by(field, criterion, obj )
{
	var arr = [];
	if(typeof(obj) == "object")
	{
		for(var i = 0; i < obj.length; i++)
		{
			if(obj[i][field] == criterion)
			{
				arr.push(obj[i]);
			}
		}
	}

	return arr;
}

//возвращает объект содержащий объекты, индексы которых в родительском объекте соответствуют id юнитов
function get_units(data)
{
	if(typeof(data) == "object")
	{
		var objs = {};
		for(var i = 0; i < data.length; i++)
		{	
			objs[ data[i]['id'] ] = { 'id_session' : data[i]['id_session'],
									  'root' : data[i]['root'],
									  'uname' : data[i]['uname'],
									  'id_image' : data[i]['id_image'],
									  'generation' : data[i]['generation'],
									  'id_father' : data[i]['id_father'],
									  'id_mother' : data[i]['id_mother'],
									  'id_sibling' : data[i]['id_sibling'],
									  'gender' : data[i]['gender'],
									  'number' : data[i]['number'],
									  'f_name' : data[i]['f_name'],
									  'l_name' : data[i]['l_name'],
									  'patron' : data[i]['patron'],
									  'birthday' : data[i]['birthday'],
									  'retired' : data[i]['retired'],
									  'left' : 0};			
		}
	}
	return objs;
};