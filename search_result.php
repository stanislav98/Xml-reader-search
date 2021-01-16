<?php
	include './helpers/Database.php';
	$db = new Database;
	$search_term = $_POST['search_term'];
	if(!empty($search_term)) {
		$results = $db->search_by_author($search_term);
		$out = '';
		foreach($results as $k => $v) {
			$out .= '<div class="single_box">
				<h4>'.$v['author'].'</h4>
				<p>Name : '.$v['book_name'].'</p>
				<p>Date : '.$v['date_added'].'</p>
				<p>Folder Depth : '.$v['depth'].'</p>
				<p>Row Number : '.$v['row_number'].'</p>
			</div>';
		}
		echo $out;
	} else {
		$results = $db->select_all_books();
		$out = '';
		foreach($results as $k => $v) {
			$out .= '<div class="single_box">
				<h4>'.$v['author'].'</h4>
				<p>Name : '.$v['book_name'].'</p>
				<p>Date : '.$v['date_added'].'</p>
				<p>Folder Depth : '.$v['depth'].'</p>
				<p>Row Number : '.$v['row_number'].'</p>
			</div>';
		}
		echo $out;
	}
?>