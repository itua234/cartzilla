<?php 
    session_start();
    include 'layout/header.php';
    //connect to database
    include 'Functions.php';
	$user = new User();
	if(isset($_POST['sess-delete'])):
		session_destroy();
	endif;
?>
  <!--<section class="container" style="border:2px solid red;">
    <div class="smart-gallery">
      <a href="images/slide-01.jpg">Open image 1</a>
      <a href="images/slide-02.jpg">Open image 2</a>
      <a href="images/slide-03.jpg">Open image 3</a>
    </div>
  </section>-->

    <!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<?php
					$query = "SELECT * FROM slider";
					$row = $user->query($query);
					if($row){
						while($array = $row->fetch_array()){
							?>	
							<div class="item-slick1" style="background-image: url(images/<?php echo $array[1];?>);">
								<div class="container h-full">
									<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
										<div class="layer-slick1 animated visible-false" data-appear="<?php echo $array[5]; ?>" data-delay="0">
											<span class="ltext-101 cl2 respon2">
												<?php echo $array[2]; ?>
											</span>
										</div>
											
										<div class="layer-slick1 animated visible-false" data-appear="<?php echo $array[6]; ?>" data-delay="800">
											<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
												<?php echo $array[3]; ?>
											</h2>
										</div>
											
										<div class="layer-slick1 animated visible-false" data-appear="<?php echo $array[7]; ?>" data-delay="1600">
											<a href="products.php" class="btn btn-primary flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
												<?php echo $array[4]; ?>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</section>
	<!--<form method="post" action="">
					<button class="btn btn-primary" type="submit" name='sess-delete'>Delete sessions</button>
					</form>-->
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-center p-b-15 p-t-40 bg-faded-primary">
                <span class="media d-block m-b-15"><img class="w-h-30" src="images/footer/edit.svg"></span>
                <h5>Read the blog</h5>
                <p class="fs-12 m-t--10">Latest store, fashion news and trends</p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 text-center p-b-15 p-t-40 bg-faded-accent">
                <span class="media d-block m-b-15"><img class="w-h-30" src="images/footer/instagram.svg"></span>
                <h5>Follow on Instagram</h5>
                <p class="fs-12 m-t--10">#ShopWithCartzilla</p>
            </div>
        </div>
    </div>
</section>
<div class="container p-t-20">
	<div class="row" style="">
		<?php
			$query = "SELECT * FROM products LIMIT 16";
			$row = $user->query($query);
			if($row):
				while($array = $row->fetch_array()):
					?>
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
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
<!-- Blog -->
<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Our Blogs
				</h3>
			</div>

			<div class="row">
				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="blog-detail.html">
								<img src="images/blog-01.jpg" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										Nancy Ward
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										July 22, 2017 
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
									8 Inspiring Ways to Wear Dresses in the Winter
								</a>
							</h4>

							<p class="stext-108 cl6">
								Duis ut velit gravida nibh bibendum commodo. Suspendisse pellentesque mattis augue id euismod. Interdum et male-suada fames
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="blog-detail.html">
								<img src="images/blog-02.jpg" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										Nancy Ward
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										July 18, 2017
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
									The Great Big List of Men’s Gifts for the Holidays
								</a>
							</h4>

							<p class="stext-108 cl6">
								Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit ame
							</p>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="blog-detail.html">
								<img src="images/blog-03.jpg" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										Nancy Ward
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										July 2, 2017 
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
									5 Winter-to-Spring Fashion Trends to Try Now
								</a>
							</h4>

							<p class="stext-108 cl6">
								Proin nec vehicula lorem, a efficitur ex. Nam vehicula nulla vel erat tincidunt, sed hendrerit ligula porttitor. Fusce sit amet maximus nunc
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'layout/footer.php'; ?>