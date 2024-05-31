<body>
    <header class="header">
        <div class="container">
            <div class="header-area">
                <div class="logo">
                    <a href="index.php"><img src="assets/img/CTlogo.png" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <ul>
                        <?php
                        if ($_SESSION['user_id'] == 0) {
                            echo '<li>Welcome Guest</li>';
                            echo '<li><a href="Login.php">Login</a></li>';
                        } else {
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                if ($_SESSION['Gender'] == 'M') {
                                    echo 'Welcome Mr. ' . $_SESSION['first_name'] . '!';
                                } else if ($_SESSION['Gender'] == 'F') {
                                    echo 'Welcome Ms. ' . $_SESSION['first_name'] . '!';
                                }
                                else{
                                    echo 'Welcome ' . $_SESSION['first_name'] . '!';
                                }
                            }
                            echo '</a>';
                        
                        ?>
                        <div class="dropdown-content">
                            <?php
                            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0) {
                                echo '<a href="Customer.php?userid=' . $_SESSION['user_id'] . '">View Profile</a>';
                            }
                            ?>
                            <a href="logout.php" id="logout">Log out</a>
                        </div>
                    </ul>
                </div>
                <div class="menu-area">
                    <div class="responsive-menu"></div>
                    <div class="mainmenu">
                        <ul id="primary-menu">
                            <?php 
                            if ($_SESSION['user_id'] == 0) {
                                echo '<li><a class="active" href="index.php">Home</a></li>';
                            }
                            if ($_SESSION['user_id'] != 0) {
                                echo '<li><a class="active" href="main.php?user_id=">Home</a></li>';
                            }
                            ?>
                            <?php echo '<li><a href="movies.php?userid=' . $_SESSION['user_id'] . '">Movies</a></li>' ?>
                            <li><a class="theme-btn" href="#"><i class="icofont icofont-ticket"></i> Buy Tickets</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
