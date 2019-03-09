window.onload = function()
{
	if (document.getElementById('transup'))transup.addEventListener("click", onclick);
	if (document.getElementById('transin'))transin.addEventListener("click", onclick);

	function onclick()
	{
		singin.classList.toggle("hiden_form");
		singup.classList.toggle("shown_form");
		singin.classList.toggle("shown_form");
		singup.classList.toggle("hiden_form");
		transup.classList.toggle("hiden_form");
		transup.classList.toggle("shown_form");
		transin.classList.toggle("hiden_form");
		transin.classList.toggle("shown_form");
		forgot.classList.toggle("hiden_form");
		forgot.classList.toggle("shown_form");
	};

	if (document.getElementById('buttonfs')) buttonfs.addEventListener("click", openDialogFile);

	function openDialogFile()
	{
		alert();
		inputfs.click();
	}

	if (document.getElementById('inputfs')) inputfs.addEventListener("change", onchange);

	function onchange(event)
	{
		if(event.target.files[0].type.match('image.*'))
		{
			unit_photo.setAttribute('src', URL.createObjectURL(event.target.files[0]));
		}
	}
}