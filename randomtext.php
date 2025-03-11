<?php
/**
 * Plugin Name: Hello WooCommerce
 * Description: نمایش جملات تصادفی روی محصولات ووکامرسه 
 * Version: 1.0
 * Author: sadra
 */



 if ( ! defined( 'WPINC' ) ) {
	die;
}

/*این کد یه تابع هستش برای تولید جمله های تصادفی*/
function random_alert(){
    $alert=[
        " امروز بهترین روز برای خرید شماست!",
        " فرصت رو از دست نده، همین حالا سفارش بده!",
        " یک انتخاب هوشمندانه برای شما!",
        " این محصول میتونه زندگی‌تو تغییر بده!",
        " این محصول داغه، از دستش نده!",
        "من منتظر بهترین‌ها هستم و بهترین ها رو آرزو دارم و به بهترین نحو عمل میکنم "

return $alert[array_rand($alert)];

}

add_action( 'save_post', 'saveRandomText' );

function saveRandomText($post_id){
    if(get_post_type($post_id) != 'product'){
        return;
    }
    
    $slogan = get_post_meta($post_id,'stone_slogan');
    if(empty($slogan)){
        update_post_meta($post_id,'stone_slogan',random_alert());
    }
    return;
}

add_action('woocommerce_before_single_product_summary', 'showSlogan',10);

function showSlogan($post_id){
    global $post;

    // دریافت پست متای 'slogan' برای محصول فعلی
    $slogan = get_post_meta($post->ID, 'stone_slogan', true);

    if ($slogan) {
        // نمایش اسلوگان
        echo '<p class="product-slogan">' . esc_html($slogan) . '</p>';
    }
}