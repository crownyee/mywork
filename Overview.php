<?php
require_once('./connection.php');

$sql = "SELECT * FROM `myclient`;";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="shortcut icon" href="./assets/images/icon.png">
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
            <div class="overview">
                <div class="title">
                    <h2 class="section--title"><p class="text-dark">預覽</p></h2>
                    <select name="date" id="date" class="dropdown">
                        <option value="today">Today</option>
                        <option value="lastweek">Last Week</option>
                        <option value="lastmonth">Last Month</option>
                        <option value="lastyear">Last Year</option>
                        <option value="alltime">All Time</option>
                    </select>
                </div>
                <div class="cards">
                    <div class="card card-1">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">客戶人數</h5>
                                <h1>
                                <i class="ri-bar-chart-fill card--icon stat--icon"></i>
                                <?php
                                    $people = "SELECT * from `myclient` where ID";
                                    $peopleresult = mysqli_query($link, $people);
                                    $count=0;
                                    if ($result-> num_rows > 0){
                                        while ($people_row=$peopleresult-> fetch_assoc()) {
                                
                                            $count=$count+1;
                                        }
                                    }
                                    echo $count;
                                ?>
                                </h1>
                            </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                        <div class="card--stats">
                        <span>
                        <i class="ri-arrow-up-s-fill card--icon up--arrow">正常
                        <?php
                            $stay = "SELECT * from `myclient` where Consumption_status='正常'";
                            $stayresult = mysqli_query($link, $stay);
                            $count=0;
                            if ($result-> num_rows > 0){
                                while ($stay_row=$stayresult-> fetch_assoc()) {
                        
                                    $count=$count+1;
                                }
                            }
                            echo $count;
                        ?>
                        </i>
                        </span>
                        <span>
                        <i class="ri-arrow-down-s-fill card--icon down--arrow">停用
                        <?php
                            $stop = "SELECT * from `myclient` where Consumption_status='停用'";
                            $stopresult = mysqli_query($link, $stop);
                            $count=0;
                            if ($result-> num_rows > 0){
                                while ($stop_row=$stopresult-> fetch_assoc()) {
                                    $count=$count+1;
                                }
                            }
                            echo $count;
                        ?>
                        </i>
                        </span>

                        </div>
                    </div>
                    <div class="card card-2">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">客戶平均年齡</h5>
                                <h1>
                                <i class="ri-bar-chart-fill card--icon stat--icon"></i>
                                <?php
                                $Avgage = "SELECT AVG(Age) AS myage from `myclient` ";
                                $Avgageresult = mysqli_query($link, $Avgage);
                                while ($age_row = mysqli_fetch_assoc($Avgageresult)){
                                    echo round($age_row['myage'],2);
                                }
                                ?>
                                </h1>
                            </div>
                            <i class="ri-pages-line card--icon--lg"></i>
                        </div>
                    </div>
                    <div class="card card-3">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">訂貨總金額</h5>
                                <h1>
                                <i class="ri-exchange-dollar-fill card--icon stat--icon"></i>
                                <?php 
                                $money = "SELECT SUM(Receivable_amount) AS Sumoney from `mycompany_receive` ";
                                $pending = "SELECT SUM(Pending) AS sumpend from `mycompany_receive` ";
                                $money_result = mysqli_query($link, $money);
                                $pend_result  = mysqli_query($link, $pending);
                                while ($money_row=mysqli_fetch_assoc($money_result)){
                                    $pend_row=mysqli_fetch_assoc($pend_result);
                                    echo round($money_row['Sumoney']- $pend_row['sumpend']);
                                }
                                ?>
                                </h1>
                            </div>
                            <i class="ri-money-dollar-box-line card--icon--lg"></i>
                        </div>
                    </div>

                    <div class="card card-4">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">訂單數量</h5>
                                <h1>
                                <i class="ri-boxing-line card--icon stat--icon"></i>
                                <?php
                                    $orderr = "SELECT * from `myorder_history`";
                                    $orderresult = mysqli_query($link, $orderr);
                                    $count=0;
                                    while($row3=mysqli_fetch_assoc($orderresult)){
                                        if($row3['Order_name'] != "退費"){
                                            $count=$count+1;
                                        }
                                    }
                                    echo $count;
                                ?>  
                                </h1>
                            </div>
                            <i class="ri-bookmark-fill card--icon--lg"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>