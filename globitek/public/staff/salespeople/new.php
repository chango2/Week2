<?php
require_once('../../../private/initialize.php');
$errors = array();
$salesperson = array(
	'first_name' => '',
	'last_name' => '',
	'phone' => '',
	'email' => ''
);
if(is_post_request()) {
	if(isset($_POST['firstName'])) {
		$salesperson['first_name'] = h($_POST['firstName']);
	}
	if(isset($_POST['lastName'])) {
		$salesperson['last_name'] = h($_POST['lastName']);
	}
	if(isset($_POST['phone'])) {
		$salesperson['phone'] = h($_POST['phone']);
	}
	if(isset($_POST['email'])) {
		$salesperson['email'] = h($_POST['email']);
	}

	$result = insert_salesperson($salesperson);
	if($result === true) {
	    $new_id = db_insert_id($db);
	    redirect_to('show.php?id=' . $new_id);
	} else {
    	$errors = $result;
 	}
}
?>

<?php $page_title = 'Staff: New Salesperson'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>New Salesperson</h1>
  <?php echo display_errors($errors); ?>
  <form action="new.php" method="POST">
  	First Name:</br>
  	<input type="text" name="firstName" value="<?php echo $salesperson['first_name']; ?>"/> </br>
  	Last Name: </br>
  	<input type="text" name="lastName" value="<?php echo $salesperson['last_name']; ?>" /></br>
  	Phone: </br>
  	<input type="text" name="phone" value="<?php echo $salesperson['phone']; ?>" /></br>
  	Email: </br>
  	<input type="text" name="email" value="<?php echo $salesperson['email']; ?>" /></br>
  	<input type="submit" name="submit" value="submit">

  </form>
  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
