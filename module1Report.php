<?php
// Include your database connection file
include("dbase.php");

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Initialize an array to store approved counts for each day of the month
$approvedCountsByDay = array();

// Loop through each day of the month
for ($day = 1; $day <= date('t'); $day++) {
    // Format the date
    $date = $currentYear . '-' . $currentMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

    // Query to get the count of registered vehicles that have been approved for the current day
    $query = "SELECT COUNT(*) AS approvedCount FROM register_vehicle WHERE ApprovalStatus = 'Approved' AND DATE(registration_date) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result
    $row = $result->fetch_assoc();

    // Store the approved count for the current day
    $approvedCountsByDay[$day] = $row['approvedCount'];
}

// Calculate the total approved count for the month
$totalApprovedCount = array_sum($approvedCountsByDay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Approval Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Vehicle Approval Report</h1>
    <!-- Add a canvas element for the chart -->
    <canvas id="approvalChart" width="400" height="200"></canvas>

    <script>
        // PHP variables containing the approved counts by day and total for the month
        var approvedCountsByDay = <?php echo json_encode(array_values($approvedCountsByDay)); ?>;
        var totalApprovedCount = <?php echo $totalApprovedCount; ?>;

        // Get the canvas element
        var ctx = document.getElementById('approvalChart').getContext('2d');

        // Create the chart
        var approvalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(range(1, date('t'))); ?>,
                datasets: [{
                    label: 'Approved Vehicles',
                    data: approvedCountsByDay,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Vehicle Approval Report for <?php echo date('F Y'); ?>'
                }
            }
        });
    </script>
</body>
</html>
