<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = new Repository($product);
    }

    public function showPage(){
        $id = Auth::user()->getAuthIdentifier();
        $products = $this->model->where(['user_id' => $id], 'description');

        return view('product.index', compact('products'));
    }

    public function index($id){
        $data = $this->model->where(['user_id' => $id], 'description');

        return response()->json($data);
    }

    public function store(Request $request){
        $data = $request->only($this->model->getModel()->getFillable());

        $data['price'] = $this->replaceValue($data['price']);

        return response()->json(($this->model->create($data)), 201);
    }

    public function update(Request $request, $id){
        $data = $request->only($this->model->getModel()->getFillable());

        $result = $this->model->update($data, $id);
        if(!$result){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($result);
    }

    public function show($produto_id){
        $product = $this->model->show($produto_id);

        if(!$product){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($product);
    }

    public function destroy($produto_id){
        $result = $this->model->delete($produto_id);

        if(!$result){
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($result);
    }

    public function replaceValue($valor){
        return str_replace(',', '.', $valor);
    }
}
