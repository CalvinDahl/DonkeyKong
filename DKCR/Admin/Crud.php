<?php
	require_once 'includes/config_session.inc.php';
	
	if(!isset($_SESSION['user_id'])){
		header("location:LoginDisplay.php");
	}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	
	<link href="./../../DataTables/datatables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="Styles.css">
</head>
<body>
	<!-- DataTables -->
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<h1 class="text-center">Server Database Entries</h1>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<button type="button" style="margin-bottom: 20px;" class="btn btn-primary" data-bs-toggle="modal"
						data-bs-target="#addDataEntry">Add New Entry</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table id="searchTable" class="table table-striped">
							<thead>
								<th>Player Name</th>
								<th>Nation</th>
								<th>Level ID</th>
								<th>Level Time</th>
								<th>Date Set</th>
								<th>Video Link / URL</th>
								<th>Options</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="col-md-1"></div>
				</div>
				<h1 class="text-center">Server Changes to be Applied</h1>
				<div class="row">
					<div class = "col-md-1"></div>
						<div class="col-md-10">
							<table id="changelogtable" class="table table-striped">
								<thead>
									<th>Changes To Be Made</th>
									<th>Changes Made</th>
									<th>Options</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					<div class = "col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- DataTables Styles & Plugins -->
	<script src="./../../DataTables/datatables.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/plug-ins/2.1.7/dataRender/ellipsis.js" type="text/javascript"></script>
	
	<!-- AJAX Server Calls -->
	<script type="text/javascript">
		//Upload Table Initialization
		$('#searchTable').DataTable({
			'serverSide':'true',
			'processing':'true',
			'paging':'true',
			'pagingType': 'simple_numbers',
			'order':[],
			'ajax':{
				'url':'includes/fetch_data.inc.php',
				'type':'post',
			},
			'fnCreatedRow':function(nRow,aData,iDataIndex)
			{
				$(nRow).attr('id',aData[0]);
			},
			//"drawCallback": function(settings) {
			//   console.log(settings.json)
			//  //do whatever  
			//},
			'columnDefs':[
				{'target':[5],'searchable':false, 'render': DataTable.render.ellipsis(15)},
				{'target':[1,5,6],'orderable':false},
				{'target':"_all",'className':'text-start'},
			]
		});
		
		//Changelog Table Initialization
		$('#changelogtable').DataTable({
			'serverSide':'true',
			'processing':'true',
			'paging':'true',
			'pagingType': 'simple_numbers',
			'searching':false,
			'order':[],
			'ajax':{
				'url':'includes/fetch_changelog_data.inc.php',
				'type':'post',
			},
			'fnCreateRow':function(nRow,aData,iDataIndex)
			{
				$(nRow).attr('id',aData[0]);
			},
			'columnDefs':[
				{'target':"_all",'className':'text-start','orderable':false,'searchable':false},
			]
		});
		
		//Add Entry
		$(document).on('submit','#addNewEntry',function(event){
			event.preventDefault();
			var player = $('#inputPlayer').val();
			var nation = $('#inputNation').val();
			var level_id = $('#inputLevelID').val();
			var level_time = $('#inputLevelTime').val();
			var date_set = $('#inputDateSet').val();
			var video_link = $('#inputVideoLink').val();
			$.ajax({
				url:"includes/newentry.inc.php",
				data:{player:player,nation:nation,level_id:level_id,level_time:level_time,date_set:date_set,video_link:video_link},
				type:'post',
				success:function(data){
					alert(data);
					var json = JSON.parse(data);
					status = json.status;
					if(status=='success'){
						alert('added new entry to changelog');
						$('#inputPlayer').val('');
						$('#inputNation').val('');
						$('#inputLevelID').val('');
						$('#inputLevelTime').val('');
						$('#inputDateSet').val('');
						$('#inputVideoLink').val('');
						$('#addDataEntry').modal('hide');
						
						table= $('#changelogtable').DataTable();
						table.draw();
					}else alert(json.status);
				}
			});
		});
		
		//Upload Table Buttons
		$('#searchTable').on('click','.editBtn',function(event){
			var id = $(this).data('id');
			var database = " upload ";
			$('#editDataEntry').modal('show');
			$.ajax({
				url:"includes/fetch_single_data.inc.php",
				data:{id:id,database:database},
				type:"post",
				success:function(data){
					var json = JSON.parse(data);
					$('#id').val(json.id);
					$('#editPlayer').val(json.player);
					$('#editPlayer').attr('placeholder',json.player);
					$('#editNation').val(json.nation);
					$('#editNation').attr('placeholder',json.nation);
					$('#editLevelID').val(json.level_id);
					$('#editLevelID').attr('placeholder',json.level_id);
					$('#editLevelTime').val(json.level_time);
					$('#editLevelTime').attr('placeholder',json.level_time);
					$('#editDateSet').val(json.date_set);
					$('#editDateSet').attr('placeholder',json.date_set);
					$('#editVideoLink').val(json.video_link);
					$('#editVideoLink').attr('placeholder',json.video_link);
				}
			})
		});
		$('#searchTable').on('click','.deleteBtn',function(event){
			var id = $(this).data('id');
			$.ajax({
				url:"includes/removeentry.inc.php",
				data:{id:id},
				type:"post",
				success:function(data){
					console.log(data);
					var json = JSON.parse(data);
					status = json.status;
					if(status=='success'){
						alert('removed entry - check changelog to approve request');
						table= $('#changelogtable').DataTable();
						table.draw();
					}else alert('failed to remove entry');
				}
			})
		});
		
		//Edit Entry
		$(document).on('submit','#editNewEntry',function(){
			var id = $('#id').val();
			var player = $('#editPlayer').val();
			var nation = $('#editNation').val();
			var level_id = $('#editLevelID').val();
			var level_time = $('#editLevelTime').val();
			var date_set = $('#editDateSet').val();
			var video_link = $('#editVideoLink').val();
			$.ajax({
				url:"includes/update.inc.php",
				data:{id:id,player:player,nation:nation,level_id:level_id,level_time:level_time,
				date_set:date_set,video_link:video_link},
				type:"post",
				success:function(data){
					table= $('#changelogtable').DataTable();
					table.draw();
					var json = JSON.parse(data);
					var status = json.status;
					if(json.status!==""){
						alert(json.status);
					} else{
						var message = json.message;
						if(message==""){
							alert('No Changes Made');
						}else{
							alert(message);
						};
					}
				}
			});
		});
		
		//Changelog Table Buttons
		$(document).on('click','.infoBtn',function(event){
			var id = $(this).data('id');
			var database = " changelog ";
			$.ajax({
				url:"includes/fetch_single_data.inc.php",
				data:{id:id,database:database},
				type:"post",
				success:function(data){
					var json = JSON.parse(data);
					$('#id').val(json.id);
					$('#infoPlayer').val(json.player);
					$('#infoPlayer').attr('placeholder',(json.player));
					$('#infoNation').val(json.nation);
					$('#infoNation').attr('placeholder',(json.nation));
					$('#infoLevelID').val(json.level_id);
					$('#infoLevelID').attr('placeholder',(json.level_id));
					$('#infoLevelTime').val(json.level_time);
					$('#infoLevelTime').attr('placeholder',(json.level_time));
					$('#infoDateSet').val(json.date_set);
					$('#infoDateSet').attr('placeholder',(json.date_set));
					$('#infoVideoLink').val(json.video_link);
					$('#infoVideoLink').attr('placeholder',(json.video_link));
					$('#infoDataEntry').modal('show');
				}
			});
		});
		$(document).on('click','.denyBtn',function(event){
			var id = $(this).data('id');
			var approved = false;
			if(confirm('Are you sure you want to deny these changes?')){
				$.ajax({
					url:"includes/approve_deny_changes.inc.php",
					data:{id:id,approved:approved},
					type:"post",
					success:function(data){
						var json = JSON.parse(data);
						var status = json.status;
						if(status = 'success'){
							table= $('#changelogtable').DataTable();
							table.draw();
							table= $('#searchTable').DataTable();
							table.draw();
						} else alert('failed');
					}
				});
			}
		});
		$(document).on('click','.approveBtn',function(event){
			var id = $(this).data('id');
			var approved = true;
			if(confirm('Are you sure you want to apply these changes?')){
				$.ajax({
					url:"includes/approve_deny_changes.inc.php",
					data:{id:id,approved:approved},
					type:"post",
					success:function(data){
						var json = JSON.parse(data);
						var status = json.status;
						if(status = 'success'){
							table= $('#changelogtable').DataTable();
							table.draw();
							table= $('#searchTable').DataTable();
							table.draw();
						} else alert('failed');	
					}
				});
			}
		});
	</script>
	
	
	
	<!-- Add Entry Modal -->
	<div class="modal fade" id="addDataEntry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add New Entry</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form id="addNewEntry" action="javascript:void();" method="post">
			  <div class="modal-body">
				<div class="mb-3 row">
					<label for="inputPlayer" class="col-sm-3 col-form-label">Player</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputPlayer" name="inputPlayer" Placeholder="FunkyKawng">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="player-list"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="inputNation" class="col-sm-3 col-form-label">Nation</label>
					<div class="col-sm-9">
						<input type ="text" class="form-control" id="inputNation" name="inputNation" Placeholder="Tonga">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="country-list"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="inputLevelID" class="col-sm-3 col-form-label">Level ID</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputLevelID" name="inputLevelID" Placeholder="1-1">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="levelID-list"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="inputLevelTime" class="col-sm-3 col-form-label">Level Time</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputLevelTime" name="inputLevelTime" Placeholder="00:00:00.00">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="inputDateSet" class="col-sm-3 col-form-label">Date Set</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" id="inputDateSet" name="inputDateSet" Placeholder="mm/dd/yyyy">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="inputVideoLink" class="col-sm-3 col-form-label">Link / URL</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputVideoLink" name="inputVideoLink" Placeholder="https://youtube.com">
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Edit Entry Modal -->
	<div class="modal fade" id="editDataEntry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Update Entry</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form id="editNewEntry" action="javascript:void();" method="post">
			  <div class="modal-body">
				<input type="hidden" id="id" name="id" value="">
				<div class="mb-3 row">
					<label for="editPlayer" class="col-sm-3 col-form-label">Player</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="editPlayer" name="editPlayer" Placeholder="FunkyKawng">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="player-list2"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="editNation" class="col-sm-3 col-form-label">Nation</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="editNation" name="editNation" Placeholder="Tonga">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="country-list2"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="editLevelID" class="col-sm-3 col-form-label">Level ID</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="editLevelID" name="editLevelID" Placeholder="1-1">
						<div class="dropdownmenu">
							<ul class="autocomplete-list" id="levelID-list2"></ul>
						</div>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="editLevelTime" class="col-sm-3 col-form-label">Level Time</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="editLevelTime" name="editLevelTime" Placeholder="00:00:00.00">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="editDateSet" class="col-sm-3 col-form-label">Date Set</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" id="editDateSet" name="editDateSet" Placeholder="mm/dd/yyyy">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="editVideoLink" class="col-sm-3 col-form-label">Link / URL</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="editVideoLink" name="editVideoLink" Placeholder="https://youtube.com">
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- Info Entry Modal -->
	<div class="modal fade" id="infoDataEntry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Info</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form id="infoNewEntry" action="javascript:void();" method="post">
			  <div class="modal-body">
				<input type="hidden" id="id" name="id" value="">
				<div class="mb-3 row">
					<label for="infoPlayer" class="col-sm-3 col-form-label">Player</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="infoPlayer" name="infoPlayer" Placeholder="">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="infoNation" class="col-sm-3 col-form-label">Nation</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="infoNation" name="infoNation" Placeholder="">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="infoLevelID" class="col-sm-3 col-form-label">Level ID</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="infoLevelID" name="infoLevelID" Placeholder="">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="infoLevelTime" class="col-sm-3 col-form-label">Level Time</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="infoLevelTime" name="infoLevelTime" Placeholder="">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="infoDateSet" class="col-sm-3 col-form-label">Date Set</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" id="infoDateSet" name="infoDateSet" Placeholder="">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="infoVideoLink" class="col-sm-3 col-form-label">Link / URL</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="infoVideoLink" name="infoVideoLink" Placeholder="">
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
	
	<!-- Drop Down Menus For Modal Inputs -->
	<script src ="js/drop_down_menu.js"></script>
</body>
</html>