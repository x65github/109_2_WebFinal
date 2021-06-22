    <?php 
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");         
     ?>


    <div id="main">
    <h3>網頁說明</h3>

    <ol class="round">
        <li class="one">
            <h5>成立初衷</h5>
           希望能讓小說有好的成立介面
           #網站管理者的使用者名稱和密碼是儲存在Includes目錄的simplecms-config.php設定檔.
        </li>
        <li class="two">
            <h5>使用方式</h5>
             點選頁面來查看喜歡的作品，按擊下方的鈕即可下載該作品並在自己的電腦上進行遊戲
         </li>
        <li class="asterisk">
            <div class="visit">
                備註：此網站僅供109-2期末報告使用
            </div>
         </li>
    </ol>
    </div>

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>