<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Http\Requests\BlogCategoryStore;
use Modules\Blog\Http\Requests\BlogCategoryUpdate;
use Modules\Blog\Transformers\BlogCategoryResource;
use Modules\Blog\Transformers\ListAllBlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        $page = $request->page ? $request->page : 1;
        $per_page = $request->per_page ? $request->per_page : 10;
        $sort_by = $request->sort_by ? $request->sort_by : 'id';
        $order_by = $request->order_by ? $request->order_by : 'asc';

        $query = BlogCategory::orderBy($sort_by, $order_by);

        $data = $query->paginate($per_page);

        $response = new ListAllBlogCategory($data);

        return response()->json($response);
    }

    public function store(BlogCategoryStore $request){
        $data = BlogCategory::create($request->all());

        $response = new BlogCategoryResource($data, 'Success Create Category');
        
        return response()->json($response);
    }

    public function update(BlogCategoryUpdate $request, $id){
        $data = BlogCategory::find($id);
        // $data = BlogCategory::where('title', $id)->first();

        $data->update($request->all());

        $response = new BlogCategoryResource($data, 'Success Update Category');

        return response()->json($response);
    }

    public function destroy($id){
        // $data = BlogCategory::destroy($id);

        $data = BlogCategory::find($id);
        $data->delete();

        $response = new BlogCategoryResource($data, 'Success Delete Category');

        return response()->json($response);
    } 
    
    public function show($id){
        $data = BlogCategory::find($id);

        $response = new BlogCategoryResource($data, 'Success Get Detail Category');

        return response()->json($response);
    }
}

