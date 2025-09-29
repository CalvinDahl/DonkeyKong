//Download CSV
	$(document).on('click','#DownloadCSV',function(event){
		var database = document.getElementById('game-mode-switch').dataset.value;
		$.ajax({
			url:"includes/Excel.inc.php",
			data:{database:database},
			type:"post",
			success:function(data){
				// Create a Blob from the CSV data
				const blob = new Blob([data], { type: 'text/csv;charset=utf-8;' });
				const link = document.createElement('a');
				const url = URL.createObjectURL(blob);
				
				link.setAttribute('href', url);
				link.setAttribute('download', 'dkctf_wrs.csv');
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		});
	});