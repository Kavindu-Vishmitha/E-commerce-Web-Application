<?php

require "connection.php";

$text = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";


if (!empty($text) && $select == 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%'";
} else if (empty($text) && $select != 0) {

    $query .= " WHERE `category_id`='" . $select . "'";
} else if (!empty($text) && $select != 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%' AND `category_id`='" . $select . "'";
} else {
}

?>
<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row justify-content-center gap-5 mt-4">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 4;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                            OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                    `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>

                <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                    <span class="badge rounded-pill text-bg-warning align-self-end" style="width:40px;">New</span>

                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-4 zoom" style="height: 180px" onclick="sendsingelProductid(<?php echo $selected_data['id']; ?>);" />

                    <div class="card-body ms-0 m-0 text-center">
                        <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                        <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                        <?php
                        if ($selected_data["qty"] > 0) {
                        ?>
                            <span class="card-text text-warning fw-bold">In Stock</span></br>
                            <span class="caed-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span></br>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <div class="row ">

                                <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]);  ?>" class=" col-4 btn btn-outline-warning mt-2 border border-dark"> <i class="bi bi-bag-fill text-dark fs-5"></i></a>


                                <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToCart(<?php echo $selected_data['id']; ?>);">
                                    <i class="bi bi-cart-fill text-dark fs-5"></i>
                                </button>
                            <?php
                        } else {
                            ?>
                                <span class="card-text text-danger fw-bold">Out of Stock</span></br>
                                <span class="caed-text text-success fw-bold">0 Items Available</span></br>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <div class="row ">

                                    <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]);  ?>" class=" col-4 btn btn-outline-warning mt-2 border border-dark"> <i class="bi bi-bag-fill text-dark fs-5"></i></a>


                                    <button class="col-4 btn btn-outline-warning mt-2 border border-dark">
                                        <i class="bi bi-cart-fill text-dark fs-5"></i>
                                    </button>
                                <?php
                            }
                                ?>

                                <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);">
                                    <i class="bi bi-heart-fill text-dark fs-5" id="heart<?php echo $selected_data["id"]; ?>"></i>
                                </button>

                                </div>
                            </div>
                    </div>


                <?php
            }

                ?>

                </div>
        </div>



        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php

                    for ($y = 1; $y <= $number_of_pages; $y++) {
                        if ($y == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php

                                                                                                } ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <script src="js/script.js"></script>
    </div>