//Time Total
	function extractContent(s) {
	  var span = document.createElement('span');
	  span.innerHTML = s;
	  return span.textContent || span.innerText;
	}
	
	function SummedTable(Table){
		var times = [];
		var row2 = '0';
		Table.data.forEach((row) => {
			if(row[0] != row2){
				times.push(extractContent(row[5]));
			}
			row2 = row[0];
		});
		
		let sum = 0;
		for (let i = 0; i < times.length; i++) {
			if(i == 0){
				
				var a = times[i].split(":");
				
				if(a.length == 2){
					sum = ((+a[0])*60 + (+a[1]));
				}else if(a.length == 1){
					sum = (+a[0]);
				}
				continue;
			}else{
				
				var b = times[i].split(":");
				
				if(b.length == 2){
					var second = ((+b[0])*60 + (+b[1]));
				}else if(b.length == 1){
					var second = (+b[0]);
				}else if(b.length == 3){
					var second = ((+b[0])*60*60 + (+b[1])*60 + (+b[2]));
				}
				sum += second;
			}
		}
		hours = Math.floor(sum/3600);
		minutes = Math.floor((sum - (hours*3600))/60);
		seconds = Math.round((sum - (hours * 3600) - (minutes * 60))*100)/100;
		timeString = hours.toString().padStart(1, '0') + ':' + 
			  minutes.toString().padStart(2, '0') + ':' + 
			  seconds.toString().padStart(2, '0');
		document.getElementById('total_time').innerHTML = timeString;
	}