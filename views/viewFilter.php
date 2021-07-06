<?php
$names = ['type' => 'Type de produits', 'price' => 'Prix', 'brand' => 'Marques', 'color' => 'Couleurs', 'material' => 'Matériaux'];
$count = 0;
?>
<form method="post" class="filters">
    <h2 class="filter__title">Filtrer par</h2>

     <?php foreach ($filters as $key => $filter): ?>
    <div class="filter__item">
        <div class="filter ">
            <h3 class="filter__subTitle"><?=$names[$key]?></h3>
            <span class="icon-minus"></span>
        </div>
        <div class="filter__list <?=count($filter) < 9 ?: 'scrollbar'?>">
            <ul class="filter__ul">
                <?php foreach ($filter as $data => $item):
    if ($filter != $filters['price']) {?>
		    	<li>
		    	    <label class='container'>
		    	        <input type='checkbox' name='filter_<?=$key?>' value='<?=$item['id']?>'>
		    	        <span class='checkmark'></span>
		    	        <p><?=array_values($item)[0] . ' (' . $item['cnt'] . ')'?></p>
		    	    </label>
		    	</li>
		    <?php } else {
        $start = <<<"EOT"
    <li>
        <label class='container'>
            <input type='radio' name='filter_price' data-min='{$filters['price'][$count]['min']}' data-max='{$filters['price'][$count]['max']}'>
            <span class='checkmark'></span><p>
    EOT;
        $count++;
        $end = "</p></label></li>";
        switch ($data) {
            case 0:
                echo "$start Tous ({$item['cnt']}) $end";
                break;
            case 1:
                echo "$start moins de {$item['max']} CHF ({$item['cnt']}) $end";
                break;
            case count($filters['price']) - 1:
                echo "$start {$item['min']} CHF ou plus ({$item['cnt']}) $end";
                break;
            default:
                echo "$start {$item['min']} CHF - {$item['max']} CHF ({$item['cnt']}) $end";
        }
    }
endforeach;?>
            </ul>
        </div>
    </div>
    <?php
endforeach;?>
    <!-- Reset button -->
    <button class="filters__reset">
        <p>Reset</p>
    </button>
</form>