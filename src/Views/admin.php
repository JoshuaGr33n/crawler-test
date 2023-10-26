<?php include_once("inc/header.php"); ?>

<body>
    Welcome <?= $_SESSION['user']; ?><br>
  <a href="/results">Results</a>
</body>
<?php include_once("inc/footer.php"); ?>