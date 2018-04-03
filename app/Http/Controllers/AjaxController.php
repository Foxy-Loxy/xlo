<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function phone(\App\Post $post)
    {
        \App\PostEvent::addEvent($post, 3);
        $phone = $post->user->phone;
        return response()->json(array('phone' => $phone), 200);
    }

    public function uploadPhoto(Request $request)
    {
//        dd($request->except('post_id'));
        $this->validate($request, [
            'image*' => 'mimetypes:image/jpeg,image/png,image/bmp|size:2000|required'
        ]);
        if($request->has('edit')){
            $photos = \App\Photo::where('post_id', $request->input('post_id'))->get();
            $i = 0;
            foreach ($photos as $photo){
                $response['image'][$i]['filename'] = $photo->photo_url;
                $response['image'][$i]['id'] = $photo->id;
                if($photo->type == 1)
                    $response['image'][$i]['thumbnail'] = true;
                $i++;
            }
            $response['status'] = 200;
            return response()->json($response, 200);
        }
        if($request->has('post_id'))
            $post_id = $request->input('post_id');
        else
            $post_id = NULL;

        $img_arr = $request->except('post_id');
        $c = count(\App\Photo::where('user_id', auth()->id())
            ->where('post_id', $post_id)
            ->get());
        if(count($img_arr) > 5){
            $response['status'] = '400';
            $response['message'] = 'Too Many Images';
            return response()->json($response, 400);
        }
        $c = 5 - $c;
            $response['image'] = array();
            $i = 0;
            if ($c == 0) {
                $response['status'] = '400';
                $response['message'] = 'Image Limit Reached';
                return response()->json($response, 400);
            }
            foreach ($img_arr as $image) {
                if ($c == 0) {
                    break;
                }
                $filename = $image->store('photos');
                $photo = \App\Photo::create([
                    'user_id' => auth()->id(),
                    'photo_url' => $filename,
                    'post_id' => $post_id
                ]);
                $response['image'][$i]['filename'] = $filename;
                $response['image'][$i]['id'] = $photo->id;
                $i++;
                $c--;
            }
            $response['status'] = '200';
            $response['message'] = 'Images Uploaded SUCCESSFULLY';

            return response()->json($response, 200);
    }

    public function deletePhoto(Request $request)
    {
        if (\App\Photo::find($request->input('img_id'))->user_id == auth()->id()) {
            \App\Photo::find($request->input('img_id'))->delete();
            $response['status'] = '200';
            return response()->json($response,200);
        }
        else
            $response['status'] = '400';
            return response()->json($response,400);
    }

    public function thumbnailPhoto(Request $request)
    {
        if (\App\Photo::find($request->input('img_id'))->user_id == auth()->id()) {
            $img_post = \App\Photo::find($request->input('img_id'))->post_id;
            if(\App\Photo::where('type', '1')
                ->where('post_id', $img_post)
                ->exists()) {
                $photo = \App\Photo::where('type', '1')
                            ->where('post_id', $img_post)
                            ->get()[0];
                $photo->type = 0;
                $photo->save();
            }
            $photo = \App\Photo::find($request->input('img_id'));
            $photo->type = 1;
            $photo->save();
            $response['status'] = '200';
            return response()->json($response, 200);
        } else
            $response['status'] = '400';
            return response()->json($response, 400);
    }
}
