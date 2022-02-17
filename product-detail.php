<?php 
	session_start();	
	//connect to database
	include 'Functions.php';
	$user = new User();
	$product_id = $_GET['id'];
	$query = "SELECT * FROM products WHERE product_id='$product_id' LIMIT 1";
	$array = $user->details($query);
	if($array):
		$product_name = $array[1];
		$product_image = $array[4];
		$price = $array[2];
		$total_stock = $array[3];
		$category_id = $array[5];
	endif;
	$error = array();
	if(isset($_POST['submit_review'])):
		$name = $user->escape_string($_POST['name']);
		$email = $user->escape_string($_POST['email']);
		$review = $user->escape_string($_POST['review']);
		$rating = $user->escape_string($_POST['rating']);
		$rating = (int)$rating;

		if(empty($name)):
			$error['name'] = "This field is required";
		else:
			$name = $user->test_input($name);
		endif;

		if(empty($email)):
			$error['email'] = "This field is required";
		else:
			$email = $user->test_input($email);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
				$errors['email'] = "Invalid email format";
			endif;
		endif;

		if(empty($review)):
			$error['review'] = "This field is required";
		else:
			$review = $user->test_input($review);
		endif;

		if($rating === 0):
			$error['rating'] = "This field is required";
		else:
			$rating = $user->test_input($rating);
		endif;

		$date = "";
		if(count($error) == 0):
			$sql = "INSERT INTO product_reviews (review_id, product_id, name, email, message, rating) VALUES (NULL, '$product_id', '$name', '$email', '$review', '$rating')";
			$result = $user->insert($sql);
			if($result):
				echo "review has been made";
			endif;
		endif;
	endif;
	include 'layout/header.php';
?>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
                                <?php
                                    $query = "SELECT * FROM products WHERE product_id='$product_id' LIMIT 1";
									$row = $user->query($query);
                                    if($row):
                                        while($array = $row->fetch_array()):
                                            ?>
                                                <div class="item-slick3" data-thumb="images/<?php echo $array[4]; ?>">
                                                    <div class="wrap-pic-w pos-relative">
                                                        <img class="w-full" src="images/<?php echo $array[4]; ?>" alt="IMG-PRODUCT">

                                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/<?php echo $array[4]; ?>">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                    </div>
												</div>
											<?php
												if(!is_null($array[7])):
													?>
														<div class="item-slick3" data-thumb="images/<?php echo $array[7]; ?>">
															<div class="wrap-pic-w pos-relative">
																<img class="w-full" src="images/<?php echo $array[7]; ?>" alt="IMG-PRODUCT">

																<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/<?php echo $array[7]; ?>">
																	<i class="fa fa-expand"></i>
																</a>
															</div>
														</div>
													<?php
												endif;
												if(!is_null($array[8])):
													?>
														<div class="item-slick3" data-thumb="images/<?php echo $array[8]; ?>">
															<div class="wrap-pic-w pos-relative">
																<img class="w-full" src="images/<?php echo $array[8]; ?>" alt="IMG-PRODUCT">

																<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/<?php echo $array[8]; ?>">
																	<i class="fa fa-expand"></i>
																</a>
															</div>
														</div>
													<?php
												endif;
                                        endwhile;
                                    endif;
                                ?>
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $product_name; ?>
						</h4>

						<span class="mtext-106 cl2">
							$<?php echo $price; ?>
						</span>

						<p class="stext-102 cl3 p-t-23">
							Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
						</p>
						
						<!--  -->
						<!--<form class="" action="" method="post">-->
							<form class="add_to_cart_form p-t-33" action="" method="post">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>
								
									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="size">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="color">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
										<input type="hidden" name="product_id" value="<?=$product_id?>">
										<button type="submit" name="sub_item" style="border:none;" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
										<span class="demos"></span>
									</div>
								</div>	
							</form>
						<!--</form>-->

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews 
								<?php
									$sql = "SELECT count(*) as cnt FROM product_reviews WHERE product_id='$product_id'";
									$row = $user->details($sql);
									if($row):
										echo "(".$row['cnt'].")";
									endif;
								?>
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Weight
											</span>

											<span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

											<span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>

											<span class="stext-102 cl6 size-206">
												60% cotton
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

											<span class="stext-102 cl6 size-206">
												Black, Blue, Grey, Green, Red, White
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

											<span class="stext-102 cl6 size-206">
												XL, L, M, S
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<?php 
											$sql = "SELECT * FROM product_reviews WHERE product_id='$product_id'";
											$query = $user->query($sql);
											if($query):
												while($row = $query->fetch_array()):
													?>
														<div class="flex-w flex-t p-b-68">
															<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
																<img src="images/avatar-01.jpg" alt="AVATAR">
															</div>

															<div class="size-207">
																<div class="flex-w flex-sb-m p-b-17">
																	<span class="mtext-107 cl2 p-r-20">
																		<?php echo $row['name']; ?>
																	</span>

																	<span class="fs-18 cl11">
																		<?php 
																			if($row['rating'] == "1"):
																				?>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																				<?php
																			elseif($row['rating'] == "2"):
																				?>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																				<?php
																			elseif($row['rating'] == "3"):
																				?>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																				<?php
																			elseif($row['rating'] == "4"):
																				?>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star-outline"></i>
																				<?php
																			else:
																				?>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																					<i class="zmdi zmdi-star"></i>
																				<?php
																			endif;
																		?>
																		
																		<!--<i class="zmdi zmdi-star-half"></i>-->
																	</span>
																</div>

																<p class="stext-102 cl6">
																	<?php echo $row['message']; ?>
																</p>
															</div>
														</div>
													<?php
												endwhile;
											endif;
										?>

										
										
										<!-- Add review -->
										<form class="w-full" action="" method="post">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
												<span class="error fs-10">
													<?php 
														if(isset($rating_err)):
															echo $rating_err;
														endif;
													?>
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>

											<button type="submit" style="border:none;" name="submit_review" class="submit_review flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: JAK-01
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Categories: Jacket, Men
			</span>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					<?php
						$query = "SELECT * FROM products WHERE category_id='$category_id' AND product_id!='$product_id' LIMIT 8";
						$row = $user->query($query);
						if($row):
							while($array = $row->fetch_array()):
								?>
									<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
										<!-- Block2 -->
										<div class="block2">
											<div class="block2-pic hov-img0">
												<img src="images/<?php echo $array[4] ?>" alt="IMG-PRODUCT">

												<a href="" data-id="<?php echo $array[0]; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
													Quick View
												</a>
											</div>

											<div class="block2-txt flex-w flex-t p-t-14">
												<div class="block2-txt-child1 flex-col-l ">
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
			</div>
		</div>
	</section>
	<?php include 'layout/footer.php'; ?>