<?php
require_once './connection.php';

$Id_card_number = $_GET["Id_card_number"];
$Client_name = "";
$Telephone_number = "";
$Address = "";
$Age = "";
$Job = "";
$Date_of_Registration = "";
$Consumption_status = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){


    if (!isset($_GET["Id_card_number"])) {
        header("location: ./ComWeb1.php");
        exit;
    }


    
    $Id_card_number = $_GET["Id_card_number"];

    $sql = "SELECT * FROM myclient WHERE Id_card_number='$Id_card_number'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("location: ./ComWeb1.php");
        exit;
    }     

    $Client_name = $row["Client_name"];
    $Id_card_number = $row["Id_card_number"];
    $Telephone_number = $row["Telephone_number"];
    $Address = $row["Address"];
    $Age = $row["Age"];
    $Job = $row["Job"];
    $Date_of_Registration = $row["Date_of_Registration"];
    $Consumption_status = $row["Consumption_status"];
    
}
else{

    $Client_name = $_POST["Client_name"];
    $Telephone_number = $_POST["Telephone_number"];
    $Address = $_POST["Address"];
    $Age = $_POST["Age"];
    $Job = $_POST["Job"];
    $Date_of_Registration = $_POST["Date_of_Registration"];
    $Consumption_status = $_POST["Consumption_status"];

    $name = $_FILES['photo']['name'];
    $temp = $_FILES['photo']['tmp_name'];
    $location="./uploads/";
    $image=$location.$name;

    $finalImage=$location.$name;

    move_uploaded_file($temp,$finalImage);
    do{
        if (empty($Client_name) || empty($Telephone_number) ||
            empty($Address) || empty($Age) || empty($Job) ||
            empty($Date_of_Registration) || empty($Consumption_status) || empty($image)){
            $errorMessage = "每一個欄位都必須填";
            break;
        }

        $sql =  "UPDATE myclient SET Client_name = '$Client_name',
                                     Telephone_number='$Telephone_number', Address='$Address',
                                     Age='$Age',Job='$Job',Date_of_Registration='$Date_of_Registration',
                                     Consumption_status='$Consumption_status',photo='$image' WHERE Id_card_number='$Id_card_number';";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            $errorMessage = "每一個欄位都必須填".mysqli_error($link);
            break;
        }

        $successMessage = "客戶已添加成功";
        header("location: ./ComWeb1.php");
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

        <h2>編輯客戶資料</h2>
        <form method = "post" enctype="multipart/form-data">
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">名字</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Client_name readonly='true' value="<?php echo $Client_name; ?> ">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">身分證字號</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Id_card_number readonly='true' value="<?php echo $Id_card_number; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">電話</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Telephone_number value="<?php echo $Telephone_number; ?>" >
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">住址</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Address value="<?php echo $Address; ?>" >
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">年齡</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Age value="<?php echo $Age; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">職業</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Job value="<?php echo $Job; ?>" >
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">註冊日期</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name=Date_of_Registration value="<?php echo $Date_of_Registration; ?>">
                </div>
            </div>
            <div class="row mb=3">
                <label class="col-sm-3 col-form-label">消費狀態</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name=Consumption_status value="<?php echo $Consumption_status; ?>">
                </div>
            </div>
            <div class="row mb=3">
                    <label class="col-sm-3 col-form-label">照片</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name=photo>
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
                    <a class="btn btn-outline-primary" href="./ComWeb1.php" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>