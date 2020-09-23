<?php /** @var \app\models\Product[] $goods */ ?>

<section class="product center">
    <?php foreach ($goods as $product): ?>
        <div class="product__box">
            <a href="/?c=product&a=one&id=<?= $product->id ?>">
                <img src="" alt="<?= $product->name ?>" class="product__img"></a>
            <div class="product__descriptions">
                <h3 class="product__name"><?= $product->name ?></h3>
                <p class="product__price"><span><?= $product->price ?>$</span></p>
                <p class="procduct__type"><?= $product->type ?></p>
                <p class="product__quantuty">В наличии <span><?= $product->quantity ?></span></p>
            </div>
            </a>
        </div>
    <?php endforeach; ?>
</section>
