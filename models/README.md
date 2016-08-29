*try {} catch (PDOException $e){}
	當出現異常的時候 catch會捕捉錯誤/異常的物件$e
	因為PDO(PDOException)發生錯誤的時候會主動拋出異常，所以function中不用特別設置
	如果程式碼無法主動拋出異常，則需要自己撰寫
	ex:
	try
	{
	    //code

	    if(!file_exists("Config.php"))
	    {
	        throw new Exception("Config.php not found!");
	    }//拋出異常/錯誤資訊

	    //code
	}
	catch(Exception $err)
	{
	    echo "出錯： ".$err->getMessage();
	}

	finally則是一定會被執行的區塊(不過我沒有用到)

*FOR UPDATE v.s. LOCK IN SHARE MODE

	http://imgur.com/a/deOeC
	↑操作過程

	當transaction開始時，SQL語法的表達方式是
	BEGIN;
	//sql statement
	COMMIT;

	    LOCK IN SHARE MODE
	    同樣使用共享鎖的連線可以同時SELECT到資料，如果一方UPDATE，則會發生等待的狀況，
	    直到其他連線也提交UPDATE(會產生衝突 dead lock)或是連線逾時(30秒)，產生衝突時先提交UPDATE的
	    一方可以完成指令，另一條連線則會被迫中止transaction，LOCK IN SHARE MODE成立複數
	    連線時，任何變動資料的動作都會產生等待，直到逾時或衝突發生(踢掉另一個transection連線)

	    FOR UPDATE
	    先連上伺服器並且在transection使用FOR UPDATE的連線即獲得row的使用權，此時
	    不論用 SELECT ... LOCK IN SHARE MODE 或是 FOR UPDATE 、UPDATE都要等待持有權的連線COMMIT

	在這兩種transection的方式下，其他連線都可以使用單純的SELECT，但是資料的變動只會
	發生在transection commit之後，也就是說在commit之前，其他所有連線的select都是未更
	動前的資料。


