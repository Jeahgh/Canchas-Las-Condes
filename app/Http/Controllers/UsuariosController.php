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
        try {
            // Primero validamos los datos
            $request->validate([
                'nombre' => 'required|string|max:255',
                'rut' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'telefono' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'genero' => 'required|string',
                'rol' => 'required|integer|in:1,2', // Validamos que el rol sea 1 o 2
                'password' => 'required|min:6'
            ]);
    
            $usuario = User::create([
                'nombre' => $request->nombre,
                'rut' => $request->rut,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero,
                'rol' => $request->rol,
                'password' => bcrypt($request->password),
                'estado' => 1,
                'fecha_registro' => now(), // Agregamos la fecha de registro
                'ultima_conexion' => now(), // Establecemos la última conexión
                'intentos_fallidos' => 0 // Inicializamos los intentos fallidos
            ]);
    
            return response()->json($usuario, 201);
    
        } catch (\Exception $e) {
            // Log del error para debugging
            \Log::error('Error al crear usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el usuario', 'details' => $e->getMessage()], 500);
        }
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
