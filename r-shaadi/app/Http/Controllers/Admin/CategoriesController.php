<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;

class CategoriesController extends AdminController
{

    public function __construct()
    {
        view()->share('type', 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = "Vendors Categories";
        return view('admin.category',  compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $languages = Language::lists('name', 'id')->toArray();
        return view('admin.articlecategory.create_edit', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('error'=>TRUE, 'msg'=>$validator->messages()));
        }else{
            $category = Category::storeCategory($request->all());

            if($category->id){
                return response()->json(array('error'=>FALSE, 'msg'=>'Category has beeen successfully saved.'));
            }else{
                return response()->json(array('error'=>TRUE, 'msg'=>'Sorry, Invalid data has been send.'));
            }

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(Request $category)
    {
        echo $category;exit;
        $category = Category::lists('category.category_id','category.category_name', 'category.created_at')->toArray();
        if(!empty($category)){
            return response()->json(array('error'=>FALSE, 'category'=>$category));
        }else{
            return response()->json(array('error'=>TRUE, 'msg'=>'Sorry, Invalid data has been send.'));
        }
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $articlecategory)
    {
        $articlecategory->user_id_edited = Auth::id();
        $articlecategory->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function delete($id,Request $request)
    {
        if ( $request->isXmlHttpRequest() && $id != '')
        {
            $category = Category::where('category_id', $id)->delete();
            if(count($category)>0){
                return json_encode(array('error'=>FALSE));
            }else{
                return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.'));
            }
        }
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $categories =  Category::select(array('category.category_id','category.category_name', 'category.created_at'))->get()
            ->map(function ($categories) {
                return [
                    'category_name' => $categories->category_name,
                    'created_at' => $categories->created_at->format('d.m.Y'),
                    'action' => '<a href="'.url('admin/category/'  . $categories->category_id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>&nbsp;&nbsp;<a href="'.url('admin/category_delete/' . $categories->category_id).'" class="btn btn-sm btn-danger delete_category"><span class="glyphicon glyphicon-trash"></span> Delete</a>',
                ];
            });
        return Datatables::of($categories)
            ->remove_column('category_id')
            ->make(true);
    }

    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request)
    {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                ArticleCategory::where('id', '=', $value)->update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }

}
