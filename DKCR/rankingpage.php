<!doctype html>
<html lang="en">

<script type="text/javascript">

	//LONGEST LASTING WR ANALYTICS
	$('#PlayerStats').DataTable({
		'processing':true,
		'paging':false,
		'searching':false,
		'lengthChange':false,
		'info':false,
		'data':[],
		'order':[],
		'columns': [
			{ "data": "rank" },
			{ "data": "player" },
			{ "data": "nation" },
			{ "data": "total_wr" },
			{ "data": "total_duration" },
			{ "data": "game_percent" },
			{ "data": "unique_wr" }
		],
		'columnDefs':[
			{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
			{'target':0,'width':'5%'},
			{'target':2,'width':'5%'},
			{'target':3,'width':'10%'},
			{'target':4,'width':'10%'},
			{'target':5,'width':'10%'},
			{'target':6,'width':'10%'}
		],
		'rowCallback': function (row, data) {}
	});
	//CHANGE DATE -> LOAD DATA
	$(document).on('click','.datebtn',function(event){
		var check_date = $('#inputDate2').val();
		var start_date = document.getElementById('inputDate2').min;
		var database = document.getElementById('game-mode-switch').dataset.value;
		$.ajax({
			url: 'includes/fetch_rankingpage_data.inc.php',
			data:{check_date:check_date,level_id:level_id,start_date:start_date,database:database},
			type: "post",
			success: function(data){ // RECEIVE DATA
				var json = JSON.parse(data);
				table = $('#PlayerStats').DataTable();
				table.clear().draw();
				table.rows.add(json).draw();
			}
		})
	});
	//ONE TIME ON CLICK -> LOAD DATA
	$('#Player_rankings').one('click',function(event){
		var check_date = $('#inputDate2').val();
		var start_date = document.getElementById('inputDate2').min;
		var database = document.getElementById('game-mode-switch').dataset.value;
		$.ajax({
			url: 'includes/fetch_rankingpage_data.inc.php',
			data:{check_date:check_date,level_id:level_id,start_date:start_date,database:database},
			type: "post",
			success: function(data){ // RECEIVE DATA
				var json = JSON.parse(data);
				table = $('#PlayerStats').DataTable();
				table.clear().draw();
				table.rows.add(json).draw();
			}
		})
	});
	//SET MINIMUM DATE FOR BUTTON SWITCH
	let minimum_date2 = document.getElementById('inputDate2')
	if (gamemode_check =="turbo"){
		minimum_date2.min = '2026-01-20';
	} else{
		minimum_date2.min = '2025-01-16';
	}
	
</script>


<div class="modal fade statistics-modal" id="rankingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Player Rankings</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <form id="WorldRecordAnalytics" action="javascript:void();" method="post">
		  <div class="modal-body">
			<div class="mb-3 row">
				<label for="inputDate2" class="col-sm-2 col-form-label text-modal">Select Date</label>
				<div class="col-sm-3">
					<input type="date" class="form-control text-modal" id="inputDate2" name="inputDate2" min="2025-01-16" value ="<?php echo date('Y-m-d') ?>">
				</div>
				<div class="col-sm-2">
					<button class="btn btn-secondary datebtn">Go</button>
				</div>
				<div class="col-sm-12">
					<table id="PlayerStats" class="table table-striped">
						<thead>
							<th>Rank</th>
							<th>Player</th>
							<th>Nation</th>
							<th>Total WRs</th>
							<th>Total Duration</th>
							<th>Game Duration</th>
							<th>Unique Wrs</th>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
	  </form>
	</div>
  </div>
</div>


</html>