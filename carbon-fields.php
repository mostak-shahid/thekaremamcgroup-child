<?php
use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    $product_cat = mos_get_terms('product_cat');
    $output_product_cat = [];
    if (sizeof($product_cat)){
        foreach($product_cat as $value){
            $output_product_cat[$value['term_id']] = $value['name'];
        }
    }
    /*Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_text', 'Text Field' ),
        ));
    Container::make( 'post_meta', 'Custom Data' )
        ->where( 'post_type', '=', 'page' )
        ->add_fields( array(
            Field::make( 'map', 'crb_location' )
                ->set_position( 37.423156, -122.084917, 14 ),
            Field::make( 'sidebar', 'crb_custom_sidebar' ),
            Field::make( 'image', 'crb_photo' ),
        ));*/
    Block::make( __( 'Mos Image Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-image-heading', __( 'Heading' ) ),
        Field::make( 'image', 'mos-image-media', __( 'Image' ) ),
        Field::make( 'rich_text', 'mos-image-content', __( 'Content' ) ),
        //Field::make( 'color', 'mos-image-hr', __( 'Border Color' ) ),
        Field::make( 'text', 'mos-image-btn-title', __( 'Button' ) ),
        Field::make( 'text', 'mos-image-btn-url', __( 'URL' ) ),
        Field::make( 'select', 'mos-image-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'id-alt' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-image-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-image-block text-<?php echo esc_html( $fields['mos-image-alignment'] ) ?>">
                <div class="img-part"><?php echo wp_get_attachment_image( $fields['mos-image-media'], 'full' ); ?></div>
                <div class="text-part">
                    <h4><?php echo esc_html( $fields['mos-image-heading'] ); ?></h4>
<!--                    <hr style="background-color: <?php echo esc_html( $fields['mos-image-hr'] ) ?>;">-->
                <?php if ($fields['mos-image-content']) :?>
                    <div class="desc"><?php echo apply_filters( 'the_content', $fields['mos-image-content'] ); ?></div> 
                <?php endif?>                 
                <?php if ($fields['mos-image-btn-title'] && $fields['mos-image-btn-url']) :?>   
                    <div class="wp-block-buttons"><div class="wp-block-button"><a href="<?php echo esc_url( $fields['mos-image-btn-url'] ); ?>" title="" class="wp-block-button__link"><?php echo esc_html( $fields['mos-image-btn-title'] ); ?></a></div></div>  
                <?php endif?>                 
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos 3 Column CTA' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-3ccta-heading', __( 'Heading' ) ),        
        Field::make( 'image', 'mos-3ccta-media', __( 'Image' ) ),
        Field::make( 'text', 'mos-3ccta-link', __( 'Link' ) ),
        Field::make( 'textarea', 'mos-3ccta-content', __( 'Content' ) ),
        Field::make( 'image', 'mos-3ccta-bgimage', __( 'Background Image' ) ),
        Field::make( 'color', 'mos-3ccta-bgcolor', __( 'Background Color' ) ),
    ))
    ->set_icon( 'phone' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-3ccta-wrapper <?php echo $attributes['className'] ?>" style="<?php if ($fields['mos-3ccta-bgcolor']) echo 'background-color:'.esc_html($fields['mos-3ccta-bgcolor']).';' ?><?php if ($fields['mos-3ccta-bgimage']) echo 'background-image:url('.wp_get_attachment_url($fields['mos-3ccta-bgimage']).');' ?>">
            <div class="mos-3ccta">
                <div class="call-left">
                    <h3><?php echo esc_html( $fields['mos-3ccta-heading'] ); ?></h3>
                </div>
                <div class="call-center">
                    <a href="<?php echo esc_url( $fields['mos-3ccta-link'] ); ?>" class="" target="_blank"><?php echo wp_get_attachment_image( $fields['mos-3ccta-media'], 'full' ); ?></a>
                </div>
                <div class="call-right">
                    <div class="desc"><?php echo esc_html( $fields['mos-3ccta-content'] ); ?></div>
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Icon Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-icon-heading', __( 'Heading' ) ),
        Field::make( 'text', 'mos-icon-class', __( 'Icon Class' ) ),
        Field::make( 'textarea', 'mos-icon-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-icon-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_description( __( 'Use Font Awesome in <b>Icon class</b>, you can find Fontawesome <a href="https://fontawesome.com/v4.7.0/cheatsheet/">Here</a>.' ) )
    ->set_icon( 'editor-customchar' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-icon-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-icon-block text-<?php echo esc_html( $fields['mos-icon-alignment'] ) ?>">
                <?php if ($fields['mos-icon-class']) : ?>
                <div class="icon-part"><i class="fa <?php echo esc_html( $fields['mos-icon-class'] ); ?>"></i></div>
                <?php endif;?>
                <div class="text-part">
                    <?php if ($fields['mos-icon-heading']) : ?>
                    <h4><?php echo esc_html( $fields['mos-icon-heading'] ); ?></h4>
                    <?php endif;?>
                    <?php if ($fields['mos-icon-content']) : ?>
                    <div class="desc"><?php echo  $fields['mos-icon-content']; ?></div>                    
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Counter Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-counter-prefix', __( 'Prefix' ) ),
        Field::make( 'text', 'mos-counter-number', __( 'Number' ) ),
        Field::make( 'text', 'mos-counter-suffix', __( 'Suffix' ) ),
        Field::make( 'color', 'mos-counter-color', __( 'Heading Color' ) ),
        Field::make( 'color', 'mos-counter-text-color', __( 'Text Color' ) ),
        Field::make( 'textarea', 'mos-counter-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-counter-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'clock' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-counter-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-counter-block text-<?php echo esc_html( $fields['mos-counter-alignment'] ) ?>">
                <h2 style="color: <?php echo esc_html( $fields['mos-counter-color'] ); ?>"><span class="prefix"><?php echo esc_html( $fields['mos-counter-prefix'] ); ?></span><span class='numscroller counter' data-min='1' data-counterup-time="1500"><?php echo esc_html( $fields['mos-counter-number'] ); ?></span><span class="suffix"><?php echo esc_html( $fields['mos-counter-suffix'] ); ?></span></h2>
                <div class="mb-0" style="color: <?php echo esc_html( $fields['mos-counter-text-color'] ); ?>"><?php echo esc_html( $fields['mos-counter-content'] ); ?></div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Pricing Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-pricing-title', __( 'Heading' ) ),
        Field::make( 'text', 'mos-pricing-symbol', __( 'Symbol' ) ),
        Field::make( 'text', 'mos-pricing-amount', __( 'Amount' ) ),
        Field::make( 'text', 'mos-pricing-period', __( 'Period' ) )
            ->set_attribute( 'placeholder', 'Ex: per clean / billed weekly' ),
        Field::make( 'text', 'mos-pricing-subtitle', __( 'Sub Heading' ) ),
        Field::make( 'textarea', 'mos-pricing-desc', __( 'Desacription' ) ),
        Field::make( 'complex', 'crb_slider', __( 'Features' ) )
            ->add_fields( array(
                Field::make( 'text', 'mos-pricing-feature', __( 'Feature' ) ),
            )),
        Field::make( 'text', 'mos-pricing-btn-title', __( 'Button' ) ),
        Field::make( 'text', 'mos-pricing-btn-url', __( 'URL' ) ),
        Field::make( 'select', 'mos-counter-alignment', __( 'Content Alignment' ) )
        ->set_options( array(
            'left' => 'Left',
            'right' => 'Right',
            'center' => 'Center',
        ))
    ))
    ->set_icon( 'list-view' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-counter-pricing-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-counter-pricing text-<?php echo esc_html( $fields['mos-counter-alignment'] ) ?>">            
                <div class="title-part">
                    <h3><?php echo esc_html( $fields['mos-pricing-title'] ); ?></h3>
                </div>
                <div class="pricing-part">
                    <div class="pricing-value"> <span class="pricing-symbol"><?php echo esc_html( $fields['mos-pricing-symbol'] ); ?></span> <span class="pricing-amount"><?php echo esc_html( $fields['mos-pricing-amount'] ); ?></span> <span class="plan-period"><?php echo esc_html( $fields['mos-pricing-period'] ); ?></span>
                    </div>
                </div>
                <?php if ($fields['mos-pricing-subtitle']) : ?>
                    <h5 class="desc-subtitle"><?php echo esc_html( $fields['mos-pricing-subtitle'] ); ?></h5>
                <?php endif?>
                <?php if ($fields['mos-pricing-desc']) : ?>
                    <div class="desc-part"><?php echo esc_html( $fields['mos-pricing-desc'] ); ?></div>
                <?php endif?>
                <div class="features-part">
                    <ul class="pricing-features">
                        <li>Custom schedules everyday.</li>
                        <li>Desks and workstations cleaning.</li>
                        <li>Washrooms cleaning.</li>
                        <li>Floor cleaning.</li>
                        <li>Waiting area cleaning.</li>
                    </ul>
                </div>
                
                <?php if($fields['mos-pricing-btn-title'] && $fields['mos-pricing-btn-url']) : ?>
                <div class="wp-block-buttons"><div class="wp-block-button"><a href="<?php echo esc_html( $fields['mos-pricing-btn-url'] ); ?>" title="" class="wp-block-button__link"><?php echo esc_html( $fields['mos-pricing-btn-title'] ); ?></a></div></div>
                <?php endif;?>
            
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Category Slider' ) )
    ->add_fields( array(        
        Field::make( 'select', 'mos-category-block-grid', __( 'Large Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-category-block-grid-md', __( 'Medium Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-category-block-grid-sm', __( 'Small Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-category-block-autoplay', __( 'Autoplay' ) )
        ->set_options( array(
            'true' => 'Enable',
            'false' => 'Disable'
        )),
        Field::make( 'text', 'mos-category-block-autoplay-speed', __( 'Autoplay Speed' ) )
            ->set_attribute( 'placeholder', '2000' ),
        Field::make( 'text', 'mos-category-block-image-size', __( 'Image Size' ) )
            ->set_attribute( 'placeholder', 'width,height. Ex: 370,370' ),
        Field::make( 'multiselect', 'mos-category-ids', __( 'Select Categories' ) )
            ->set_options( $output_product_cat),
        Field::make( 'text', 'mos-category-block-sub-size', __( 'No of Subcategories' ) )
            ->set_attribute( 'placeholder', 'Default 5' ),
        Field::make( 'select', 'mos-category-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'store' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-category-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-category-block text-<?php echo esc_html( $fields['mos-category-alignment'] ) ?>">
                <?php  
                if(sizeof($fields['mos-category-ids'])) : 
                $sub_size = ($fields['mos-category-block-sub-size'])?$fields['mos-category-block-sub-size']:5;
                $slidesToScroll = ($fields['mos-category-block-grid'])?$fields['mos-category-block-grid']:1;
                $slidesToScroll_992 = ($fields['mos-category-block-grid-md'])?$fields['mos-category-block-grid-md']:1;
                $slidesToScroll_786 = ($fields['mos-category-block-grid-sm'])?$fields['mos-category-block-grid-sm']:1;            
                $autoplay = ($fields['mos-category-block-autoplay'])?$fields['mos-category-block-autoplay']:true;
                $autoplaySpeed = ($fields['mos-category-block-autoplay-speed'])?$fields['mos-category-block-autoplay-speed']:2000;
                $data_slick = '{"slidesToShow": '.$slidesToScroll.',"slidesToScroll": '.$slidesToScroll.',"autoplay": '.$autoplay.',"autoplaySpeed": '.$autoplaySpeed.',"dots": true,"arrows":false,"responsive": [{"breakpoint": 992,"settings": {"slidesToShow": '.$slidesToScroll_992.',"slidesToScroll": '.$slidesToScroll_992.'}},{"breakpoint": 786,"settings": {"arrows": true,"dots": false,"slidesToShow": '.$slidesToScroll_786.',"slidesToScroll": '.$slidesToScroll_786.'}}]}';            
                ?>
                <div class="slick-slider" data-slick='<?php echo $data_slick ?>'>
                    <?php 
                    foreach($fields['mos-category-ids'] as $term_id) : 
                        $term = get_term( $term_id, 'product_cat' );
                        $term_link = get_term_link($term->slug, 'product_cat');
                        $thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                        $term_img = aq_resize(wp_get_attachment_url(  $thumb_id ),148,148,true);
                        $children = get_term_children( $term_id, 'product_cat');
                    ?>
                    <div class="item-content" id="item-<?php echo $term_id?>">
                        
                            <div class="text-part">
                                <a href="<?php echo $term_link?>" class="catalog-title"><?php echo $term->name?></a>
                                
                                <?php if (sizeof($children)) : ?>
                                <div class="subitems">
                                    <?php 
                                    $n = 1;
                                    foreach($children as $child) :                                     
                                        $child_term = get_term( $child, 'product_cat' );
                                        $child_term_link = get_term_link($child_term->slug, 'product_cat');
                                        $child_thumb_id = get_woocommerce_term_meta( $child_term->term_id, 'thumbnail_id', true );
                                        $child_term_img = aq_resize(wp_get_attachment_url(  $child_thumb_id ),148,148,true);
                                    ?>
                                    <div class="subitem" data-image="<?php echo $child_term_img ?>">
                                        <a href="<?php echo $child_term_link?>"><span><?php echo $child_term->name?></span></a>
                                    </div>
                                    <?php 
                                        if ($n >= $sub_size) break; 
                                        $n++;
                                    ?>
                                    <?php endforeach;?>
                                    <?php if (sizeof($children)> $sub_size) : ?>
                                    <div class="subitem view-more">
                                        <a href="<?php echo $term_link ?>"><span>See all products</span></a>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <?php endif;?>
                            </div>
                            
                            <div class="img-part">                                
                                <a href="<?php echo $term_link?>" class="catalog-image">
                                    <img src="<?php echo $term_img ?>" data-image="<?php echo $term_img ?>" alt="<?php echo $term->name?>" width="220" height="220" class="lazyload lazyloaded">
                                </a>
                            </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Lightbox Gallery' ) )
    ->add_fields( array(
        Field::make( 'select', 'mos-gallery-grid', __( 'Large Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'text', 'mos-gallery-size', __( 'Thumbnail Size' ) )
            ->set_attribute( 'placeholder', 'width,height. Ex: 370,370' ),
        Field::make( 'media_gallery', 'mos-gallery-gallery', __( 'Media Gallery' ) )
            ->set_type( array( 'image', 'video' ) )
    ))
    ->set_icon( 'format-gallery' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-counter-block-wrapper <?php echo $attributes['className'] ?>">
            <?php
                $grid = ($fields['mos-gallery-grid'])?$fields['mos-gallery-grid']:1;
                $size = (preg_match('/[0-9]+,[0-9]+/',$fields['mos-gallery-size']))?$fields['mos-gallery-size']:'370,370';
                $slice = explode(',',$size);
                $width = $slice[0];
                $height = $slice[1];
                $gallery = $fields['mos-gallery-gallery'];
            ?>
            <?php if(sizeof($gallery)): ?>
                <div class="flex-grid grid-<?php echo $grid;?>">
                    <?php foreach($gallery as $attachment_id) : ?>                        
                        <a class="fancybox-gallery" data-fancybox="gallery" href="<?php echo wp_get_attachment_url( $attachment_id ) ?>">
                            <img src="<?php echo aq_resize(wp_get_attachment_url( $attachment_id ),$width,$height,true) ?>" alt="<?php echo get_post_meta($attachment_id, '_wp_attachment_image_alt', TRUE); ?>" class="img-fluid img-gallery" width="<?php echo $width ?>" height="<?php echo $height ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
        </div>
        <?php
    });
    Block::make( __( 'Mos Slider' ) )
    ->add_fields( array(
        Field::make( 'select', 'mos-slider-grid', __( 'Large Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-slider-grid-md', __( 'Medium Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-slider-grid-sm', __( 'Small Device Grid' ) )
        ->set_options( array(
            '1' => 'Single Column',
            '2' => 'Two Column',
            '3' => 'Three Column',
            '4' => 'Four Column',
            '5' => 'Five Column',
        )),
        Field::make( 'select', 'mos-slider-autoplay', __( 'Autoplay' ) )
        ->set_options( array(
            'true' => 'Enable',
            'false' => 'Disable'
        )),
        Field::make( 'text', 'mos-slider-autoplay-speed', __( 'Autoplay Speed' ) )
            ->set_attribute( 'placeholder', '2000' ),
        Field::make( 'text', 'mos-slider-size', __( 'Thumbnail Size' ) )
            ->set_attribute( 'placeholder', 'width,height. Ex: 370,370' ),
        Field::make( 'complex', 'mos-slider-items', __( 'Items' ) )
            ->add_fields( array(
                Field::make( 'image', 'image', __( 'Image' ) ),
                Field::make( 'text', 'title', __( 'Title' ) ),
                Field::make( 'textarea', 'desc', __( 'Desacription' ) ),
                Field::make( 'text', 'btn-title', __( 'Button Title' ) ),
                Field::make( 'text', 'btn-url', __( 'Button Link' ) ),
            )),
    ))
    ->set_icon( 'format-gallery' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-slider-block-wrapper <?php echo $attributes['className'] ?>">
            <?php
                $items = $fields['mos-slider-items'];
                $grid = ($fields['mos-slider-grid'])?$fields['mos-slider-grid']:1;
                $size = (preg_match('/[0-9]+,[0-9]+/',$fields['mos-slider-size']))?$fields['mos-slider-size']:'370,370';
                $slice = explode(',',$size);
                $width = $slice[0];
                $height = $slice[1];
                
                $slidesToScroll = ($fields['mos-slider-grid'])?$fields['mos-slider-grid']:1;
                $slidesToScroll_992 = ($fields['mos-slider-grid-md'])?$fields['mos-slider-grid-md']:1;
                $slidesToScroll_786 = ($fields['mos-slider-grid-sm'])?$fields['mos-slider-grid-sm']:1;            
                $autoplay = ($fields['mos-slider-autoplay'])?$fields['mos-slider-autoplay']:true;
                $autoplaySpeed = ($fields['mos-slider-autoplay-speed'])?$fields['mos-slider-autoplay-speed']:2000;
                $data_slick = '{"slidesToShow": '.$slidesToScroll.',"slidesToScroll": '.$slidesToScroll.',"autoplay": '.$autoplay.',"autoplaySpeed": '.$autoplaySpeed.',"dots": true,"arrows":true,"responsive": [{"breakpoint": 992,"settings": {"slidesToShow": '.$slidesToScroll_992.',"slidesToScroll": '.$slidesToScroll_992.'}},{"breakpoint": 786,"settings": {"slidesToShow": '.$slidesToScroll_786.',"slidesToScroll": '.$slidesToScroll_786.'}}]}';            
                
            ?>
            <?php if(sizeof($items)): ?>
                <div class="slick-slider" data-slick='<?php echo $data_slick ?>'>
                    <?php foreach($items as $slide) : ?>                
                        <div class="item">                            
                            <div class="img-part"> <img src="<?php echo aq_resize(wp_get_attachment_url( $slide['image'] ),$width,$height,true) ?>" alt="<?php echo get_post_meta($slide['image'], '_wp_attachment_image_alt', TRUE); ?>" class="img-fluid img-gallery" width="<?php echo $width ?>" height="<?php echo $height ?>"></div>
                            <div class="text-part">
                                <?php if ($slide['title']) : ?>
                                <h4 class="slide-title"><?php echo do_shortcode($slide['title'])?></h4>
                                <?php endif?>
                                <?php if ($slide['desc']) : ?>
                                <div class="slide-desc"><?php echo do_shortcode($slide['desc'])?></div>
                                <?php endif?>
                                <?php if ($slide['btn-title'] && $slide['btn-url']) : ?>
                                <div class="wp-block-buttons is-content-justification-center">
                                    <div class="wp-block-button"><a href="<?php echo esc_url(do_shortcode($slide['btn-url'])) ?>" class="wp-block-button__link"><?php echo do_shortcode($slide['btn-title']) ?></a></div>
                                </div>
                                <?php endif?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
        </div>
        <?php
    });
    Block::make( __( 'Mos Tab' ) )
    ->add_fields( array(
        
        Field::make( 'complex', 'mos-tab-items', __( 'Items' ) )
            ->add_fields( array(
                Field::make( 'image', 'image', __( 'Image' ) ),
                Field::make( 'text', 'title', __( 'Title' ) ),
                Field::make( 'textarea', 'desc', __( 'Desacription' ) ),
                Field::make( 'text', 'btn-title', __( 'Button Title' ) ),
                Field::make( 'text', 'btn-url', __( 'Button Link' ) ),
            )),
    ))
    ->set_icon( 'clock' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        //var_dump($fields['mos-tab-items']);
        ?>
        <div class="mos-tab-block-wrapper <?php echo $attributes['className'] ?>">
            <?php if (sizeof($fields['mos-tab-items'])) : ?>
            <div class="mos-tab-block">
                <ul class="tab-list">
                    <?php $n=0?>
                    <?php foreach($fields['mos-tab-items'] as $item) : ?>
                        <li data-id="<?php echo $item['_id'] ?>" class="tab-item <?php if (!$n) echo 'active' ?>"><?php echo $item['title'] ?></li>
                        <?php $n++?>
                    <?php endforeach;?>
                </ul>
                <?php $n=0?>
                <?php foreach($fields['mos-tab-items'] as $item) : ?>
                    <div id="<?php echo $item['_id'] ?>" class="tab-inner <?php if (!$n) echo 'active' ?>">
                        <div class="tab-text"><?php echo do_shortcode($item['desc']); ?></div><!--/.tab-text-->
                    </div><!--/#<?php echo $item['_id'] ?>-->
                    <?php $n++?>
                <?php endforeach;?>
            </div>
            <?php endif?>
        </div>
        <?php
    });
    
}
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}