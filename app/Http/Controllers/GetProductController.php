<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class GetProductController extends Controller
{
    public function byCity($city){

     	if(ctype_alpha($city)){

        $url = 'https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term';
        $result = Http::get($url);
        $date = date("Y-m-d H:00:00");

          	for($i = 0; $i < sizeof($result['forecastTimestamps']); $i++){

              	if($result['forecastTimestamps'][$i]['forecastTimeUtc'] == $date){

                	$currentCondition = $result['forecastTimestamps'][$i]['conditionCode'];
					$products = DB::table('get_products')->where('conditionCode', $currentCondition)->get()->take(5);

                  		foreach($products as $product){
                      	$productsArray[] = [
                          	'sku' => $product->sku,
                          	'name' => $product->name,
                          	'price' => $product->price
                      	];
                		}
                  
                  	$result = array(
                      	'city' => $city,
                      	'current_weather' => $currentCondition,
                      	'recommended_products' => $productsArray,
                      	'source of the data, is' => 'LHMT'
                  	);

                $result = json_encode($result);

                  	return $result;
              	}
          	}
		}
		else{ 
			$result="The city can only contain letters!"; 
			return $result;}
  	}
}
