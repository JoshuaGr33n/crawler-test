<?php include_once("inc/header.php"); ?>
<body>
    <h2>Post Content to home page</h2>
    <form action="/post-content" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br><br>
        <label for="url">URL:</label>
        <input type="url" id="url" name="url" required>
        <br><br>
        <input type="submit" value="POST">
    </form>
</body>
<?php include_once("inc/footer.php"); ?>