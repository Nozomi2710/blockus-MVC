<ul>
<li>App.php</li>
<p>修正get url後直接尋找$url[0] . Controller會產生的問題，改為只有指定的Controller才能讀取，避免太多的資料被閱讀</p>
<li>Config.php</li>
<p>移除非必要的靜態參數，全域設定挪到Config中</p>
<li>Controller.php</li>
<p>修正撰寫格式</p>
</ul>