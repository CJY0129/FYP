
    <style>
  .form-container {
            background-color: #c0153a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .form-container input, .form-container button {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        input{
            color:white;
        }

      
    </style>


    <div class="container">
        <?php
        $_SESSION['totalprice'] = $_GET["totalPrice"]; 
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 0) {
            echo '<h2>Personal Details</h2>';
            echo '<div class="form-container">
                    <form action="payment main page.php" method="POST">
                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="phone" placeholder="Phone Number" >
                        <button type="submit">Proceed to Payment</button>
                    </form>
                  </div>';
            } else {
                echo'<meta http-equiv="refresh" content="0;url=payment main page.php">';
            }
        ?>
    </div>

