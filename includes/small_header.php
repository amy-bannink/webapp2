<header>
    <div class="logo-wrapper">
        <div class="logo"></div>
        <div class="slogan-wrapper">
            <h1 class="blue-text slogan-big">Find your next stay<h1>
                    <p class="blue-text slogan-small">Scout the way. Embrace the journey.</p>
        </div>
    </div>
    <nav>
        <ul>
            <?php
            if (($_SESSION['role_id'] ?? null) === 2) {
                echo '<li><a href="../admin.php" class="hover-pointer blue-text admin-header">Admin</a></li>';
            }
            ?>
            <li><a href="../index.php" class="hover-pointer blue-text">Home</a></li>
            <li><a href="../contact.php" class="hover-pointer blue-text">Contact</a></li>
            <li><a href="../reviews.php" class="hover-pointer blue-text">Reviews</a></li>
            <?php
            if (isset($_SESSION['user_id']) ){   
            } else {
                echo '<li><a href="../sign_up.php" class="hover-pointer blue-text sign-up-header">Sign up</a></li>';
            }
            ?>
        </ul>
    </nav>
    <a href="../login.php" class="profile-icon-link">
        <img src="../assets/img/person.png" alt="Profile" class="profile-pic hover-pointer">
    </a>
</header>