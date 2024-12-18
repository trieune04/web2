<?php

session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Twelve Shop</title>
  <meta charset="utf-8">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
      .nav-link {
          color: white !important;
      }
      .nav-link:hover {
        color: #ffc108 !important;
      }
      .cart-amount {
        top: -13px;
        right: -10px;
        min-width: 20px;
        min-height: 20px;
        border-width: 2px;
        border-radius: 50%;
        font-size: 12px;
    }
    .p:hover {
    box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark sticky-top shadow-lg py-2">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="text-warning">Twelve Shop</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="product.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Giới Thiệu</a>
            </li>
            
          </ul>

          <form class="form-inline" method="get" action="search.php">
            <input style="width:250px; background:#D3D3D3" class="form-control-sm mr-sm-2 border-0" type="search" name="keyword"  placeholder="Tìm kiếm" aria-label="Search">
            <button class="btn my-sm-0 "><a class="text-light"><i class="fas fa-search"></i></i></a></button>
            <a href="cart.php" class="btn my-sm-0 border-0 bg-transparent text-light">
                <i class="fas fa-shopping-cart position-relative">
                <?php
                    
                    $total_price = 0;
                    $total_qty = 0;
                    if(isset($_SESSION['cart'])) {
                        foreach($_SESSION['cart'] as $value) {
                            $total_qty += $value["quantity"];
                            $total_price += (int)$value["price"]*$value["quantity"];
                        } 
                    }
                ?>
                <div class="cart-amount bg-warning position-absolute text-white d-flex justify-content-center align-items-center font-weight-bold">
                <span id="cart_amount"><?php echo $total_qty ?></span>
                </div></i>
            </a>
            <?php
            if(!isset($_SESSION['user_email'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("usernav.php");
            }
            ?>
          </form>
        </div>        
    </nav>
    
    <div class="jumbotron py-4" style="background: linear-gradient(#ecd8f2 50%, #beb6f2 50%);">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="font-weight-bold" style="color: #b888ff">
                        SALE OFF
                        <span style="color: #fbb419;">30%</span>
                    </h2>
                    <h1 class="font-weight-bold" style="color: #253b70;  text-shadow: 6px 6px #D3D3D3; font-size: 500%;">
                        <span>MERRY</span>
                        <span>CHRISTMAS</span>
                    </h1>
                    <a class="btn btn-primary rounded-0 border-0 p-2 px-4 mt-3" style="background-color: #FF6347;" href="product.php" role="button">Mua Ngay</a>
                </div>
                <div class="col-md-7">
                    <img src="img/nen-removebg-preview.png" style="height:400px;" class="text-right w-50 d-block m-auto">
                </div>
            </div>
            
        </div>
    </div>

    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
            <div class="toast bg-success font-weight-bold p-2 text-light">
                <div class="toast-body">
                        Sản Phẩm Đã Được Thêm Vào Giỏ Hàng
                </div>
            </div>
    </div>


    <!-- Sản phẩm mới -->
    <div class="container-fluid hpproduct text-center">
        <div class="row mt-4 mb-4">
            <div class="col-md-12 ">
                <h2 class="font-weight-bolder" style="color: #253b70;text-shadow: 3px 3px #D3D3D3">Sản Phẩm Mới</h2>
                <div class="row mt-0 mx-4 card-deck">
                <?php 

                    



                    
                    $i = 0;
                    $queryP = "SELECT * FROM SP LIMIT 4";

                    $resultP = $MyConn->query($queryP);



                    while($getP = mysqli_fetch_array($resultP)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo "admin/product_images/".$getP['HINHANH_SP'] ?>" class="card-img-top h-100 img-reponsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
            
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-warning"><i class="fas fa-money-bill"></i><span> </span><?php echo number_format($getP['GIA'],0,",","."); ?><span>đ</span></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-danger w-100 mt-auto text-white">Thêm Vào Giỏ Hàng</button>

                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
            </div>
        </div>
        <div id="newProduct" class="row mb-3 ml-4 mr-4">
        
        </div>
    </div>
    <!-- Sản phẩm bán chạy -->
    <div class="container-fluid hpproduct text-center">
            <div class="row mt-5 mb-4">
                <div class="col-md-12">
                    <h2 class="font-weight-bolder d-block" style="color: #253b70;text-shadow: 3px 3px #D3D3D3">Sản Phẩm Bán Chạy</h2>
                    <div class="row mt-0 mx-4 card-deck">
                <?php 

                    



                    
                    $i = 0;
                    $queryP = "SELECT SP.MA_SP, SP.TEN_SP, SP.HINHANH_SP, SP.GIA, SUM(CT_HOADON.SOLUONG) FROM SP, CT_HOADON WHERE SP.MA_SP = CT_HOADON.MA_SP GROUP BY MA_SP LIMIT 4";

                    $resultP = $MyConn->query($queryP);



                    while($getP = mysqli_fetch_array($resultP)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo "admin/product_images/".$getP['HINHANH_SP'] ?>" class="card-img-top h-100 img-reponsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-warning"><i class="fas fa-money-bill"></i><span> </span><?php echo number_format($getP['GIA'],0,",","."); ?><span>đ</span></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-danger w-100 mt-auto text-white">Thêm Vào Giỏ Hàng</button>

                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
                </div>
            </div>
        
        <div id="bestSeller" class="row mb-3 ml-4 mr-4">
            
        </div>
    </div>
    <!-- Maybe you like this-->
    <div class="container-fluid hpproduct text-center">
            <div class="row mt-5 mb-4">
                <div class="col-md-12 ">
                    <h2 class="font-weight-bolder" style="color: #253b70;text-shadow: 3px 3px #D3D3D3">Có Thể Bạn Sẽ Thích</h2>
                    <div class="row mt-0 mx-4 card-deck">
                <?php 

                    



                    
                    $i = 0;
                    $queryP = "SELECT * FROM SP ORDER BY RAND() LIMIT 4";

                    $resultP = $MyConn->query($queryP);



                    while($getP = mysqli_fetch_array($resultP)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo "admin/product_images/".$getP['HINHANH_SP'] ?>" class="card-img-top h-100 img-reponsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-warning"><i class="fas fa-money-bill"></i><span> </span><?php echo number_format($getP['GIA'],0,",","."); ?><span>đ</span></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-danger w-100 mt-auto text-white">Thêm Vào Giỏ Hàng</button>

                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
                </div>
            </div>
        <div id="recommend" class="row mb-3 ml-4 mr-4">
            
        </div>
    </div>
    
    <footer class="bg-secondary">
        <div class="container-fuild text-light">
            <div class="row card-deck pt-3">
                <div class="col-md-5 pr-0">
                    <div class="card border-0 bg-secondary ml-4">
                        <div class="card-header bg-secondary border-0"><h4>ĐỊA CHỈ</h4></div>
                        <div class="card-body border-0">
                            <p>273 An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
                <div class="col-md pl-0">
                    <div class="card border-0 bg-secondary ml-4">
                        <div class="card-header bg-secondary border-0"><h4>CHÍNH SÁCH & DỊCH VỤ</h4></div>
                        <div class="card-body border-0">
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-shipping-fast mr-2"></i>Vận chuyển</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-money-check-alt mr-2"></i>Thanh toán</a><br>
                            <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-exchange-alt mr-2"></i>Đổi trả</a>
                        </div>
                    </div>
                </div> 
                <div class="col-md">
                    <div class="card border-0 bg-secondary mx-0 ml-4">
                        <div class="card-header bg-secondary border-0"><h4>LIÊN HỆ</h4></div>
                        <div class="card-body border-0">
                            <p><i class="fas fa-phone-alt mr-2"></i>SĐT: 0123456789 <br>
                            <i class="fab fa-facebook"></i> Facebook: Twelve Shop <br>
                            <i class="fab fa-instagram"></i> Instagram: twelvefromsgu
                        </p>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </footer>













    <?php include("login_registry_modal.php"); ?>
    <script type="text/javascript" src="js/addCart.js"></script>

    
</body>
</html>