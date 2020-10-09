<?php/** @var \app\models\Product $good */ ?>
<section class="product center" xmlns="">
    <div class="single-block">
        <img src="../" alt="<?=$good->name?>">
        <div class="info">
            <h2 class="info__name"><?=$good->name?></h2>
            <h3 class="info__type"><?=$good->type?></h3>
            <p class="info__descriptions"><?=$good->descriptions?></p>
        </div>
    </div>

    <div class="buy">
        <p class="buy_price"><?=$good->price?>$</p>
        <div class="buy__button"><span> <?=$good->name?></span></div>
        <div>
            <input id="qty_input" type="text" name="qty">
            <input id="add_to_card" data-id="<?=$good->id?>" type="submit" value="Добавить в корзину">
        </div>
    </div>
    
</section>
