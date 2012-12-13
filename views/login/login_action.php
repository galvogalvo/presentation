<?php echo $error; ?>
<form method='post' action='<?php echo $form_action; ?>'>
	PIN: <input type='text' name='pin' />
	Name: <input type='text' name='name' />
	<input type='hidden' name='id' value='<?php echo $id; ?>' />
	<input type='submit' />
</form>