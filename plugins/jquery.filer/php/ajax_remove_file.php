<?php
if (isset($_POST['file'])) {
    $file = '../../../upload/' . $_POST['file'];
	
    if(file_exists($file))
		unlink($file);
}