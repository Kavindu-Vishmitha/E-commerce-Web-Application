<?php
session_start();

include "connection.php";

if (isset($_SESSION["u"])) {

    $watchlist_rs = Database::search("SELECT * FROM `watchlist` 
                                      INNER JOIN `product` ON watchlist.Product_id = product.id 
                                      INNER JOIN `condition` ON product.condition_condition_id = condition.condition_id 
                                      INNER JOIN `users` ON product.users_email = users.email 
                                      WHERE watchlist.users_email = '" . $_SESSION["u"]["email"] . "'");

    $watchlist_num = $watchlist_rs->num_rows;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wishlist | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>

        <?php include "header.php"; ?>

        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-lg-6 text-lg-end mt-lg-2 mt-2 col-6 text-end">
                    <span style="font-family:'Times New Roman';font-size:38px; font-weight:bold">Wishlist</span>
                </div>
                <div class="col-lg-6 col-6 text-start">
                    <img src="resources/heart_icon.svg" style="width:60px;">
                </div>
            </div>

            <div class="col-12 col-lg-12 mb-3 bg-body">
                <div class="row">
                    <div class="offset-lg-3 col-12 col-lg-6 mb-4">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-4 mb-1 input-group" style="justify-content: center;">
                                <input type="text" class="form-control border border-secondary" placeholder="Type keyword to search..." id="ws" />
                                <select class="form-select border border-secondary" style="max-width: 250px;" id="category">
                                    <option value="0">All Categories</option>
                                    <?php
                                    $category_rs = Database::search("SELECT * FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="btn btn-primary" onclick="whishlistSearch(0);"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 offset-3 offset-lg-5 d-grid mb-2">
                        <button class="btn btn-danger" onclick="clearA();">Clear</button>
                    </div>
                </div>
            </div>

            <div class="offset-lg-1 mb-2">
                <a href="index.php">
                    <span class="badge rounded-pill text-bg-success " style="width:60px;">Home</span></a>
                <span class="text-dark" style="font-weight: bold;">/ Whishlist</span>
            </div>

            <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3  border border-secondary">
                <div class="row ">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-lg-3 col-10 offset-1 col-lg-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($watchlist_num == 0) { ?>
                <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 border border-secondary">
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                <div class="mt-lg-5 mb-lg-5 mt-4 mb-4">
                                    <img src="resources/add cart.png" style="width:150px;">
                                </div>
                                <div class="col-10 offset-1 col-lg-12 offset-lg-0 mt-3 mb-5">
                                    <span class="h1 text-black-50 fw-bold">No items added...</span>
                                </div>
                                <a href="index.php" class="btn btn-success fs-3 fw-bold mb-lg-5 col-6 offset-3 offset-lg-2 mb-4 col-lg-8">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php
                for ($x = 0; $x < $watchlist_num; $x++) {
                    $watchlist_data = $watchlist_rs->fetch_assoc();
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $watchlist_data["Product_id"] . "'");
                    $img_data = $img_rs->fetch_assoc();
                ?>
                    <div class="col-12 col-lg-10 bg-body-light rounded border border-1 border-primary p-4 mb-3 offset-lg-1">
                        <div class="row mb-lg-4 mt-lg-4">
                            <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0 text-center mt-lg-1" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $watchlist_data['description']; ?>" title="Product Description">
                                <img src="<?php echo $img_data["img_path"]; ?>" class="img-thumbnail zoom" id="productImg" style="max-width: 100%;" />
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 mt-lg-4">
                                <h5 class="fw-bold"><?php echo $watchlist_data["title"]; ?></h5>
                                <div>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-7 col-lg-4">

                                        <?php
                                        $p_rs = Database::search("SELECT color.clr_name  
FROM product 
INNER JOIN color ON product.`color_clr_id` = color.`clr_id`
WHERE product.id = '" . $watchlist_data["Product_id"] . "'");
                                        $product_num = $p_rs->num_rows;
                                        $product_data = $p_rs->fetch_assoc()

                                        ?>
                                        <span>Color: <?php echo $product_data["clr_name"] ?> </span>|


                                        <span>Condition: <?php echo $watchlist_data["condition_name"]; ?></span>
                                    </div>
                                </div>
                                <p class="mt-2 mb-2 mb-lg-2">Price: <b>Rs. <?php echo $watchlist_data["price"]; ?> .00</b></p>
                                <div class="row align-items-center ">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Quantity: <b><?php echo $watchlist_data["qty"]; ?> Items Available</b></label>
                                    </div>
                                </div>


                                <div class="row mt-lg-3 mt-3">
                                    <div class="col-12 col-md-4 mb-2 mb-md-0 d-grid">
                                        <a href="<?php echo 'singleProductView.php?id=' . $watchlist_data['Product_id']; ?>" class="btn btn-success" style="border-radius: 20px;">Buy Now</a>
                                    </div>
                                    <?php
                                    if ($watchlist_data["qty"] > 0) {
                                    ?>
                                        <div class="col-12 col-md-4 mb-2 mb-md-0 d-grid">
                                            <button class="btn btn-warning fw-bold" style="border-radius: 20px;" onclick="addToCart(<?php echo $watchlist_data['Product_id']; ?>);">Add to Cart</button>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12 col-md-4 mb-2 mb-md-0 d-grid">
                                            <button class="btn btn-warning fw-bold" style="border-radius: 20px;">Add to Cart</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-12 col-md-4 d-grid">
                                        <button class="btn btn-danger" style="border-radius: 20px;" onclick="deleteFromWhishlist(<?php echo $watchlist_data['w_id']; ?>);">Remove</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <?php include "footer.php"; ?>

        <script src="js/script.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        </script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>

<?php
} else {
?>
    <script>
        window.location = "SignIn.php";
    </script>
<?php
}
?>