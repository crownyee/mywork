<?php
require_once('./connection.php');

$sql = "SELECT * FROM `myorder_history`;";
$result = mysqli_query($link, $sql);
$arr_users = [];

if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}

?>
 
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="shortcut icon" href="./assets/images/icon.png">
    <link rel="shortcut" type="text/css" href="print.css">
    <title>資料庫系統</title>
</head>

<body>
    <section class="header">
        <div class="logo">
        <i class="ri-menu-line icon icon-0 menu"></i>            
            <h2>ACHU<span>869</span></h2>                
        </div>
        <div class="search--notification--profile">
            <div class="search">
                <input type="text" placeholder="Search...">
                <button><i class="ri-search-2-line"></i></button>
            </div>
            <div class="notification--profile">
                <div class="picon lock">
                    <i class="ri-lock-line"></i>
                </div>
                <div class="picon bell">
                    <i class="ri-notification-2-line"></i>
                </div>
                <div class="picon chat">
                    <i class="ri-wechat-2-line"></i>
                </div>
                <div class="picon profile">
                    <img src="assets/images/profile.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <div class="sidebar">
        <ul class="sidebar--items">
                <li>
                    <a href="./Overview.php ">
                        <span class="icon icon-0"><i class="ri-app-store-line"></i></span>
                        <span class="sidebar--item">預覽 </span>
                    </a>
                </li>
                <li>
                    <a href="./ComWeb1.php">
                        <span class="icon icon-1    "><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">客戶基本資料介面</span>
                    </a>
                </li>
                <li>
                    <a href="./ComWeb2.php">
                        <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                        <span class="sidebar--item">客戶訂貨記錄</span>
                    </a>
                </li>
                <li>
                    <a href="./ComWeb3.php">
                        <span class="icon icon-3"><i class="ri-car-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">公司進貨資料</span>
                    </a>
                </li>   
                <li>
                    <a href="./ComWeb4.php">
                        <span class="icon icon-4"><i class="ri-line-chart-line"></i></span>
                        <span class="sidebar--item">公司應收帳款</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-5"><i class="ri-customer-service-line"></i></span>
                        <span class="sidebar--item">Support</span>
                    </a> 
                </li>
                <li>
                    <a href="./index.php">
                        <span class="icon icon-7"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div> 
        <div class="main--content">
            <div class="recent--patients">
                <div class="title">
                    <h2 class="section--title">訂貨歷史資料列表</h2>
                </div>
                <div class="table">
                <a class="btn btn-primary"href="./2_Create.php" role="button">新增訂單資料</a>
                <button onclick="window.print();" class="btn btn-primary">Print</button>
                <table id="usetTable" class="table">
                    <thead>
                    <th>身分證字號</th>
                    <th>訂單名字</th>
                    <th>訂單日期</th>
                    <th>單位</th>
                    <th>數量</th>
                    <th>單價</th>
                    <th>訂單價錢</th>
                    <th>供應商名字</th>
                    <th>供應商編號</th>
                    <th>預計遞交</th>
                    <th>實際遞交</th>
                    <th>退貨修正功能</th>
                    </thead>
                    <tbody>
                    <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $user) { ?>
                            <tr>
                                <td><?php echo $user['Id_card_number']; ?></td>
                                <td><?php echo $user['Order_name']; ?></td>
                                <td><?php echo $user['Order_date']; ?></td>
                                <td><?php echo $user['Unit']; ?></td>
                                <td><?php echo $user['Quantity']; ?></td>
                                <td><?php echo $user['Price']; ?></td>
                                <td><?php echo $user['Order_price']; ?></td>
                                <td><?php echo $user['Supplier_name']; ?></td>
                                <td><?php echo $user['Supplier_number']; ?></td>
                                <td><?php echo $user['Expected_delivery_date']; ?></td>
                                <td><?php echo $user['Actual_delivery_date']; ?></td>
                                <td><?php echo "
                                <a class='ri-edit-line edit' href='./2_Edit.php?ID=$user[ID]' ></a> 
                                <a class='ri-feedback-line delete' href='./2_return.php?ID=$user[ID]'></a>$user[consume]</a> 
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
    </section>
    <script src="assets/js/main.js"></script>
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