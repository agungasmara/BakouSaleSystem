<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Product;
use DB;
use Carbon\Carbon;
use Session;

class ProductController extends Controller
{

    public function index($id){
    	// Get Info product Details
		$productInfo = $this->getProduct($id);	
		// Get product image
		$images = array();
		$results = $this->getProductImages($id);
		foreach ($results as $result) {
			$images[] = array(
				'image' => $result->image
			);
		}
		//Get Attribute group
		$attribute_groups = $this->getProductAttributes($id);
		// Get DiscountProduct
		$discounts = $this->getProductDiscounts($id);
		$discount_arr = array();
		foreach ($discounts as $discount) {
			$discount_arr[] = array(
				'quantity' => $discount->quantity,
				'price' => $discount->price
			);
		}
		// Review
		if ($productInfo->minimum) {
			$minimum = $productInfo->minimum;
		} else {
			$minimum = 1;
		}
		// Review
		$review_status = config_review_status;
		$reviews = sprintf("Review", (int)$productInfo->reviews);
		$rating = (int)$productInfo->rating;
		// Product relate
		$product_related = array();

		$results = $this->getProductRelated($id);

		foreach ($results as $result) {
			// if ($result->image) {
			// 	$image = $result->image;
			// } else {
			// 	$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_related_width'), $this->config->get($this->config->get('config_theme') . '_image_related_height'));
			// }

			// if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
			// 	$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			// } else {
			// 	$price = false;
			// }

			// if ((float)$result['special']) {
			// 	$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			// } else {
			// 	$special = false;
			// }

			// if ($this->config->get('config_tax')) {
			// 	$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
			// } else {
			// 	$tax = false;
			// }

			if (config_review_status) {
				$rating = (int)$result->rating;
			} else {
				$rating = false;
			}

			$product_related[] = array(
				'product_id'  => $result->product_id,
				'thumb'       => $result->image,
				'name'        => $result->name,
				'description' => html_entity_decode($result->description, ENT_QUOTES, 'UTF-8'),
				// 'price'       => $price,
				// 'special'     => $special,
				// 'tax'         => $tax,
				'minimum'     => $result->minimum > 0 ? $result->minimum : 1,
				'rating'      => $rating,
				'href'        => 'product/product', 'product_id=' . $result->product_id
			);
		}
		return response()->json(['data' => $productInfo,'images'=>$images,'attribute_groups' => $attribute_groups,'discount' => $discount_arr,'product_relate' => $product_related,'review_status' => $review_status,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);

    }
    
    public function getProductDiscounts($product_id) {
		$query = DB::select("SELECT * FROM ".env('DB_PREFIX')."product_discount 
				WHERE product_id = '".(int)$product_id."'
				AND customer_group_id = '".config_customer_group_id."'
				AND quantity > 1 
				AND ((date_start = '0000-00-00' OR date_start < NOW()) 
				AND (date_end = '0000-00-00' OR date_end > NOW())) 
				ORDER BY quantity ASC, priority ASC, price ASC");
		return $query;
	}

	public function getProductImages($product_id) {
		$query = DB::table("product_image")
				->where("product_id",$product_id)
				->orderBy('sort_order','asc')
				->get();
		return $query;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();
		$product_attribute_group_query = DB::select("SELECT ag.attribute_group_id, agd.name 
										FROM ".env('DB_PREFIX')."product_attribute pa 
										LEFT JOIN ".env('DB_PREFIX')."attribute a ON (pa.attribute_id = a.attribute_id) 
										LEFT JOIN ".env('DB_PREFIX')."attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) 
										LEFT JOIN ".env('DB_PREFIX')."attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) 
										WHERE pa.product_id = '".(int)$product_id."'
										AND agd.language_id = '".config_language_id."'
										ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = DB::select("SELECT a.attribute_id, ad.name, pa.text FROM ".env('DB_PREFIX')."product_attribute pa LEFT JOIN ".env('DB_PREFIX')."attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN ".env('DB_PREFIX')."attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group->attribute_group_id . "' AND ad.language_id = '" . config_language_id . "' AND pa.language_id = '" . config_language_id . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute->attribute_id,
					'name'         => $product_attribute->name,
					'text'         => $product_attribute->text
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group->attribute_group_id,
				'name'               => $product_attribute_group->name,
				'attribute'          => $product_attribute_data
			);
		}
		return $product_attribute_group_data;
	}

	public function getProductRelated($product_id) {
		$product_data = array();
		$query = DB::select("SELECT * FROM ".env('DB_PREFIX')."product_related pr 
							LEFT JOIN ".env('DB_PREFIX')."product p ON (pr.related_id = p.product_id) 
							LEFT JOIN ".env('DB_PREFIX')."product_to_store p2s ON (p.product_id = p2s.product_id) 
							WHERE pr.product_id = '".(int)$product_id."'
							AND p.status = '1' 
							AND p.date_available <= NOW() 
							AND p2s.store_id = '".config_store_id."'
							");

		foreach ($query as $result) {
			$product_data[$result->related_id] = $this->getProduct($result->related_id);
		}
		return $product_data;
	}
}
