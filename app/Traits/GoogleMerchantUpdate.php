<?php
namespace App\Traits;

use App\SellerProduct;
use Exception;

class GoogleMerchantUpdate
{
    public static function run()
    {

        try {
            $seller_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function ($query) {
                $query->where('status', 'ACTIVE');
            })->whereHas('product.product_images', function ($query) {
                $query->where('status', 'ACTIVE');
            })->with(['product' => function ($query) {
                $query->where('status', 'ACTIVE');
            }, 'product.product_images' => function ($query) {
                $query->where('status', 'ACTIVE');
            }])->whereHas('product.category', function ($query) {
                $query->where('status', 'ACTIVE');
            })->whereHas('product.sub_category', function ($query) {
                $query->where('status', 'ACTIVE');
            })->orderBy('id', 'asc')->get();

            $feedXmlStr = "";
            $feedXmlStr = $feedXmlStr . "<?xml version=\"1.0\"?>";
            $feedXmlStr = $feedXmlStr . "<rss xmlns:g=\"http://base.google.com/ns/1.0\" version=\"2.0\">";

            $feedXmlStr = $feedXmlStr . "\n\t<channel>";
            $feedXmlStr = $feedXmlStr . "\n\t\t<title>GBMart</title>";
            $feedXmlStr = $feedXmlStr . "\n\t\t<link>https://www.gbmart.in</link>";
            $feedXmlStr = $feedXmlStr . "\n\t\t<description>This is a sample feed containing the required and recommended attributes for a variety of different products</description>";

            $feedXmlStr = $feedXmlStr . "\n\n";

            foreach ($seller_products as $seller_product) {
                $googleProductCategory = "Others > Other";
                if (strpos($seller_product->product->sub_category->name, 'mobile') !== false) {
                    $googleProductCategory = "Electronics > Communications > Telephony > Mobile Phones";
                } elseif ($seller_product->product->sub_category->name == 'shirt') {
                    $googleProductCategory = 'Men > shirt';
                } elseif ($seller_product->product->sub_category->name == 'SPORT SHOES') {
                    $googleProductCategory = 'Men > SPORT SHOES';
                } elseif ($seller_product->product->sub_category->name == 'WATCH') {
                    $googleProductCategory = 'Men > WATCH';
                }


                $feedXmlStr = $feedXmlStr . "\n\t\t<item>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:id>" . $seller_product->id . "</g:id>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:title><![CDATA[" . $seller_product->product->display_name . "]]></g:title>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:description><![CDATA[" . $seller_product->product->description_small . "]]></g:description>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:link><![CDATA[" . 'https://www.gbmart.in' . '/store/' . $seller_product->product->category->name . '/' . $seller_product->product->sub_category->name . '/' . $seller_product->product->name . '-' . $seller_product->id . '' . "]]></g:link>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:image_link><![CDATA[" . $seller_product->product->product_images[0]->url . "]]></g:image_link>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:condition>new</g:condition>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:availability>" . ($seller_product->is_in_stock ? 'in stock' : 'out of stock') . "</g:availability>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:price>" . $seller_product->seller_price . " INR</g:price>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:shipping>\n\t\t\t\t<g:country>IN</g:country>\n\t\t\t\t<g:service>Standard</g:service>\n\t\t\t\t<g:price>" . $seller_product->delivery_charge . " INR</g:price>\n\t\t\t</g:shipping>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:brand>" . $seller_product->product->brand . "</g:brand>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:mpn></g:mpn>";
                $feedXmlStr = $feedXmlStr . "\n\t\t\t<g:google_product_category><![CDATA[" . $googleProductCategory . "]]></g:google_product_category>";

                $feedXmlStr = $feedXmlStr . "\n\t\t</item>";
                $feedXmlStr = $feedXmlStr . "\n";

            }

            $feedXmlStr = $feedXmlStr . "\n\t</channel>";
            $feedXmlStr = $feedXmlStr . "\n</rss>";

            \File::put(public_path() . "/feeds.xml", $feedXmlStr);
        } catch (Exception $ex) {
            dd($ex);
            echo("Error occurred.");
        }

    }
}
