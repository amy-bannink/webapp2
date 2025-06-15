<header>
    <div class="logo-wrapper">
        <div class="logo"></div>
        <div class="slogan-wrapper">
                <h1 class="blue-text slogan-big">Find your next stay</h1>
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
            <li><a href="../index.php" class="hover-pointer blue-text home-header">Trips</a></li>
            <li><a href="../locations.php" class="hover-pointer blue-text locations-header">Locations</a></li>
            <li><a href="../contact.php" class="hover-pointer blue-text contact-header">Contact</a></li>
            <li><a href="../about-us.php" class="hover-pointer blue-text about-us-header">About Us</a></li>
            <li><a href="../reviews.php" class="hover-pointer blue-text reviews-header">Reviews</a></li>
            <?php
            if (isset($_SESSION['user_id']) ){   
            } else {
                echo '<li><a href="../sign-up.php" class="hover-pointer blue-text sign-up-header">Sign up</a></li>';
            }
            ?>
        </ul>
    </nav>
    <a href="../login.php" class="profile-icon-link">
        <img src="../assets/img/person.png" alt="Profile" class="profile-pic hover-pointer">
    </a>
    <div class="preference-wrapper">
    <form action="../dbcalls/search-handler.php" method="POST" class="preference-list" id="searchForm">
            <div>
                <label class="preference-items" where>
                    <input type="text" id="where" name="where" class="input-inline preference-top normal-hover-pointer" placeholder="Where">
                </label>
            </div>

            <div class="preference-line"></div>

            <div>
                <label class="preference-items">Check-in</label><br>
                <input type="date" id="check-in" name="check-in" class="input-inline">
            </div>

            <div class="preference-line"></div>

            <div>
                <label class="preference-items">Check-out</label><br>
                <input type="date" id="check-out" name="check-out" class="input-inline">
            </div>

            <div class="preference-line"></div>

            <div>
                <label class="preference-items">
                    <input type="number" id="who" name="who" class="input-inline normal-hover-pointer" placeholder="How many" min="1">
                </label>
            </div>

            <div class="preference-line"></div>

            <label class="custom-checkbox preference-items">
                <input type="checkbox" id="flight"/>
                <span class="checkmark normal-hover-pointer"></span>
                Flight
            </label>
            <button type="submit" class="search preference-items preference-bottom hover-pointer">Search</button>
        </form>
    </div>
    <script src="../assets/js/search-form.js"></script>
</header>