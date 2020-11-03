<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = new Repository($product);
    }

    public function showPage(){
        return view('product.index');
    }

    public function index($id){
        $data = $this->model->where(['user_id' => $id], 'description');

        return response()->json($data);
    }

    public function store(Request $request){
        $data = $request->only($this->model->getModel()->getFillable());

        return response()->json(($this->model->create($data)));
    }

    public function update(Request $request, $id){
        $data = $request->only($this->model->getModel()->getFillable());

        if($this->model->update($data, $id)){
            return response()->json(['message' => 'ok']);
        } else {
            return response()->json(['message' => 'error']);
        }
    }

    public function show($produto_id){
        return response()->json($this->model->show($produto_id));
    }

    public function destroy($produto_id){
        if($this->model->delete($produto_id)){
            return response()->json(['message' => 'ok']);
        } else {
            return response()->json(['message' => 'error']);
        }
    }
}
