<?php


// Define an array of banks with their respective URLs for online banking portals
$banks = array(
    "CIMB" => "https://www.cimbclicks.com.my/",
    "Maybank" => "https://www.maybank2u.com.my/",
    "Public Bank" => "https://www.pbebank.com/",
    "RHB" => "https://www.rhbgroup.com/"
);

// Check if a bank is selected
if (isset($_POST['bank'])) {
    // Retrieve the selected bank
    $selectedBank = $_POST['bank'];

    // Check if the selected bank exists in the array
    if (array_key_exists($selectedBank, $banks)) {
        // Redirect the user to the selected bank's online banking portal
        header("Location: " . $banks[$selectedBank]);
        exit;
    } else {
        // If the selected bank is not found, display an error message
        $error = "Invalid bank selection.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Website - Payment</title>
  <link rel="stylesheet" type="text/css" href="cs2.css">
</head>
<body>
  <header>
    <div class="container">
      <h1>CineTime</h1>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="movies.html">Movies</a></li>
          <li><a href="booking.html">Booking</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
        <div class="container">
            <h1>Select Bank - Online Banking</h1>
        </div>
    </header>

    <main>
        <section class="bank-selection">
            <div class="container">
                <h2>Select your bank for online banking payment</h2>
                <form action="" method="post">
                    <div class="bank-options">
                        <?php foreach ($banks as $bank => $url) : ?>
                            <input type="radio" id="<?php echo $bank; ?>" name="bank" value="<?php echo $bank; ?>">
                            <label for="<?php echo $bank; ?>"><?php echo $bank; ?></label><br>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit">Proceed to Online Banking</button>
                    <?php if (isset($error)) : ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 CineTime</p>
        </div>
    </footer>
</body>
</html>
