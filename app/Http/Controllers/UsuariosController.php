<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::select('id', 'nombre', 'rut', 'email', 'telefono', 'rol', 'estado', 'fecha_registro')
            ->get();
        return view('usuarios', compact('usuarios'));
    }

    public function getUsuarios()
    {
        $usuarios = User::select('id', 'nombre', 'rut', 'email', 'telefono', 'rol', 'estado', 'fecha_registro')
            ->get();
        return response()->json(['data' => $usuarios]);
    }

    public function getUser($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

     public function createUser(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'email' => 'required|email|unique:users',
             'telefono' => 'required|min:9|max:9',
             'password' => 'required|min:6'
         ]);

         $usuario = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'telefono' => $request->telefono,
             'password' => bcrypt($request->password),
             'estado' => 1
         ]);

         return response()->json($usuario);
     }

     public function deshabilitarUsuario(Request $request, $id)
     {
         $usuario = User::find($id);
    
         if (!$usuario) {
             return response()->json(['error' => 'Usuario no encontrado'], 404);
         }
    
        //  Cambiamos el estado al opuesto del actual
         $nuevoEstado = $usuario->estado === 1 ? 0 : 1;
            
         $usuario->update([
             'estado' => $nuevoEstado
         ]);
    
         $mensaje = $nuevoEstado === 0 ? 'Usuario deshabilitado correctamente' : 'Usuario habilitado correctamente';
    
         return response()->json([
             'message' => $mensaje,
             'estado' => $nuevoEstado,   //Añadimos el nuevo estado a la respuesta
             'usuario' => $usuario
         ]);
     }



    // Actualizar usuario
     public function update(Request $request, $id)
     {
         $usuario = User::find($id);

         if (!$usuario) {
             return response()->json(['error' => 'Usuario no encontrado'], 404);
         }

         $request->validate([
             'name' => 'sometimes|required|string|max:255',
             'email' => 'sometimes|required|email|unique:users,email,' . $id,
             'telefono' => 'sometimes|required|min:9|max:9',
             'password' => 'sometimes|required|min:6'
         ]);

         $usuario->update([
             'name' => $request->name ?? $usuario->name,
             'email' => $request->email ?? $usuario->email,
             'telefono' => $request->telefono ?? $usuario->telefono,
             'password' => $request->password ? bcrypt($request->password) : $usuario->password
         ]);

         return response()->json($usuario);
     }

    //   Eliminar usuario
     public function destroy($id)
     {
         $usuario = User::find($id);

         if (!$usuario) {
             return response()->json(['error' => 'Usuario no encontrado'], 404);
         }
    
         $usuario->update([
             'eliminado' => true
         ]);
    
         return response()->json(['message' => 'Usuario eliminado correctamente']);
     }
}
