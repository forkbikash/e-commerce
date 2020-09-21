<?php
if(!defined('_special-price')){
    header("HTTP/1.0 404 Not Found");
    exit;
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['sp_item_id'])){
        $cart->addToCart($_POST['user_id'], $_POST['sp_item_id']);
    }
}
shuffle($products);
$brand=array_map(function($item){return $item['item_brand'];}, $products);/*tried array_map instead of foreach loop*/
$unique=array_unique($brand);
sort($unique);
?>
<section id="special-price">
    <div class="container">
        <h4 class="font-rubik font-size-20">Special Price</h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">All Brand</button>
            <?php array_map(function ($brand){
            printf('<button class="btn" data-filter=".%s">%s</button>', $brand, $brand);
            }, $unique); ?>
        </div>

        <div class="grid">
            <?php foreach ($products as $item) { ?>
            <div class="grid-item <?php echo $item['item_brand'];?> border">
                <div class="item py-2" style="width: 200px;">
                    <div class="product font-rale">
                        <a href=<?php printf('./product.php?item_id=%s', $item['item_id']);?> ><img class="img-fluid" alt="product1" src=<?php echo $item['item_image'];?> ></a>
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
                                <button name="sp_item_id" disabled value=<?php echo $item['item_id'];?> type="submit" class="btn btn-warning font-size-12">In the Cart</button>
                            <?php } else{ ?>
                                <button name="sp_item_id" value=<?php echo $item['item_id'];?> type="submit" class="btn btn-warning font-size-12">Add to Cart</button>
                            <?php } ?>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>