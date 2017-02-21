<?php
require_once('../../../private/initialize.php');
if(!isset($_GET['state_id'])) {
	redirect_to('../index.php');
}
$errors = array();
$territory = array(
	'name' => '',
	'position' => '',
	'state_id' => $_GET['state_id']
	);


if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $territory['name'] = $_POST['name']; }
  if(isset($_POST['position'])) { $territory['position'] = $_POST['position']; }


  $result = insert_territory($territory);
  if($result === true) {
    $new_id = db_insert_id($db);
    redirect_to('show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }
}
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/index.php">Back to State Details</a><br />

  <h1>New Territory</h1>
  <?php echo display_errors($errors); ?>

  <form action="<?php echo 'new.php?state_id=' . $_GET['state_id']?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
    Position:<br />
    <input type="text" name="position" value="<?php echo $territory['position']; ?>" /><br />
    <input type="submit" name="submit" value="Create"  />
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
