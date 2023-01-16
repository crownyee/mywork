<?php
require_once './connection.php';
                    
$Id_card_number = "";
$Order_name = "";
$Order_date = "";
$Unit = "";
$Quantity = ""; 
$Price = "";
$Supplier_number = "";
$Expected_delivery_date = "";
$Actual_delivery_date = "";

$errorMessage = "";
$successMessage = "";

$sql2 = "SELECT * FROM myclient";
$result2 = mysqli_query($link,$sql2);
$result5 = mysqli_query($link,$sql2);

$sql3 = "SELECT * FROM mycompany_income";
$result3 = mysqli_query($link,$sql3);
$result4 = mysqli_query($link,$sql3);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $Id_card_number = $_POST['Id_card_number'];
    $Order_date = $_POST['Order_date'];
    $Order_name = $_POST['Order_name'];
    $Unit = $_POST['Unit'];
    $Quantity = $_POST['Quantity'];
    $Price = $_POST['Price'];
    $Supplier_number = $_POST['Supplier_number'];
    $Expected_delivery_date = $_POST['Expected_delivery_date'];
    $Actual_delivery_date = $_POST['Actual_delivery_date'];
 
    $sqli = "SELECT * FROM `mycompany_income` WHERE Supplier_number='$Supplier_number'";
    $nameres = mysqli_query($link,$sqli);
    $namerow=mysqli_fetch_assoc($nameres);
    $Supplier_name = $namerow['Supplier_name'];

    do{
        if (empty($Id_card_number) || empty($Order_date) ||
            empty($Order_name) || empty($Unit) || empty($Quantity) || 
            empty($Price) || empty($Supplier_name) || empty($Supplier_number) ||
            empty($Expected_delivery_date) || empty($Actual_delivery_date)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }
        $sql = "INSERT INTO myorder_history (Id_card_number,Order_name,Order_date,Unit,Quantity,Price,
                            Supplier_name,Supplier_number,Expected_delivery_date,Actual_delivery_date)" . 
                            "VALUES ('$Id_card_number','$Order_name','$Order_date', '$Unit','$Quantity','$Price',
                            '$Supplier_name','$Supplier_number','$Expected_delivery_date','$Actual_delivery_date')";
    
        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $ID = "";
        $Id_card_number = "";
        $Order_name = "";
        $Order_date = "";
        $Unit = "";
        $Quantity = "";
        $Price = "";
        $Supplier_number = "";
        $Expected_delivery_date = "";
        $Actual_delivery_date = "";

        $successMessage = "客戶已添加成功";
        
        header("location: ./ComWeb2.php");
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
        <h2>新增客戶歷史資料</h2>
        <form method = "post">
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">身分證字號</label>
                <div class="col-sm-6">
                    <select name="Id_card_number" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result2){
                                    while($row2=mysqli_fetch_assoc($result2)){
                                        if($row2["Consumption_status"]=="正常"){
                                            $stname2 = $row2["Id_card_number"];
                                            echo "<option>$stname2 <br></option>";                                          
                                        }
                                    }
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">訂單品名</label>
                <div class="col-sm-6">
                    <select name="Order_name" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result3){
                                    while($row3=mysqli_fetch_assoc($result3)){
                                        $stname3 = $row3["Product_name"];
                                        echo "<option>$stname3 <br></option>";
                                    }
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">訂單日期</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name=Order_date value="<?php echo $Order_date; ?>">
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">單位</label>
                <div class="col-sm-6">
                    <select name="Unit" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option selected>公斤
                        <option >公克 <br></option>;
                    </select>
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">數量</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Quantity value="<?php echo $Quantity; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">單價</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Price value="<?php echo $Price; ?>">
                </div>
            </div> 

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">供應商編號</label>
                <div class="col-sm-6">
                    <select name="Supplier_number" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result4){
                                    while($row4=mysqli_fetch_assoc($result4)){
                                        $stname4 = $row4["Supplier_number"];
                                        echo "<option>$stname4 <br></option>";
                                    }
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">預計遞交</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name=Expected_delivery_date value="<?php echo $Expected_delivery_date; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">實際遞交</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name=Actual_delivery_date value="<?php echo $Actual_delivery_date; ?>">
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
                    <button type="submit" class="btn btn-primary" >送出</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./ComWeb2.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>