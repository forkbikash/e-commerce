<?php
//error_reporting(0);
    if(!defined('_cart')){
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['cart_id'])){
            $cart->deleteCart($_POST['user_id'], $_POST['cart_id']);
        }
        /*else if(isset($_POST['wishlist'])){
            $cart->addToWishlist($_POST['wishlist']);
        }*/
    }
?>
<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

        <!--  shopping cart items  -->
        <div class="row">
            <div class="col-sm-9">
                <!-- cart item -->
                <?php
                $cart_list=$cart->getUserCart($_SESSION['user_id'] ?? 1);
                foreach($cart_list as $item):
                    $cart_id = $item['cart_id'];
                    $product_rows = $product->getProduct($item['item_id']);
                    foreach ($product_rows as $product_row):
                ?>
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src=<?php echo $product_row['item_image']; ?> style="height: 120px;" alt="cart1" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $product_row['item_name']; ?></h5>
                        <small>by <?php echo $product_row['item_brand']; ?></small>
                        <!-- product rating -->
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                        </div>
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-25">
                                <button class="qty-up border bg-light" data-id=<?php echo $product_row['item_id']; ?> ><i class="fas fa-angle-up"></i></button>
                                <input type="text" data-id=<?php echo $product_row['item_id']; ?> class="qty_input <?php echo 'class'.$product_row['item_id']; ?> border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                <button data-id=<?php echo $product_row['item_id']; ?> class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                            <form method="post">
                                <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id'] ?? 1; ?> >
                                <button name="cart_id" value="<?php echo $cart_id; ?>" type="submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                <button name="wishlist" value="<?php echo $cart_id; ?>" type="submit" class="btn font-baloo text-danger">Wishlist</button>
                            </form>
                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="<?php echo 'price'.$product_row['item_id']; ?> product_price"><?php echo $product_row['item_price']; ?></span>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                    endforeach;
                ?>
                <!-- !cart item -->
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal (<?php echo count($cart_list); ?> item):&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo $cart->getSubTotal($cart_list); ?></span> </span> </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>