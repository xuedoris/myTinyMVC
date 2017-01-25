<?php
	/*
	* PhoneBookController is the main controller to control the logic flow in this application.
	* Always set views and data in Controller then pass into View.
	* It contains all the operations to run the Phonebook.
	*/
	class PhoneBookController extends Controller {
		/*
		* Showing home.php, the main page with the contact list order by last name.
		*/
		public function home(){
			$this->setView('home');
			$model = new Model('phonebook');
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data, 'column'=>''));
		}

		/*
		* Server-side validation. Check existing contacts.
		*/
		public function checkContact(){
			$existContact = false;
			$existName = false;
			$existNumber = false;
			$this->setView('checkContact');
			$model = new Model('phonebook');
			$contact = $model->selectBySql("select * from people natural join phoneowner where last = '{$_POST['lname']}' and first = '{$_POST['fname']}' and phone_number = {$_POST['phone_number']}");
			$name = $model->selectBySql("select P_ID from people where last = '{$_POST['lname']}' and first = '{$_POST['fname']}'");
			$number = $model->selectBySql("select * from phone_info where phone_number = {$_POST['phone_number']}");
			// Check if name-number contact combination exists.
			if (!empty($contact) && $contact){
				$existContact = true;
			}
			// Check if name exists.
			if (!empty($name) && $name){
				$existName = true;
			}
			// Check if number exists.
			if (!empty($number) && $number){
				$existNumber = true;
			}
			// Pass data to View.
			$this->setData(array(
							'existContact'=>$existContact,
							'existName'=>$existName,
							'existNumber'=>$existNumber,
							'name'=>$name
							));
		}

//---------------------------Insert according to 4 cases---------------------//
		/*
		* Insert brand-new contact; that is, name and number both don't exist.
		*/
		public function insertNewContact(){
			$first = mysql_real_escape_string($_POST['fname']);
			$last = mysql_real_escape_string($_POST['lname']);
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to insert into all 3 tables.
			$model->excuteBySql("INSERT INTO `people`(`P_ID`, `Last`, `First`) VALUES (default,'{$last}','{$first}')");
			$model->excuteBySql("INSERT INTO `phone_info`(`Phone_Number`, `Phone_Type`) VALUES ({$_POST['phone_number']},'{$_POST['phone_type']}')");
			$model->excuteBySql("INSERT INTO `phoneowner`(`P_ID`, `Phone_Number`) VALUES (default,{$_POST['phone_number']})");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

		/*
		* Insert contact number when the name has already existed in database.
		*/
		public function insertNumberContact(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to insert into 2 tables, phone_info and phoneowner, since the name exists in 'people' table already.
			$model->excuteBySql("INSERT INTO `phone_info`(`Phone_Number`, `Phone_Type`) VALUES ({$_POST['phone_number']},'{$_POST['phone_type']}')");
			$model->excuteBySql("INSERT INTO `phoneowner`(`P_ID`, `Phone_Number`) VALUES ({$_POST['pid']},{$_POST['phone_number']})");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info");
			$this->setData(array('data'=>$data));
		}

		/*
		* Insert contact name when the number has already existed in database.
		*/
		public function insertNameContact(){
			$first = mysql_real_escape_string($_POST['fname']);
			$last = mysql_real_escape_string($_POST['lname']);
			$this->setView('updateContact');
			$model = new Model('phonebook');
			
			// Need to insert into 2 tables, people and phoneowner, since the number exists in 'phone_info' table already.
			$model->excuteBySql("INSERT INTO `people`(`P_ID`, `Last`, `First`) VALUES (default,'{$last}','{$first}')");
			$model->excuteBySql("INSERT INTO `phoneowner`(`P_ID`, `Phone_Number`) VALUES (default,{$_POST['phone_number']})");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

		/*
		* Insert a contact  when the name and number both has already existed in database 
		* but their combination is new.
		*/
		public function insertCombination(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to insert into 1 tables, phoneowner, since both the name and the number exist already.
			$model->excuteBySql("INSERT INTO `phoneowner`(`P_ID`, `Phone_Number`) VALUES ({$_POST['pid']},{$_POST['phone_number']})");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}
//--------------------------------update contacts----------------------------//

		/*
		* Update contact according to user inputs.
		*/
		public function updateContact(){
			$first = mysql_real_escape_string($_POST['f']);
			$last = mysql_real_escape_string($_POST['l']);
			$number = $_POST['n'];
			$type = $_POST['t'];
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Update the filled field(s).
			// If first name input field is filled, then updates First in people table.
			if (!empty($first) && $first)
				$model->excuteBySql("UPDATE `people` SET `First`= '$first' WHERE P_ID = {$_POST['id']}");
			// If last name input field is filled, then updates Last in people table.
			if (!empty($last) && $last)
				$model->excuteBySql("UPDATE `people` SET `Last`= '$last' WHERE P_ID = {$_POST['id']}");
			// If phone type select field is choosed, then updates phone_type in phone_info table.
			if (!empty($type) && $type)
				$model->excuteBySql("UPDATE `phone_info` SET `Phone_Type`= '$type' WHERE Phone_Number = {$_POST['p_id']}");
			// If phone number input field is filled, then updates phone_number in phoneowner table and phone_info table.
			if (!empty($number) && $number){
				$model->excuteBySql("UPDATE `phoneowner` SET `Phone_Number`= '$number' WHERE Phone_Number = {$_POST['p_id']}");
				$model->excuteBySql("UPDATE `phone_info` SET `Phone_Number`= '$number' WHERE Phone_Number = {$_POST['p_id']}");
			}

			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

//-------------------------------delete according to 4 cases------------------//
		/*
		* Check the contact status before deleting.
		*/
		public function deleteCheck(){
			$uniqueID = true;
			$uniqueNumber = true;
			$pid = $_POST['id'];
			$num = $_POST['num'];
			$this->setView('delete');
			$model = new Model('phonebook');
			$id = $model->selectBySql("select p_id from phoneowner where p_id = $pid");
			$number = $model->selectBySql("select phone_number from phoneowner where phone_number = $num");
			
			// Check if the contact owns more than one phone numbers.
			if (count($id) > 1&&$id)
				$uniqueID = false;
			// Check if the single number has more than one owners.
			if (count($number) > 1&&$number){
				$uniqueNumber = false;
			}
			$this->setData(array(
							'uniqueID'=>$uniqueID,
							'uniqueNumber'=>$uniqueNumber,
							'pid'=>$pid,
							'num'=>$num
							));
		}

		/*
		* Delete the contact which its name and number are both unique.
		*/
		public function deleteFull(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to delete from all 3 tables.
			$model->excuteBySql("delete from people where P_ID = {$_POST['id']} ");
			$model->excuteBySql("delete from phoneowner where P_ID = {$_POST['id']}");
			$model->excuteBySql("delete from phone_info where phone_number = {$_POST['num']}");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

		/*
		* Delete the contact which its name and its number are both not unique.
		*/
		public function deleteCombination(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to delete from phoneowner table. Since other names own the number; and other numbers own the name.
			$model->excuteBySql("delete from phoneowner where P_ID = {$_POST['id']} and phone_number = {$_POST['num']}");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

		/*
		* Delete the contact which the number is unique.
		*/
		public function deleteNumber(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to delete from phone_info table and phoneowner table. Since the number is unique.
			$model->excuteBySql("delete from phoneowner where phone_number = {$_POST['num']}");
			$model->excuteBySql("delete from phone_info where phone_number = {$_POST['num']}");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}

		/*
		* Delete the contact which the name is unique.
		*/
		public function deleteName(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Need to delete from people table and phoneowner table. Since the name is unique.
			$model->excuteBySql("delete from people where P_ID = {$_POST['id']} ");
			$model->excuteBySql("delete from phoneowner where P_ID = {$_POST['id']}");
			
			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info", 'last');
			$this->setData(array('data'=>$data));
		}
//-------------------------------search contact------------------------------//
		/*
		* Search the contact by first name or full name.
		*/
		public function search(){
			$this->setView('search');
			$model = new Model('phonebook');
			$flag = strpos($_POST['searchContent']," ");

			if($flag === false)
				// Search by first name.
				$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info where first = '{$_POST['searchContent']}'");
			else{
				// Search by full name
				$temp = explode(" ",$_POST['searchContent']);
				$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info where first = '{$temp[0]}' and last = '{$temp[1]}'");
			}
			// Show search results.
			$this->setData(array('data'=>$data));
		}
//-------------------------------re-order the contact list-------------------//
		/*
		* Re-order the contact list by specific field.
		*/
		public function order(){
			$this->setView('updateContact');
			$model = new Model('phonebook');

			// Initialize $_SESSION['orderby'].
			$_SESSION['orderby'] = $_POST['o'];
			// Order can be ascending or descending.
			if($_SESSION['orderby'] === null)
				$_SESSION['orderby'] = 'ASC';
			else if($_SESSION['orderby'] == 'ASC')
					$_SESSION['orderby'] = 'DESC';
			else if($_SESSION['orderby'] = 'DESC')
					$_SESSION['orderby'] = 'ASC';

			// Refresh the contact list.
			$data = $model->selectBySql("select * from people natural join phoneowner natural join phone_info",$_POST['column']. " {$_SESSION['orderby']}");
			$this->setData(array('data'=>$data, 'column'=>$_POST['column']));
		}
}
