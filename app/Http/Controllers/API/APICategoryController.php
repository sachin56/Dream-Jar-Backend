<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class APICategoryController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'name')
            ->get();
    
        if ($category->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $category,
        ], 200);
    }
}
