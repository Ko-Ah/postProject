<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        return view('dashboard.tags.index');

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>['required','string','unique:tags'],
        ]);
        if ($validator->fails()) {
            $flag = false;
            $data['flag'] = $flag;
            return response()->json(['data' => $data,'errors'=> $validator->errors()->all()]);
        }else {

                    $flag = true;
                    $data['flag'] = $flag;
                    $tag = new Tag();
                    $tag->name = $request->name;
                    $name = Str::lower($request->name);
                    $tag->slug = preg_replace('/\s+/', '-', trim($name));

                    $tag->save();
                    $tags = DB::table('tags')->orderBy('id', 'DESC')->first();
                    $data['tags'] = $tags;
                    return response()->json(['success' => 'آیتم با موفقیت اضافه شد', 'data' => $data]);
        }

    }


    public function show(Request $request)
    {
        $data= Tag::all();

        return response()->json(['success' => 'آیتم با موفقیت اضافه شد','data'=>$data]);

    }
    public function edit(Request $request)
    {
        $tags = Tag::find($request->id);
        return response()->json(['tags'=>$tags]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>['string','unique:tags'],
        ]);
        if ($validator->fails()) {
            $flag= false;
            $data['flag']=$flag;
            return response()->json(['data' =>$data,'errors'=> $validator->errors()->all()]);
        }else {
            $flag = true;
            $data['flag'] = $flag;
            $tag = Tag::find($request->id);

                $tag->name = $request->name;
                $name = Str::lower($request->name);
                $tag->slug = preg_replace('/\s+/', '-', trim($name));
                $tag->save();
                $tags = Tag::find($request->id);
                $data['tags'] = $tags;
                return response()->json(['success' => 'آپدیت با موفقیت انجام شد', 'data' => $data]);
        }
    }

    public function destroy(Request $request)
    {
        $tag = Tag::find($request->id);
         $tag->delete();
        return response()->json(['success'=>'حذف با موفقیت انجام شد']);
    }

}
