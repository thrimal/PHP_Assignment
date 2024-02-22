<?php
include 'index.php';
include "connection.php";

$titles = array("Mr", "Mrs", "Miss");

$sql_category = "SELECT * FROM item_category";
$result_category = $conn->query($sql_category);

$sql_subcategory = "SELECT * FROM item_subcategory";
$result_subcategory = $conn->query($sql_subcategory);

if (!$result_category) {
    die("Invalid query: " . $conn->error);
} else {
    while ($row = $result_category->fetch_assoc()) {
        // Assuming 'district' is one of the columns in the 'customer' table
        // Add each district to the $districts array
        $categories[] = array(
            'id' => $row['id'],
            'category' => $row['category']
        );
    }

    $result_category->free();
}

if (!$result_subcategory) {
    die("Invalid query: " . $conn->error);
} else {
    while ($row = $result_subcategory->fetch_assoc()) {
        // Assuming 'district' is one of the columns in the 'customer' table
        // Add each district to the $districts array
        $subcategories[] = array(
            'id' => $row['id'],
            'subcategory' => $row['sub_category']
        );
    }

    $result_subcategory->free();
}
?>

<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $item_code = $_POST['item_code'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    // echo "Title: $title <br>";
    // echo "First Name: $first_name <br>";
    // echo "Middle Name: $middle_name <br>";
    // echo "Last Name: $last_name <br>";
    // echo "Contact Number: $contact <br>";
    // echo "District: $district <br>";

    $query = $conn->prepare("INSERT INTO `item`(`item_code`, `item_category`, `item_subcategory`, `item_name`, `quantity`, `unit_price`) VALUES (?, ?, ?, ?, ?, ?)");

    $query->bind_param("ssssss", $item_code, $item_category, $item_subcategory, $item_name, $quantity, $unit_price);

    $query->execute();

    if ($query->errno) {
        echo "Error: " . $query->error;
    } else {
        echo "Record inserted successfully!";
    }
}
?>
<div style="top: 0px; height: 48px; width: 100%;position: relative; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <h3 style="position: absolute; margin: auto; top: 5px; bottom: 0; left: 20px; text-align: center;">New Item Form</h3>
    <!-- <a style="height: 40px; position: absolute; right: 20px; margin: auto; text-align: center; top: 0; bottom: 0; font-weight: bolder;" type="button" class="btn btn-outline-success" href="newCustomer.php">New Customer</a> -->
</div>
<div class="container-fluid mt-1" style="width: 100%; height: 100%; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; display: flex; justify-content: center; justify-items: center; align-items: center; align-content: center;">
    <div class="card" style="max-width: 400px; height: auto; position: relative; ">
        <form method="post" class="row p-0 m-0" style="width: 100%; display: flex; justify-content: center; justify-items: center; align-items: center; align-content: center;">
            <div class="col-12">
                <div class="row g-2">
                    <div class="col-12">
                        <label for="validationDefault01" class="form-label">Item Code</label>
                        <input type="text" class="form-control" id="validationDefault01" name="item_code" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault02" class="form-label">Item Category</label>
                        <select class="form-select form-control" name="item_category" id="validationDefault02" required>
                            <option selected disabled value="">Select...</option>
                            <?php foreach ($categories as $item_category) : ?>
                                <option value="<?php echo $item_category['id']; ?>"><?php echo $item_category['category']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault03" class="form-label">Item Subcategory</label>
                        <select class="form-select" name="item_subcategory" id="validationDefault03" required>
                            <option selected disabled value="">Select...</option>
                            <?php foreach ($subcategories as $item_subcategory) : ?>
                                <option value="<?php echo $item_subcategory['id']; ?>"><?php echo $item_subcategory['subcategory']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault04" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="validationDefault04" name="item_name" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault05" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="validationDefault05" name="quantity" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault06" class="form-label">Unit Price</label>
                        <input type="text" class="form-control" id="validationDefault06" name="unit_price" required>
                    </div>
                    <div class="col-12 pb-2" style="display: flex; justify-content: center;">
                        <button class="btn btn-primary" name="submit" type="submit">Submit Form</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>