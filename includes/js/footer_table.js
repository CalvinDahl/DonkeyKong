//FOOTER TABLES
	function SubDataTable(Table){
		var names = [];
		var nations = [];
		Table.data.forEach((row) => {
			names.push(row[1]);
			nations.push(row[2]);
		});
		var player_count = names.reduce((cnt, cur) => (cnt[cur] = cnt[cur] + 1 || 1, cnt), {});
		var player_array = Object.entries(player_count);
		player_array.forEach((col) => {
			let index = player_array.indexOf(col);
			for(var row of Table.data){
				if (col[0] == row[1]){
					player_array[index].splice(1,0,row[2]);
					break;
				}
			};
		});
		player_array = player_array.sort((a, b) => b[2] - a[2]);
		
		var nation_count = nations.reduce((cnt, cur) => (cnt[cur] = cnt[cur] + 1 || 1, cnt), {});
		var nation_array = Object.entries(nation_count);
		for (var col of nation_array){
			let index = nation_array.indexOf(col);
			if(col[0] == ""){
				nation_array.splice(index,1);
				break;
			}
		};
		nation_array = nation_array.sort((a, b) => b[1] - a[1]);
		
		//Multiple Record Holders Table
		$('#multiple-records').DataTable({
			'paging':false,
			'searching':false,
			'lengthChange':false,
			'info':false,
			'order':[],
			columns: [
				{ title: 'Player' },
				{ title: 'Nation' },
				{ title: "WR's" },
			],
			data: player_array,
			'columnDefs':[
				{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
			]
		});
		//Nation Record Holders Table
		$('#nation-records').DataTable({
			'paging':false,
			'searching':false,
			'lengthChange':false,
			'info':false,
			'order':[],
			columns: [
				{ title: 'Nation' },
				{ title: "WR's" },
			],
			data: nation_array,
			'columnDefs':[
				{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
			]
		});
	}
		
	function SubPageDataTable(Table){
		
		var record_array =  Table[Object.keys(Table)[Object.keys(Table).length - 1]].at(-1);
		var record_array = [record_array];
		
		//Current Record Table
		$('#current-record').DataTable({
			'paging':false,
			'searching':false,
			'lengthChange':false,
			'info':false,
			'order':[],
			columns: [
				{ title: "Date Set" },
				{ title: "Name" },
				{ title: "Nation" },
				{ title: "" },
				{ title: "Time / Video" },
			],
			data: record_array,
			'columnDefs':[
				{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
				{'target':0,'width':'15%'},
				{'target':2,'width':'3%'},
				{'target':3,'width':'3%'},
				{'target':4,'width':'15%'},
			]
		});
	}