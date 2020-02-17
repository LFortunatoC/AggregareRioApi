<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Language as LanguageResource;
use Illuminate\Support\Facades\Storage;
use App\Language;
use App\Constants;
use File;
// use App\User; 

class LanguageController extends Controller
{

    const DOCUMENT_FOLDER = Constants::DOCUMENT_FOLDER;
    const DEFAULT_STORAGE = Constants::DEFAULT_STORAGE_DISK;
    const DEFAULT_STORAGE_PATH = Constants::DEFAULT_FLAGS_STORAGE_PATH;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::paginate(15);
        return LanguageResource::collection($languages);
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
            'language' => 'required|string',
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $flagPath = '';

        if($request->hasFile('flag')) {
            $file = $request->file('flag');

            if(!$file->isValid()) {
                abort( response()->json('Invalid_file_upload', 400) );
            }

            $name = $file->getClientOriginalName();

            $flagPath = self::DEFAULT_STORAGE_PATH;

            if (File::exists($flagPath.'/'.$name)) {
                abort( response()->json('File already uploaded', 422) );
            }

            $file->move($flagPath, $file->getClientOriginalName());
  
            $flagPath = asset($flagPath.$name);
        }

        
        $newLanguage = Language::create([
            'language' => $request->language,
            'description' => $request->description,
            'flagPath' => $flagPath,
            'active'=> true,
        ]);

        return response($newLanguage, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Langauge::findOrFail($id);

        return response($language,200);
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
        $validationData = $request->validate([
            'language' => 'required|string',
        ]);

       $user =  auth()->user()->id;
       $language = Language::findOrFail($id);

       $data = [
           'language' =>  $request->has('language')? $request->language : $language->language,
           'description'=> $request->has('description')? $request->description: $language->description,
           'flagPath' => $request->has('flagPath')? $request->flagPath: $language->flagPath,
           'active' =>$request->has('active')? $request->active: $language->active
       ];

        $language->update($data);

       return response($language, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $minAccess = Constants::REQ_MIN_ACCESS;
        // $user = Auth::user();
        // $userRole =  User::with('permissions')->findOrFail($user->id);;

        // if ($userRole->permissions->role !== $minAccess ) {
        //     abort( response()->json('Access Denied insufficient permissions', 403) );
        // }
        
        $language = Language::findOrFail($id);

        if($language->delete()) {
            return response($language,200);
        }
    }
}
