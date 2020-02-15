<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Menu as MenuResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Menu;
use App\Constants;
use File;

class MenuController extends Controller
{

    const DEFAULT_REST_PICTURE_STORAGE_PATH = Constants::DEFAULT_REST_PICTURE_STORAGE_PATH;
    const DEFAULT_LOGO_STORAGE_PATH = Constants::DEFAULT_LOGO_STORAGE_PATH;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(15);
        return MenuResource::collection($menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|integer',
            'defaultLang' => 'required|integer',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $picturePath = '';
        $logoPath ='';

        if($request->hasFile('picture')) {
            $picture = $request->file('picture');

            if(!$picture->isValid()) {
                abort( response()->json('Invalid_picture_upload', 400) );
            }

            $name = $picture->getClientOriginalName();

            $picturePath = self::DEFAULT_REST_PICTURE_STORAGE_PATH;

            if (File::exists($picturePath.'/'.$name)) {
                abort( response()->json('File already uploaded', 422) );
            }

            $picture->move($picturePath, $picture->getClientOriginalName());
  
            $picturePath = asset($picturePath.'/'.$name);
        }

        if($request->hasFile('logo')) {
            $logo = $request->file('logo');

            if(!$logo->isValid()) {
                abort( response()->json('Invalid_logo_upload', 400) );
            }

            $name = $logo->getClientOriginalName();

            $logoPath = self::DEFAULT_LOGO_STORAGE_PATH;

            if (File::exists($logoPath.'/'.$name)) {
                abort( response()->json('File already uploaded', 422) );
            }

            $logo->move($logoPath, $logo->getClientOriginalName());
  
            $logoPath = asset($logoPath.'/'.$name);
        }
      
        $newMenu = Menu::create([
            'client_id' => $request->client_id,
            'picturePath' => $picturePath,
            'logoPath' => $logoPath,
            'defaultLang' => $request->defaultLang,
            'active'=> 1
        ]);
        $menuComplete = Menu::with('language')->findOrFail($newMenu->id);
        return response($menuComplete, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::with('language')->findOrFail($id);

        return response($menu,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $menu = Menu::findOrFail($id);

        //$user =  User::findOrFail(auth()->user()->id);
     
        $data = $request->all();

        $picturePath = '';
        $logoPath ='';


        if($request->hasFile('picture')) {
            $picture = $request->file('picture');

            if(!$picture->isValid()) {
                abort( response()->json('Invalid_picture_upload', 400) );
            }

            $name = $picture->getClientOriginalName();

            $picturePath = self::DEFAULT_REST_PICTURE_STORAGE_PATH;

            if (File::exists($picturePath.'/'.$name)) {
                abort( response()->json('File already uploaded', 422) );
            }

            $picture->move($picturePath, $picture->getClientOriginalName());
  
            $picturePath = asset($picturePath.'/'.$name);

            $data['picturePath'] = $picturePath ;
        }

        if($request->hasFile('logo')) {
            $logo = $request->file('logo');

            if(!$logo->isValid()) {
                abort( response()->json('Invalid_logo_upload', 400) );
            }

            $name = $logo->getClientOriginalName();

            $logoPath = self::DEFAULT_LOGO_STORAGE_PATH;

            if (File::exists($logoPath.'/'.$name)) {
                abort( response()->json('File already uploaded', 422) );
            }

            $logo->move($logoPath, $logo->getClientOriginalName());
  
            $logoPath = asset($logoPath.'/'.$name);

            $data['logoPath'] = $logoPath ;
        }

        Arr::forget($data, ['id']); //make sure those fields wont be changed.

        $menu->update($data);

        $menuComplete = Menu::with('language')->findOrFail($menu->id);
        return response($menuComplete, 200);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if($menu->delete()) {
            return response($menu,200);
        }
    }
}
