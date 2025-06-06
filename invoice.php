<?php
include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];
    $oid = $_GET["id"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice | X-flax</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="resources/logo.svg">

    </head>
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

        .invoice-details span {
            display: block;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tfoot tr th,
        .table tfoot tr td {
            background-color: #f8f9fa;
        }

        .table tfoot tr td {
            font-weight: bold;
        }

        .alert-info {
            background-color: #e9f7fe;
        }
    </style>

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
                                $address_rs = Database::search("SELECT * FROM users_has_address WHERE users_email='" . $umail . "'");
                                if ($address_rs->num_rows > 0) {
                                    $address_data = $address_rs->fetch_assoc();
                                ?>
                                    <p>
                                        <strong><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></strong><br>
                                        <?php echo $address_data["line1"] . " " . $address_data["line2"]; ?><br>
                                        <?php echo $umail; ?>
                                    </p>
                                <?php } ?>
                            </div>
                            <div class="col-6 text-end">
                                <?php
                                $invoice_rs = Database::search("SELECT * FROM invoice WHERE order_id='" . $oid . "'");
                                if ($invoice_rs->num_rows > 0) {
                                    $invoice_data = $invoice_rs->fetch_assoc();
                                ?>
                                    <h5 class="fw-bold">Invoice #<?php echo $invoice_data["invoice_id"]; ?></h5>
                                    <p>Date & Time of Invoice:<br><?php echo $invoice_data["date"]; ?></p>
                                <?php } ?>
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
                                $product_rs = Database::search("SELECT * FROM product WHERE id='" . $invoice_data["Product_id"] . "'");
                                if ($product_rs->num_rows > 0) {
                                    $product_data = $product_rs->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $invoice_data["invoice_id"]; ?></td>
                                        <td>
                                            <strong><?php echo $oid; ?></strong><br>
                                            <span class="text-primary"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="text-end">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="text-end"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="text-end">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <?php
                                $city_rs = Database::search("SELECT * FROM city WHERE city_id='" . $address_data["city_city_id"] . "'");
                                if ($city_rs->num_rows > 0) {
                                    $city_data = $city_rs->fetch_assoc();
                                    $delivery = ($city_data["district_district_id"] == 2) ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
                                    $subtotal = $invoice_data["total"] - $delivery;
                                ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-end">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $subtotal; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-end">Delivery Fee</td>
                                        <td class="text-end">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-end text-primary">GRAND TOTAL</td>
                                        <td class="text-end text-primary">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                    </tr>
                                <?php } ?>
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
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-grid offset-lg-5 mb-lg-5 col-4 offset-4 mb-5">

            <button class="btn btn-success" onclick="printInvoice();">Download</button>
        </div>

        <?php include "footer.php"    ?>
    </body>

    </html>

<?php
}
?>