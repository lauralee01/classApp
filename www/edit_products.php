<?php

	session_start();

	$page_title = "Edit Products";

	include ("includes/db.php");
	include ("includes/functions.php");
	include ("includes/dashboard_header.php");

	checkLogin();

	if($_GET['book_id']) {

		$book_id = $_GET['book_id'];
	}

	$item = getBookById($conn, $book_id);

	$category = getCategoryById($conn, $item[5]);

	$errors = [];

	if(array_key_exists('edit', $_POST)) {

		if(empty($_POST['title'])) {
			$errors['title'] = "Please enter a book title";
		}
		if(empty($_POST['author'])) {
			$errors['author'] = "Please enter book author";
		}
		if(empty($_POST['price'])) {
			$errors['price'] = "Please enter a price";
		}
		if(empty($_POST['year'])) {
			$errors['year'] = "Please enter year of publication";
		}
		if(empty($_POST['cat'])) {
			$errors['cat'] = "Please select a category";
		}
		if(empty($errors)) {

			$clean = array_map('trim', $_POST);

			$clean[id] = $book_id;

			updateBook($conn, $clean);

			redirect("view_products.php");
		}
	}

?>

<div class="wrapper">
    <div id="stream">
        <form id="register"  action ="" method ="POST">
			<div>
				<?php  
					$info = displayErrors($errors, 'title');
					echo $info;
				?>
				<label>Edit Title:</label>
				<input type="text" name="title" placeholder="title" value="<?php echo $item[1]; ?>">
            </div>
            <div>
				<?php  
					$info = displayErrors($errors, 'author');
					echo $info;
				?>
				<label>Edit Author:</label>
				<input type="text" name="author" placeholder="author" value="<?php echo $item[2]; ?>">
            </div>
            <div>
				<?php  
					$info = displayErrors($errors, 'price');
					echo $info;
				?>
				<label>Edit Price:</label>
				<input type="text" name="price" placeholder="price" value="<?php echo $item[3]; ?>">
            </div>
            <div>
				<?php  
					$info = displayErrors($errors, 'year');
					echo $info;
				?>
				<label>Edit Publication Date:</label>
				<input type="text" name="year" placeholder="publication date" value="<?php echo $item[4]; ?>">
            </div>
             <div>
				<?php  
					$info = displayErrors($errors, 'cat');
					echo $info;
				?>
				<label>Edit Category:</label>
				<select name= "cat">
					<option value="<?php echo $category[0];?>"><?php echo $category[1] ;?></option>
					<?php
						$data = fetchCategory($conn, $category[1]);
						echo $data;
					?>
				</select>
            </div>
            <input type="submit" name="edit" value="Edit Product"/>
        </form>

        <h4 class="jumpto">To edit product image <a href="edit_image.php?img=<?php echo $book_id; ?>">click here</a>
        </h4>
    </div>
</div>

<?php
    include("includes/footer.php");
?>