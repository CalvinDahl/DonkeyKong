<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tropical Freeze</title>
	
	<link href="DataTables/datatables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="Styles.css">
</head>
<body>
	<div class="container-fluid overflow-hidden">
		<div class="row" style="margin-top: 0.5rem">
			<div class = "container">
				<div class = "row flex-row flex-nowrap align-items-start">
					<div class="nav col-3 col-md-2">
						<center>
							<a href = ".">
								<img src="includes/images/Tropical_Freeze_Logo.png" style='height: 100%; width: 100%; object-fit: contain; margin: 0.5rem'>
							</a>
						</center>
						<div class="Nav-Worlds">
							<h2>World 1: Lost Mangroves</h2>
							<ul>
								<li>1-1: Magrove Cove</li>
								<li>1-2: Shipwreck Shore</li>
								<li>1-3: Canopy Chaos</li>
								<li>1-4: Trunk Twister</li>
								<li>1-A: Zip-Line Shrine</li>
								<li>1-B: Busted Bayou</li>
								<li>1-K: Swinger Flinger</li>
								<li>1-Boss: Big Top Bop</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 2: Autumn Heights</h2>
							<ul>
								<li>2-1: Windmill Hills</li>
								<li>2-2: Mountain Mania</li>
								<li>2-3: Horn Top Hop</li>
								<li>2-4: Sawmill Thrill</li>
								<li>2-5: Alpine Incline</li>
								<li>2-6: Wing Ding</li>
								<li>2-A: Crumble Cavern</li>
								<li>2-B: Rodent Ruckus</li>
								<li>2-K: Bopopolis</li>
								<li>2-Boss: Mountaintop Tussle</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 3: Bright Savannah</h2>
							<ul>
								<li>3-1: Grassland Groove</li>
								<li>3-2: Baobab Bonanza</li>
								<li>3-3: Frantic Fields</li>
								<li>3-4: Scorch 'n' Torch</li>
								<li>3-5: Twilight Terror</li>
								<li>3-6: Cannon Canyon</li>
								<li>3-A: Rickety Rafters</li>
								<li>3-B: Bramble Scramble</li>
								<li>3-K: Precarious Pendulums</li>
								<li>3-Boss: Triple Trouble</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 4: Sea Breeze Cove</h2>
							<ul>
								<li>4-1: Deep Keep</li>
								<li>4-2: High Tide Ride</li>
								<li>4-3: Amiss Abyss</li>
								<li>4-4: Irate Eight</li>
								<li>4-5: Sea Stack Attack</li>
								<li>4-6: Current Capers</li>
								<li>4-A: Rockin' Relics</li>
								<li>4-B: Shoal Atoll</li>
								<li>4-K: Spinning Spines</li>
								<li>4-Boss: Fugu Face-Off</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 5: Juicy Jungle</h2>
							<ul>
								<li>5-1: Harvest Hazards</li>
								<li>5-2: Reckless Ride</li>
								<li>5-3: Fruity Factory</li>
								<li>5-4: Panicky Paddles</li>
								<li>5-5: Jelly Jamboree</li>
								<li>5-6: Frosty Fruits</li>
								<li>5-A: Beehive Brawl</li>
								<li>5-B: Jammin' Jams</li>
								<li>5-K: Platform Problems</li>
								<li>5-Boss: Punch Bowl</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 6: Donkey Kong Island</h2>
							<ul>
								<li>6-1: Homecoming Hijinxs</li>
								<li>6-2: Seashore War</li>
								<li>6-3: Aqueduct Assault</li>
								<li>6-4: Blurry Flurry</li>
								<li>6-5: Forest Folly</li>
								<li>6-6: Cliffside Slide</li>
								<li>6-7: Frozen Frenzy</li>
								<li>6-8: Meltdown Mayhem</li>
								<li>6-A: Dynamite Dash</li>
								<li>6-B: Icicle Arsenal</li>
								<li>6-K: Slippy Spikes</li>
								<li>6-Boss: Volcano Dome</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>World 7: Secret Seclusion</h2>
							<ul>
								<li>7-1: Levitation Station</li>
								<li>7-2: Rocket Rails</li>
								<li>7-3: Crazy Clouds</li>
							</ul>
						</div>
						<div class="Nav-Worlds">
							<h2>About</h2>
							<ul>
								<li><a href="Admin/LoginDisplay.php" target="_blank">Updaters</a></li>
								<li><a href="javascript:void(0)" id="DownloadCSV">Download CSV</a></li>
								<li><a href="https://discord.gg/geapzyk8mS" target="_blank">Discord Link</a></li>
							</ul>
						</div>
						<center>
								<img src="includes/images/Splash.png" style='width:105%; object-fit: contain; margin: 0.5rem; margin-bottom: -18%'>
						</center>
					</div>
					
					<div class="background col-9 col-md-10">
						<h1 class="text-center">Current World Records</h1>
						<div class = "row justify-content-center">
							<span class="background-table">
								<table id="leaderboard" class="table table-striped">
									<thead>
										<th>Level</th>
										<th>Name</th>
										<th>Nation</th>
										<th>Date Set</th>
										<th>Barrel</th>
										<th>Time / Video</th>
									</thead>
									<tbody></tbody>
								</table>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- DataTables Styles & Plugins -->
	<script src="DataTables/datatables.min.js" type="text/javascript"></script>
	
	<!-- AJAX Server Calls -->
	<script type="text/javascript">
		//Upload Table Initialization
		$('#leaderboard').DataTable({
			'serverSide':true,
			'processing':true,
			'paging':false,
			'searching':false,
			'lengthChange':false,
			'info':false,
			'order':[],
			'ajax':{
				'url':'includes/fetch_data.inc.php',
				'type':'post',
			},
			'fnCreatedRow':function(nRow,aData,iDataIndex)
			{
				$(nRow).attr('id',aData[0]);
			},
			"drawCallback": function(settings) {
				console.log(settings.json)
				MergeGridCells('leaderboard',[1]);
			   //do whatever  
			},
			'columnDefs':[
				{'target':"_all",'searchable':false,'orderable':false,'className':'text-center align-middle'},
				{'target':0,'width':'15%'},
				{'target':2,'width':'10%'},
				{'target':3,'width':'15%'},
				{'target':4,'width':'10%'},
				{'target':5,'width':'15%'},
			]
		});
		function MergeGridCells(TableID,rCols) {
		  var dimension_cells = new Array();
		  var dimension_col = null;
		  for(Col in rCols) {
			dimension_col=rCols[Col];
			// first_instance holds the first instance of identical td
			var first_Hash="";
			var first_instance = null;
			var rowspan = 1;
			// iterate through rows
			$("#"+TableID+"> tbody > tr").children("td").attr('hidden', false);
			$("#"+TableID+"> tbody > tr").children("td").attr('rowspan', 1);
			$("#"+TableID).find('tr').each(function () {
			  // find the td of the correct column (determined by the dimension_col set above)
			  var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');
			  var dim_Hash="";
			  for(x=1;x<dimension_col;x++){
				dim_Hash+=$(this).find('td:nth-child(' + x + ')').text();
			  }
			  if (first_instance === null) {
				  // must be the first row
				  first_instance = dimension_td;
			  } else if (dimension_td.text() === first_instance.text() && first_Hash === dim_Hash) {
				  // the current td is identical to the previous AND the Hashes are as well
				  // remove the current td
				  // dimension_td.remove();
				  dimension_td.attr('hidden', true);
				  ++rowspan;
				  // increment the rowspan attribute of the first instance
				  first_instance.attr('rowspan', rowspan);
			  } else {
				  // this cell is different from the last
				  first_instance = dimension_td;
				  first_Hash = dim_Hash;
				  rowspan = 1;
			  }
			});
		  }
		} 
		
		//Download CSV
		$(document).on('click','#DownloadCSV',function(event){
			$.ajax({
				url:"includes/Excel.inc.php",
				type:"post",
				success:function(data){
					console.log(data);
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
	</script>
</body>
</html>
	