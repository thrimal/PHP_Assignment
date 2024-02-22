<?php
include 'index.php';
include "connection.php";

$titles = array("Mr", "Mrs", "Miss");

$sql = "SELECT * FROM district";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
} else {
    while ($row = $result->fetch_assoc()) {
        // Assuming 'district' is one of the columns in the 'customer' table
        // Add each district to the $districts array
        $districts[] = array(
            'id' => $row['id'],
            'district' => $row['district']
        );
    }

    $result->free();
}
?>

<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact = $_POST['contact'];
    $district = $_POST['district'];

    // echo "Title: $title <br>";
    // echo "First Name: $first_name <br>";
    // echo "Middle Name: $middle_name <br>";
    // echo "Last Name: $last_name <br>";
    // echo "Contact Number: $contact <br>";
    // echo "District: $district <br>";

    $query = $conn->prepare("INSERT INTO `customer`(`title`, `first_name`, `middle_name`, `last_name`, `contact_no`, `district`) VALUES (?, ?, ?, ?, ?, ?)");

    $query->bind_param("ssssss", $title, $first_name, $middle_name, $last_name, $contact, $district);

    $query->execute();

    if ($query->errno) {
        echo "Error: " . $query->error;
    } else {
        echo "Record inserted successfully!";
    }
}
?>
<div style="top: 0px; height: 48px; width: 100%;position: relative; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <h3 style="position: absolute; margin: auto; top: 5px; bottom: 0; left: 20px; text-align: center;">New Customer Form</h3>
    <!-- <a style="height: 40px; position: absolute; right: 20px; margin: auto; text-align: center; top: 0; bottom: 0; font-weight: bolder;" type="button" class="btn btn-outline-success" href="newCustomer.php">New Customer</a> -->
</div>
<div class="container-fluid mt-1" style="width: 100%; height: 100%; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; display: flex; justify-content: center; justify-items: center; align-items: center; align-content: center;">
    <div class="card" style="max-width: 400px; height: auto; position: relative; ">
        <form method="post" class="row p-0 m-0" style="width: 100%; display: flex; justify-content: center; justify-items: center; align-items: center; align-content: center;">
            <div class="col-12">
                <div class="row g-2">
                    <div class="col-12">
                        <label for="validationDefault01" class="form-label">Title</label>
                        <select class="form-select form-control" name="title" id="validationDefault01" required>
                            <option selected disabled value="">Select...</option>
                            <?php foreach ($titles as $title) : ?>
                                <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault02" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationDefault02" name="first_name" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault03" class="form-label">Middle name</label>
                        <input type="text" class="form-control" id="validationDefault03" name="middle_name" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault04" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationDefault04" name="last_name" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault05" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="validationDefault05" name="contact" required>
                    </div>
                    <div class="col-12">
                        <label for="validationDefault06" class="form-label">District</label>
                        <select class="form-select" name="district" id="validationDefault06" required>
                            <option selected disabled value="">Select...</option>
                            <?php foreach ($districts as $district) : ?>
                                <option value="<?php echo $district['id']; ?>"><?php echo $district['district']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 pb-2" style="display: flex; justify-content: center;">
                        <button  class="btn btn-primary" name="submit" type="submit">Submit Form</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>