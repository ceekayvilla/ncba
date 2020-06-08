<input type="text" name="name" id="name" placeholder='Name' class="customclass"> 
<input type="text" name="mail" id="email" placeholder='Email Address' >
<input type="text" name="phone" id="phone" placeholder='Phone Number'> 
<textarea id="message" class="input_area" name="message" placeholder='Message' columns="10"></textarea>
<?php //print drupal_render($form['captcha']); ?>
<input type="submit" id="submitter" value="Submit" />
<?php 
	print drupal_render($form['form_token']);
	print drupal_render($form['form_build_id']);
//print drupal_render($form['form_id']);print drupal_render($form['actions']); 
	 ?>
