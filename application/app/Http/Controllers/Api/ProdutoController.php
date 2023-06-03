<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
  
    public function index()
    {
        $produto = $this->produto->with('categorias')->paginate('5');

        return response()->json($produto, 200);
    }

    public function show($id)
    {
        try{

            $produto = $this->produto->findOrFail($id);

            return response()->json([
                'data' => [
                    'data' => $produto
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    public function store(ProdutoRequest $request)
    {
        $data = $request->all();
        
        try{

            $this->produto->create($data);

            return response()->json([
                'data' => [
                    'msg' => "Produto cadastrado com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    public function update(ProdutoRequest $request, string $id)
    {
        $data = $request->all();
        
        try{

            $produto = $this->produto->findOrFail($id);
            $produto->update($data);

            return response()->json([
                'data' => [
                    'msg' => "Produto atualizado com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    public function destroy(string $id)
    {
        try{

            $produto = $this->produto->findOrFail($id);
            $produto->delete();

            return response()->json([
                'data' => [
                    'msg' => "Produto excluído com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
