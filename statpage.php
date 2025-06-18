<!doctype html>
<html lang="en">

<script type="text/javascript">

	//LONGEST LASTING WR ANALYTICS
	$('#LongestLastingWR').DataTable({
		'processing':true,
		'paging':false,
		'searching':false,
		'lengthChange':false,
		'info':false,
		'data':[],
		'order':[],
		'columns': [
			{ "data": "rank" },
			{ "data": "level_id" },
			{ "data": "player" },
			{ "data": "nation" },
			{ "data": "kong_used" },
			{ "data": "level_time" },
			{ "data": "date_set" },
			{ "data": "difference" },
			{ "data": "current" }
		],
		'columnDefs':[
			{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
			{'target':0,'width':'5%'},
			{'target':1,'width':'10%'},
			{'target':3,'width':'8%'},
			{'target':4,'width':'5%'},
			{'target':5,'width':'16%'},
			{'target':6,'width':'16%'},
			{'target':7,'width':'8%'},
			{'target':8,'width':'5%'},
		],
		'rowCallback': function (row, data) {}
	});
	//CHANGE DATE -> LOAD DATA
	$(document).on('click','.datebtn',function(event){
		var check_date = $('#inputDate1').val();
		var database = document.getElementById('game-mode-switch').value;
		$.ajax({
			url: 'includes/fetch_statpage_data.inc.php',
			data:{check_date:check_date,level_id:level_id,database:database},
			type: "post",
			success: function(data){ // RECEIVE DATA
				var json = JSON.parse(data);
				table = $('#LongestLastingWR').DataTable();
				table.clear().draw();
				table.rows.add(json).draw();
			}
		})
	});
	//ONE TIME ON CLICK -> LOAD DATA
	$('#WR_Analytics').one('click',function(event){
		var check_date = $('#inputDate1').val();
		var database = document.getElementById('game-mode-switch').value;
		$.ajax({
			url: 'includes/fetch_statpage_data.inc.php',
			data:{check_date:check_date,level_id:level_id,database:database},
			type: "post",
			success: function(data){ // RECEIVE DATA
				var json = JSON.parse(data);
				table = $('#LongestLastingWR').DataTable();
				table.clear().draw();
				table.rows.add(json).draw();
			}
		})
	});
	//SET MINIMUM DATE FOR BUTTON SWITCH
	let minimum_date1 = document.getElementById('inputDate1')
	if (gamemode_check =="funky"){
		minimum_date1.min = '2018-05-04';
	} else{
		minimum_date1.min = '2014-02-13';
	}
	
</script>


<div class="modal fade statistics-modal" id="statisticsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Longest Lasting World Records</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <form id="WorldRecordAnalytics" action="javascript:void();" method="post">
		  <div class="modal-body">
			<div class="mb-3 row">
				<label for="inputDate1" class="col-sm-2 col-form-label text-modal">Select Date</label>
				<div class="col-sm-3">
					<input type="date" class="form-control text-modal" id="inputDate1" name="inputDate1" min="2014-02-13" value ="<?php echo date('Y-m-d') ?>">
				</div>
				<div class="col-sm-2">
					<button class="btn btn-secondary datebtn">Go</button>
				</div>
				<div class="col-sm-12">
					<table id="LongestLastingWR" class="table table-striped">
						<thead>
							<th>Rank</th>
							<th>Level</th>
							<th>Name</th>
							<th>Nation</th>
							<th></th>
							<th>Time / Video</th>
							<th>Date Set</th>
							<th>Duration</th>
							<th>WR?</th>
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