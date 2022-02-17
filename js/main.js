(function ($) {
    "use strict";

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1){
            $(this).next().val(numProduct - 1);
        }
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Search product ]*/
    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    
     /*==================================================================
     [Load total cart quantity and price]*/
        $(document).ready(function(){
            $.ajax({
				type:'post',
				url:'load_quantity_&_price.php',
				data:{},
				dataType:'json'
			})
			//using the done promise callback
			.done(function(data){
                if(data){
                    $('.cart-total-quantity').text(data.cart_total_quantity);
                    $('.cart-total-price').text("$" + data.cart_total_price);
                }
			});
        });

     /*==================================================================
    [ Remove cart item ]*/
    $('.js-remove-cart-item').on('click',function(e){
        e.preventDefault();
        var product_id = $(this).data("id");
        var item_remove_btn = $(this);
        //start the animation
        $('.form-animation').css({"display":"flex"});
        $.ajax({
            type:'post',
            url:'remove_cart_item.php',
            data:{product_id: product_id},
            dataType:'json'
        })
        //using the done promise callback
        .done(function(data){
            if(data){
                if(data.message){
                    $('.cart_item_container').text(data.message);
                }else{
                    item_remove_btn.parent().parent().parent().parent().css("display","none");
                }
                if(data.cart_total){
                    $('.cart_item_price').text("$"+ data.cart_total);
                    $('.cart-total-price').text("$" + data.cart_total);
                    $('.header-cart-total').text("Total: $" + data.cart_total);
                }else{
                    $('.cart_item_price').text("$"+"0");
                    $('.cart-total-price').text("$"+"0");
                    $('.header-cart-total').text("Total: $" + 0);
                }
                if(data.cart_total_quantity){
                    $('.cart-total-quantity').text(data.cart_total_quantity);
                }else{
                    $('.cart-total-quantity').text(0);
                }
                // stop the animation
                $('.form-animation').css({"display":"none"});
            }
        })
        //using the fail promise callback
        .fail(function(data){

        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on("click",function(e){
        e.preventDefault();
        var product_id = $(this).data("id");
        // AJAX request
        $.ajax({
            type:'post',
            url:'show_cart_modal.php',
            data:{product_id: product_id},
            dataType:'json'
        })
        //using the done promise callback
        .done(function(data){
            if(data){
                if(data.detail){
                    $('.js-name-detail').text(data.detail.product_name);
                    $('.product-price').text(data.detail.price);
                    $('.product-short-desc').text(data.detail.short_description);
                    $('.product-id').val(product_id);
                    $('.num-product').val(1);
                    $('.product-image-thumb').data("thumb", "images/" + data.detail.image_1);
                }
                if(data.slick1){
                    //$('.cart_modal_container').html(data.slick1);
                    $('.container-slick').html(data.slick1);
                }
                //Display Modal
                $('.js-modal1').addClass('show-modal1');
            }
            //Add response in Modal body
        })
        //using the fail promise callback
        .fail(function(data){

        });
    });

    /*==================================================================
    [ Close modal1 ]*/
    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });



        /*==================================================================
    [ Update cart item ]*/
    $(document).ready(function(){
        $('.cart-form').on("submit",function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            //start the animation
            $('.form-animation').css({"display":"flex"});
            // AJAX request
            $.ajax({
                type:'post',
                url:'update_cart.php',
                data:formData,
                dataType:'json'
            })
            //using the done promise callback
            .done(function(data){
                if(data){
                    if(data.cart_total){
                        $('.cart_item_price').text("$"+ data.cart_total);
                        $('.cart-total-price').text("$" + data.cart_total);
                        $('.header-cart-total').text("Total: $" + data.cart_total);
                    }else{
                        $('.cart_item_price').text("$"+"0");
                        $('.cart-total-price').text("$"+"0");
                        $('.header-cart-total').text("Total: $" + 0);
                    }
                    if(data.cart_total_quantity){
                        $('.cart-total-quantity').text(data.cart_total_quantity);
                    }else{
                        $('.cart-total-quantity').text(0);
                    }
                    // stop the animation
                    $('.form-animation').css({"display":"none"});
                    //swal("Cart has been updated successfuly", "", "success");
                }
            })
            //using the fail promise callback
            .fail(function(data){

            });
        });
    });


    $('.clicktest').click(function(){
        alert("button clicked");
        $('.testcontainer').load("load.html");
    })



})(jQuery);