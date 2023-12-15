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
                        Hi <?php echo $_SESSION['username'] ?>
                        <br>
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
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $query_result = mysqli_query($connection, $query);
                                    ConfirmQuery($query_result);

                                    $post_count = mysqli_num_rows($query_result);
                                    ?>
                                    <div class='huge'><?php echo $post_count ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $query_result = mysqli_query($connection, $query);
                                    ConfirmQuery($query_result);

                                    $comment_count = mysqli_num_rows($query_result);
                                    ?>
                                    <div class='huge'><?php echo $comment_count ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $query_result = mysqli_query($connection, $query);
                                    ConfirmQuery($query_result);

                                    $user_count = mysqli_num_rows($query_result);
                                    ?>
                                    <div class='huge'><?php echo $user_count ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $query_result = mysqli_query($connection, $query);
                                    ConfirmQuery($query_result);

                                    $category_count = mysqli_num_rows($query_result);
                                    ?>
                                    <div class='huge'><?php echo $category_count ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);
            $post_published_count = mysqli_num_rows($query_result);

            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);
            $post_draft_count = mysqli_num_rows($query_result);

            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);
            $comment_unapproved_count = mysqli_num_rows($query_result);

            $query = "SELECT * FROM users WHERE user_role = 'user'";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);
            $user_normal_count = mysqli_num_rows($query_result);
            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $comment_unapproved_count, $user_count, $user_normal_count, $category_count];

                            for ($i = 0; $i < 8; $i++) {
                                echo "['{$element_text[$i]}', {$element_count[$i]}],";
                            }
                            ?>
                            // ['Posts', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: 'Page Performance',
                                subtitle: 'Posts, Comments, Users, Categories',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>

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