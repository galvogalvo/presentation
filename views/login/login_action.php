<h1>Please Login</h1>

<?php echo $error; ?>

<form method='post' action='<?php echo $form_action; ?>'>
	<dl>
		<dt>*PIN: </dt>
		<dd><input type='text' name='pin' required/></dd>

		<dt>*Name: </dt>
		<dd><input type='text' name='name' required/></dd>
	</dl>

	<input type='submit' />
</form>