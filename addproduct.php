<?php

include_once('userdata.php');

// Initialize an array to store slugs
$existingSlug = [];

// Fetch the slug from tblmaster for compare the slug
$querySlug = "SELECT slug FROM tblmaster";
$stmt = $conn->prepare($querySlug);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$resSlugName = $stmt->get_result();
while ($row = $resSlugName->fetch_assoc()) {
    $existingSlug[] = $row['slug'];
}
$stmt->close();

// Get the update id from update button products.php
$upid = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

// Fetch the data of update id
if ($upid) {
    $stmt = $conn->prepare("SELECT * FROM tblmaster WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $upid);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
    }

    $fetchStatus1 = $data['status'];
    $fetchStatus = explode(', ', $fetchStatus1);

    $stmt->close();
}

// Initialize an array to store errors
$errors = [];

// For title and buttons
if (!$upid) {
    $NAME = "Add";
} else {
    $NAME = "Edit";
}

// To insert the record
if (isset($_POST['Add'])) {
    $pname = $_POST['pname'];
    $pdescription = $_POST['pdescription'];
    $pslug = $_POST['pslug'];
    $pcategory = $_POST['pcategory'];
    $psize = $_POST['psize'];
    $pcolor = $_POST['pcolor'];
    $pweight = $_POST['pweight'];
    $poldprice = $_POST['poldprice'];
    $pnewprice = $_POST['pnewprice'];
    $pstatus = $_POST['pstatus'];
    $pprocessor = $_POST['pprocessor'];
    $pclockspeed = $_POST['pclockspeed'];
    $pgpu = $_POST['pgpu'];
    $pram = $_POST['pram'];
    $pramslot = $_POST['pramslot'];
    $pssdhdd = $_POST['pssdhdd'];
    $pos = $_POST['pos'];
    $pdisplaysize = $_POST['pdisplaysize'];
    $pdisplaytype = $_POST['pdisplaytype'];
    $pdisplaytouch = $_POST['pdisplaytouch'];
    $ppoweradapter = $_POST['ppoweradapter'];
    $pbatterycapacity = $_POST['pbatterycapacity'];
    $pbatteryhour = $_POST['pbatteryhour'];
    $pdimension = $_POST['pdimension'];
    $pcolors = $_POST['pcolors'];
    $pioports = $_POST['pioports'];
    $pfingerprintsensor = $_POST['pfingerprintsensor'];
    $pcamera = $_POST['pcamera'];
    $pkeyboard = $_POST['pkeyboard'];
    $ptouchpad = $_POST['ptouchpad'];
    $pwifi = $_POST['pwifi'];
    $pbluetooth = $_POST['pbluetooth'];
    $pspeaker = $_POST['pspeaker'];
    $pmic = $_POST['pmic'];



    // image array for multiple image
    $images = [];
    $image_count = count($_FILES['image']['name']);

    if (empty($pstatus)) {
        $pstatus[] = "Out of Stock";
        $errors['pstatus'] = "";
    }
    $strStatus = implode(', ', $pstatus);

    // Validate inputs
    if (empty($pname)) {
        $errors['pname'] = "Enter product name";
    }

    if (empty($pdescription)) {
        $errors['pdescription'] = "Enter product description";
    }

    if (empty($pslug)) {
        $errors['pslug'] = "Enter slug";
    }

    if (in_array($pslug, $existingSlug)) {
        $errors['slug'] = "Slug already exists";
    }

    if (empty($pcategory)) {
        $errors['pcategory'] = "Select category";
    }

    if (empty($psize)) {
        $errors['psize'] = "Select size";
    }

    if (empty($pcolor)) {
        $errors['pcolor'] = "Please select color";
    }

    if (empty($pweight)) {
        $errors['pweight'] = "Enter wight";
    }

    if (empty($poldprice)) {
        $errors['poldprice'] = "Enter old price";
    }

    if (empty($pnewprice)) {
        $errors['pnewprice'] = "Enter new price";
    }

    // for loop is used for take multiple image and insert into database
    for ($i = 0; $i < $image_count; $i++) {
        $new_image = $_FILES['image']['name'][$i];
        $temp_name = $_FILES['image']['tmp_name'][$i];
        $folder = "assets/img/productimage/" . basename($new_image);
        $folder2 = "G:/Applications/PHP/xampp/htdocs/Projects/php-college-project-user/assets/img/productimage/" . basename($new_image);

        // Validate and move each file
        if ($new_image != '') {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'][$i], $allowed_types)) {
                if ($_FILES['image']['size'][$i] < 5000000) { // 5MB limit
                    if (move_uploaded_file($temp_name, $folder2)) {
                        $images[] = basename($new_image); // Save the file name
                    }else {
                        $errors['image'] = "Error uploading file.";
                    }
                } else {
                    $errors['image'] = "Image size exceeds 5MB.";
                }
            } else {
                $errors['image'] = "Invalid image format. Only JPEG, PNG, and GIF are allowed.";
            }
        }
    }

    // Store image array data in separate words and delemeter is , 
    $images_string = implode(', ', $images); // Convert array to a string

    // Check if array of errors is empty the insert query is executed
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO tblmaster (name, description, slug, category, size, color, weight, oldprice, newprice, images, status, processor, clock_speed, gpu, ram, ram_slot, ssd_hdd, os, display_size, display_type, display_touch, power_adapter, battery_capacity, battery_hour, dimension, colors, io_ports, fingerprint_sensor, camera, keyboard, touchpad, wifi, bluetooth, speaker, mic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            $errors['db_error'] = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("sssssssssssssssssssssssssssssssssss", $pname, $pdescription, $pslug, $pcategory, $psize, $pcolor, $pweight, $poldprice, $pnewprice, $images_string, $strStatus, $pprocessor, $pclockspeed, $pgpu, $pram, $pramslot, $pssdhdd, $pos, $pdisplaysize, $pdisplaytype, $pdisplaytouch, $ppoweradapter, $pbatterycapacity, $pbatteryhour, $pdimension, $pcolors, $pioports, $pfingerprintsensor, $pcamera, $pkeyboard, $ptouchpad, $pwifi, $pbluetooth, $pspeaker, $pmic);
            if ($stmt->execute()) {
                header("Location: products.php");
                exit;
            } else {
                $errors['db_error'] = "Database error: Failed to register";
            }
            $stmt->close();
        }
    }
}

// To edit the record
if (isset($_POST['Edit'])) {
    $pname = $_POST['pname'];
    $pdescription = $_POST['pdescription'];
    $pslug = $_POST['pslug'];
    $pcategory = $_POST['pcategory'];
    $psize = $_POST['psize'];
    $pcolor = $_POST['pcolor'];
    $pweight = $_POST['pweight'];
    $poldprice = $_POST['poldprice'];
    $pnewprice = $_POST['pnewprice'];
    $pstatus = $_POST['pstatus'];
    $old_images = explode(', ', $_POST['image_old']); // Split the old images into an array
    $pprocessor = $_POST['pprocessor'];
    $pclockspeed = $_POST['pclockspeed'];
    $pgpu = $_POST['pgpu'];
    $pram = $_POST['pram'];
    $pramslot = $_POST['pramslot'];
    $pssdhdd = $_POST['pssdhdd'];
    $pos = $_POST['pos'];
    $pdisplaysize = $_POST['pdisplaysize'];
    $pdisplaytype = $_POST['pdisplaytype'];
    $pdisplaytouch = $_POST['pdisplaytouch'];
    $ppoweradapter = $_POST['ppoweradapter'];
    $pbatterycapacity = $_POST['pbatterycapacity'];
    $pbatteryhour = $_POST['pbatteryhour'];
    $pdimension = $_POST['pdimension'];
    $pcolors = $_POST['pcolors'];
    $pioports = $_POST['pioports'];
    $pfingerprintsensor = $_POST['pfingerprintsensor'];
    $pcamera = $_POST['pcamera'];
    $pkeyboard = $_POST['pkeyboard'];
    $ptouchpad = $_POST['ptouchpad'];
    $pwifi = $_POST['pwifi'];
    $pbluetooth = $_POST['pbluetooth'];
    $pspeaker = $_POST['pspeaker'];
    $pmic = $_POST['pmic'];

    // image array for multiple image
    $images = [];
    $image_count = count($_FILES['image']['name']);

    if (empty($pstatus)) {
        $pstatus[] = "Out of Stock";
    }
    $strStatus = implode(", ", $pstatus);

    // Validate inputs
    if (empty($pname)) {
        $errors['pname'] = "Enter product name";
    }

    if (empty($pdescription)) {
        $errors['pdescription'] = "Enter product description";
    }

    if (empty($pslug)) {
        $errors['pslug'] = "Enter slug";
    }

    if (in_array($pslug, $existingSlug)) {
        $errors['slug'] = "Slug already exists";
    }

    if (empty($pcategory)) {
        $errors['pcategory'] = "Select category";
    }

    if (empty($psize)) {
        $errors['psize'] = "Select size";
    }

    if (empty($pcolor)) {
        $errors['pcolor'] = "Please select color";
    }

    if (empty($pweight)) {
        $errors['pweight'] = "Enter wight";
    }

    if (empty($poldprice)) {
        $errors['poldprice'] = "Enter old price";
    }

    if (empty($pnewprice)) {
        $errors['pnewprice'] = "Enter new price";
    }

    // for loop is used for take multiple image and insert into database
    for ($i = 0; $i < $image_count; $i++) {
        $new_image = $_FILES['image']['name'][$i];
        $temp_name = $_FILES['image']['tmp_name'][$i];
        $folder = "assets/img/productimage/" . basename($new_image);

        // check the images and types of it
        if ($new_image != '') {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'][$i], $allowed_types)) {
                if ($_FILES['image']['size'][$i] < 5000000) { // 5MB limit
                    if (move_uploaded_file($temp_name, $folder)) {
                        $images[] = basename($new_image); // Save the file name
                    } else {
                        $errors['image'] = "Error uploading file.";
                    }
                } else {
                    $errors['image'] = "Image size exceeds 5MB.";
                }
            } else {
                $errors['image'] = "Invalid image format. Only JPEG, PNG, and GIF are allowed.";
            }
        }
    }

    // check the images and if images already available then store new images and remove old images from the folder
    if (!empty($images)) {
        foreach ($old_images as $old_image) {
            if (!empty($old_image) && file_exists("assets/img/productimage/" . $old_image)) {
                unlink("assets/img/productimage/" . $old_image);
            }
        }
        $images_string = implode(', ', $images); // Convert new images array to a string
    } else {
        $images_string = implode(', ', $old_images); // If no new images are uploaded, keep the old images
    }

    // check the array of errors is empty then update query is executed
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE tblmaster SET name = ?, description = ?, slug = ?, category = ?, size = ?, color = ?, weight = ?, oldprice = ?, newprice = ?, images = ?, status = ?, processor = ?, clock_speed = ?, gpu = ?, ram = ?, ram_slot = ?, ssd_hdd = ?, os = ?, display_size = ?, display_type = ?, display_touch = ?, power_adapter = ?, battery_capacity = ?, battery_hour = ?, dimension = ?, colors = ?, io_ports = ?, fingerprint_sensor = ?, camera = ?, keyboard = ?, touchpad = ?, wifi = ?, bluetooth = ?, speaker = ?, mic = ? WHERE id = ?");
        if (!$stmt) {
            $errors['db_error'] = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("sssssssssssssssssssssssssssssssssssi", $pname, $pdescription, $pslug, $pcategory, $psize, $pcolor, $pweight, $poldprice, $pnewprice, $images_string, $strStatus, $pprocessor, $pclockspeed, $pgpu, $pram, $pramslot, $pssdhdd, $pos, $pdisplaysize, $pdisplaytype, $pdisplaytouch, $ppoweradapter, $pbatterycapacity, $pbatteryhour, $pdimension, $pcolors, $pioports, $pfingerprintsensor, $pcamera, $pkeyboard, $ptouchpad, $pwifi, $pbluetooth, $pspeaker, $pmic, $upid);
            if ($stmt->execute()) {
                header("Location: products.php");
                exit;
            } else {
                $errors['db_error'] = "Database error: Failed to register";
            }
            $stmt->close();
        }
    }
}

// To delete the record
if (isset($_REQUEST['idd'])) {
    $id = intval($_GET['idd']); // Use intval() to ensure it's an integer

    // Fetch the product details to get the image filenames
    $stmt = $conn->prepare("SELECT images FROM tblmaster WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $dataDelete = $res->fetch_assoc();
        $images = explode(', ', $dataDelete['images']); // Convert the comma-separated string to an array

        // Delete the product record from the database
        $stmt = $conn->prepare("DELETE FROM tblmaster WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Delete images from the server
            foreach ($images as $image) {
                $imagePath = "assets/img/productimage/" . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the file
                }
            }
            header('Location: products.php'); // Redirect to the products page
            exit;
        } else {
            die("Database error: Failed to delete record");
        }
    } else {
        die("Product not found");
    }
}


$title = "Products";

?>

<?php include_once 'includes/body.php'; ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $NAME; ?></h3>
                                </div>
                                <form method="post" id="pform" enctype="multipart/form-data">

                                    <!-- To display errors -->
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?php foreach ($errors as $err) : ?>
                                                <p><?php echo $err; ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">

                                        <!-- Product Name -->
                                        <div class="form-group row">
                                            <label for="pname" class="col-sm-2 col-form-label">Product Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="pname" id="pname" class="form-control" value="<?php echo $upid ? $data['name'] : ''; ?>">
                                            </div>
                                        </div>

                                        <!-- Product Description -->
                                        <div class="form-group row">
                                            <label for="pdescription" class="col-sm-2 col-form-label">Product Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <textarea name="pdescription" id="pdescription" class="form-control">
            <?php echo $upid ? $data['description'] : ''; ?>
        </textarea>
                                            </div>
                                        </div>

                                        <!-- Product Slug -->
                                        <div class="form-group row">
                                            <label for="pslug" class="col-sm-2 col-form-label ">Product Slug <span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="pslug" id="pslug" class="form-control" value="<?php echo $upid ? $data['slug'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Category -->
                                                <div class="form-group row">
                                                    <label for="pcategory" class="col-sm-2 col-form-label col-sm-3">Category <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select name="pcategory" id="pcategory" class="form-control">
                                                            <option value="">Select Category</option>
                                                            <?php

                                                            $sqlSelectCategory = "SELECT name FROM tblcomputercategory";
                                                            $resultSelectCategory = mysqli_query($conn, $sqlSelectCategory);
                                                            foreach ($resultSelectCategory as $result) {
                                                                $selectedCategory = $data['category'];
                                                                $isSelected = ($result['name'] == $selectedCategory) ? "selected" : "";
                                                                echo "<option value='" . $result['name'] . "' " . $isSelected . ">" . $result['name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Size -->
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="psize" class="col-sm-2 col-form-label col-sm-3">Size <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select name="psize" id="psize" class="form-control">
                                                            <option value="">Select Size</option>
                                                            <option value="11" <?php if (!$upid) {
                                                                                } else {
                                                                                    if ($data['size'] == "11") echo 'selected="selected"';
                                                                                } ?>>11</option>
                                                            <option value="14" <?php if (!$upid) {
                                                                                } else {
                                                                                    if ($data['size'] == "14") echo 'selected="selected"';
                                                                                } ?>>14</option>
                                                            <option value="15.6" <?php if (!$upid) {
                                                                                    } else {
                                                                                        if ($data['size'] == "15.6") echo 'selected="selected"';
                                                                                    } ?>>15.6</option>
                                                            <option value="17.3" <?php if (!$upid) {
                                                                                    } else {
                                                                                        if ($data['size'] == "17.3") echo 'selected="selected"';
                                                                                    } ?>>17.3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Color -->
                                                <div class="form-group row">
                                                    <label for="pcolor" class="col-sm-2 col-form-label col-sm-3">Color <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="color" name="pcolor" id="pcolor" class="form-control" value="<?php echo $upid ? $data['color'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Weight -->
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="pweight" class="col-sm-2 col-form-label col-sm-3">Weigth <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="pweight" id="pweight" class="form-control" value="<?php echo $upid ? $data['weight'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Old Price - New Price -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="poldprice" class="col-sm-2 col-form-label col-sm-3">Old Price <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="poldprice" id="poldprice" class="form-control" value="<?php echo $upid ? $data['oldprice'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pnewprice" class="col-sm-2 col-form-label col-sm-3">New Price <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="pnewprice" id="pnewprice" class="form-control" value="<?php echo $upid ? $data['newprice'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Image - Status -->
                                        <div class="row">
                                            <!-- Product Image -->
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="inputImage" class="col-sm-3 col-form-label">Product Image <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name="image[]" id="inputImage" multiple>
                                                        <input type="hidden" name="image_old" value="<?php echo !$upid ? '' : $data['images']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Status -->
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="pstatus[]" id="pstatus" value="Active" <?php echo $upid && in_array("Active", $fetchStatus) ? "checked" : ""; ?>>
                                                            <label class="form-check-label" for="pstatus">Active</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Processor - Clock Speed -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pprocessor" class="col-sm-2 col-form-label col-sm-3">Processor <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pprocessor" id="pprocessor" class="form-control" value="<?php echo $upid ? $data['processor'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pclockspeed" class="col-sm-2 col-form-label col-sm-3">Clock Speed <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pclockspeed" id="pclockspeed" class="form-control" value="<?php echo $upid ? $data['clock_speed'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product GPU - RAM -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pgpu" class="col-sm-2 col-form-label col-sm-3">GPU <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pgpu" id="pgpu" class="form-control" value="<?php echo $upid ? $data['ram'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pram" class="col-sm-2 col-form-label col-sm-3">RAM <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pram" id="pram" class="form-control" value="<?php echo $upid ? $data['ram'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product RAM Slot - SSD OR HDD -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pramslot" class="col-sm-2 col-form-label col-sm-3">RAM Slot <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="pramslot" id="pramslot" class="form-control" value="<?php echo $upid ? $data['ram_slot'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pssdhdd" class="col-sm-2 col-form-label col-sm-3">SSD OR HDD <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pssdhdd" id="pssdhdd" class="form-control" value="<?php echo $upid ? $data['ssd_hdd'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product OS - Display Size -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pos" class="col-sm-2 col-form-label col-sm-3">OS <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pos" id="pos" class="form-control" value="<?php echo $upid ? $data['os'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pdisplaysize" class="col-sm-2 col-form-label col-sm-3">Display Size <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pdisplaysize" id="pdisplaysize" class="form-control" value="<?php echo $upid ? $data['display_size'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Display Type - Display Touch -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pdisplaytype" class="col-sm-2 col-form-label col-sm-3">Display Type <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pdisplaytype" id="pdisplaytype" class="form-control" value="<?php echo $upid ? $data['display_type'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pdisplaytouch" class="col-sm-2 col-form-label col-sm-3">Display Touch <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pdisplaytouch" id="pdisplaytouch" class="form-control" value="<?php echo $upid ? $data['display_touch'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Power Adapter - Battery Capacity -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="ppoweradapter" class="col-sm-2 col-form-label col-sm-3">Power Adapter <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="ppoweradapter" id="ppoweradapter" class="form-control" value="<?php echo $upid ? $data['power_adapter'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pbatterycapacity" class="col-sm-2 col-form-label col-sm-3">Battery Capacity <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pbatterycapacity" id="pbatterycapacity" class="form-control" value="<?php echo $upid ? $data['battery_capacity'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Battery Hour - Dimension -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pbatteryhour" class="col-sm-2 col-form-label col-sm-3">Battery Hour <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pbatteryhour" id="pbatteryhour" class="form-control" value="<?php echo $upid ? $data['battery_hour'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pdimension" class="col-sm-2 col-form-label col-sm-3">Dimension <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pdimension" id="pdimension" class="form-control" value="<?php echo $upid ? $data['dimension'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Colors - IO Ports -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pcolors" class="col-sm-2 col-form-label col-sm-3">Colors <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pcolors" id="pcolors" class="form-control" value="<?php echo $upid ? $data['colors'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pioports" class="col-sm-2 col-form-label col-sm-3">IO Ports <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pioports" id="pioports" class="form-control" value="<?php echo $upid ? $data['io_ports'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Fingerprint Sensor - Camera -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pfingerprintsensor" class="col-sm-2 col-form-label col-sm-3">Fingerprint Sensor <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pfingerprintsensor" id="pfingerprintsensor" class="form-control" value="<?php echo $upid ? $data['fingerprint_sensor'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pcamera" class="col-sm-2 col-form-label col-sm-3">Camera <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pcamera" id="pcamera" class="form-control" value="<?php echo $upid ? $data['camera'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Keyboard - Touchpad -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pkeyboard" class="col-sm-2 col-form-label col-sm-3">Keyboard <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pkeyboard" id="pkeyboard" class="form-control" value="<?php echo $upid ? $data['keyboard'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="ptouchpad" class="col-sm-2 col-form-label col-sm-3">Touchpad <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="ptouchpad" id="ptouchpad" class="form-control" value="<?php echo $upid ? $data['touchpad'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Wi-Fi - Bluetooth -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pwifi" class="col-sm-2 col-form-label col-sm-3">Wi-Fi <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pwifi" id="pwifi" class="form-control" value="<?php echo $upid ? $data['wifi'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pbluetooth" class="col-sm-2 col-form-label col-sm-3">Bluetooth <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pbluetooth" id="pbluetooth" class="form-control" value="<?php echo $upid ? $data['bluetooth'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Speaker - Mic -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Product Old Price -->
                                                <div class="form-group row">
                                                    <label for="pspeaker" class="col-sm-2 col-form-label col-sm-3">Speaker <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pspeaker" id="pspeaker" class="form-control" value="<?php echo $upid ? $data['speaker'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product New Price -->
                                                <div class="form-group row">
                                                    <label for="pmic" class="col-sm-2 col-form-label col-sm-3">Mic <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="pmic" id="pmic" class="form-control" value="<?php echo $upid ? $data['mic'] : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="<?php echo $NAME; ?>" class="btn btn-primary">
                                            <?php echo $NAME; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'includes/footer.php'; ?>