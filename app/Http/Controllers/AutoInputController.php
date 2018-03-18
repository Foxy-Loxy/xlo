<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoInputController extends Controller
{
    public function category(Request $request) {

    	$search = $request->input('q');
    	//dd($search);
    	$result = new \App\Category;
    	$json = $result->where('category_name', 'like', $search . '%')->orderBy('category_name')->get();
    	$n = 0;
    	$arr = NULL;
    	foreach ($json as $output) {
    		$arr[$n]['name'] = $output->category_name;
    		$arr[$n]['id'] = $output->id;
    		$n++;
    	}
    	$json = json_encode($arr);

    	return response()->json($arr);
    }

    public function city(Request $request) {

    	$search = $request->input('q');
    	//dd($search);
    	$result = new \App\City;
    	$json = $result->where('city_name', 'like', $search . '%')->orderBy('city_name')->get();
    	$n = 0;
    	$arr = NULL;
    	foreach ($json as $output) {
    		$arr[$n]['name'] = $output->city_name;
    		$arr[$n]['id'] = $output->id;
    		$n++;
    	}
    	$json = json_encode($arr);

    	return response()->json($arr);
    }
}
