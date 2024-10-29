<?php

declare(strict_types=1);

function search_inputs(){
	
	if (isset($_SESSION["search_data"])){
		echo '<input type="text" name="player" placeholder="Player Name" value = "' . $_SESSION["search_data"]["player"] .'">';
		echo '<input type="text" name="nation" placeholder="Nation" value = "' . $_SESSION["search_data"]["nation"] .'">';
		echo '<input type="number" name="level_id" placeholder="Level ID" value = "' . $_SESSION["search_data"]["level_id"] .'">';
		echo '<input type="text" name="level_time" placeholder="Level Time" value = "' . $_SESSION["search_data"]["level_time"] .'">';
		echo '<input type="date" name="date_set" placeholder="Date Set" value = "' . $_SESSION["search_data"]["date_set"] .'">';
		echo '<input type="text" name="kong_used" placeholder="Kong Used" value = "' . $_SESSION["search_data"]["kong_used"] .'">';
		echo '<input type="text" name="video_link" placeholder="Video Link / URL" value = "' . $_SESSION["search_data"]["video_link"] .'">';
	} else{
		echo '<input type="text" name="player" placeholder="Player Name">';
		echo '<input type="text" name="nation" placeholder="Nation">';
		echo '<input type="number" name="level_id" placeholder="Level ID">';
		echo '<input type="text" name="level_time" placeholder="Level Time">';
		echo '<input type="date" name="date_set" placeholder="Date Set">';
		echo '<input type="text" name="kong_used" placeholder="Kong Used">';
		echo '<input type="text" name="video_link" placeholder="Video Link / URL">';
	}
}

function search_results(){
	if(isset($_SESSION['search_errors'])){
		$errors = $_SESSION['search_errors'];
		
		echo '<h3>Search Results:</h3>';
		foreach($errors as $error){
			echo '<p>' . $error . '</p>';
		}
		unset($_SESSION['search_errors']);
	}
	else if(isset($_SESSION['search_results'])){
		$results = $_SESSION['search_results'];
		echo '<h3>Search Results:</h3>';
		echo '<table class = "wr">';
			echo '<tbody>';
			foreach ($results as $row){
				?>
				<html>
				<form action="includes/update.inc.php" method="post">
				<tr>
					<input type="hidden" name="id" value="<?=$row["id"]?>">
					<td><input type="text" name="player" value="<?=$row["player"]?>"></td>
					<td><input type="text" name="nation" value="<?=$row["nation"]?>"></td>
					<td><input type="number" name="level_id" value="<?=$row["level_id"]?>"></td>
					<td><input type="text" name="level_time" value="<?=$row["level_time"]?>"></td>
					<td><input type="date" name="date_set" value="<?=$row["date_set"]?>"></td>
					<td><input type="text" name="kong_used" value="<?=$row["kong_used"]?>"></td>
					<td><input type="text" name="video_link" value="<?=$row["video_link"]?>"></td>
					<td><button type="submit">Update</button></td>
				</form>
				<form action="includes/removeentry.inc.php" method="post">
					<td><button type="delete">Delete</button></td>
				</form>
				</tr>
				</html>
				<?php
			}
			echo '</tbody>';
		echo '</table>';
	}
}