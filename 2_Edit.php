<?php
require_once './connection.php';

$ID = $_GET["ID"];
$Order_name = "";
$consume = "";
$Id_card_number = "";
$errorMessage = "";
$successMessage = "";

$sql2 = "SELECT * FROM mycompany_income";
$result2 = mysqli_query($link,$sql2);


if ($_SERVER['REQUEST_METHOD'] == 'GET'){


    if (!isset($_GET["ID"])) {
        header("location: ./ComWeb2.php");
        exit;
    }

    $ID = $_GET["ID"];

    $sql = "SELECT * FROM myorder_history WHERE ID=$ID";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
 
    if (!$row) {
        header("location: ./ComWeb2.php");
        exit;
    }    

    $Id_card_number = $row["Id_card_number"];
    $Order_name = $row["Order_name"];
    $consume = $row["consume"];
    
}
else{

    $Id_card_number = $_POST["Id_card_number"];
    $Order_name = $_POST["Order_name"];
    $consume = $_POST["consume"];
    
    do{
        if (empty($Order_name) || empty($consume)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }

        $sql =  "UPDATE myorder_history SET Order_name = '$Order_name', consume='$consume' WHERE ID=$ID;";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $successMessage = "客戶退貨修正成功";
        header("location: ./ComWeb2.php");
        exit;

    } while(false);
}

?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>退貨資料管理</title>

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

        <h2>編輯客戶資料</h2>
        <form method = "post">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">訂單品名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Id_card_number value="<?php echo $Id_card_number; ?>" readonly="true">
                </div>  
            </div>
            
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">訂單品名</label>
                <div class="col-sm-6">
                <select name="Order_name" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                echo $Order_name;
                                if ($result2){
                                    while($row2=mysqli_fetch_assoc($result2)){
                                        $stname2 = $row2["Product_name"];
                                          echo "<option>$stname2 <br>  
                                                </option>";
                                    }
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">退貨價錢</label> 
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=consume value="<?php echo $consume; ?>">
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
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./ComWeb2.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>