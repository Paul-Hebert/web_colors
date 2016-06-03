<select data-unit="" data-scale="">
	<?php 
		$hex = str_split('0123456789ABCDEF');

		foreach($hex as $option){
			if ($option === $character){
				$selected = ' selected';
			} else{
				$selected = '';				
			}

			echo'
				<option' . $selected . '>
				' . $option . '	
				</option>			
			';
		}
	?>
</select>