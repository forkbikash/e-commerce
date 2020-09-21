<?php
if(!defined('_top-sale')){
    header("HTTP/1.0 404 Not Found");
    exit;
}
shuffle($products);
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['ts_item_id'])){
        $cart->addToCart($_POST['user_id'], $_POST['ts_item_id']);
    }
}
?>
<section id="top-sale">
    <div class="container py-5">
        <h4 class="font-rubik font-size-20">Top Sale</h4>
        <hr>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($products as $item) { ?>
            <div class="item py-2">
                <div class="product font-rale">
                    <a href="<?php printf('./product.php?item_id=%s', $item['item_id']);?>" ><img alt="product1" class="img-fluid" src=<?php echo $item['item_image']?> ></a>
                    <div class="text-center">
                        <h6><?php echo $item['item_name'];?></h6>
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <div class="price py-2">
                            <span>$<?php echo $item['item_price'];?></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id'] ?? 1; ?> >
                            <?php if(in_array($item['item_id'], $cart->getCartId($_SESSION['user_id'] ?? 1, $product->getData('cart')) ?? [])){ ?>
                                <button name="ts_item_id" disabled value=<?php echo $item['item_id'];?> type="submit" class="btn btn-warning font-size-12">In the Cart</button>
                            <?php } else{ ?>
                                <button name="ts_item_id" value=<?php echo $item['item_id'];?> type="submit" class="btn btn-warning font-size-12">Add to Cart</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>