<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
	include 'layout/header.php';
?>
    <div class="container m-t-80">
		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
					All Products
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
					Women
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
					Men
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
					Bag
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".shoes">
					Shoes
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".watches">
					Watches
				</button>
			</div>

			<div class="flex-w flex-c-m m-tb-10">
				<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
					<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
					<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Filter
				</div>

				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Search
				</div>
			</div>
				
			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">
					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>

					<input class="mtext-107 cl2 size-114 plh2 p-r-15 form-control" type="text" name="search-product" placeholder="Search">
				</div>	
			</div>
		</div>
        <div class="row" style="">
            <?php
				$query = "SELECT * FROM products LIMIT 16";
				$row = $user->query($query);
				if($row):
					while($array = $row->fetch_array()):
						?>
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item 
                                <?php 
									switch($array[5]):
										case "1":
											echo "watches";
										break;
										case "2":
											echo "shoes";
										break;
										case "3":
											echo "bags";
										break;
										case "4":
											echo "men";
										break;
										default:
											echo "women";
									endswitch;
								?>">
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img class="w-full" src="images/<?php echo $array[4]; ?>" alt="IMG-PRODUCT">
                                        <a href="" data-id="<?php echo $array[0]; ?>" class="block2-btn d-flex align-items-center justify-content-center fs-15 cl2 bg0 bor2 size-102 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Quick View
                                        </a>
                                    </div>
                                    <div class="block2-txt d-flex p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="product-detail.php?id=<?php echo $array[0]; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    <?php echo $array[1] ?>
                                                </a>

                                                <span class="stext-105 cl3">
                                                    <?php echo $array[2] ?>
                                                </span>
                                            </div>

                                            <div class="block2-txt-child2 flex-r p-t-3">
                                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                    <img class="w-h-20 icon-heart1 dis-block trans-04" src="images/icon/heart-01.png">
                                                    <img class="w-h-20 icon-heart2 dis-block trans-04 ab-t-l" src="images/icon/heart-02.svg">
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    endwhile;
                endif;
            ?>
        </div>
        <!-- Load more -->
		<div class="flex-c-m flex-w w-full p-t-45">
			<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Load More
			</a>
		</div>
    </div>
<?php include 'layout/footer.php'; ?>