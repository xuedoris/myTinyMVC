<!--Search results page.-->
<table>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Phone Type</th>
	</tr>

	<?php
		if($data){
			$i = 0;
			foreach($data as $d){
			?>
			<tr <?php echo ($i%2 == 1) ? 'class = alt' : '' ;?>>
				<td><input type = "text" size="10" ><?php echo $d->First; ?></td>
				<td><input type = "text" size="10" ><?php echo $d->Last; ?></td>
				<td><input type = "text" size="10" ><?php echo $d->Phone_Number; ?></td>
				<td><input type = "text" size="10" ><?php echo $d->Phone_Type; ?></td>
			</tr>
			<?php
				$i++;
			}
		}
		else{
		?>
		<tr><td colspan="4">Sorry, the contact does not exist in your phone book! Please try again!</td></tr>
		<?php
		}
	?>
</table>