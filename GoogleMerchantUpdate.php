<?php
class GoogleMerchentUpdate {
	public static function run() {
		echo "It's running.";
		/*
		try {
			$seller_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function($query) {
				$query->where('status', 'ACTIVE');
			})->whereHas('product.product_images', function($query) {
				$query->where('status', 'ACTIVE');
			})->with([ 'product' => function($query) {
				$query->where('status', 'ACTIVE');
			}, 'product.product_images' => function($query) {
				$query->where('status', 'ACTIVE');
			} ])->whereHas('product.category', function($query) {
				$query->where('status', 'ACTIVE');
			})->whereHas('product.sub_category', function($query) {
				$query->where('status', 'ACTIVE');
			})->orderBy('id', 'asc')->get();

			$feedXmlStr = "";
			$feedXmlStr = $feedXmlStr . "<?xml version=\"1.0\"?>";
			$feedXmlStr = $feedXmlStr . "<rss xmlns:g=\"http://base.google.com/ns/1.0\" version=\"2.0\">";

			$feedXmlStr = $feedXmlStr . "\n\t<channel>";
			$feedXmlStr = $feedXmlStr . "\n\t\t<title>GBMart</title>";
			$feedXmlStr = $feedXmlStr . "\n\t\t<link>https://www.gbmart.in</link>";
			$feedXmlStr = $feedXmlStr . "\n\t\t<description>This is a sample feed containing the required and recommended attributes for a variety of different products</description>";
			
			$feedXmlStr = $feedXmlStr . "\n\t</channel>";
			$feedXmlStr = $feedXmlStr . "\n</rss>";

			\File::put(public_path() . "/feeds.xml", $feedXmlStr);
			echo (public_path() . "/feeds.xml");
		}
		catch (Exception $ex) {
			echo ("Error occurred.");
		}
		*/
	}
}
GoogleMerchentUpdate::run();
?>