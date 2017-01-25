<!--This page contains the contact list will be refreshed after each operation.-->
<table>
	<tr>
		<th><a href = "javascript:order('first','<?php echo $_SESSION['orderby'];?>')">First Name
			<img src="App/public/Images/trans.png"  width = "1" height= "1" class="<?php echo($column == 'first' ? '' : 'hidden');?> <?php echo($_SESSION['orderby']=='ASC') ? 'arrow-up' : 'arrow-down';?>" alt="arrow"/>
			</a>
		</th>
		<th><a href = "javascript:order('last','<?php echo $_SESSION['orderby'];?>')">Last Name
			<img src="App/public/Images/trans.png"  width = "1" height= "1" class="<?php echo($column == 'last' ? '' : 'hidden');?> <?php echo($_SESSION['orderby']=='ASC') ? 'arrow-up' : 'arrow-down';?>" alt="arrow"/></a>
		</th>
		<th><a href = "javascript:order('phone_number','<?php echo $_SESSION['orderby'];?>')">Phone Number
			<img src="App/public/Images/trans.png"  width = "1" height= "1" class="<?php echo($column == 'phone_number' ? '' : 'hidden');?> <?php echo($_SESSION['orderby']=='ASC') ? 'arrow-up' : 'arrow-down';?>" alt="arrow"/></a>

		</th>
		<th>Phone Type</th>
		<th></th>
	</tr>

	<?php
		if($data){
			$i = 0;
			foreach($data as $d){
				$pid = $d->P_ID;
				$number = $d->Phone_Number;
			?>

			<tr <?php echo ($i%2 == 1) ? 'class = alt' : '' ;?>>
				<td><input type = "text" size="10" id = <?php echo 'first_'.$pid.'_'.$number?> class = <?php echo 'txt_'.$pid.'_'.$number ?>>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><?php echo $d->First; ?></span></td>
				<td><input type = "text" size="10" id = <?php echo 'last_'.$pid.'_'.$number?> class = <?php echo 'txt_'.$pid.'_'.$number ?>>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><?php echo $d->Last; ?></span></td>
				<td><input type = "text" size="10" id = <?php echo 'number_'.$pid.'_'.$number?> class = <?php echo 'txt_'.$pid.'_'.$number ?>>
					<p style="display: none;" id="invalid_num">At least 7 digits.</p>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><?php echo $d->Phone_Number; ?></span></td>
				<td><select style="display: none;" id = <?php echo 'type_'.$pid.'_'.$number?> class = <?php echo 'txt_'.$pid.'_'.$number ?>>
						<option></option>
						<option value = "home">Home</option>
						<option value = "mobile">Mobile</option>
						<option value = "office">Office</option>
						<option value = "other">Other</option>
					</select>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><?php echo $d->Phone_Type; ?></span></td>
				<td><span style="display: none;"  class = <?php echo 'txt_'.$pid.'_'.$number ?>><a href="javascript:save(<?php echo $pid.",".$number?>)"><img src="App/public/Images/save.gif" width="40" height="20" alt="Save"/></a></span>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><a href="javascript:edit(<?php echo $pid.",".$number?>)"><img src="App/public/Images/edit.png" width="20" height="20" alt="Edit"/></a></span>
					<span class = <?php echo 'lb_'.$pid.'_'.$number ?>><a href="javascript:deleteContact(<?php echo $pid.",".$number?>)"><img src="App/public/Images/delete.png" width="20" height="20" alt="Delete"/></a></span></td>
			</tr>
			<?php
				$i++;
			}
		}
	?>
</table>