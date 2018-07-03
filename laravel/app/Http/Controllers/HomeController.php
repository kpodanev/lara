<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function users()
    {
        $users = User::all();
         return view('users',['users'=>$users]);
    }

    public function categoryIndex()
    {
        $categories = Category::all();
        return view('index', [
            'categories' => $categories,
            ]);
    }
    public function categoryDelete($id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return redirect(route('categories.index'));
    }


    public function category(Request $request,$slug){

        $category = Category::where(['slug' => $slug])->first();
        // dd($category);
       
        return view('welcome',[
            'category'=>$category,
            ]);
    }

    public function create(Request $request, $slug=null)
    {
        $category=null;
        if($slug){
        $category = Category::where(['slug' => $slug])->first();
    }
        return view('create', [
            'category'=>$category
            ]
            );
        }
    public function save(Request $request){
        $name = $request->get('name');
        $slug = $request->get('slug');

        $validator = \Validator::make($request->all(), [
            'slug' => 'required|unique:categories,slug',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('categories.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $id = $request->get('id');
        if($id===null){
            $category = new Category();
        }else {
            $category = Category::find($id);
        }
        $category->name = $name;
        $category->slug = $slug;
        $category->save();

        return redirect(route('categories.show', ['slug' => $slug]));
    }

}