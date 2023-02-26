<div class="filter-sidebar">
    <form class="filerForm inner-filter">
        <h4 class="sidebar-title"><?php echo __('Filter','WordPress'); ?></h4>
        <div class="link-wrap">
            <?php $categories = get_terms( 'category', array(
                'hide_empty' => 0,
                'order'   => 'ASC',
                'orderby'   => 'date',
            ));
            if ( $categories ) {
                ?>
                <h4 class="sidebar-filter-title"><?php echo __('Categories','WordPress'); ?></h4>
                <ul>
                    <?php
                    foreach ( $categories as $cat ): ?>
                        <li>
                            <label>
                                <input type="checkbox" name="cat[]" value="<?php echo $cat->term_id; ?>"
                                    class="filter">
                                <span class="fake-input"></span>
                                <span class="filter-label"><?php echo $cat->name; ?></span>
                                <a href="#" class="filter-remove"><i class="icon-close"></i></a>
                            </label>
                        </li>
                <?php endforeach; ?>
                </ul>
                <?php
            }
            if ( $categories ) {
                $orders = ['ASC'=>'Ascending', "DESC"=>"Descending"];
                ?>
                <h4 class="sidebar-filter-title"><?php echo __('Order By','WordPress'); ?></h4>
                <ul>
                <?php
                    $i = 1;
                    foreach ( $orders as $order => $value):
                    ?>    
                    <li>
                        <label for="order-<?php echo $order; ?>">
                            <input type="radio" name="order" value="<?php echo $order; ?>" class="filter" <?php echo $i==1?'checked=checked':'';?>>
                            <span id="order-<?php echo $order; ?>"><?php echo $value; ?></span>
                        </label>
                    </li>
                    <?php $i++; endforeach; ?>
                </ul>
                <?php } ?>
        </div>
    </form>
    <div class="filter-apply-holder">
        <a href="javascript:void(0)" class="btn wpc-filter-apply"><?php echo __('Apply Filter','WordPress'); ?></a>
    </div>
</div>