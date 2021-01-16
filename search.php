<?php
	include './helpers/Database.php';
	include './helpers/function.php';
	$db = new Database;
	$results = $db->select_all_books();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search DB - Ajax</title>

	<link rel="stylesheet" href="../assets/style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../assets/main.js"></script>
</head>
<body>

	<div class="container">
		<h2 class="box_title">Search For Result</h2>
		<input type="text" name="search" id="search" placeholder="Search By Author Name">
		<div class="boxes mt-20">
			<?php 
			foreach($results as $k => $v) {
			$output = '<div class="single_box">
				<h4>'.$v['author'].'</h4>
				<p>Name : '.$v['book_name'].'</p>
				<p>Date : '.$v['date_added'].'</p>
				<p>Folder Depth : '.$v['depth'].'</p>
				<p>Row Number : '.$v['row_number'].'</p>
			</div>';
			echo $output;
			} ?>
		</div>
	</div>
	
</body>
</html>