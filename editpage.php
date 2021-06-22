<?php
require_once ("Includes/session.php");
require_once ("Includes/simplecms-config.php");
require_once ("Includes/connectDB.php");
include("Includes/header.php");
#confirm_is_admin();
#confirm_is_writer();

$pageId = null;
$menulabel = null;
$content = null;
$link = null;
if(isset($_GET['id']))
{
    $pageId = $_GET['id'];
    $query = "SELECT menulabel, content, link FROM pages WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $pageId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('資料庫查詢錯誤: ' . $statement->error);
    }

    $pageExists = $statement->num_rows == 1;
    if ($pageExists)
    {
        $statement->bind_result($menulabel, $content, $link);
        $statement->fetch();
    }
    else
    {
        header("Location: index.php");
    }
}
else if (isset($_POST['submit']))
{
    $pageId = $_POST['pageId'];
    $menulabel = $_POST['menulabel'];
    $content = $_POST['content'];
    $link = $_POST['link'];
    $query = "UPDATE pages SET menulabel = ?, content = ?, link = ? WHERE Id = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('sssd', $menulabel, $content, $link, $pageId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('資料庫查詢錯誤: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        header ("Location: index.php");
    }
    else
    {
        echo '錯誤: 編輯頁面錯誤...';
    }
}
else
{
    header ("Location: index.php");
}
?>
<div id="main">

    <h1>編輯頁面</h1>
    <form action="editpage.php" method="post">
            <fieldset>
                <legend>編輯頁面</legend>
                <ol>
                    <li>
			<input type="hidden" id="pageId" name="pageId" value="<?php echo $pageId; ?>" />
                        <label for="menulabel">作品名稱:</label> 
                        <input type="text" name="menulabel" value="<?php echo $menulabel; ?>" id="menulabel" />
                    </li>
                    <li>
                        <label for="content">作品簡介:</label>
                        <textarea name="content" id="content"><?php echo $content; ?></textarea>
                    </li>
                    <li>
                        <label for="link">作品網址連結:</label> 
                        <input type="text" name="link" value="<?php echo $link; ?>" id="link" />
                    </li>
                </ol>
                <input type="submit" name="submit" value="更新" />
                <p>
                    <a href="index.php">取消</a>
                </p>
        </fieldset>
    </form>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>