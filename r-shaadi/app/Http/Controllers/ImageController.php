<?php

namespace App\Http\Controllers;
use App\Photo;
use App\User;
use App\Gallary;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Image;

class ImageController extends Controller {

    /**
     * @param Storage $storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store( Storage $storage, Request $request )
    {
        if ( $request->isXmlHttpRequest() )
        {
            $image = $request->file( 'file' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                $file = new Photo;
                $file->file = $savedImageName;
                $file->save();
                $data = array('error'=>FALSE , 'file_id'=>$file->id, 'file_name' => $file->file);
                return json_encode( $data, JSON_UNESCAPED_SLASHES );
            }
            return json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
        }

    }


    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'slider' )->put( $imageFullName, $filesystem->get( $image ) );
    }

    /**
     * @return string
     */
    protected function getFormattedTimestamp()
    {
        return str_replace( [' ', ':'], '-', Carbon::now()->toDateTimeString() );
    }

    /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName( $timestamp, $image )
    {
        $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        return $timestamp.rand(0,999999).'.'.$ext;
    }

    /**
     * @param Storage $storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function upload( Storage $storage, Request $request )
    {
        if ( $request->isXmlHttpRequest() )
        {
            $image = $request->file( 'file' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadGallery( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                $storeFolder = public_path().'/uploads/gallary/';
                $destinationPath = $storeFolder.'/thumbnail';
                $img = Image::make($storeFolder.$savedImageName);
                $img->resize(350, 250, function ($c) {
                    $c->aspectRatio();
                     $c->upsize();
                })->save($destinationPath.'/'.$savedImageName);

                $file = new Gallary;
                $file->user_id = auth()->guard('user')->id();
                $file->gallary_img = $savedImageName;
                $file->path = url('public/uploads/gallary').'/'.$savedImageName;
                $file->save();
                $data = array('error'=>FALSE , 'file_id'=>$file->gallary_id, 'file_name' => $file->gallary_img);
                return json_encode( $data, JSON_UNESCAPED_SLASHES );
            }
            return json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
        }

    }


    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadGallery( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'gallary' )->put( $imageFullName, $filesystem->get( $image ) );
    }

    /**
     * @param Storage $storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function banner( Storage $storage, Request $request )
    {
        if ( $request->isXmlHttpRequest() )
        {
            $image = $request->file( 'file' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadBanner( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                $storeFolder = public_path().'/uploads/banner/';
                $destinationPath = $storeFolder.'/thumbnail';
                $img = Image::make($storeFolder.$savedImageName);
                $img->resize(350, 250, function ($c) {
                    $c->aspectRatio();
                     $c->upsize();
                })->save($destinationPath.'/'.$savedImageName);

                $user = User::find(auth()->guard('user')->id());
                $user->banner = $savedImageName;
                $user->save();
                $data = array('error'=>FALSE , 'file_id'=>$user->id, 'file_name' => $user->banner);
                return json_encode( $data, JSON_UNESCAPED_SLASHES );
            }
            return json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
        }

    }


    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadBanner( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'banner' )->put( $imageFullName, $filesystem->get( $image ) );
    }

    public function remove(Storage $storage, Request $request)
    {
        $input = $request->all();
        $image = Photo::find($input['file_id']);
        $file= $image->file;
        $filename = public_path().'/uploads/slider/'.$file;
        \File::delete($filename);
        $image->delete();
        return json_encode(array('error'=>FALSE , 'file_name' => $file));
        exit;
    }

    public function banner_remove(Storage $storage, Request $request)
    {
        $input = $request->all();
        $user = User::find($input['file_id']);
        $file= $user->banner;
        $filename = public_path().'/uploads/banner/'.$file;
        \File::delete($filename);
        $user->banner = '';
        $user->save();
        return json_encode(array('error'=>FALSE , 'file_name' => $file));
        exit;
    }

    public function gallary_remove(Storage $storage, Request $request)
    {
        $input = $request->all();
        $image = Gallary::where('gallary_id', $input['file_id'])->first();
        $file= $image->gallary_img;
        $filename = public_path().'/uploads/gallary/'.$file;
        
        if(\File::exists($filename)) {
            \File::delete($filename);
        }
        Gallary::where('gallary_img', $file)->delete();
        return json_encode(array('error'=>FALSE , 'file_name' => $file));
        exit;
    }

    public function getFiles($filename, Request $request){
        $ds = DIRECTORY_SEPARATOR;
        $storeFolder = public_path().'/uploads/slider/';
        if($filename != "")
        {
            $obj= array();
            $result = Photo::where('file', $filename)->first();
            if(!empty($result)){
                $obj['name'] = $result->file;
                $obj['file_id'] = $result->id;
                $obj['file'] = url('public/uploads/slider/').'/'.$result->file;
                $obj['size'] = filesize($storeFolder.$ds.$result->file);
            }
            if(!empty($obj)){
                return  json_encode(array('error'=>FALSE , 'output' => $obj));
            }else{
                return  json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
            }
            exit;
        }
    }

    public function getBannerFiles($filename, Request $request){
        $ds = DIRECTORY_SEPARATOR;
        $storeFolder = public_path().'/uploads/banner/';
        if($filename != "")
        {
            $obj= array();
            $result = User::where('banner', $filename)->first();
            if(!empty($result)){
                $obj['name'] = $result->banner;
                $obj['file_id'] = $result->id;
                $obj['file'] = url('public/uploads/banner/').'/'.$result->banner;
                $obj['thumb_path'] = url('public/uploads/banner/thumbnail').'/'.$result->banner;
                $obj['size'] = filesize($storeFolder.$ds.$result->banner);
            }
            if(!empty($obj)){
                return  json_encode(array('error'=>FALSE , 'output' => $obj));
            }else{
                return  json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
            }
            exit;
        }
    }

    public function getGallaryFiles($filename, Request $request){
        $ds = DIRECTORY_SEPARATOR;
        $storeFolder = public_path().'/uploads/gallary/';
        if($filename != "")
        {
            $obj= array();
            $result = Gallary::where('gallary_img', $filename)->first();
            if(!empty($result)){
                $obj['name'] = $result->gallary_img;
                $obj['file_id'] = $result->gallary_id;
                $obj['file'] = url('public/uploads/gallary').'/'.$result->gallary_img;
                $obj['thumb_path'] = url('public/uploads/gallary/thumbnail').'/'.$result->gallary_img;
                $obj['size'] = filesize($storeFolder.$ds.$result->gallary_img);
            }
            if(!empty($obj)){
                return  json_encode(array('error'=>FALSE , 'output' => $obj));
            }else{
                return  json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
            }
            exit;
        }
    }

    public function thumbnail()
    {
        $storeFolder = public_path().'/uploads/banner/';
        $destinationPath = $storeFolder.'/thumbnail';
        $image_files = $this->get_files($storeFolder);
        foreach ($image_files as $image) {
            if($image != 'thumbnail' && $image != '.' && $image != '..'){

                $img = Image::make($storeFolder.$image);
                $img->resize(350, 250, function ($c) {
                    $c->aspectRatio();
                     $c->upsize();
                })->save($destinationPath.'/'.$image);

               /* $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);*/
            }
        }
        echo 'success';
        exit;
    }

    /* function:  returns files from dir */
    public function get_files($images_dir,$exts = array('jpg')) {
        $files = array();
        if($handle = opendir($images_dir)) {
            while(false !== ($file = readdir($handle))) {
                $files[] = $file;
            }
            closedir($handle);
        }
        return $files;
    }

}
