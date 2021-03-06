﻿<?php
    require './model/Book.php';
?>

<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Chi tiết sản phẩm</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer js -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">

        <!-- Header -->
        <?php include('include/header.php'); ?>
        <!-- //Header -->
        <!-- Start Search Popup -->
        <?php include('include/search.php'); ?>
        <!-- End Search Popup -->

        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--default">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Chi tiết sản phẩm</h2>
                            <nav class="bradcaump-content">
                                <a class="breadcrumb_item" href="index.php">Trang chủ</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb_item active">Chi tiết sản phẩm</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <?php
							// No book found
							if (!isset($_SESSION['currentlyViewedBook']) || $_SESSION['currentlyViewedBook'] == null) {
								// header('location:404.php');
						?>
                        <div class="wn__single__product">
                            <div class="row">
                                <h1>Không tìm thấy sản phẩm yêu cầu!</h1>
                            </div>
                        </div>
                        <?php
							}
							else {
								// var_dump($_SESSION['currentlyViewedBook']);
								$currentBook = $_SESSION['currentlyViewedBook'];
						?>
                        <div class="wn__single__product">
                            <div class="row">
                                <div class="col-lg-6 col-12">


                                    <img style="width: 450px;height:565px;" src="<?=$currentBook->getImage()?>" alt="">
                                    <!-- <a href="2.jpg"><img src="images/product/2.jpg" alt=""></a>
													<a href="3.jpg"><img src="images/product/3.jpg" alt=""></a>
													<a href="4.jpg"><img src="images/product/4.jpg" alt=""></a>
													<a href="5.jpg"><img src="images/product/5.jpg" alt=""></a>
													<a href="6.jpg"><img src="images/product/6.jpg" alt=""></a>
													<a href="7.jpg"><img src="images/product/7.jpg" alt=""></a>
													<a href="8.jpg"><img src="images/product/8.jpg" alt=""></a> -->


                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="product__info__main">
                                        <h1><?php echo $currentBook->getTitle(); ?></h1>
                                        <div class="price-box">
                                            <span><?php echo $currentBook->getPrice(); ?>đ</span>
                                        </div>
                                        <div class="product__overview">
                                            <p>Tác giả: <?php echo $currentBook->getAuthor(); ?></p>
                                            <p>Nhà xuất bản: <?php echo $currentBook->getPublisher(); ?></p>
                                            <?php
                                                if($currentBook->getQuantity()==0):
                                            ?>
                                            <p class="text-danger">Đã Hết hàng</p>
                                            <?php else:?>
                                            <p>Số lượng trong kho: <?php echo $currentBook->getQuantity(); ?></p>
                                            <?php endif;?>
                                        </div>
                                        <form action="controller/addCart.php" method="get">
                                            <div class="box-tocart d-flex">
                                                <span>Số lượng</span>
                                                <input id="qty" class="input-text qty" name="quantity" min="1" max="<?php echo  $currentBook->getQuantity(); ?>" value="1" title="Số lượng" type="number">
                                                <input type="hidden" name="id" value="<?php echo $currentBook->getId();?>">
                                                <div class="addtocart__actions">
                                                    <button <?php
                                                        if($currentBook->getQuantity()==0){
                                                            echo "disabled ";
                                                            echo 'style="background:#7b7a7a; color: #b2b0b0;"';}?> class="tocart" type="submit" title="Thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
                                                </div>
                                                <div class="product-addto-links clearfix">
                                                    <!-- "Add to Wishlist" and "Compare" were here -->
                                                </div>
                                            </div>
                                        </form>
                                        <div class="product_meta">
                                            <span class="posted_in">Danh mục:
                                                <?php
                                                    $catDao = new CategoryDao();
                                                    $catList = $catDao->getCategoriesByBookId($currentBook->getId());

                                                    foreach ($catList as $category) {
                                                ?>
                                                <a href="controller/BookController.php?category=<?php echo $category->getId(); ?>">
                                                    <?php echo $category->getName(); ?>
                                                </a>
                                                <?php
                                                    }
                                                ?>

                                            </span>
                                        </div>
                                        <!-- <div class="product-share">
                                            <ul>
                                                <li class="categories-title">Chia sẻ :</li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-social-twitter icons"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-social-tumblr icons"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-social-facebook icons"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-social-linkedin icons"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__info__detailed">
                            <div class="pro_details_nav nav justify-content-start" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Chi tiết sản phẩm</a>
                                <!-- <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a> -->
                            </div>
                            <div class="tab__container">
                                <!-- Start Single Tab Content -->
                                <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                    <div class="description__attribute">
                                        <?php echo $currentBook->getDescription(); ?>
                                    </div>
                                </div>
                                <!-- End Single Tab Content -->
                                <!-- Start Single Tab Content -->
                                <!-- <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
											<div class="review__attribute">
												<h1>Customer Reviews</h1>
												<h2>Hastech</h2>
												<div class="review__ratings__type d-flex">
													<div class="review-ratings">
														<div class="rating-summary d-flex">
															<span>Quality</span>
															<ul class="rating d-flex">
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>

														<div class="rating-summary d-flex">
															<span>Price</span>
															<ul class="rating d-flex">
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>
														<div class="rating-summary d-flex">
															<span>value</span>
															<ul class="rating d-flex">
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>
													</div>
													<div class="review-content">
														<p>Hastech</p>
														<p>Review by Hastech</p>
														<p>Posted on 11/6/2018</p>
													</div>
												</div>
											</div>
											<div class="review-fieldset">
												<h2>You're reviewing:</h2>
												<h3>Chaz Kangeroo Hoodie</h3>
												<div class="review-field-ratings">
													<div class="product-review-table">
														<div class="review-field-rating d-flex">
															<span>Quality</span>
															<ul class="rating d-flex">
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>
														<div class="review-field-rating d-flex">
															<span>Price</span>
															<ul class="rating d-flex">
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>
														<div class="review-field-rating d-flex">
															<span>Value</span>
															<ul class="rating d-flex">
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
																<li class="off"><i class="zmdi zmdi-star"></i></li>
															</ul>
														</div>
													</div>
												</div>
												<div class="review_form_field">
													<div class="input__box">
														<span>Nickname</span>
														<input id="nickname_field" type="text" name="nickname">
													</div>
													<div class="input__box">
														<span>Summary</span>
														<input id="summery_field" type="text" name="summery">
													</div>
													<div class="input__box">
														<span>Review</span>
														<textarea name="review"></textarea>
													</div>
													<div class="review-form-actions">
														<button>Submit Review</button>
													</div>
												</div>
											</div>
										</div> -->
                                <!-- End Single Tab Content -->
                            </div>
                        </div>
                        <div class="wn__related__product pt--80 pb--50">
                            <?php include('include/module-related-product.php'); ?>

                            <?php include('include/module-best-seller-product.php'); ?>
                        </div>
                        <?php
							}
						?>
                    </div>
                    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                        <div class="shop__sidebar">
                            <!-- Categories -->
                            <?php include('include/widget-category.php'); ?>

                            <!-- Filter by price widget was here -->

                            <!-- Product tag section was here -->

                            <!-- Sales off -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End main Content -->

        <!-- Start Search Popup -->
        <?php include('include/search.php'); ?>
        <!-- End Search Popup -->

        <!-- Footer Area -->
        <?php include('include/footer.php'); ?>
        <!-- //Footer Area -->


        <!-- QUICKVIEW PRODUCT -->
        <!-- Quick views of related and best seller products are included in respective modules -->
        <!-- END QUICKVIEW PRODUCT -->

    </div>
    <!-- //Main wrapper -->


    <!-- JS Files -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>

</body>

</html>
