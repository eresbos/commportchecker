<?php

function comm_list() {

		$commport = shell_exec('mode');

		if(substr_count($commport,'COM')<1) {
			$commport_list[0] = 'None';
		} else {

			$conn = explode(' ',$commport);
			$count = count($conn);
			for($i=0;$i<$count;$i++) {
				if(substr_count($conn[$i],'COM')<1) {
					$commport_list[$i] = '';
				} else {
					$commport_list[$i] = str_replace(':','',substr($conn[$i],0,5)).'-';
				}
			}

		}

		$commport = implode('',$commport_list);
		$commport = trim($commport);
		$commport = trim(str_replace('-',' ',$commport));
		$commport_list = explode(' ',$commport);

		return $commport_list;
	}

	function baud_list() {

		$baud_list = array(
			'2400',
			'4800',
			'9600',
			'19200',
			'38400',
			'57600',
			'115200',
			'230400',
		);

		return $baud_list;
	}

if(isset($_POST['comm'])) {

	if($_POST['comm']=='None') {
		echo 'Your comm-port not active.Check your connection<br />
		(My computer right click - Properties - Hardware - Device Manager - Ports (COM & LPT))<br />
		If your comm-port is active make sure that it is not being used';
	} else {
		echo 'Port = '.$_POST['comm'].'<br /> Baud Rate = '.$_POST['baud']."<br/>Port Open.";

	}


} else {

	$commport_list = comm_list();
	$baud_list = baud_list();

	$count = count($commport_list);
	$count2 = count($baud_list);

	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
	Port <select name="comm">';
	for($i=0;$i<$count;$i++) {
		echo '<option value="'.$commport_list[$i].'">'.$commport_list[$i].'</option>';	
	}
	echo '</select> Baud Rate <select name="baud">';
	for($i=0;$i<$count2;$i++) {
		echo '<option value="'.$baud_list[$i].'">'.$baud_list[$i].'</option>';	
	}
	echo '</select> <input type="submit" value="Select" />
	</form>
	<hr />';

}

?>