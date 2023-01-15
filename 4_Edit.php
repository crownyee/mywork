<?php
require_once './connection.php';

$ID = $_GET["ID"];
$Client_name = "";
$Id_card_number = "";
$Receivable_amount = "";
$Receivable_date = "";
$Pending = "";

$sql2 = "SELECT * FROM myclient";
$result2 = mysqli_query($link,$sql2);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){


    if (!isset($_GET["ID"])) {
        header("location: ./ComWeb4.php");
        exit;
    }

    $ID = $_GET["ID"];

    $sql = "SELECT * FROM mycompany_receive WHERE ID='$ID'";
    $result = mysqli_query($link, $sql);    
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("location: ./ComWeb4.php");
        exit;
    }    

    $Client_name = $row["Client_name"];
    $Id_card_number = $row["Id_card_number"];
    $Receivable_amount = $row["Receivable_amount"];
    $Receivable_date = $row["Receivable_date"];
    $Pending = $row["Pending"];
    
}
else{

    $Client_name = $_POST["Client_name"];
    $Id_card_number = $_POST["Id_card_number"];
    $Receivable_amount = $_POST["Receivable_amount"];
    $Receivable_date = $_POST["Receivable_date"];
    $Pending = $_POST["Pending"];
    
    do{
        if ( empty($Id_card_number) || empty($Receivable_amount) ||
            empty($Receivable_date) || empty($Pending)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }

        $sql =  "UPDATE mycompany_receive SET Client_name = '$Client_name', Id_card_number='$Id_card_number',
                Receivable_amount = '$Receivable_amount', Receivable_date = '$Receivable_date',
                Pending = '$Pending' WHERE ID=$ID ";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $successMessage = "客戶退貨修正成功";
        header("location: ./ComWeb4.php");
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

        <div class="row mb=3">
                <label class="col-sm-3 col-form-label">客戶姓名</label>
                <div class="col-sm-6">
                    <select name="Client_name" class="form-select form-select-sm-3" aria-label=".form-select-lg example">
                        <option>
                            <?php 
                                if ($result2){
                                    while($row2=mysqli_fetch_assoc($result2)){
                                        if($row2['Id_card_number'] == $Id_card_number){
                                            $stname2 = $row2["Client_name"];
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
                <label class="col-sm-3 col-form-label">身份證字號</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control"readonly='true' name=Id_card_number value="<?php echo $Id_card_number; ?>">
                </div>
            </div>

            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">應收金額</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Receivable_amount value="<?php echo $Receivable_amount; ?>">
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
                    <input type="text" class="form-control" name=Pending value="<?php echo $Pending; ?>" >
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
                    <a class="btn btn-outline-primary" href="./ComWeb4.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>