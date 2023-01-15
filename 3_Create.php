<?php
require_once './connection.php';
                    

$Supplier_name = ""; 
$Supplier_number = "";
$Supplier_r_people = "";
$Product_name = "";
$Source = "";
$Specification = "";
$Import_Unit = "";
$Import_Price = "";
$Quantity = "";
#$Subtotal = "0";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $Supplier_name = $_POST['Supplier_name'];
    $Supplier_number = $_POST['Supplier_number'];
    $Supplier_r_people = $_POST['Supplier_r_people'];
    $Product_name = $_POST['Product_name'];
    $Source = $_POST['Source'];
    $Specification = $_POST['Specification'];
    $Import_Unit = $_POST['Import_Unit'];
    $Import_Price = $_POST['Import_Price'];
    $Quantity = $_POST['Quantity'];
    #$Subtotal = $_POST['Subtotal'];


    do{
        #Subtotal
        if (empty($Supplier_name) || empty($Supplier_number) || empty($Supplier_r_people) ||
            empty($Product_name) || empty($Source) || empty($Specification) ||
            empty($Import_Unit) || empty($Import_Price) || empty($Quantity)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }

        #Subtotal
        $sql = "INSERT INTO mycompany_income (Supplier_name,Supplier_number,Supplier_r_people,Product_name,Source,
                                      Specification,Import_Unit,Import_Price,Quantity)" . 
                            "VALUES ('$Supplier_name','$Supplier_number','$Supplier_r_people','$Product_name',
                                     '$Source','$Specification','$Import_Unit','$Import_Price','$Quantity')";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $Supplier_name = "";
        $Supplier_number = "";
        $Supplier_r_people = "";
        $Product_name = "";
        $Source = "";
        $Specification = "";
        $Import_Unit = "";
        $Import_Price = "";
        $Quantity = "";
        #$Subtotal = "";

        $successMessage = "商品已添加成功";
        
        header("location: /mywork/ComWeb3.php");
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

        <h2>新增商品資料</h2>
        <form method = "post">
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">供應商名稱</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Supplier_name value="<?php echo $Supplier_name; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">供應商編號</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Supplier_number value="<?php echo $Supplier_number; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">負責人</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Supplier_r_people value="<?php echo $Supplier_r_people; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">品名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Product_name value="<?php echo $Product_name; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">貨源</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Source value="<?php echo $Source; ?>" >
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">品級</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Specification value="<?php echo $Specification; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">進口單位</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Import_Unit value="<?php echo $Import_Unit; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">進貨價格</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Import_Price value="<?php echo $Import_Price; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">數量</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Quantity value="<?php echo $Quantity; ?>">
                </div>
            </div>
            <?php
            
            /*
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">小計</label>
                <div class="col-sm-6">
                    <input type="text" class="iprice" name=Subtotal value="0" readonly="true">
                </div>
            </div>
            */
            ?>

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
                    <a class="btn btn-outline-primary" href="./ComWeb3.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>