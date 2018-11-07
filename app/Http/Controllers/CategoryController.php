<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.categories.categories');
    }

    public function add_category() {
        return view('admin.categories.add-category');
    }

    public function preview_category_img(Request $request) {
      $image = $request->file('image');
      $extension = $request->file('image')->getClientOriginalExtension(); // getting excel extension
      $dir = 'images/categories/';
      $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
      $move = $request->file('image')->move($dir, $filename);
      if($move) {
        return response()->json(['image_src'=>$filename]);
      }
    }

    public function remove_img(Request $request) {
      $file_path = public_path().'/images/categories/'.$request->path;
      $unlink = unlink($file_path);
      if($unlink) {
        return response()->json(['message'=>'IMG_DELETE']);
      }
    }

    public function create_category(Request $request)
    {
      $category = new Category;
      $category->parent_id = $request->parent_id;
      $category->name = $request->name;
      $category->description = $request->description;
      $category->image = $request->image;
      $category->url = $request->url;
      $category->active = $request->active;
      $category->save();

      if($category) {
        return response()->json(['success'=>'CATEGORY_ADD']);
      }
    }

    public function get_parent_categories() {
      $data = array();
      $categories = Category::where(['parent_id' => 0])->get();
      foreach ($categories as $category) {
        $data[] = '<option value="'.$category->id.'">'.$category->name.'</option>';
      }
      return response()->json(['categories'=>$data]);
    }

    public function get_categories_table() {
      $categories = Category::select('id', 'parent_id', 'name', 'image', 'url', 'active');

      return DataTables::of($categories)
      ->editColumn('active', function(Category $category) {
          $id = $category->id;
          $url = $category->url;
          return '<a href="'. route('admin.edit-category', ['url' => $url]) .'" name="edit" data-id="'.$id.'" class="btn btn-success edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="" onclick="return confirm("Да ли сте сигурни да желите да обришете ову категорију?")" name="delete_brand" id="'.$id.'" data-id="'.$id.'" class="btn btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        })

      ->editColumn('image', function(Category $category) {
          $image = $category->image;
          return '<img src="http://localhost/store/public/images/categories/'.$image.'" alt="" style="width:50px; height:auto">';
        })

      ->addColumn('status', function(Category $category) {
        if($category->active == 1) {
          return '<span class="label label-success">Активна</span>';
        } else {
          return '<span class="label label-danger">Неaктивна</span>';
        }
      })

      ->editColumn('parent_id', function(Category $category) {
          $parent_id = $category->parent_id;
          if($parent_id == 0) {
            return '<span class="label label-primary">Главна категорија</span>';
          } else {
            $parent = Category::where(['id' => $parent_id])->first();
            return 'Подкатегорија за ' . '<span class="label label-info">' . $parent->name . '</span>';
          }
        })->rawColumns(['active', 'image', 'status', 'parent_id'])
            ->make(true);
    }

    public function edit_category($url) {
      $category = Category::where(['url' => $url])->first();
      return view('admin.categories.categories')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
