<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoInputController extends Controller
{
    public function category(Request $request) {

    	$search = $request->input('q');
    	$json = \App\Category::where('category_name', 'like', $search . '%')->orderBy('category_name')->get();
    	$n = 0;
    	$arr = array();
    	foreach ($json as $output) {
    		$arr[$n]['name'] = $output->category_name;
    		$arr[$n]['id'] = $output->id;
    		$n++;
    	}
    	return response()->json($arr);
    }

    public function city(Request $request) {

    	$search = $request->input('q');
    	$json = \App\City::where('city_name', 'like', $search . '%')->orderBy('city_name')->get();
    	$n = 0;
    	$arr = NULL;
    	foreach ($json as $output) {
    		$arr[$n]['name'] = $output->city_name;
    		$arr[$n]['id'] = $output->id;
    		$n++;
    	}
    	return response()->json($arr);
    }
}
