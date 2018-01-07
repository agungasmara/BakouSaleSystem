<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Product;
use DB;
use Carbon\Carbon;
class ProductController extends Controller
{
    // public function GetProduct($num)
    // {
    // 	return Product::take($num)->get();
    // }

    private $currencies = array();
    private $tax_rates = array();

    public function index($id){

    	//dd(config_encryption);

		$prdouctInfo = $this->getProduct($id);
		if($prdouctInfo){
			//Get Price
			if (!config_customer_price) {
				// dd("pricetest");
				$session_currency='$';
				$price = $this->Currencyformat($this->calculate($prdouctInfo['price']), $prdouctInfo['tax_class_id'], config_tax, $session_currency);
			} else {
				$price = false;
			}

			// dd($price);
			// Get Discount
			$discounts = $this->getProductDiscounts($id);
			$discount_arr = array();
			foreach ($discounts as $discount) {
				// dd($discount->quantity);
				$discount_arr[] = array(
					'quantity' => $discount->quantity,
					// 'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
					'price' => $discount->price
				);
			}
		}
		
		return response()->json(['data' => $prdouctInfo,'discount' => $discount_arr,'success' => true, 'message' => 'Success']);
    }

    public function Currencyformat($number, $currency, $value = '', $format = true) {
		$symbol_left = $this->currencies[$currency]['symbol_left'];
		$symbol_right = $this->currencies[$currency]['symbol_right'];
		$decimal_place = $this->currencies[$currency]['decimal_place'];

		if (!$value) {
			$value = $this->currencies[$currency]['value'];
		}

		$amount = $value ? (float)$number * $value : (float)$number;
		
		$amount = round($amount, (int)$decimal_place);
		
		if (!$format) {
			return $amount;
		}

		$string = '';

		if ($symbol_left) {
			$string .= $symbol_left;
		}

		$string .= number_format($amount, (int)$decimal_place, $this->language->get('decimal_point'), $this->language->get('thousand_point'));

		if ($symbol_right) {
			$string .= $symbol_right;
		}

		return $string;
	}

    public function calculate($value, $tax_class_id, $calculate = true) {
		if ($tax_class_id && $calculate) {
			$amount = 0;

			$tax_rates = $this->getRates($value, $tax_class_id);

			foreach ($tax_rates as $tax_rate) {
				if ($calculate != 'P' && $calculate != 'F') {
					$amount += $tax_rate['amount'];
				} elseif ($tax_rate['type'] == $calculate) {
					$amount += $tax_rate['amount'];
				}
			}

			return $value + $amount;
		} else {
			return $value;
		}
	}

	public function getRates($value, $tax_class_id) {
		$tax_rate_data = array();

		if (isset($this->tax_rates[$tax_class_id])) {
			foreach ($this->tax_rates[$tax_class_id] as $tax_rate) {
				if (isset($tax_rate_data[$tax_rate['tax_rate_id']])) {
					$amount = $tax_rate_data[$tax_rate['tax_rate_id']]['amount'];
				} else {
					$amount = 0;
				}

				if ($tax_rate['type'] == 'F') {
					$amount += $tax_rate['rate'];
				} elseif ($tax_rate['type'] == 'P') {
					$amount += ($value / 100 * $tax_rate['rate']);
				}

				$tax_rate_data[$tax_rate['tax_rate_id']] = array(
					'tax_rate_id' => $tax_rate['tax_rate_id'],
					'name'        => $tax_rate['name'],
					'rate'        => $tax_rate['rate'],
					'type'        => $tax_rate['type'],
					'amount'      => $amount
				);
			}
		}

		return $tax_rate_data;
	}

    public function getProductDiscounts($product_id) {
		// $query = DB::table('product_discount')
		// 		->where('product_id',$product_id)
		// 		->where('customer_group_id',1)
		// 		->where('quantity','>',1)
		// 		// ->where('date_start','=','0000-00-00','or','date_start','<',Carbon::today())
		// 		// ->where('date_end','=','0000-00-00','or','date_end','<',Carbon::today())	
		// 		->orderBy('quantity','asc')
		// 		->orderBy('priority','asc')
		// 		->orderBy('price','asc')
		// 		->get();
		$query = DB::select("SELECT * FROM sg_product_discount 
				WHERE product_id = 49
				AND customer_group_id = 1
				AND quantity > 1 
				AND ((date_start = '0000-00-00' OR date_start < NOW()) 
				AND (date_end = '0000-00-00' OR date_end > NOW())) 
				ORDER BY quantity ASC, priority ASC, price ASC");
		return $query;
	}

}
