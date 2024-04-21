<?php

?>

<header class="my-header">
    <div class="container-fluid">
        <div class="row py-4">
            <div class="col-6">
                <h1 class="text-white mx-3">My Blog</h1>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <div>
                    <a class="my-a-btn" href="/php-blog/index.php">Home</a>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <a class="my-a-btn " href="/php-blog/create_posts.php">Add Post</a>
                        <a class="my-a-btn" href="/php-blog/posts.php">My Posts</a>
                        <a class="my-a-btn" href="/php-blog/user/logout.php">Logout</a>
                    <?php  } else { ?>
                        <a class="my-a-btn" href="/php-blog/user/login.php">Log In</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>