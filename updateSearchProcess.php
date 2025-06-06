<?php

include "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["mo"];


$query = "SELECT * FROM `product`";
$status = 0;


if (!empty($search_txt)) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
}
if ($category != 0 && $status == 0) {
    $query .= " WHERE `category_id`='" . $category . "'";
    $status = 1;
} else if ($category != 0 && $status != 0) {
    $query .= " AND `category_id`='" . $category . "'";
}

$pid = 0;
if ($brand != 0 && $model == 0) {
    $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
                                            `brand_brand_id`='" . $brand . "'");
    $modelHasBrand_num = $modelHasBrand_rs->num_rows;

    for ($x = 0; $x < $modelHasBrand_num; $x++) {
        $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
        $pid = $modelHasBrand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand == 0 && $model != 0) {

    $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
                                            `model_model_id`='" . $model . "'");
    $modelHasBrand_num = $modelHasBrand_rs->num_rows;

    for ($x = 0; $x < $modelHasBrand_num; $x++) {
        $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
        $pid = $modelHasBrand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand != 0 && $model != 0) {

    $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
                    `model_model_id`='" . $model . "' AND `brand_brand_id`='" . $brand . "'");
    $modelHasBrand_num = $modelHasBrand_rs->num_rows;

    for ($x = 0; $x < $modelHasBrand_num; $x++) {
        $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
        $pid = $modelHasBrand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row justify-content-center gap-5">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 3;
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

                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-4 zoom" style="height: 180px " />

                    <div class="card-body ms-0 m-0 text-center">
                        <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                        <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                        <?php
                        if ($selected_data["qty"] > 0) {
                        ?>
                            <span class="card-text text-warning fw-bold">In Stock</span><br />
                        <?php
                        } else {
                        ?>
                            <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                        <?php
                        }
                        ?>
                        <span class="caed-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span></br>
                        <div class="row mt-2">

                            <div class="col-12 d-grid">
                                <button class="btn btn-success" onclick="sendid(<?php echo $selected_data['id']; ?>);">Update</button>
                            </div>

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
                                            ?> onclick="updateSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="updateSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="updateSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="updateSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>