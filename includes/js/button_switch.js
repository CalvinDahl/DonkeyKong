//Initialize button states and styles	
	let button_styles = document.querySelector('#game-mode-switch')
	let background_styles = document.getElementById('background-overlay')
	let hasInteracted = true;
//Set params for refresh and refresh window	
	$(document).on('click','.game-mode-switch',function(event){
		if (gamemode_check =="funky"){
			//Refresh Tables
			urlParams.set('gamemode', 'original');
			localStorage.setItem("hasInteracted", "false");
			window.location.search = urlParams;
		} else{
			//Refresh Tables
			urlParams.set('gamemode', 'funky');
			localStorage.setItem("hasInteracted", "false");
			window.location.search = urlParams;
		}
	});
//Check if button was clicked
	if (localStorage.getItem("hasInteracted") == false){
		hasInteracted = localStorage.getItem("hasInteracted");
	};
//Apply Styles	
	if (gamemode_check =="original"){
		button_styles.innerHTML  = "Funky Mode";
		button_styles.title = "click to view funky mode times";
		button_styles.value = "dkctf_om_database";
		background_styles.classList.add('active2');
		background_styles.classList.remove('active1');
		
		button_styles.addEventListener('mouseenter', () => {
			if (hasInteracted) {
				background_styles.classList.remove('active_button1');
				background_styles.classList.add('active_button2');
			}
		});

		button_styles.addEventListener('mouseleave', () => {
			if (hasInteracted) {
				background_styles.classList.remove('active_button2');
				background_styles.classList.add('active_button1');
			}
			hasInteracted = true;
		});
	} else if (gamemode_check =="funky"){
		button_styles.innerHTML  = "Original Mode";
		button_styles.title = "click to view original mode times";
		button_styles.value = "dkctf_database";
		background_styles.classList.add('active1');
		background_styles.classList.remove('active2');
		
		
		button_styles.addEventListener('mouseenter', () => {
			if (hasInteracted) {
				background_styles.classList.remove('active_button2');
				background_styles.classList.add('active_button1');
			}
		});

		button_styles.addEventListener('mouseleave', () => {
			if (hasInteracted) {
				background_styles.classList.remove('active_button1');
				background_styles.classList.add('active_button2');
			}
			hasInteracted = true;
		});
	}
//Add Current Gamemode to Nav Links	
	$('.subpage-link').each(function(i, el){
		let $this = $(this); // only need to create the object once
		$this.attr({
			href: $this.attr("href") + '&gamemode=' + gamemode_check
		});
	});