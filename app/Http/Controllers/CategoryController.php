<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListAllCategory;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
