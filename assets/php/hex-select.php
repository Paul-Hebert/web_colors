<select data-unit="" data-scale="">
	<?php 
		for($i = 0; $i < 255; $i ++){
			$hex = base_convert($i, 10, 16);

			if ($hex === strtolower($character) ){
				$selected = ' selected';
			} else{
				$selected = '';				
			}

			echo'
				<option' . $selected . '>
				' . $hex . '	
				</option>			
			';
		}
	?>
</select>