<?php
	function fun_alert($message, $location)
	{
		echo "<script type='text/javascript'>alert('$message'); window.location.href='$location'</script>";
	}
?>