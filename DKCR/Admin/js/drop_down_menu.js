//Constants
	let player_names = [];
	
	let level_ids = ['1-1','1-2','1-3','1-4','1-5','1-6','1-K','1-Boss',
		'2-1','2-2','2-3','2-4','2-5','2-6','2-7','2-K','2-Boss',
		'3-1','3-2','3-3','3-4','3-5','3-6','3-K','3-Boss',
		'4-1','4-2','4-3','4-4','4-5','4-K','4-Boss',
		'5-1','5-2','5-3','5-4','5-5','5-6','5-7','5-8','5-K','5-Boss',
		'6-1','6-2','6-3','6-4','6-5','6-6','6-7','6-8','6-K','6-Boss',
		'7-1','7-2','7-3','7-4','7-5','7-6','7-7','7-R','7-K','7-Boss',
		'8-1','8-2','8-3','8-4','8-5','8-6','8-7','8-K','8-Boss',
		'9-1','9-2','9-3','9-4','9-5','9-6','9-7','9-8','9-9'];
	let countries = [];
	let kongs = ["Diddy","Dixie","Default"];
	
	const playerListElement = document.querySelector('#player-list');
	const playerInputElement = document.querySelector('#inputPlayer');
	
	const countryListElement = document.querySelector('#country-list');
	const nationInputElement = document.querySelector('#inputNation');
	
	const levelID_ListElement = document.querySelector('#levelID-list');
	const levelID_InputElement = document.querySelector('#inputLevelID');
	
	const kong_ListElement = document.querySelector('#kong-list');
	const kong_InputElement = document.querySelector('#inputKongUsed');
	
	const e1 = document.querySelector('#addNewEntry');
	
	////////////////////////////////////////////////////////////////////////////////////////////
	
	const playerListElement2 = document.querySelector('#player-list2');
	const playerInputElement2 = document.querySelector('#editPlayer');
	
	const countryListElement2 = document.querySelector('#country-list2');
	const nationInputElement2 = document.querySelector('#editNation');
	
	const levelID_ListElement2 = document.querySelector('#levelID-list2');
	const levelID_InputElement2 = document.querySelector('#editLevelID');
	
	const kong_ListElement2 = document.querySelector('#kong-list2');
	const kong_InputElement2 = document.querySelector('#editKongUsed');
	
	const e2 = document.querySelector('#editNewEntry');
	
//Functions
	function fetchNames(){
		var data = new FormData();
		data.append('db_switch',db_switch);
		fetch('./includes/fetch_player_names_data.inc.php',{
			method: 'POST',
			body: data,
		}).then(res => res.json())
		.then(data => {
			player_names = data.map((filObj) => filObj.player);
		}).catch(err => {
			console.log(err);
		})
	}
	
	function fetchCountries(){
		fetch('./../../country-flags-main/countries.json')
		.then(res => res.json())
		.then(data => {
			countries = Object.values(data);
			console.log(data);
		}).catch(err => {
			console.log(err);
		})
	}
	
	function loadData(data,element,name){
		if (data){
			element.innerHTML = "";
			let output = "";
			Object.keys(data).forEach((entry) => {
				output += `<li class = ${name}>${data[entry]}</li>`
			});
			element.innerHTML = output;
		}
	};
	
	function filterData(data, searchText){
		return data.filter((x) => x.toLowerCase().includes(searchText.toLowerCase()));
	}
	
//Initialize
	countryListElement2.style.display = "none";
	countryListElement.style.display = "none";
	levelID_ListElement2.style.display = "none";
	levelID_ListElement.style.display = "none";
	kong_ListElement2.style.display = "none";
	kong_ListElement.style.display = "none";
	playerListElement2.style.display = "none";
	playerListElement.style.display = "none";

	fetchNames();
	fetchCountries();
	
//////////  ADD MODAL LISTENERS  ///////////

//Player Input Listener
	playerInputElement.addEventListener("input", function(){
		let filteredData = filterData(player_names,playerInputElement.value);
		loadData(filteredData,playerListElement,"player-item");
	})
//Nation Input Listener
	nationInputElement.addEventListener("input", function(){
		let filteredData = filterData(countries,nationInputElement.value);
		loadData(filteredData,countryListElement,"nation-item");
	})
//Level Id Input Listener
	levelID_InputElement.addEventListener("input", function(){
		let filteredData = filterData(level_ids,levelID_InputElement.value);
		loadData(filteredData,levelID_ListElement,"level-item");
	})
//Kong Input Listener	
	kong_InputElement.addEventListener("input", function(){
		let filteredData = filterData(kongs,kong_InputElement.value);
		loadData(filteredData,kong_ListElement,"kong-item");
	})
	
//Click anywhere on modal
	e1.addEventListener("click", (e) => {
		//PLAYER
		if(e.target.id === "inputPlayer"){
			let filteredData = filterData(player_names,playerInputElement.value);
			loadData(filteredData,playerListElement,"player-item");
			playerListElement.style.display = "block";
		}else if(e.target.classList.contains("player-item") === true){
			playerInputElement.value = e.target.innerHTML;
			loadData([],playerListElement,"player-item");
			playerListElement.style.display = "none";
		}else{
			loadData([],playerListElement,"player-item");
			playerListElement.style.display = "none";
		}
		//NATION
		if(e.target.id === "inputNation"){
			let filteredData = filterData(countries,nationInputElement.value);
			loadData(filteredData,countryListElement,"nation-item");
			countryListElement.style.display = "block";
		}else if(e.target.classList.contains("nation-item") === true){
			nationInputElement.value = e.target.innerHTML;
			loadData([],countryListElement,"nation-item");
			countryListElement.style.display = "none";
		}else{
			loadData([],countryListElement,"nation-item");
			countryListElement.style.display = "none";
		}
		//LEVEL ID
		if(e.target.id === "inputLevelID"){
			let filteredData = filterData(level_ids,levelID_InputElement.value);
			loadData(filteredData,levelID_ListElement,"level-item");
			levelID_ListElement.style.display = "block";
		}else if(e.target.classList.contains("level-item") === true){
			levelID_InputElement.value = e.target.innerHTML;
			loadData([],levelID_ListElement,"level-item");
			levelID_ListElement.style.display = "none";
		}else{
			loadData([],levelID_ListElement,"level-item");
			levelID_ListElement.style.display = "none";
		}
		//KONG USED
		if(e.target.id === "inputKongUsed"){
			let filteredData = filterData(kongs,kong_InputElement.value);
			loadData(filteredData,kong_ListElement,"kong-item");
			kong_ListElement.style.display = "block";
		}else if(e.target.classList.contains("kong-item") === true){
			kong_InputElement.value = e.target.innerHTML;
			loadData([],kong_ListElement,"kong-item");
			kong_ListElement.style.display = "none";
		}else{
			loadData([],kong_ListElement,"kong-item");
			kong_ListElement.style.display = "none";
		}
	});

//////////  EDIT MODAL LISTENERS  ///////////

//Player Input Listener
	playerInputElement2.addEventListener("input", function(){
		let filteredData = filterData(player_names,playerInputElement2.value);
		loadData(filteredData,playerListElement2,"player-item");
	})	
//Nation Input Listener
	nationInputElement2.addEventListener("input", function(){
		let filteredData = filterData(countries,nationInputElement2.value);
		loadData(filteredData,countryListElement2,"nation-item");
	})
//Level Id Input Listener
	levelID_InputElement2.addEventListener("input", function(){
		let filteredData = filterData(level_ids,levelID_InputElement2.value);
		loadData(filteredData,levelID_ListElement2,"level-item");
	})
//Kong Input Listener	
	kong_InputElement2.addEventListener("input", function(){
		let filteredData = filterData(kongs,kong_InputElement2.value);
		loadData(filteredData,kong_ListElement2,"kong-item");
	})
	
	
//Click anywhere on modal
	e2.addEventListener("click", (e) => {
		//PLAYER
		if(e.target.id === "editPlayer"){
			let filteredData = filterData(player_names,playerInputElement2.value);
			loadData(filteredData,playerListElement2,"player-item");
			playerListElement2.style.display = "block";
		}else if(e.target.classList.contains("player-item") === true){
			playerInputElement2.value = e.target.innerHTML;
			loadData([],playerListElement2,"player-item");
			playerListElement2.style.display = "none";
		}else{
			loadData([],playerListElement2,"player-item");
			playerListElement2.style.display = "none";
		}
		//NATION
		if(e.target.id === "editNation"){
			const filteredData = filterData(countries,nationInputElement2.value);
			loadData(filteredData,countryListElement2,"nation-item");
			countryListElement2.style.display = "block";
		}else if(e.target.classList.contains("nation-item") === true){
			nationInputElement2.value = e.target.innerHTML;
			loadData([],countryListElement2,"nation-item");
			countryListElement2.style.display = "none";
		}else{
			loadData([],countryListElement2,"nation-item");
			countryListElement2.style.display = "none";
		}
		//LEVEL ID
		if(e.target.id === "editLevelID"){
			const filteredData = filterData(level_ids,levelID_InputElement2.value);
			loadData(filteredData,levelID_ListElement2,"level-item");
			levelID_ListElement2.style.display = "block";
		}else if(e.target.classList.contains("level-item") === true){
			levelID_InputElement2.value = e.target.innerHTML;
			loadData([],levelID_ListElement2,"level-item");
			levelID_ListElement2.style.display = "none";
		}else{
			loadData([],levelID_ListElement2,"level-item");
			levelID_ListElement2.style.display = "none";
		}
		//KONG USED
		if(e.target.id === "editKongUsed"){
			let filteredData = filterData(kongs,kong_InputElement2.value);
			loadData(filteredData,kong_ListElement2,"kong-item");
			kong_ListElement2.style.display = "block";
		}else if(e.target.classList.contains("kong-item") === true){
			kong_InputElement2.value = e.target.innerHTML;
			loadData([],kong_ListElement2,"kong-item");
			kong_ListElement2.style.display = "none";
		}else{
			loadData([],kong_ListElement2,"kong-item");
			kong_ListElement2.style.display = "none";
		}
	});
	
	