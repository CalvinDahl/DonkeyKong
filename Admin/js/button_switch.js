//Initialize button states and styles
	let button_styles_funky = document.getElementById('game-mode-funky')
	let button_styles_original = document.getElementById('game-mode-original')
	let gamemode_query = document.getElementById('game-mode-switch')
	
	let gamemode_check = "funky";
	if(localStorage.getItem('gamemode')){
		gamemode_check = localStorage.getItem('gamemode');
	}
//Set params for refresh and refresh window	
	$(document).on('click','.game-mode-funky',function(event){
		//Refresh Tables
		urlParams.set('gamemode', 'funky');
		localStorage.setItem("gamemode", "funky");
		window.location.search = urlParams;
	});
	$(document).on('click','.game-mode-original',function(event){
		//Refresh Tables
		urlParams.set('gamemode', 'original');
		localStorage.setItem("gamemode", "original");
		window.location.search = urlParams;
	});
//Apply Styles	
	if (gamemode_check =="original"){
		gamemode_query.dataset.value = "dkctf_om_database";
		
		button_styles_original.classList.add('active_button2');
		button_styles_funky.classList.remove('active_button1');
		
	} else if (gamemode_check =="funky"){
		gamemode_query.dataset.value = "dkctf_database";
		
		button_styles_original.classList.remove('active_button2');
		button_styles_funky.classList.add('active_button1');
	}