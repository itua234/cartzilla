<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    $product_id = 0;
    if(isset($_POST['product_id'])):
        $product_id = $user->escape_string($_POST['product_id']);
    endif;
    $sql = "SELECT * FROM products WHERE product_id='$product_id' LIMIT 1";
    $row = $user->details($sql);
    if($row):
        $detail = [
            'product_name' => $row['product_name'],
            'product_id' => $row['product_id'],
            'price' => $row['price'],
            'short_description' => $row['short_description'],
            'image_1' => $row['product_image'],
            'image_2' => $row['product_image2'],
            'image_3' => $row['product_image3']
        ];
    endif;
    $slick1 = '
        <div class="item-slick3 product-image-thumb" data-thumb="images/'.$row['product_image'].'">
            <div class="wrap-pic-w pos-relative">
                <img class="w-full product-image" src="images/'.$row['product_image'].'" alt="IMG-PRODUCT">

                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04 product-image-link" href="images/'.$row['product_image'].'">
                    <i class="fa fa-expand"></i>
                </a>
            </div>
        </div>
        ';
   
    $data = [
        'detail' => $detail,
        'slick1' => $slick1
    ];
    echo json_encode($data);
    exit;
?>