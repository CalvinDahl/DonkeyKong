<?php
	require_once 'includes/config_session.inc.php';
	require_once 'includes/search_view.inc.php';
	require_once 'includes/compare_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css">
</head>
<body>
	<!--
	<h3>Add New Entry</h3>
	<form class ="entryform" action="includes/newentry.inc.php" method="post">
		<input type="text" name="player" placeholder="Player Name">
		<input type="text" name="nation" placeholder="Nation">
		<input type="number" name="level_id" placeholder="Level ID">
		<input type="text" name="level_time" placeholder="Level Time">
		<input type="date" name="date_set" placeholder="Date Set">
		<input type="text" name="kong_used" placeholder="Kong Used">
		<input type="text" name="video_link" placeholder="Video Link / URL">
		<button>Submit</button>
	</form>
	
	<h3>Search Entries</h3>
	<form class="searchform" action="includes/search.inc.php" method="post">
		<?php
			search_inputs();
		?>
		<button>Submit</button>
	</form>
	
	<?php
		search_results();
	?>
	-->
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal"
						data-bs-target="#addDataEntry">Add Entry</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<table id="datatable" class="table table-striped">
							<thead>
								<th>Player Name</th>
								<th>Nation</th>
								<th>Level ID</th>
								<th>Level Time</th>
								<th>Date Set</th>
								<th>Kong Used</th>
								<th>Video Link / URL</th>
								<th>Options</th>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
									<td><a class="btn">Edit</a><a href="">Delete</a></td>
								</tr>
								<tr>
									<td>adf</td>
									<td>adf</td>
									<td>ags</td>
									<td>4sdfg</td>
									<td>5sfgs</td>
									<td>6wrwgfw</td>
									<td>7wrg</td>
									<td><a class="btn">Edit</a><a href="">Delete</a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
	</div>
	<!--
	<h3>Apply Changes</h3>
	<?php
		require_once 'includes/compare.inc.php';
	?>
	
	<?php
		compare_data();
	?>
	-->
	
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>

	<script>
		$('datatable').DataTable({
			'serverside':true,
			'processing':true,
			'paging':true,
			'order':[],
			'ajax':{
				'url':'includes/search.inc.php',
				'type':'post',
			},
			'fnCreateRow':function(nRow,aData,iDataIndex)
			{
				$(nRow).attr('id',aData[0]);
			}
			'columnDefs':[{
				'target':[0,5],
				'orderable':false,
			}]
		});
	</script>
	
	
	<!-- add user Modal -->

	<!-- Add Entry -->
	<div class="modal fade" id="addDataEntry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			...
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>
</body>
</html>