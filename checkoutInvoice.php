<?php
session_start();
include "connection.php";

if (!isset($_SESSION["u"])) {
    echo "unauthorized";
    exit();
}

if (!isset($_GET["id"])) {
    echo "invoice_not_specified";
    exit();
}

$oid = $_GET["id"];
$umail = $_SESSION["u"]["email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | X-flax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg">
    <style>
        .invoice-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .invoice-footer {
            text-align: center;
            border-top: 2px solid #007bff;
            padding-top: 20px;
            margin-top: 20px;
        }

        .invoice-header img {
            max-width: 120px;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tfoot tr td {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .alert-info {
            background-color: #e9f7fe;
        }
    </style>
</head>

<body style="background-color: #f7f7ff;">

    <?php include "header.php"; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="invoice-container" id="page">
                    <div class="row invoice-header">
                        <div class="col-12 text-center mb-4">
                            <img src="resources/logo.svg" alt="X-flax Logo">
                            <h2 class="fw-bold text-primary">INVOICE</h2>
                            <h2 class="fw-bold text-dark" style="font-family: 'Times New Roman';">X-flax</h2>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-bold">INVOICE TO:</h5>
                            <?php
                            $address_rs = Database::search("SELECT * FROM users_has_address WHERE users_email='$umail'");
                            $address_data = ($address_rs->num_rows > 0) ? $address_rs->fetch_assoc() : null;
                            if ($address_data) {
                                echo "<p>
                                    <strong>{$_SESSION["u"]["fname"]} {$_SESSION["u"]["lname"]}</strong><br>
                                    {$address_data["line1"]}, {$address_data["line2"]}<br>
                                    $umail
                                </p>";
                            }
                            ?>
                        </div>
                        <div class="col-6 text-end">
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM invoice WHERE order_id='$oid'");
                            if ($invoice_rs->num_rows > 0) {
                                $first_invoice = $invoice_rs->fetch_assoc();
                                echo "<h5 class='fw-bold'>Invoice #{$first_invoice["invoice_id"]}</h5>
                                    <p>Date & Time of Invoice:<br>{$first_invoice["date"]}</p>";
                            } else {
                                echo "<h5 class='text-danger'>Invoice Not Found</h5>";
                                exit();
                            }
                            ?>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID & Product</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM invoice WHERE order_id='$oid'");
                            $subtotal = 0;
                            $delivery = 0;
                            $index = 1;

                            $city_rs = ($address_data) ? Database::search("SELECT * FROM city WHERE city_id='" . $address_data["city_city_id"] . "'") : null;
                            $city_data = ($city_rs && $city_rs->num_rows > 0) ? $city_rs->fetch_assoc() : null;

                            while ($invoice = $invoice_rs->fetch_assoc()) {
                                $product_rs = Database::search("SELECT * FROM product WHERE id='" . $invoice["Product_id"] . "'");
                                $product_data = ($product_rs->num_rows > 0) ? $product_rs->fetch_assoc() : null;
                                if (!$product_data) continue;

                                $unit_price = $product_data["price"];
                                $qty = $invoice["qty"];
                                $line_total = $unit_price * $qty;

                                $ship_fee = ($city_data && $city_data["district_district_id"] == 2)
                                    ? $product_data["delivery_fee_colombo"]
                                    : $product_data["delivery_fee_other"];

                                $subtotal += $line_total;
                                $delivery += $ship_fee;

                                echo "<tr>
                                        <td>{$index}</td>
                                        <td><strong>{$invoice["order_id"]}</strong><br><span class='text-primary'>{$product_data["title"]}</span></td>
                                        <td class='text-end'>Rs. {$unit_price}.00</td>
                                        <td class='text-end'>{$qty}</td>
                                        <td class='text-end'>Rs. {$line_total}.00</td>
                                    </tr>";
                                $index++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-end">SUBTOTAL</td>
                                <td class="text-end">Rs. <?= $subtotal ?>.00</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-end">Delivery Fee</td>
                                <td class="text-end">Rs. <?= $delivery ?>.00</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-end text-primary">GRAND TOTAL</td>
                                <td class="text-end text-primary">Rs. <?= $subtotal + $delivery ?>.00</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="invoice-footer">
                        <p class="fs-4 fw-bold text-success">Thank You!</p>
                        <div class="alert alert-info mt-4">
                            <h6 class="fw-bold">NOTICE:</h6>
                            <p>Purchased items can be returned within 7 days of delivery.</p>
                        </div>
                        <p class="text-muted">Invoice was created on a computer and is valid without the signature and seal.</p>
                    </div>

                </div>
                <div class="d-grid col-4 offset-4 mt-4">
                    <button class="btn btn-success" onclick="printInvoice();">Download</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printInvoice() {
            var printContents = document.getElementById('page').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <?php include "footer.php"; ?>
</body>

</html>
