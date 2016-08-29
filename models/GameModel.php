<?php

class PaymentModel
{
    private static $connect;

    public function __construct()
    {
        self::$connect = new PDO(
            "mysql:host=localhost;dbname=payment;",
            Config::$paymentUser,
            Config::$paymentPWD
        );
        self::$connect->exec("SET CHARACTER SET utf8");
    }

    public function transaction($withdrawal, $deposit, $userId, $type)
    {
        $conn = self::$connect;
        $datetime = date ("Y-m-d H:i:s");

        try{
            $conn->beginTransaction();
            $balance = $conn->prepare("SELECT `balance` FROM `userDetail`
                WHERE `userId` = ? FOR UPDATE");
            $balance->bindParam(1, $userId, PDO::PARAM_INT);
            $balance->execute();
            $data = $balance->fetch(PDO::FETCH_ASSOC);

            //withdrawal 提款, $deposit 存款
            $newTotal = $data['balance'] - $withdrawal + $deposit;
            if ($newTotal < 0) {
                return '{"result":"餘額不足！"}';
            }

            $updateBalance = $conn->prepare("UPDATE `userDetail` SET `balance` = ?,
                `lastChange`= ? WHERE `userId` = ?");
            $updateBalance->bindParam(1, $newTotal, PDO::PARAM_INT);
            $updateBalance->bindParam(2, $datetime, PDO::PARAM_STR);
            $updateBalance->bindParam(3, $userId, PDO::PARAM_INT);
            $updateBalance->execute();

            $record = $conn->prepare("INSERT INTO `accountDetail` (`userId`,
                `type`, `withdrawal`, `deposit`, `balance`, `datetime`)
                VALUES (?, ?, ?, ?, ?, ?)");
            $record->bindParam(1, $userId, PDO::PARAM_INT);
            $record->bindParam(2, $type, PDO::PARAM_STR);
            $record->bindParam(3, $withdrawal, PDO::PARAM_INT);
            $record->bindParam(4, $deposit, PDO::PARAM_INT);
            $record->bindParam(5, $newTotal, PDO::PARAM_INT);
            $record->bindParam(6, $datetime, PDO::PARAM_STR);
            $record->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();

            return '{"result":"'.$e->getMessage().'<br>資料已回朔！"}';
        }

        return '{"result":"操作成功！"}';
    }

    public function listAllAccountDetail($userId)
    {
        $output = "";
        $conn = self::$connect;
        $result = $conn->prepare("SELECT * FROM `accountDetail`
            WHERE `userId` = ? ORDER BY `sNumber` DESC LIMIT 10");
        $result->bindParam(1, $userId, PDO::PARAM_INT);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $row) {
            $count="withdrawal";
            if ($row['withdrawal'] == 0) {
                $count="deposit";
            }

            $output .= "<tr>
                <td>" . $row['type'] . "</td><td>" . $row[$count] . "</td>
                <td>" . $row['balance'] . "</td><td>" . $row['datetime'] . "</td>
                </tr>";
        }

        return $output;
    }

    public function clearList($userId)
    {
        $conn = self::$connect;
        $deleteTestdata = $conn->prepare("DELETE FROM `accountDetail` WHERE `userId` = ?");
        $deleteTestdata->bindParam(1, $userId, PDO::PARAM_INT);
        $deleteTestdata->execute();

        return $deleteTestdata->rowCount();
    }
}
