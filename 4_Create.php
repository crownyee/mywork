<?php
require_once './connection.php';
                    
$Client_name = "";
$Id_card_number = "";
$Receivable_amount = "";
$Receivable_date = "";
$Pending = "";

$errorMessage = "";
$successMessage = "";

$sql2 = "SELECT * FROM myclient";
$result2 = mysqli_query($link,$sql2);
$result3 = mysqli_query($link,$sql2);

$sql3 = "SELECT * FROM myorder_history";
$result4 = mysqli_query($link,$sql3);
$result3 = mysqli_query($link,$sql3);


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $Id_card_number = $_POST['Id_card_number'];
    $Receivable_amount = $_POST['Receivable_amount'];
    $Receivable_date = $_POST['Receivable_date'];
    $Pending = $_POST['Pending'];


    $sqlr = "SELECT * FROM `myclient` WHERE Id_card_number='$Id_card_number'";
    $nameres = mysqli_query($link,$sqlr);
    $namerow=mysqli_fetch_assoc($nameres);
    $Client_name = $namerow['Client_name'];

    do{

        if (empty($Id_card_number) || empty($Receivable_amount) ||
            empty($Receivable_date) || empty($Pending)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }

        $sql = "INSERT INTO mycompany_receive (Client_name,Id_card_number,Receivable_amount,Receivable_date,Pending)". 
                            "VALUES ('$Client_name','$Id_card_number','$Receivable_amount','$Receivable_date',
                                     '$Pending')";

                    
        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $Id_card_number = "";
        $Receivable_amount = "";
        $Receivable_date = "";
        $Pending = "";

        $successMessage = "客戶已添加成功";
        
        header("location: ./ComWeb4.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>資料管理系統</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='stylesheet' href="./assets/css/index.css">
    <link rel="shortcut icon" href="./assets/images/icon.png">

</head>

<body>
    <div class="container my-5">

        <?php
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <h2>新增客戶資料</h2>
        <form method = "post">

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">身分證字號</label>
                <div class="col-sm-6">
                    <select name="Id_card_number" name="Order_name" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result3){
                                    while($row3=mysqli_fetch_assoc($result3)){
                                        if($row3["Order_name"] != "退費"){
                                            $stname3 = $row3["Id_card_number"];
                                            echo "<option>$stname3 <br></option>";
                                        } 
                                    }

                                }


                            ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">應收金額</label>
                <div class="col-sm-6">
                    <select name="Receivable_amount" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result4){
                                    while($row4=mysqli_fetch_assoc($result4)){
                                        if($row4["Order_name"] != "退費"){
                                            $stname4 = $row4["Order_price"];
                                            echo "<option>$stname4 <br></option>";
                                        }   
                                    }
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>


            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">應收日期</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name=Receivable_date value="<?php echo $Receivable_date; ?>">
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">待催收金額</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Pending value="<?php echo '0.00'; ?>" >
                </div>
            </div>

            <?php
            if (!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                "; 
            }
            ?>

            <div class="row mb=3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">送出</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./ComWeb4.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>