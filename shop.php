<?php include 'partials/head.php'; ?>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area End -->
        <?php
        require_once __DIR__ . '/../wp-load.php';

        include 'partials/header.php';
        ?>
        <!-- Header Area End -->

        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Категорії</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <!-- <ul>
                        <li class="active"><a href="#">Chairs</a></li>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Accesories</a></li>
                        <li><a href="#">Furniture</a></li>
                        <li><a href="#">Home Deco</a></li>
                        <li><a href="#">Dressings</a></li>
                        <li><a href="#">Tables</a></li>
                    </ul> -->
                    <ul>
                        <?php
                        $product_categories = get_terms('product_cat', array(
                            'hide_empty' => true,
                        ));
                        foreach ($product_categories as $category) {
                            echo '<li><a href="' . get_term_link($category) . '">' . esc_html($category->name) . '</a></li>';
                        }
                        ?>
                    </ul>

                </div>
            </div>






            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div data-min="10" data-max="1000" data-unit="$"
                            class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                            data-value-min="10" data-value-max="1000" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <div class="range-price">$10 - $1000</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <p>Showing 1-8 0f 25</p>
                                <div class="view d-flex">
                                    <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortBydate">
                                            <option value="value">Date</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Popular</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>
                                    <form action="#" method="get">
                                        <select name="select" id="viewProduct">
                                            <option value="value">12</option>
                                            <option value="value">24</option>
                                            <option value="value">48</option>
                                            <option value="value">96</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'product_cat' => 'shafy-kupe',
                    );

                    $loop = new WP_Query($args);
                    if ($loop->have_posts()):
                        while ($loop->have_posts()):
                            $loop->the_post();
                            global $product;

                            $gallery = $product->get_gallery_image_ids();
                            $main_img = wp_get_attachment_image_src($product->get_image_id(), 'medium')[0];
                            $hover_img = isset($gallery[0]) ? wp_get_attachment_image_src($gallery[0], 'medium')[0] : $main_img;

                            // Мінімальна ціна, якщо variable
                            if ($product->is_type('variable')) {
                                $available_variations = $product->get_available_variations();
                                $variation_prices = array_column($available_variations, 'display_price');
                                $min_price = min($variation_prices);
                                $price_html = 'Від ' . wc_price($min_price);
                            } else {
                                $price_html = $product->get_price_html();
                            }
                            ?>
                            <!-- Single Product Area -->
                            <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="<?php echo esc_url($main_img); ?>" alt="">
                                        <?php if ($hover_img): ?>
                                            <img class="hover-img" src="<?php echo esc_url($hover_img); ?>" alt="">
                                        <?php endif; ?>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description d-flex align-items-center justify-content-between">
                                        <!-- Product Meta Data -->
                                        <div class="product-meta-data">
                                            <div class="line"></div>
                                            <p class="product-price"><?php echo $price_html; ?></p>
                                            <a href="#">
                                                <h6><?php the_title(); ?></h6>
                                            </a>
                                        </div>
                                        <!-- Ratings & Cart -->
                                        <div class="ratings-cart text-right">
                                            <div class="cart">
                                                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" data-quantity="1"
                                                    data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                    data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                                                    class="add_to_cart_button ajax_add_to_cart" data-toggle="tooltip"
                                                    data-placement="left"
                                                    title="<?php echo esc_attr($product->add_to_cart_text()); ?>">
                                                    <img src="img/core-img/cart.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>Товари не знайдені.</p>';
                    endif;
                    ?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                                <li class="page-item"><a class="page-link" href="#">02.</a></li>
                                <li class="page-item"><a class="page-link" href="#">03.</a></li>
                                <li class="page-item"><a class="page-link" href="#">04.</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate
                            consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>

</body>

</html>