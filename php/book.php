<?php
$message = '';  // Initialize the message variable
$type = '';     // Initialize the type variable
$selectedItem = isset($_GET['item']) ? htmlspecialchars($_GET['item']) : ''; // Capture selected item

// Check for the 'message' parameter in the URL
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'success') {
        $message = "Your booking order has been sent successfully!";
        $type = "success"; // SweetAlert2 success type
    } else if ($_GET['message'] == 'error') {
        $message = "Failed to send email. Please try again later.";
        $type = "error"; // SweetAlert2 error type
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Daily Grind</title>
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="book.css"/>
</head>
<body>

<header class="header">
    <a href="#" class="logo"> The Daily Grind <i class="fas fa-seedling"></i></a>
    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about us.php">about</a>
        <a href="menu.php">menu</a>
        <a href="#book">book</a>
    </nav>
</header>

<section class="book" id="book">
    <h1 class="heading2">booking <span>Order Now</span></h1>

    <form action="send_email.php" method="POST">
        <input type="hidden" name="item" value="<?php echo $selectedItem; ?>"> <!-- Hidden field for the selected item -->
        <input type="text" name="name" placeholder="Name" class="box" required>
        <input type="email" name="email" placeholder="Email" class="box" required>
        <input type="number" name="number" placeholder="Number" class="box" required>
        <textarea name="message" placeholder="Message" class="box" cols="30" rows="10" required>
<?php echo $selectedItem ? "I would like to order: $selectedItem" : ''; ?>
        </textarea>
        <input type="submit" value="send message" class="btn">
    </form>
</section>

<div class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Contact Info</h3>
            <a href="#"><i class="fas fa-phone"></i> 0991-456-7890</a>
            <a href="#"><i class="fas fa-envelope"></i> Thedailygrind_@gmail.com</a>
            <a href="#"><i class="fas fa-map-marker-alt"></i> Poblacion, Muntinlupa City</a>
        </div>
        <div class="box">
            <h3>Follow Us</h3>
            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
    </div>
    <div class="credit">
        Made with ❤️ by <span>The Daily Grind</span>
    </div>
</div>

<script src="script.js"></script>

<!-- SweetAlert2 Pop-Up Logic -->
<?php if (!empty($message) && !empty($type)) : ?>
    <script>
        Swal.fire({
            icon: '<?php echo $type; ?>', // success or error
            title: '<?php echo $type === "success" ? "Success!" : "Error!"; ?>',
            text: '<?php echo $message; ?>',
            confirmButtonText: 'OK',
        }).then(() => {
            // Redirect to remove the message parameter from the URL
            window.location.href = 'book.php';
        });
    </script>
<?php endif; ?>

</body>
</html>
