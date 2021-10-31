<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Http\Resources\ListAllCategory;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
        public function index(Request $request) {
            $page = $request->page ? $request->page : 1;
            $per_page = $request->per_page ? $request->per_page : 10;
            $sort_by = $request->sort_by ? $request->sort_by : 'id';
            $order_by = $request->order_by ? $request->order_by : 'asc';

            $query = Category::orderBy($sort_by, $order_by);

            $data = $query->paginate($per_page);

            $response = new ListAllCategory($data);

            return response()->json($response);
        }

        public function store(CategoryStore $request){
            $data = Category::create($request->all());

            $response = new CategoryResource($data, 'Success Create Category');
            
            return response()->json($response);
        }

        public function update(CategoryUpdate $request, $id){
            $data = Category::find($id);
            // $data = Category::where('title', $id)->first();

            $data->update($request->all());

            $response = new CategoryResource($data, 'Success Update Category');

            return response()->json($response);
        }

        public function destroy($id){
            // $data = Category::destroy($id);

            $data = Category::find($id);
            $data->delete();

            $response = new CategoryResource($data, 'Success Delete Category');

            return response()->json($response);
        } 
        
        public function show($id){
            $data = Category::find($id);

            $response = new CategoryResource($data, 'Success Get Detail Category');

            return response()->json($response);
        }
    }
