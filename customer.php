<?php include 'index.php'; ?>
<div style="top: 0; height: 48px; width: 100%;position: relative; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <h3 style="position: absolute; margin: auto; top: 5px; bottom: 0; left: 20px; text-align: center;">Customers Page</h3>
    <a style="height: 40px; position: absolute; right: 20px; margin: auto; text-align: center; top: 0; bottom: 0; font-weight: bolder;" type="button" class="btn btn-outline-success" href="newCustomer.php">New Customer</a>
</div>
<div class="container-fluid mt-1" style=" box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>District</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "connection.php";
            $sql = "select * from customer";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query!");
            }
            while ($row = $result->fetch_assoc()) {
                echo "
      <tr>
        <th>$row[id]</th>
        <td>$row[title]</td>
        <td>$row[first_name]</td>
        <td>$row[last_name]</td>
        <td>$row[contact_no]</td>
        <td>$row[district]</td>
        <td>
            <a class='btn btn-success' href='edit.php?id=$row[id]'>Edit</a>
            <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
        </td>
      </tr>
      ";
            }
            ?>
        </tbody>
    </table>
</div>