<form method='post' action='<?php echo $form_action; ?>' enctype='multipart/form-data'>
	<input type='file' name='input' />
	<input type='hidden' value='1' name='test' />
	<input type='submit' />
</form>

<?php echo $output; ?>