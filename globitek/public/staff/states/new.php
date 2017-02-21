<?php
require_once('../../../private/initialize.php');
$errors = array();
$state = array(
	'name' => '',
	'code' => '',
	'country_id' => 0
	);

if(is_post_request()) {
	if(isset($_POST['name'])) {
		$state['name'] = h($_POST['name']);
	}
	if(isset($_POST['code'])) {
		$state['code'] = h($_POST['code']);
	}
	if(isset($_POST['country_id'])) {
		$state['country_id'] = h($_POST['country_id']);
	}

	$result = insert_state($state);
	if($result === true) {
	    $new_id = db_insert_id($db);
	    redirect_to('show.php?id=' . $new_id);
	} else {
    	$errors = $result;
 	}
}

?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>New State</h1>
  <?php echo display_errors($errors); ?>
  <form action="new.php" method="POST">
  	Name:</br>
  	<input type="text" name="name" value="<?php echo $state['name']; ?>"/> </br>
  	Code: </br>
  	<input type="text" name="code" value="<?php echo $state['code']; ?>" /></br>
  	Country-ID </br>
  	<select name="country_id">
  		<option value=1>United States</option>
  		<option value=2>Canada</option>
  	</select>
  	<input type="submit" name="submit" value="submit">

  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
