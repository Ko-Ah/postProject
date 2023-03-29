<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        return view('dashboard.categories.index');

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>['required','string','unique:categories'],
        ]);
                if ($validator->fails()) {
                   $flag= false;
                    $data['flag']=$flag;
                    return response()->json(['data' =>$data,'errors'=> $validator->errors()->all()]);
                }else {
                    if ($request->parentId == "" || $request->parentId == null) {

                        $flag = true;
                        if ($request->name != null || $request->name != "") {
                            $categoryItems = array();
                            $categoryItems = explode(',', $request->name);
                                $arr=array();
                            foreach ($categoryItems as $categoryItem) {

                                Category::firstOrCreate([
                                    "cat_id"=> '0',
                                    'name' => $categoryItem,
                                    'slug' =>  preg_replace('/\s+/', '-', trim($categoryItem)),
                                ]);
                                    $parentCat=Category::where('cat_id', '0')->orderBy('id', 'DESC')->first();
                                array_push($arr,$parentCat);
                                $data['flag'] = $flag;
                            }
                            return response()->json(['success' => 'آیتم با موفقیت اضافه شد', 'data' => $data,'arr'=>$arr]);

                        }
                    } else {
                            $flag=true;
                        if ($request->name != '' || $request->name != null) {
                            $categoryItems = array();
                            $arrChild = array();
                            $categoryItems = explode(',', $request->name);
                                foreach ($categoryItems as $categoryItem) {

                                    $categoryItem = Str::lower($categoryItem);
                                    Category::firstOrCreate([
                                        "cat_id"=> $request->parentId,
                                        'name' => $categoryItem,
                                        'slug' =>  preg_replace('/\s+/', '-', trim($categoryItem)),
                                    ]);
                                    $categories =Category::where('cat_id',">",'0')->orderBy('id', 'DESC')->first();
                                    array_push($arrChild,$categories);
                                    $data['flag'] = $flag;
                            }
                            return response()->json(['success' => 'آیتم با موفقیت اضافه شد', 'data' => $data,'arrChild'=>$arrChild]);
                        }

                    }
                }
        }

    public function show(Request $request)
    {

        $data['categories']= Category::where('cat_id','0')->get();
        $data['subCategories']= Category::where('cat_id','>','0')->get();

        return response()->json(['success' => 'آیتم با موفقیت اضافه شد','data'=>$data]);

    }
    public function showCategory(Request $request)
    {
        $data['categories']= Category::where('cat_id','0')->get();

        return response()->json(['success' => 'آیتم با موفقیت اضافه شد','data'=>$data]);

    }
    public function edit(Request $request)
    {

        $categories = Category::find($request->id);
        $subCat = Category::where('id',$request->childId)->get();
        return response()->json(['categories'=>$categories,'subCat'=>$subCat]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'name' =>['string','unique:categories'],
        ]);

        if ($validator->fails()) {
            $flag= false;
            $data['flag']=$flag;
            return response()->json(['data' =>$data,'errors'=> $validator->errors()->all()]);
        }else {
            $flag=true;
            if($request->parentName !=null && $request->childName ==null) {
                $category = Category::find($request->id);
                $category->name = $request->parentName;
                $name = Str::lower($request->parentName);
                $category->slug = preg_replace('/\s+/', '-', trim($name));
                $category->save();
                $parentCat = DB::table('categories')->where('id', $request->id)->orderBy('id', 'DESC')->first();
                $data['parentCat'] = $parentCat;
                $data['flag'] = $flag;
            }else if($request->parentName !=null && $request->childName !=null){
                $category = Category::find($request->id);
                $category->name = $request->parentName;
                $name = Str::lower($request->parentName);
                $category->slug = preg_replace('/\s+/', '-', trim($name));
                $category->save();
                $parentCat = DB::table('categories')->where('id', $request->id)->orderBy('id', 'DESC')->first();
                $data['parentCat'] = $parentCat;
                $data['flag'] = $flag;

                $childCategory = Category::find( $request->childId);
                $childCategory->name = $request->childName;
                $childName = Str::lower($request->childName);
                $childCategory->slug = preg_replace('/\s+/', '-', trim($childName));
                $childCategory->save();
                $childCat = DB::table('categories')->where('id', $request->childId)->orderBy('id', 'DESC')->first();
                $data['childCat'] = $childCat;
                $data['flag'] = $flag;

            }else if($request->parentName ==null && $request->childName !=null){
                $childCategory = Category::find( $request->childId);
                $childCategory->name = $request->childName;
                $childName = Str::lower($request->childName);
                $childCategory->slug = preg_replace('/\s+/', '-', trim($childName));
                $childCategory->save();
                $childCat = DB::table('categories')->where('id', $request->childId)->orderBy('id', 'DESC')->first();
                $data['childCat'] = $childCat;
                $data['flag'] = $flag;

            }
            return response()->json(['success' => 'آپدیت با موفقیت انجام شد', 'data' => $data]);
        }
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();

        if($request->childId != null){
            $childCat = Category::find($request->childId);
            $childCat->delete();
        }
        return response()->json(['success'=>'حذف با موفقیت انجام شد']);
    }

}
