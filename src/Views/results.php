<?php include_once("inc/header.php"); ?>
<body>
<a href="/admin">Admin Home</a>

    <h1><button class="button" >Trigger Crawl</button></h1>

    <div id="wrapper"><?php 
foreach ($results as $result): ?>
    <li><?= $result['title']; ?></li>
<?php endforeach ?></div>

</body>

<?php include_once("inc/footer.php"); ?>