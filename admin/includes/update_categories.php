<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Category</label>
        <?php
        if (isset($_GET['update'])) {
            $cat_id = $_GET['update'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $query_result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>

                <input value="<?php echo $cat_title; ?>" type="text" name="cat_title" class="form-control">

        <?php
            }
        }
        ?>

        <!-- Update Category -->
        <?php
        if (isset($_POST['update'])) {
            $cat_id = $_GET['update'];
            $cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '$cat_title'  WHERE cat_id = $cat_id";
            $query_result = mysqli_query($connection, $query);
            header("Location: categories.php");
        }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" name="update" value="Update Category" class="btn btn-primary">
    </div>
</form>