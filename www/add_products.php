<?php

	session_start();

	$page_title = "Admin || Add Product";
	
	include 'includes/db.php';
	include 'functions3.php';
	include 'includes/dashboard_header.php';

	checkLogin();

	$errors = [];

	$stmt = $conn->prepare("SELECT * FROM category");

	$stmt->execute();

		if(array_key_exists('add', $_POST)) {
			if(empty($_POST['title'])) {
				$errors['title'] = "Please enter a book title";
			}
			if(empty($_POST['author'])) {
				$errors['author'] = "Please enter the book author";
			}
			$clean = array_map('trim', $_POST);
			if(empty($_POST['price'])) {
				$errors['price'] = "Please enter the book price";
			} else {

				$price = numeric($clean['price']);
				if($price) {
					echo "Please enter price in digits";
				}
			}
			if(empty($_POST['pub_date'])) {
				$errors['pub_date'] = "Select the date of publication";
			}
			if(empty($_POST['quantity'])) {
				$errors['quantity'] = "Please enter the quantity available";
			} else {

				$quantity = numeric($clean['quantity']);
				if($quantity) {
					echo "Please enter quantity in digits";
				}
			}
			if(empty($_POST['cat_name'])) {
				$errors['cat_name'] = "Select a category";
			}
			if(empty($errors)) {

				$row = $stmt->fetch(PDO::FETCH_BOTH);

				$cat_id = $row[0];

				//$clean = array_map('trim', $_POST);

				
				addProducts($conn, $clean, $cat_id);

				redirect("view_products.php");
			}

		}


?>

<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="add_products.php" method ="POST">
				<div>
					<?php
						$info = displayErrors($errors, 'title');
						echo $info;
					?>
					<label>Title:</label>
					<input type="text" name="title" placeholder="Book Title">
				</div>
				<div>
					<?php
						$info = displayErrors($errors, 'author');
						echo $info;
					?>
					<label>Author:</label>
					<input type="text" name="author" placeholder="Book Author">
				</div>
				<div>
					<?php
						$info = displayErrors($errors, 'price');
						echo $info;
					?>
					<label>Price:</label>
					<input type="text" name="price" placeholder="Book Price">
				</div>
				<div>
					<?php
						$info = displayErrors($errors, 'pub_date');
						echo $info;
					?>
					<label>Publication Date:</label>
					<input type="date" name="pub_date" placeholder="Date of Publication">
				</div>
				<div>
					<?php
						$info = displayErrors($errors, 'quantity');
						echo $info;
					?>
					<label>Quantity:</label>
					<input type="text" name="quantity" placeholder="Quantity">
				</div>
				<div>
					<label>Category:</label>
									 <select name="cat_name">
									 <option value="">Select Category</option>
									 <?php while($row = $stmt->fetch(PDO::FETCH_BOTH)) {?>
									 <option value="<?php echo $row['category_name']; ?>">
									 <?php echo $row['category_name'];?> </option>
									 <?php } ?>
									 </select></p>
				</div>
					<input type="submit" name="add" value="Add">
			</form>
			
		</div>
	</div>
	<?php

		include 'includes/footer.php';


	?>