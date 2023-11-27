<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $e = User::create($inputs);
        return response()->json([
            'data' => $e,
            'mensaje' => 'REGISTRADO CON EXITO',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $e = User::find($id);
        if (isset($e)) {
            return response()->json([
                'data' => $e,
                'mensaje' => 'ENCONTRADO CON EXITO',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => 'No existe',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = User::find($id);
        if (isset($e)) {
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password);
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'ACTULIZADO CON EXITO',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $e = User::find($id);
        if (isset($e)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $e,
                    'mensaje' => ' ELIMINADO CON EXITO',
                ]);
            } else {
                return response()->json([
                    'data' => $e,
                    'mensaje' => 'No existe',
                ]);
            }
        }else{
            return response()->json([
                'error' => $e,
                'mensaje' => 'No existe',
            ]);
        }
    }
}
