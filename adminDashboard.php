<?php

session_start();

if (isset($_SESSION["a"])) {

    include "connection.php";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    </head>

    <?php
    include "adminHeader.php"
    ?>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php

                $email = $_SESSION["a"]["email"];

                $details_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");


                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $email . "'");

                $user_details = $details_rs->fetch_assoc();
                $image_details = $image_rs->fetch_assoc();

                ?>

                <div class="col-xl-3 mt-4">

                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header fw-bold " style="font-size:15px;">Profile Picture</div>
                        <div class="card-body text-center">

                            <?php

                            if (empty($image_details["path"])) {
                            ?>

                                <img class="img-account-profile rounded-circle mb-4" style="width:150px; height:150px;" src="resources/profile.svg" id="img">

                            <?php
                            } else {
                            ?>
                                <img class="img-account-profile rounded-circle mb-4" style="width:150px; height:150px;" src="<?php echo $image_details["path"] ?>" id="img">

                            <?php

                            }
                            ?>

                            <div class="  text mb-2 fw-bold" style="font-size:18px;"><?php echo $user_details["fname"] . " " . $user_details["lname"] ?></div>

                            <div class="  text-muted mb-4 "><?php echo $email; ?></div>
                            <input type="file" class="d-none" id="profileimage" />
                            <label for="profileimage" class="btn btn-success" type="button" onclick="changeAdminImg();">Upload Profile image</label>
                            <div class="d-grid col-lg-4 offset-lg-4 mt-2 col-4 offset-4">
                                <button class="btn btn-outline-warning" onclick="imageSaveAdmin();">Save Image</button>
                            </div>
                        </div>
                    </div>


                    <div class="row col-lg-10 offset-lg-1 col-8 offset-2 text-center mt-lg-4">
                        <div class=" d-none" id="msgD1">
                            <div class="alert alert-danger" role="alert" id="msgB1" onclick="reload();">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mt-lg-2">
                        <div class="col-6 d-grid">
                            <button class="btn btn-danger" onclick="adminLogout();">Log Out</button>
                        </div>
                        <div class="col-6 d-grid">
                            <button class="btn btn-primary" onclick="customerAdminLogin();">Customer Login</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 mt-4">

                    <div class="card mb-4">
                        <div class="card-header fw-bold" style="font-size:15px;">Admin Dashboard</div>
                        <div class="card-body">

                            <div class="row">

                                <div class=" offset-lg-1 rounded mb-3 border border-2 border-warning bg-light col-lg-3 p-5 me-5">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Today Sellings</span>
                                    </div>

                                    <?php
                                    date_default_timezone_set('Asia/Colombo');
                                    $today = date('Y-m-d');
                                    $purchase_count_rs = Database::search("SELECT COUNT(*) as count FROM `invoice` WHERE DATE(date) = '$today'");
                                    $purchase_count_data = $purchase_count_rs->fetch_assoc();
                                    $purchase_count = $purchase_count_data['count'];

                                    ?>

                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold"><?php echo $purchase_count; ?> Items</span>
                                    </div>
                                </div>

                                <div class=" rounded mb-3 border border-2 border-warning bg-light col-lg-3 p-5 me-5">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Daily Earnings</span>
                                    </div>
                                    <?php
                                    $today = date("Y-m-d");

                                    $total_rs = Database::search("SELECT SUM(total) AS total_amount FROM `invoice` WHERE DATE(`date`) = '$today'");

                                    if ($total_rs->num_rows > 0) {
                                        $total_data = $total_rs->fetch_assoc();
                                        $total_amount = $total_data["total_amount"];
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold">Rs. <?php echo number_format($total_amount); ?> .00</span>
                                    </div>
                                </div>
                                <div class="rounded mb-3 border border-2 border-warning bg-light col-lg-3 p-5 ">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Total Earnings</span>
                                    </div>
                                    <?php
                                    $total_rs = Database::search("SELECT SUM(total) AS total_amount FROM `invoice`");
                                    if ($total_rs->num_rows > 0) {
                                        $total_data = $total_rs->fetch_assoc();
                                        $total_amount = number_format($total_data["total_amount"]);
                                    } else {
                                        $total_amount = "0";
                                    }
                                    ?>
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold">Rs. <?php echo $total_amount; ?> .00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class=" offset-lg-1 rounded mb-3 border border-2 border-warning bg-light col-lg-3 p-5 me-5 ">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Total Engagements</span>
                                    </div>
                                    <?php
                                    $user_count_rs = Database::search("SELECT COUNT(*) as user_count FROM `users` WHERE `user_type_id` = 2");
                                    $user_count_data = $user_count_rs->fetch_assoc();
                                    $user_count = $user_count_data['user_count'];
                                    ?>
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold"><?php echo $user_count; ?> Members</span>
                                    </div>
                                    <div class="col-lg-6 d-grid offset-lg-3 mt-lg-3 col-4 offset-4 mt-3">
                                        <button class="btn  btn-dark" onclick="userReport();">See More</button>
                                    </div>
                                </div>
                                <div class=" rounded mb-3 border border-2 border-warning bg-light col-lg-3 p-5 me-5 ">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Purchased history</span>
                                    </div>
                                    <?php
                                    $order_count_rs = Database::search("SELECT COUNT(DISTINCT `order_id`) AS order_count FROM `invoice`");

                                    if ($order_count_rs->num_rows > 0) {
                                        $order_count_data = $order_count_rs->fetch_assoc();
                                        $order_count = $order_count_data["order_count"];
                                    } else {
                                        $order_count = 0;
                                    }
                                    ?>
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold"><?php echo $order_count; ?> Items</span>
                                    </div>
                                    <div class="col-lg-6 d-grid offset-lg-3 mt-lg-3 col-4 offset-4 mt-3">
                                        <button class="btn  btn-dark" onclick="userReport1();">See More</button>
                                    </div>
                                </div>
                                <div class="rounded mb-3 border border-warning bg-light col-lg-3 p-5 ">
                                    <div class="text-center">
                                        <span style="font-size: 20px; color:black; font-weight:bold">Wishlist Engage</span>
                                    </div>
                                    <?php
                                    $watchlist_count_rs = Database::search("SELECT COUNT(*) as total FROM `watchlist`");
                                    $watchlist_count_data = $watchlist_count_rs->fetch_assoc();
                                    $watchlist_count = $watchlist_count_data["total"];
                                    ?>

                                    <div class="text-center">
                                        <span style="font-size: 20px; color:blue; font-weight:bold"><?php echo $watchlist_count; ?> Items</span>
                                    </div>
                                    <div class="col-lg-6 d-grid offset-lg-3 mt-lg-3 col-4 offset-4 mt-3">
                                        <button class="btn  btn-dark" onclick="userReport2();">See More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <?php
                                $famous_customer_query = "SELECT users_email, COUNT(users_email) as frequency 
                          FROM invoice 
                          GROUP BY users_email 
                          ORDER BY frequency DESC 
                          LIMIT 1";
                                $famous_customer_rs = Database::search($famous_customer_query);

                                if ($famous_customer_rs->num_rows > 0) {
                                    $famous_customer_data = $famous_customer_rs->fetch_assoc();
                                    $famous_customer_email = $famous_customer_data['users_email'];


                                    $profile_img_query = "SELECT path FROM profile_img WHERE users_email='$famous_customer_email'";
                                    $profile_img_rs = Database::search($profile_img_query);

                                    if ($profile_img_rs->num_rows > 0) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                        $img_path = $profile_img_data['path'];
                                    } else {

                                        $img_path = "resources/user.png";
                                    }
                                } else {

                                    $img_path = "resources/user.png";
                                }
                                ?>

                                <div class="col-lg-4 col-6 offset-lg-2 offset-2 mb-2">
                                    <div class="card p-2" style="width: 18rem;">
                                        <div class="rounded mb-3 border border-3 border-light">
                                            <img src="<?php echo $img_path; ?>" class="card-img-top img-thumbnail">
                                        </div>
                                        <?php
                                        $query = "SELECT users_email, COUNT(users_email) AS frequency
          FROM invoice
          GROUP BY users_email
          ORDER BY frequency DESC
          LIMIT 1";

                                        $result = Database::search($query);
                                        $most_frequent_user = $result->fetch_assoc();

                                        $path = "resources/user.png";
                                        $fname = "";
                                        $lname = "";

                                        if ($most_frequent_user) {
                                            $email = $most_frequent_user['users_email'];


                                            $user_query = "SELECT u.fname, u.lname, p.path
                   FROM users u
                   JOIN profile_img p ON u.email = p.users_email
                   WHERE u.email = '$email'";
                                            $user_result = Database::search($user_query);
                                            $user_data = $user_result->fetch_assoc();

                                            if ($user_data) {
                                                $path = $user_data['path'];
                                                $fname = $user_data['fname'];
                                                $lname = $user_data['lname'];
                                            }
                                        }

                                        ?>
                                        <div class="card-body text-center mb-1">
                                            <?php if ($fname && $lname) : ?>
                                                <p class="card-text fw-bold fs-6 text-success" style="font-size:18px;font-weight:bold"><?php echo $fname . ' ' . $lname; ?></p>
                                            <?php endif; ?>
                                            <p class="card-text" style="font-size:18px;font-weight:bold">Famous Customer</p>

                                        </div>
                                    </div>
                                </div>

                                <?php

                                $most_purchased_query = "SELECT product_id, SUM(qty) AS total_qty FROM invoice GROUP BY product_id ORDER BY total_qty DESC LIMIT 1";
                                $most_purchased_rs = Database::search($most_purchased_query);

                                if ($most_purchased_rs->num_rows > 0) {
                                    $most_purchased_data = $most_purchased_rs->fetch_assoc();
                                    $product_id = $most_purchased_data['product_id'];


                                    $product_img_query = "SELECT img_path FROM product_img WHERE Product_id = '$product_id' LIMIT 1";
                                    $product_img_rs = Database::search($product_img_query);

                                    if ($product_img_rs->num_rows > 0) {
                                        $product_img_data = $product_img_rs->fetch_assoc();
                                        $img_path = $product_img_data['img_path'];
                                    } else {
                                        $img_path = "resources/sold.svg";
                                    }
                                } else {
                                    $img_path = "resources/sold.svg";
                                }
                                ?>

                                <div class="col-lg-4 col-6 offset-2  offset-lg-1 mb-2">
                                    <div class="card  p-2" style="width: 18rem;">
                                        <div class="rounded mb-3 border border-3  border-light">
                                            <img src="<?php echo $img_path; ?>" class="card-img-top img-thumbnail">
                                        </div>


                                        <?php

                                        $most_purchased_query = "SELECT product.title 
                         FROM invoice 
                         INNER JOIN product ON invoice.Product_id = product.id 
                         GROUP BY invoice.Product_id 
                         ORDER BY SUM(invoice.qty) DESC 
                         LIMIT 1";

                                        $most_purchased_rs = Database::search($most_purchased_query);

                                        if ($most_purchased_rs->num_rows > 0) {
                                            $most_purchased_data = $most_purchased_rs->fetch_assoc();
                                            $most_purchased_title = $most_purchased_data["title"];
                                        }

                                        ?>

                                        <div class="card-body text-center mb-1">
                                            <?php

                                            if (!empty($most_purchased_title)) {


                                            ?>
                                                <p class="card-text fw-bold fs-6 text-success "><?php echo $most_purchased_title; ?></p>
                                            <?php
                                            } ?>
                                            <p class="card-text" style="font-size:18px;font-weight:bold">Mostly Sold Item</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <?php include "adminFooter.php"
        ?>

        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {
?>
    <script>
        window.location.href = "adminSignIn.php";
    </script>
<?php
}

?>