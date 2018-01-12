<?php
namespace App\Http\Controllers\Admin;
use App\Page;
use App\Setting;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Datatables;
use Validator;

class PagesController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'pages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!Session::has('contact_setting')){
            Session::flash('pages', TRUE);
        }

        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }

        $SETTINGS = (object) $data;

        $title = "Manage Pages";
        return view('admin.pages',  compact('title','SETTINGS'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @return Response
     */
    public function create()
    {
        $title = 'Add New Page';
        return view('admin.add_page', compact('title'));
    }

    /**
     * Store a newly created page content in storage.
     *
     * @return Response
     */

    public function store(Request $request)
    {
        $title = 'Add New Page';
        $messages = array(
            'title.required' => 'Please enter title.',
            'slug.required' => 'Please enter page slug.',
            'content.required' => 'Please enter page content.',
        );

        $rules = array(
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        );



        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/pages/create')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $page = Page::create(['title'=>$input['title'], 'slug'=> $input['slug'], 'content'=>$input['content'], 'publish'=>$input['publish']]);
        if($page->id){
            return redirect('admin/pages')->with('status', 'Page content has been successfully saved.');
        }else{
            return redirect('admin/pages/create')->with('status', 'Page content not save. Please try again');
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
        $page = Page::find($id);
        if(!empty($page)){
            $title = 'Edit Page';
            return view('admin.add_page', compact('title','page'));
        }else{
            return redirect('admin/pages');
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
        $title = 'Edit Page';
        $messages = array(
            'title.required' => 'Please enter title.',
            'slug.required' => 'Please enter page slug.',
            'content.required' => 'Please enter page content.',
        );

        $rules = array(
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/pages/'.$input['id'].'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $page = Page::find($input['id']);
        $page->title = $input['title'];
        $page->slug = $input['slug'];
        $page->content = $input['content'];
        $page->publish = $input['publish'];
        $page->save();

        if($page->id){
            return redirect('admin/pages')->with('status', 'Page content has been successfully updated.');
        }else{
            return redirect('admin/pages/'.$input['id'].'/edit')->with('status', 'Page content not updated. Please try again');
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
        $page = Page::find($id);
        if(!empty($page)){
            $page->delete();
            return json_encode(array('error'=>FALSE));
        }else{
            return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.'));
        }
        exit;
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $page =  Page::select(array('id','title','slug','content','publish'))->get()
            ->map(function ($page) {
                return [
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'publish' => ($page->publish) ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>',
                    'action' => '<a href="'.url('admin/pages/'  . $page->id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>&nbsp;&nbsp;<a href="'.url('admin/pages_delete/' . $page->id).'" class="btn btn-sm btn-danger delete_pages"><span class="glyphicon glyphicon-trash"></span> Delete</a>',
                    'id' => $page->id,
                ];
            });
        return Datatables::of($page)
            ->remove_column('id')
            ->escapeColumns([])
            ->make(true);
    }
}