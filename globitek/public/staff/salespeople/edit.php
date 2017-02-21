<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$errors = array();
$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);
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

	$result = update_salesperson($salesperson);
	if($result === true) {
		redirect_to("show.php?id=" . $salesperson['id']);
	} else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />
  <?php echo display_errors($errors); ?>
  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>
  <form action=<?php echo "edit.php?id=" . $salesperson['id']?> method="POST">
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

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
