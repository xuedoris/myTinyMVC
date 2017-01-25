<?php
	/*
	* This is a helper class.
	*/
	class Helper{
		/*
		* To display error message in a JavaScript pop-up window.
		*/
		public function displayMessage($error){
			$error = 1;
			echo '<script type="text/javascript">'."alert('{$error}');".'</script>';
		}
		/*
		* To set up the root URL 'http://localhost/myTinyMVC/index.php'
		*/
		public function setURL($url){
			return 'http://'.$_SERVER['SERVER_NAME'].'/myTinyMVC/index.php'.$url;
		}
}