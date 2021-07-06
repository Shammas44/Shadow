<div class="showcase__shelfs">
<?php foreach ($products as $product): ?>
    <article class='product'>
        <div>
            <div class='div__imgProduct'>
                <img src="<?='images/lampes_images/' . $product->id() . '-1.jpg'?>" alt='image du produit' class='img__product'>
                <?php ($product->discount() > 0) ? $class = 'discount' : $class = 'is-displayNone';?>
                <div class="<?=$class?>">
                    <p><?=$product->discount() . '%'?></p>
                </div>
            </div>
            <div class='product__data'>
                <p class='product__name'><?=$product->name()?></p>
                <p class='product__brand'><?=$product->brand()?></p>
                <div class='div__available'>
                    <div class="available__chip <?=$product->isAvailable()?>"></div>
                </div>
                <p class='product__price'><?=$product->price() . ' CHF'?></p>
            </div>
        </div>
    </article>
    <?php endforeach;?>
</div>


<div class="showcase__sorting">
    <form class="dropdown sortingForm">
        <div class="sortingForm__button">
            <p>Trier par :</p>
            <span class="icon-bottomArrow"></span>
        </div>
        <div class="sortingForm__content">
            <ul class="sortingForm__ul">
<?php $array = array('Prix', 'Nouveauté', 'Promotions');?>
<?php for ($i = 0; $i < count($array); $i++) {
    $j = $i + 1;
    echo <<<STR
                <li class="sortingForm__li">
                    <label class="sortingForm__label sortingForm__label$j" for="sorting$j">{$array[$i]}
                        <input class="sortingForm__input" type="radio" name="sorting" value="$j" id="sorting$j">
                    </label>
                </li>
    STR;
}?>
            </ul>
        </div>
    </form>
    <div class="showcase__data">
        <p class="sortingValue"><?=$sorting?></p>
        <p class="nbrProducts"><?=$nbrProducts . ' produit(s)'?></p>
        <p class="showcase__pages">Page
<?php
for ($i = 1; $i <= $pagesNbr; $i++) {
    $class = ($i == $noPage) ? "is-colorYellow" : '';
    echo "<a class='showcase__page ${class}'  href='?page=${i}'>${i}</a>";
}
if ($pagesNbr != $noPage) {
    $page = $noPage + 1;
    echo "<a class='showcase__page'  href='?page=${page}'>Suivant</a>";
}?>
        </p>
    </div>