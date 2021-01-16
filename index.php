<?php
	include './helpers/Database.php';
	include './helpers/function.php';
	include './helpers/XmlValidator.php';
	$db = new Database;
	$xml_file_dir = dirname(__FILE__).'\xml';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xml Reader</title>
	<link rel="stylesheet" href="../assets/style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/4.1.0/less.js" integrity="sha512-6GyWbofPUqR2C+yM8XNielK7RQBnAdPOH+J54O8nEgKfpIfkU5sLP5exOvV7IM+YwFCodOO0QulDt8xi+iwjOA==" crossorigin="anonymous"></script>

</head>
<body>
	<?php
	$output_inserted = '<h2 class="box_title">Inserted Rows</h2><div class="inserted boxes">';
	$output_updated = '<h2 class="box_title">Updated Rows</h2><div class="updated boxes">';

	$inserted_rows_count = 0;
	$updated_rows_count = 0;

	 if(is_dir($xml_file_dir)) {
            $it = new RecursiveDirectoryIterator($xml_file_dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    		$depth = 1;
            foreach($files as $kfile => $file) {
            	if($file->getExtension() == 'xml') {
            		$validator = new XmlValidator;
            		if($validator->isXMLFileValid($file)) {
        				$xml = simplexml_load_file($file);
        				$record_number = 1;
		        		foreach($xml->book as $k => $v) {
		        			if(mb_strlen($v->author,"UTF-8") > 100 || mb_strlen($v->book,"UTF-8") > 100) {
		        				echo "The row from file ".$file." has length longer than varchar(100) so it wont be saved !";
		        				trace("Author is : ".$v->author);
		        				trace("Name is : ".$v->name);
		        			} else {
	        					$date = date('Y-m-d H:i:s');
		        				if(empty($db->check_if_book_exists($depth,$record_number))) {
		        					$db->insert_rows(array($v->author,$v->name,$depth,$record_number,$date));
		        					$inserted_rows_count += 1;
		        					$output_inserted .= 
		        						'<div class="single_box">
			        						<h4>'.$v->author.'</h4>
			        						<p>Name : '.$v->name.'</p>
			        						<p>Date : '.$date.'</p>
			        						<p>Folder Depth : '.$depth.'</p>
			        						<p>Row Number : '.$record_number.'</p>
		        						</div>';
								} else {
									$db->update_book(array($v->author,$v->name,$date,$depth,$record_number));
									$updated_rows_count += 1;
									$output_updated .= 
		        						'<div class="single_box">
			        						<h4>'.$v->author.'</h4>
			        						<p>Name : '.$v->name.'</p>
			        						<p>Date : '.$date.'</p>
			        						<p>Folder Depth : '.$depth.'</p>
			        						<p>Row Number : '.$record_number.'</p>
		        						</div>';
								}
		        			}
		        			$record_number++;
		        		}
            		} else {
            			echo "The following file was not readed because it's not valid XML : ".$file;  
            		}

            		$depth++;
            	}
            }
        }

        $output_inserted .= '</div>';
        $output_updated .= '</div>';
        ?>
        <div class="container">
        	<?php 

	        	if($inserted_rows_count != 0 ) {
	        	 	echo $output_inserted; 
	        	}
	        	if($updated_rows_count != 0 ) {
	        		echo $output_updated; 
	        	}
	        	if($updated_rows_count == 0 && $inserted_rows_count == 0 ) {
	        		echo '<h2 class="box_title">There was no inserted or updated rows</h2>';
	        	}

    		?>
        </div>
</body>
</html>

<!-- depth and row number -->