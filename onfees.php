<?php
include 'dconnect.php';

// Handle Add Payment
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $insert = mysqli_query($con, "INSERT INTO onfees (name, amount, date) VALUES ('$name', '$amount', '$date')");
    if (!$insert) {
        die("Error: " . mysqli_error($con));
    }
}

// handle update payment
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $update = mysqli_query($con, "UPDATE onfees SET name='$name', amount='$amount', date='$date' WHERE id='$id'");
    if (!$update) {
        die($con);
    } else {
        echo "<script>
                alert('Successfully Updated');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Payment</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="../images/blogo.png" type="x-icon">
</head>
<body>
    <!-- Overlay for Sidebar -->
    <div class="overlay" id="overlay"></div>

    <header class="header">
        <!-- Updated Burger Button with Hamburger Symbol and Text -->
        <button id="sidebar-toggle" class="sidebar-toggle">
            &#9776; &nbsp;&nbsp; <strong>Dashboard</strong>
        </button>

        <!-- Left Side Photo with Dropdown -->
        <div class="left-side">
            <div class="dropdown">
                <img src="../images/blogo.png" alt="Photo" class="photo" id="photo">
                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
                    <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
                    <a href="login.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar (Overlay) -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="../images/blogo.png" alt="Logo">
            <p>09090909</p>
        </div>
        <ul class="sidebar-nav">
           <li><a href="user.php"><i class="fa-solid fa-users"></i> User</a></li>
           <li><a href="strecord.php"><i class="fa-solid fa-clipboard-list"></i> Student Information</a></li>
           <li><a href="onfees.php"><i class="fa-solid fa-clipboard"></i> Ongoing fees</a></li>
           <li><a href="studentbalance.php"><i class="fa-solid fa-clipboard"></i> Students Balance</a></li>
           <li><a href="approval.php"><i class="fa-solid fa-credit-card"></i> Online Approval Payment</a></li>
           <li><a href="payrecord.php"><i class="fa-solid fa-clipboard"></i> Payment Record</a></li>
        </ul>
    </div>

    <section class="content">
    <h1>Ongoing Fees Payment</h1><br><br>
    <div id="child-container">
        <?php
        $query = mysqli_query($con, "SELECT * FROM onfees");
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<div class="payment-card">';
            echo "<p><strong>Payment Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
            echo "<p><strong>Amount:</strong> " . htmlspecialchars($row['amount']) . "</p>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
            echo '<button class="edit" data-id="' . $row['id'] . '" data-name="' . htmlspecialchars($row['name']) . '" data-amount="' . htmlspecialchars($row['amount']) . '" data-date="' . htmlspecialchars($row['date']) . '"><i class="fa-solid fa-pen-to-square"></i></button>';
            echo '<a href="delete.php?id='.$row['id'].'"><button class="delete"><i class="fa-solid fa-trash"></i></button></a>';
            echo '</div>';
        }
        ?>
    </div><br>

    <button class="add" id="openModal">+</button>
    <!-- Add Payment Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h2>Add New Payment</h2>
            <form method="post">
                <label for="name">Payment Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                <label for="amount">Amount:</label><br>
                <input type="text" id="amount" name="amount" required><br><br>
                <label for="date">Date:</label><br>
                <input type="date" id="date" name="date" required><br><br>
                <input type="submit" value="Submit" name="submit">
            </form>
        </div>
    </div>
    <!--- edit modal ----->
    <div id="updateModal" class="modal1">
    <div class="modal-content1">
        <span class="close2" id="updateClose">&times;</span>
        <h2>Update Payment</h2>
        <form method="post" id="updateForm">
            <input type="hidden" id="updateId" name="id">
            <label for="updateName">Payment Name:</label><br>
            <input type="text" id="updateName" name="name" required><br><br>
            <label for="updateAmount">Amount:</label><br>
            <input type="text" id="updateAmount" name="amount" required><br><br>
            <label for="updateDate">Date:</label><br>
            <input type="date" id="updateDate" name="date" required><br><br>
            <input type="submit" value="Update" name="update">
        </form>
    </div>
</div>
    </section>
<script src="../js/script.js"></script>
</body>
</html>
