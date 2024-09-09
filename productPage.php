<?php

include_once('userdata.php');

$slug = $_GET['id'];

if ($slug) {
    $stmt = $conn->prepare("SELECT * FROM tblmaster WHERE slug = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $dataProduct = $res->fetch_assoc();
    }
    $stmt->close();
}

$title = "Product";

?>

<?php include_once 'includes/body.php'; ?>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="assets/img/productimage/<?php echo $dataProduct['images']; ?>" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <?php
                            // Assuming $dataProduct['images'] contains a list of image filenames, separated by commas.
                            $images = explode(',', $dataProduct['images'] ?? '');
                            foreach ($images as $image) {
                                if (trim($image)) {
                                    echo '<div class="product-image-thumb"><img src="assets/img/productimage/' . htmlspecialchars(trim($image)) . '" alt="Product Image"></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1 class="my-3"><?php echo $dataProduct['name']; ?></h1>
                        <p><?php echo $dataProduct['description']; ?></p>

                        <hr>

                        <div class="price-container">
                            <p class="price">Rs. <?php echo htmlspecialchars($dataProduct["newprice"], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="discount">Rs. <?php echo htmlspecialchars($dataProduct["oldprice"], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>

                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-dark flex-shrink-0">
                                <i class="fas fa-cart-plus fa-lg mr-2 bi-cart-fill me-1"></i>
                                Add to Cart
                            </a>
                        </div>

                        <table class="table table-sm table-bordered my-3">
                            <colgroup>
                                <col width="50%">
                                <col width="50%">
                            </colgroup>
                            <thead>
                                <tr class="bg-dark">
                                    <th class="text-center">Field Name</th>
                                    <th class="text-center">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Performance</th>
                                </tr>
                                <tr>
                                    <th>Processor</th>
                                    <td>
                                        <?= $dataProduct['processor'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Clock Speed</th>
                                    <td>
                                        <?= $dataProduct['clock_speed'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>GPU</th>
                                    <td>
                                        <?= $dataProduct['gpu'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>RAM</th>
                                    <td>
                                        <?= $dataProduct['ram'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>RAM Slot</th>
                                    <td>
                                        <?= $dataProduct['ram_slot'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>SSD/HDD</th>
                                    <td>
                                        <?= $dataProduct['ssd_hdd'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>OS</th>
                                    <td>
                                        <?= $dataProduct['os'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Display</th>
                                </tr>
                                <tr>
                                    <th>Display Size</th>
                                    <td>
                                        <?= $dataProduct['display_size'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Display Type</th>
                                    <td>
                                        <?= $dataProduct['display_type'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Touch Screen</th>
                                    <td>
                                        <?= $dataProduct['display_touch'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Power and Battery</th>
                                </tr>
                                <tr>
                                    <th>Power Adapter</th>
                                    <td>
                                        <?= $dataProduct['power_adapter'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Battery Capacity</th>
                                    <td>
                                        <?= $dataProduct['battery_capacity'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Battery Hour</th>
                                    <td>
                                        <?= $dataProduct['battery_hour'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Body</th>
                                </tr>
                                <tr>
                                    <th>Dimension</th>
                                    <td>
                                        <?= $dataProduct['dimension'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>
                                        <?= $dataProduct['weight'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Colors</th>
                                    <td>
                                        <?= $dataProduct['colors'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>IO and Ports</th>
                                </tr>
                                <tr>
                                    <th>IO Ports</th>
                                    <td>
                                        <?= $dataProduct['io_ports'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fingerprint Sensor</th>
                                    <td>
                                        <?= $dataProduct['fingerprint_sensor'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Camera</th>
                                    <td>
                                        <?= $dataProduct['camera'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keyboard</th>
                                    <td>
                                        <?= $dataProduct['keyboard'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Touchpad</th>
                                    <td>
                                        <?= $dataProduct['touchpad'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Connectivity</th>
                                </tr>
                                <tr>
                                    <th>WIFI</th>
                                    <td>
                                        <?= $dataProduct['wifi'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bluetooth</th>
                                    <td>
                                        <?= $dataProduct['bluetooth'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class='text-center bg-secondary'>Audio</th>
                                </tr>
                                <tr>
                                    <th>Speaker</th>
                                    <td>
                                        <?= $dataProduct['speaker'] ?? "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mic</th>
                                    <td>
                                        <?= $dataProduct['mic'] ?? "" ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>

<?php include_once 'includes/footer.php'; ?>