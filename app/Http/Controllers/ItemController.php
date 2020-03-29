<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Item as ItemResource;
use App\ItemTitleDescription;
use Illuminate\Support\Arr;
use App\Category;
use App\SubCategory;
use App\Menu;
use App\Item;
use App\Constants;
use File;
class ItemController extends Controller
{
    const DEFAULT_STORAGE = Constants::DEFAULT_STORAGE_DISK;
    const DEFAULT_ITEM_IMG_STORAGE_PATH = Constants::DEFAULT_ITEM_IMG_STORAGE_PATH;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::paginate(15);
        return ItemResource::collection($items);
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
            'category_id' => 'required|integer',
            'subCategory_id' => 'required|integer',
            'menu_id' => 'required|integer',
            'value' => 'required|numeric'
        ]);

        //$user =  User::findOrFail(auth()->user()->id);
        $picturePath = '';

        if($request->hasFile('picture')) {
            $file = $request->file('picture');

            if(!$file->isValid()) {
                abort( response()->json('Invalid_file_upload', 400) );
            }
            
            $menu = Menu::findOrfail($request->menu_id);

            //$clientId = 22;//$menu->client_id;

            $name = $file->getClientOriginalName();

            $picturePath = self::DEFAULT_ITEM_IMG_STORAGE_PATH; // .'/'. $clientId;

            if (!File::exists($picturePath.'/'.$name)) {
                //abort( response()->json('File already uploaded', 422) );
                $file->move($picturePath, $file->getClientOriginalName());
            }        
  
            $picturePath = asset($picturePath.'/'.$name);
        }

        
        $newItem = Item::create([
            'category_id' => $request->category_id,
            'subCategory_id' => $request->subCategory_id,
            'menu_id' =>  $request->menu_id,
            'picturePath' => $picturePath,
            'value'=> $request->value,
            'active'=> true
        ]);

        return response($newItem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, $id)
    {
        $item = Item::findOrFail($id);
        if ($req->has('language_id')) {
            $titleDesc = ItemTitleDescription::OfItemLanguage($id, $req->language_id)->first();
            if($titleDesc) {
                $item ['title'] = $titleDesc['title'];
                $item ['description']= $titleDesc['description'];
            }
        }     
        return response($item,200);
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
            'category_id' => 'required|integer',
            'subCategory_id' => 'required|integer',
            'menu_id' => 'required|integer',
            'value' => 'required|numeric'
        ]);

      // $user =  auth()->user()->id;
       
        $item = Item::findOrFail($id);

        $picturePath = $item->picturePath;

        if($request->hasFile('picture')) {
            $file = $request->file('picture');

            if(!$file->isValid()) {
                abort( response()->json('Invalid_file_upload', 400) );
            }
            
            //$menu = Menu::findOrfail($request->menu_id);

           // $clientId = 22;// $menu->client_id;

            $name = $file->getClientOriginalName();

            $picturePath = self::DEFAULT_ITEM_IMG_STORAGE_PATH; // .'/'. $clientId;

            if (File::exists($picturePath.'/'.$name)) {
                //abort( response()->json('File already uploaded', 422) );
                $file->move($picturePath, $file->getClientOriginalName());
            }          
  
            $picturePath = asset($picturePath.'/'.$name);
        }


        $data = [
           'category_id' =>  $request->has('category_id')? $request->category_id : $item->category_id,
           'subCategory_id'=> $request->has('subCategory_id')? $request->subCategory_id: $item->subCategory_id,
           'menu_id' => $request->has('menu_id')? $request->menu_id: $item->menu_id,
           'value' => $request->has('value')? $request->value: $item->value,
           'picturePath' => $picturePath,
           'active' =>$request->has('active')? $request->active: $item->active
        ];

        $item->update($data);

       return response($item, 200);
    }

    public function searchItems(Request $request, $menu_id)
    {
        $itemList = array();
        $items = Item::where(['menu_id'=>$menu_id,'subCategory_id'=> $request->subcategory_id])->get();
        
        foreach($items as $item) {

            $titleDesc = ItemTitleDescription::OfItemLanguage($item->id, $request->language_id)->get();

            if(sizeof($titleDesc) >0) {
                $item ['title'] = $titleDesc[0]['title'];
                $item ['description']= $titleDesc[0]['description'];
            }
            array_push($itemList, $item);
        }

        return response($itemList, 200);

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
        
        $item = Item::findOrFail($id);

        if($item->delete()) {
            return response($item,200);
        }
    }

    
}
