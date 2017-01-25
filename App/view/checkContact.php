<?php
	/*
	* Decide which insert function should be used.
	*/
	if($existContact)
		echo "The contact already exists. Please try again!";
	else if($existName&&$existNumber){
			foreach($name as $n)
				$pid = $n->P_ID;
			echo "<script type=\"text/javascript\">insertCombination($pid);</script>";
			}
	else if($existName){
			foreach($name as $n)
				$pid = $n->P_ID;
			echo "<script type=\"text/javascript\">insertNumber($pid);</script>";
			}
	else if($existNumber)
			echo '<script type="text/javascript">insertName();</script>';
	else echo '<script type="text/javascript">insertNew();</script>';
	