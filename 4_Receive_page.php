<?php
require_once('./connection.php');

$sql = "SELECT * FROM `mycompany_receive`;";
$result = mysqli_query($link, $sql);
$arr_users = [];

if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    
    <title>公司營收資訊管理</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='stylesheet' href="./assets/css/index.css">
    <link rel="shortcut icon" href="./assets/images/icon.png">
</head>

<body>
    <nav>
      <ul><li><a href="Com.php">返回公司管理首頁</a></li></ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="container-mt-8">
                <div class="row">
                    <div class="container-mt-8">
                        <h2>客戶訂單列表</h2>
                        <a class="btn btn-primary"href="./4_Create.php" role="button">新增客戶資料</a>
                    </div>
                    <div class="container-mt-8">
                    <div class=container-md-8>
                    <table id="usetTable" class="table">
                    <thead>
                    <th>ID</th>
                    <th>客戶姓名</th>
                    <th>身分證字號</th>
                    <th>應收金額</th>
                    <th>應收日期</th>
                    <th>待催收金額</th>
                    <th>客戶編輯刪除功能</th>
                    </thead>
                    <tbody>
                    <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $user) { ?>
                            <tr>
                                <td><?php echo $user['ID']; ?></td>
                                <td><?php echo $user['Client_name']; ?></td>
                                <td><?php echo $user['Id_card_number']; ?></td>
                                <td><?php echo $user['Receivable_amount']; ?></td>
                                <td><?php echo $user['Receivable_date']; ?></td>
                                <td><?php echo $user['Pending']; ?></td>
                                <td><?php echo "<a class='btn btn-primary btn-sm' href='./4_Edit.php?ID=$user[ID]' >編輯客戶資料</a> 
                                                <a class='btn btn-danger btn-sm' href='./4_Delete.php?ID=$user[ID]' >刪除客戶資料</a> 
                                    ";?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script>
        $(document).ready(function() {
            $('#usetTable').DataTable();
        } );
    </script>
</body>
</html>