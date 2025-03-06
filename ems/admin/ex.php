<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto-set Today's Date and Time</title>
</head>
<body>

    <!-- Date and Time input field -->
    <label for="datetime">Select Date and Time: </label>
    <input type="datetime-local" id="datetime">

    <script>
        // Function to set today's date and time automatically
        window.onload = function() {
            const today = new Date(); // Get current date and time
            const dd = String(today.getDate()).padStart(2, '0'); // Day
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Month (0-indexed)
            const yyyy = today.getFullYear(); // Year

            const hours = String(today.getHours()).padStart(2, '0'); // Hours
            const minutes = String(today.getMinutes()).padStart(2, '0'); // Minutes

            // Format the date as YYYY-MM-DD and time as HH:mm
            const formattedDateTime = `${yyyy}-${mm}-${dd}T${hours}:${minutes}`;

            // Set the value of the input to today's date and time
            document.getElementById('datetime').value = formattedDateTime;
        }
    </script>

</body>
</html>
