<?php

declare(strict_types=1);

function compare_data(){
	if (isset($_SESSION["compare_data"])){
	$results = $_SESSION["compare_data"];
		echo '<table class = "wr">';
			echo '<tbody>';
			foreach ($results as $row){
				?>
				<html>
				<tr>
					<td><?=$row["player"]?></td>
					<td><?=$row["nation"]?></td>
					<td><?=$row["level_id"]?></td>
					<td><?=$row["level_time"]?></td>
					<td><?=$row["date_set"]?></td>
					<td><?=$row["kong_used"]?></td>
					<td><?=$row["video_link"]?></td>
					<form >
						<button>Apply Changes</button>
					</form>
				</tr>
				</html>
				<?php
			}
			echo '</tbody>';
		echo '</table>';
	}
}