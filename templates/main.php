<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и
        горнолыжное снаряжение.
    </p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ( $categories as $category ): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?= xssAdg( $category ) ?></a>
            </li>
        <? endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php foreach ( $advertisement as $k => $ad ): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $ad['img'] ?? '' ?>"
                         width="350" height="260" alt="Картинка лота">
                </div>
                <div class="lot__info">
                    <span class="lot__category">
                            <?= isset( $ad['category'] ) ? xssAdg( $ad['category'] ) : '' ?>
                    </span>
                    <h3 class="lot__title">
                        <a class="text-link" href="pages/lot.html">
                            <?= isset( $ad['name'] ) ? xssAdg( $ad['name'] ) : '' ?>
                        </a>
                    </h3>
                    <div class="lot__state">

                        <div class="lot__rate">
                            <span class="lot__amount">
                                <?= isset( $ad['price'] ) ? xssAdg( $ad['price'] ) : 'По запросу' ?>
                            </span>
                            <span class="lot__cost">
                                <?= formatSumm( 3412245.34 ) ?>
                            </span>
                        </div>

                        <?php $range = get_dt_range( xssAdg( $ad['data'] ) );
                            if ( (int) $range[0] == 0 && (int) $range[1] <= 60 ): ?>
                                <div class="lot__timer timer timer--finishing">
                                    <?= $range[0] . ':' . $range[1] ?>
                                </div>
                            <?php else: ?>
                                <div class="lot__timer timer ">
                                    <?= $range[0] . ':' . $range[1] ?>
                                </div>
                            <?php endif ?>

                    </div>
                </div>
            </li>
        <? endforeach; ?>
    </ul>
</section>
