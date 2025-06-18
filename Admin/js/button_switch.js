//Set URL Params for switch		
	$(document).on('click','.game-mode-switch',function(event){
		if (gamemode_check =="funky"){
			//Refresh Tables
			urlParams.set('gamemode', 'original');
			window.location.search = urlParams;
		} else{
			//Refresh Tables
			urlParams.set('gamemode', 'funky');
			window.location.search = urlParams;
		}
	});
	let button_styles = document.querySelector('#game-mode-switch')
	let title_styles = document.getElementById('main-title')
	if (gamemode_check =="original"){
		button_styles.innerHTML  = "Funky Mode";
		button_styles.title = "click to edit funky mode times";
		button_styles.value = "dkctf_om_database";
		button_styles.classList.remove('game-mode-switch-active');
		title_styles.innerHTML = "Original Mode Database Entries";
	} else if(gamemode_check =="funky"){
		button_styles.innerHTML  = "Original Mode";
		button_styles.title = "click to edit original mode times";
		button_styles.value = "dkctf_database";
		button_styles.classList.add('game-mode-switch-active');
		title_styles.innerHTML = "Funky Mode Database Entries";
	}