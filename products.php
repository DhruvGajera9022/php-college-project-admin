<?php

include_once('userdata.php');

// Fetch product data from tblmaster
$query = "SELECT * FROM tblmaster";
$stmtProducts = $conn->prepare($query);
if (!$stmtProducts) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmtProducts->execute()) {
    die("Execute failed: " . $stmtProducts->error);
}
$resProducts = $stmtProducts->get_result();

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
                            <div class="d-flex flex-row-reverse">
                                <a href="addproduct.php" class="btn btn-primary">Add</a>
                            </div>
                            <table id="tableProduct" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Weight</th>
                                        <th>Old Price</th>
                                        <th>New Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($dataProduct = $resProducts->fetch_assoc()) {
                                        $images_array = explode(', ', $dataProduct['images']); // Split images into an array
                                    ?>
                                        <tr>
                                            <td>
                                                <?php foreach ($images_array as $image) { ?>
                                                    <img src="assets/img/productimage/<?php echo ($image); ?>" height="50px" alt="product image">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $dataProduct['name']; ?></td>
                                            <td><?php echo $dataProduct['slug']; ?></td>
                                            <td><?php echo $dataProduct['category']; ?></td>
                                            <td><?php echo $dataProduct['size']; ?></td>
                                            <td><input type="color" name="" id="" disabled value="<?php echo $dataProduct['color']; ?>"></td>
                                            <td><?php echo $dataProduct['weight']; ?></td>
                                            <td><?php echo $dataProduct['oldprice']; ?></td>
                                            <td><?php echo $dataProduct['newprice']; ?></td>
                                            <td><?php echo $dataProduct['status']; ?></td>
                                            <td>
                                                <a href="addproduct.php?id=<?php echo $dataProduct['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="addproduct.php?idd=<?php echo $dataProduct['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'includes/footer.php'; ?>