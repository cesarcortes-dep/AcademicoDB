<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class EstudiantesController extends Controller
{
    public function index()
    {

        return Estudiante::all();
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Estudiante::create($inputs);
        return response()->json([
            'data' => $e,
            'mensaje' => 'ESTUDIANTE ACTULIZADO CON EXITO',
        ]);
    }


    public function update(Request $request, $id)
    {
        $e = Estudiante::find($id);
        if (isset($e)) {
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'ESTUDIANTE ACTULIZADO CON EXITO',
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => 'No se actulizo el Estudiante',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => 'No existe Estudiante',
            ]);
        }
    }


    public function show($id)
    {
        $e = Estudiante::find($id);
        if (isset($e)) {

            return response()->json([
                'data' => $e,
                'mensaje' => 'ESTUDIANTE ENCONTRADO CON EXITO',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => 'No existe Estudiante',
            ]);
        }
    }

    public function destroy($id)
    {
        $e = Estudiante::find($id);
        if (isset($e)) {
            $res = Estudiante::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'ESTUDIANTE ELIMINADO CON EXITO',
                ]);
            } else {
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'Estudiante no existe',
                ]);
            }
        }else{
            return response()->json([
                'error' => $e,
                'mensaje' => 'No existe el Estudiante',
            ]);
        }
    }
}
