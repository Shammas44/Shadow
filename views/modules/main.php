<main>
<?php
switch ($this->_file) {
    case 'views/viewError.php':
        echo $content;
        break;
    default:
        echo <<<"EOT"
        <section class="shop">
            {$content['filter']}
            <div class="showcase">
            {$content['product']}
            </div>
        </section>
       EOT;
}
?>
</main>
