<?php
class GoogleMerchentUpdate {
    public static function run()
    {
    	$shopping_content = Google::make('ShoppingContent');

		print_r($shopping_content->products->listProducts('114635174'));

    	echo "It's working.";
    }
}
GoogleMerchentUpdate::run();
?>