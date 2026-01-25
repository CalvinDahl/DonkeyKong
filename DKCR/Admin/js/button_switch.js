//Initialize button states and styles
	let button_styles_turbo = document.getElementById('game-mode-turbo')
	let button_styles_original = document.getElementById('game-mode-original')
	let gamemode_query = document.getElementById('game-mode-switch')
	
	let gamemode_check = "turbo";
	if(localStorage.getItem('gamemode')){
		gamemode_check = localStorage.getItem('gamemode');
	}
//Set params for refresh and refresh window	
	$(document).on('click','.game-mode-turbo',function(event){
		//Refresh Tables
		urlParams.set('gamemode', 'turbo');
		localStorage.setItem("gamemode", "turbo");
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
		gamemode_query.dataset.value = "dkcr_tm_database";
		
		button_styles_original.classList.add('active_button2');
		button_styles_turbo.classList.remove('active_button1');
		
	} else if (gamemode_check =="turbo"){
		gamemode_query.dataset.value = "dkcr_database";
		
		button_styles_original.classList.remove('active_button2');
		button_styles_turbo.classList.add('active_button1');
	}