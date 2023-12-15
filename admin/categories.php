<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin page
                        <small>Subheading</small>
                    </h1>
                    <!-- <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol> -->

                    <div class="col-xs-2">
                        <?php Insert_Category(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                            </div>
                        </form>

                        <!-- Update Category -->
                        <?php
                        if (isset($_GET['update'])) {
                            include "includes/update_categories.php";
                        }
                        ?>
                    </div>

                    <div class="col-xs-10">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Category Title</td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Show All Category -->
                                <?php Show_All_Categories(); ?>

                                <!-- Delete Category -->
                                <?php Delete_Category(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<?php include "includes/admin_footer.php" ?>