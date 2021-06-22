<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 
?>

<div id="main">
    <?php
        $pageid = $_GET['pageid'];
        $query = 'SELECT menulabel, content, link FROM pages WHERE id = ? LIMIT 1';
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $pageid);
        $statement->execute();
        $statement->store_result();
        if ($statement->error)
        {
            die('資料庫查詢錯誤: ' . $statement->error);
        }

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($menulabel, $content, $link);
            $statement->fetch();
            echo "<p><h2>作品名稱：$menulabel</h2></p>";
            echo "<p><h4>作品簡介：</h4><br>$content</p>";
            echo "<a href='$link' target='_blank'>作品網址：$link</a>";
        }
        else
        {
            echo '頁面沒有找到...';
        }
    ?>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php 
    include ("Includes/footer.php");
 ?>