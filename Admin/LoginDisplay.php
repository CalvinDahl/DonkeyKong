<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	
	<link href="../DataTables/datatables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="Styles.css">
</head>
<body>

	<!-- DataTables Styles & Plugins -->
	<script src="../DataTables/datatables.min.js" type="text/javascript"></script>
	
	<div class="container-fluid">
		<div class="row">
			<div class="mb-3 row"></div>
			<h3 class="text-center">Login</h3>
			<div class="mb-3 row">
				<div class="col-sm-2"></div>
				<label for="enterUsername" class="col-sm-2 col-form-label">Enter Username:</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="enterUsername" name="enterUsername" Placeholder="Username">
				</div>
			</div>
			<div class="mb-3 row">
				<div class="col-sm-2"></div>
				<label for="enterPassword" class="col-sm-2 col-form-label">Enter Password:</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" id="enterPassword" name="enterPassword" Placeholder="Password">
				</div>
				<div class="col-sm-2">
					<button type="button" style="margin-bottom: 20px;" class="btn btn-primary loginBtn">Login</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on('click','.loginBtn',function(event){
			var username = $('#enterUsername').val();
			var pwd = $('#enterPassword').val();
			$.ajax({
				url:"includes/Login.inc.php",
				data:{username:username,pwd:pwd},
				type:"post",
				success:function(data){
					var json = JSON.parse(data);
					empty = json.empty_input;
					info = json.login_incorrect;
					if((empty === "") && (info === "")){
						location.replace("./Crud.php");
					} else if (empty === ""){
						alert(info);
					} else alert(empty);
				}
			});
		});
	</script>
</body>
</html>