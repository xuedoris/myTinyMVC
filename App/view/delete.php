<?php
	/*
	* Decide which delete function should be used.
	*/
	if($uniqueID&&$uniqueNumber)
		echo "<script type=\"text/javascript\">deleteFull($pid, $num);</script>";
	else if(!$uniqueID&&!$uniqueNumber)
			echo "<script type=\"text/javascript\">deleteCombination($pid, $num);</script>";
	else if(!$uniqueID)
			echo "<script type=\"text/javascript\">deleteNumber($pid, $num);</script>";
	else if(!$uniqueNumber)
			echo "<script type=\"text/javascript\">deleteName($pid, $num);</script>";
	