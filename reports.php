<?php
include 'index.php';
include "connection.php";

if (isset($_POST['submit'])) {
    $daterange = $_POST['daterange'];

    $dates = explode(' - ', $daterange);
    $startDate = date('Y-m-d', strtotime($dates[0]));
    $endDate = date('Y-m-d', strtotime($dates[1]));

    // echo "Start date: " . $startDate . "<br>";
    // echo "End date: " . $endDate . "<br>";

    $query = $conn->prepare("SELECT 
    invoice.invoice_no, 
    invoice.date,
    customer.title,
    customer.first_name, 
    customer.contact_no, 
    district.district, 
    invoice.item_count, 
    invoice.amount 
    FROM 
    invoice 
    INNER JOIN 
    customer ON invoice.customer = customer.id 
    INNER JOIN 
    district ON customer.district = district.id
    WHERE 
    invoice.date BETWEEN ? AND ?");

    $query->bind_param("ss", $startDate, $endDate);

    $query->execute();

    $result = $query->get_result();

    if ($query->errno) {
        echo "Error: " . $query->error;
    } else {
        echo "<table>
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Contact No</th>
                        <th>District</th>
                        <th>Item Count</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['invoice_no'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['contact_no'] . "</td>
                    <td>" . $row['district'] . "</td>
                    <td>" . $row['item_count'] . "</td>
                    <td>" . $row['amount'] . "</td>
                </tr>";
        }
        echo "</tbody></table>";

        $query->close();
    }
} else {
    echo "<script>Date range not received</script>";
}


?>

<div style="top: 0px; height: 48px; width: 100%;position: relative; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <h3 style="position: absolute; margin: auto; top: 5px; bottom: 0; left: 20px; text-align: center;">Reports Form</h3>
</div>

<div class="container-fluid">
    <div class="row mt-2 m-0 p-0">
        <div class="col-4">
            <div class="card" style="background: lightgray;width: 100%; height: 200px; position: relative;">
                <form class="mt-2" method="post" action="" style="position: relative;display: flex; flex-direction: column; justify-content: center; justify-items: center; align-content: center; align-items: center;">
                    <label for="validationDefault01" class="form-label"></label>
                    <input class="form-control" style="position: relative;" type="text" name="daterange" id="validationDefault01" value="<?php echo isset($_POST['daterange']) ? $_POST['daterange'] : ''; ?>" required />
                    <button style="position: relative; width: 200px; margin-top: 10px;" type="submit" class="btn btn-primary" name="submit">Invoice Report</button>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="background: lightblue;width: 100%; height: 200px; position: relative; ">

            </div>
        </div>
        <div class="col-4">
            <div class="card" style="background: lightsalmon;width: 100%; height: 200px; position: relative; ">

            </div>
        </div>
    </div>
</div>

<script>
    var startDate;
    var endDate;
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');
            console.log(startDate + " " + endDate);

            $.ajax({
                method: 'POST',
                url: 'reports.php',
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    console.log('Date range sent to PHP successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Error sending date range to PHP');
                }
            });
        });
    });
</script>