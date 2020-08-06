<body>
    <header class="continer-fluid ">
        <div id="menu-jk" class="header-bottom">
            <div class="container">
                <div class="row nav-row">
                    <div class="col-md-3 logo">
                        <img src="images/logo.jpg" alt="">
                    </div>
                    <div class="col-md-9 nav-col">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup.php">Donate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="donor.php">Donor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signin.php">Signin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="search.php">Search</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="blog.php">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.php">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contact US</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"><?php if(isset($_SESSION['name'])) echo ucfirst($_SESSION['name']); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>