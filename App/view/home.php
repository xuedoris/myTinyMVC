<!--This is the home page of PhoneBook application.-->
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Xanadu Phonebook!</title>
		<script src = "//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src = "App/public/JS/PhoneBook.js" type="text/javascript"></script>
		<link href="App/public/CSS/PBstyle.css" rel="stylesheet" type="text/css" >
		<meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
	</head>
	<body>
		<div id = "wrap">
			<div id = "header">
				<div id = "logo">
				<h1><a href = "<?php echo Helper::setURL('')?> ">Xanadu Phonebook Application</a></h1>
				<p>Using a small original MVC.</p>
				</div>
			</div>

			<div id = "menu"><b>PHONEBOOK VERSION 1.0: </b> Tested on Firefox and GoogleChrome</div>

			<div id = "sidebar">
				<div id = "new_contact">
				<h4>Add New Contact</h4>
				<div id = "exist"></div>
				<form name="newContact" id = "newContact" action="" method="post" >
				First name:<input name="fname" id = "fname">
				<p id="lb_fname">you have to enter first name</p>
				Last name:<input name="lname" id = "lname">
				<p id="lb_lname">you have to enter last name</p>
				Phone number:<input name="phone_number" id = "phone_number" >
				<p id="invalid_number">The number is NOT valid. Please enter at least 7 digits number.</p>
				Phone type:
				<select name = "phone_type">
					<option value = "home">Home</option>
					<option value = "mobile">Mobile</option>
					<option value = "office">Office</option>
					<option value = "other">Other</option>
				</select>
				<a href="javascript:validate()" class="button">Add contact</a>
				<input type = "reset" id = "reset" value = "Reset">
				</div>

				<div id = "search">
				<h4>Search Contact</h4>
				<form name="searchBox" id = "searchBox" action="" method="post" >
				By name:
				<input name="searchContent" id = "searchContent">
				<p id="invalid_name">The name is NOT valid. Ex.Dara Pich</p>
				<a href="javascript:search()" class="button">Search</a>
				</div>
			</div>
			<div id = "main">
			<?php include_once('updateContact.php');?>
			</div>
			<div id = "footer">
				<div id = "desc">
				<h5>Designed and Implemented by <em>Xueyuan Peng</em></h5>
				<p>This is a simple phonebook application developed in object-oriented php along with
				AJAX, JQuery, CSS and HTML.
				</p>
				</div>
			</div>
		</div>
	</body>
</html>
