<?php
namespace App\Http\Controllers\Admin;
use App\Slider;
use App\Photo;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Datatables;
use Validator;
class SliderController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'slider');
    }
    /**
* Display a listing of the resource.
*
* @return Response
*/
    public function index()
    {
        $title = "Manage Slider Images";
        return view('admin.slider',  compact('title'));
    }
    /**
* Show the form for creating a new resource.
*
* @return Response
*/
    public function create()
    {
        $title = 'Add Slider Images';
        return view('admin.add_slider', compact('title'));
    }
    /**
* Store a newly created resource in storage.
*
* @return Response
*/
    public function store(Request $request)
    {
        $title = 'Add Slider Images';
        $messages = array(
            'title.required' => 'Please enter title.',
            'attachment.required' => 'Please attach slider image.',
        );
        $rules = array(
            'title' => 'required',
            'attachment' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/slider/create')
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $slider = Slider::create(['title'=>$input['title'], 'image'=> $input['attachment']]);
        if($slider->id){
            return redirect('admin/slider')->with('status', 'Slider image has been successfully saved.');
        }else{
            return redirect('admin/slider/create')->with('status', 'Slider image not save. Please try again');
        }
    }
    /**
* Show the form for editing the specified resource.
*
* @param  int $id
* @return Response
*/
    public function edit($id)
    {
        $slider = Slider::find($id);
        if(!empty($slider)){
            $title = 'Edit Slider Images';
            return view('admin.add_slider', compact('title','slider'));
        }else{
            return redirect('admin/slider');
        }
    }
    /**
* Update the specified resource in storage.
*
* @param  int $id
* @return Response
*/
    public function update(Request $request)
    {
        $title = 'Edit Slider Images';
        $input = $request->all();
        $messages = array(
            'title.required' => 'Please enter title.',
            'attachment.required' => 'Please attach slider image.',
        );
        $rules = array(
            'title' => 'required',
            'attachment' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/slider/'.$input['id'].'/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $slider = Slider::find($input['id']);
        $slider->image = $input['attachment'];
        $slider->title = $input['title'];
        $slider->save();
        if($slider->id){
            return redirect('admin/slider')->with('status', 'Slider image has been successfully update.');
        }else{
            return redirect('admin/slider/'.$input['id'].'/edit')->with('status', 'Slider image not save. Please try again');
        }
    }
    /**
* Remove the specified resource from storage.
*
* @param $id
* @return Response
*/
    public function delete($id,Request $request)
    {
        $slider = Slider::find($id);
        $image = Photo::where('file', $slider->image)->first();
        if(!empty($image)){
            $file= $image->file;
            $filename = public_path().'/uploads/slider/'.$file;
            \File::delete($filename);
            $image->delete();
            $slider->delete();
            return json_encode(array('error'=>FALSE));
        }else{
            return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.please try again after some times.'));
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
        $slider =  Slider::select(array('slider.id','slider.title', 'slider.image','slider.order'))->get()
            ->map(function ($slider) {
                return [
                    'title' => $slider->title,
                    'image' => '<a href="javascript:void(0);" class="slider_img"><img src="'. url('public/uploads/slider/').'/'.$slider->image.'" width="100" /></a>',
                    'order' => $slider->order,
                    'action' => '<a href="'.url('admin/slider/'  . $slider->id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>&nbsp;&nbsp;<a href="'.url('admin/slider_delete/' . $slider->id).'" class="btn btn-sm btn-danger delete_slider"><span class="glyphicon glyphicon-trash"></span> Delete</a>',
                    'id' => $slider->id,
                ];
            });
        return Datatables::of($slider)
            ->setRowId('id') // via column name if exists else just return the value
            ->setRowId(function($slider) {
                return $slider->id;
            }) // via closure
            ->setRowId('{{ $id }}')
            ->remove_column('id')
            ->escapeColumns([])
            //->rawColumns(['action', 'image'])
            ->make(true);
    }
    /**
* Reorder items
*
* @param items list
* @return items from @param
*/
    public function PostReorder(Request $request)
    {
        $lists = $request->orderval;
        $order = 1;
        foreach ($lists as $value) {
            if ($value != '') {
                Slider::where('id', '=', $value)->update(array('order' => $order));
                $order++;
            }
        }
        return json_encode($lists);
        exit;
    }
}
