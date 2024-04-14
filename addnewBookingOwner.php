<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <title>Add New Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <center><h2>Add New Booking</h2></center>
        <form id="bookingForm" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="scheduleDate">Schedule Date:</label>
                <input type="datetime-local" id="scheduleDate" name="scheduleDate" required>
            </div>

            <div class="form-group">
                <label for="bookingID">Booking ID:</label>
                <input type="text" id="bookingID" name="bookingID" required>
            </div>

            <div class="form-group">
                <label for="serviceType">Service Type:</label>
                <input type="text" id="serviceType" name="serviceType" required>
            </div>

            <div class="form-group">
                <label for="vehicleNumber">Vehicle Number:</label>
                <input type="text" id="carType" name="vehicleNumber" required>
            </div>

            <div class="form-group">
                <label for="paymentOption">Payment Option:</label>
                <input type="text" id="paymentOption" name="paymentOption" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <center><button type="submit" class="btn btn-primary">Submit</button></center>
        </form>
    </div>

    <script>
        function validateForm() {
            var form = document.getElementById('bookingForm');

            // Check if the form is valid (HTML5 built-in validation)
            if (form.checkValidity()) {
                // You can add additional custom validation logic here if needed
                alert('Booking added successfully!');
                return true;
            } else {
                // Display HTML5 validation error messages
                form.reportValidity();
                return false;
            }
        }
    </script>
</body>
</html>
