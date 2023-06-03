<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }
  
    public function index()
    {
        $categoria = $this->categoria->paginate('20');

        return response()->json($categoria, 200);
    }

    public function show($id)
    {
        try{

            $categoria = $this->categoria->findOrFail($id);

            return response()->json([
                'data' => [
                    'data' => $categoria
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function store(CategoriaRequest $request)
    {
        $data = $request->all();
        
        try{

            $this->categoria->create($data);

            return response()->json([
                'data' => [
                    'msg' => "Categoria cadastrada com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function update(CategoriaRequest $request, $id)
    {
        $data = $request->all();
        
        try{

            $categoria = $this->categoria->findOrFail($id);
            $categoria->update($data);

            return response()->json([
                'data' => [
                    'msg' => "Categoria atualizada com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function destroy(string $id)
    {
        try{

            $categoria = $this->categoria->findOrFail($id);
            $categoria->delete();

            return response()->json([
                'data' => [
                    'msg' => "Categoria excluída com sucesso!"
                ]
            ], 200);


        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
