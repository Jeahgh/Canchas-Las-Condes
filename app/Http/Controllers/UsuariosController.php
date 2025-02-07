<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UsuariosController extends Controller
{

    // Vista de usuarios
    public function index(Request $request)
    {
        $query = User::where('eliminado', false);
    
        // Aplicar filtros si existen
        if ($request->nombre) {
            $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
        }
    
        if ($request->rut) {
            $query->where('rut', 'LIKE', '%' . $request->rut . '%');
        }
    
        if ($request->rol) {
            $query->where('rol', $request->rol);
        }
    
        if ($request->estado !== null && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }
    
        $usuarios = $query
            ->select('id', 'nombre', 'rut', 'email', 'telefono',
                DB::raw("CASE WHEN rol = 1 THEN 'Administrador' ELSE 'Vecino' END AS rol"),
                DB::raw("CASE WHEN estado = 1 THEN 'Habilitado' ELSE 'Deshabilitado' END AS estado"),
                'estado',
                'fecha_registro')
            ->get();
    
        return view('usuarios', compact('usuarios'));
    }

    // Obtener todos los usuarios
    public function getUsuarios()
    {
        $usuarios = User::select(
            'id',
            'nombre',
            'rut',
            'email',
            'telefono',
            'rol',
            'estado',
            DB::raw("CASE WHEN rol = 1 THEN 'Administrador' ELSE 'Vecino' END AS rol"),
            DB::raw("CASE WHEN estado = 1 THEN 'Habilitado' ELSE 'Deshabilitado' END AS estado"),
            'fecha_registro'
        )
        ->get();
    
        return response()->json(['data' => $usuarios]);
    }

    // Obtener usuario por ID
    public function getUser($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    // Crear usuario
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

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rut' => 'required|string|unique:users,rut,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'telefono' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string',
            'rol' => 'required|integer|in:1,2',
            'password' => 'nullable|min:6'
        ]);
    
        $datos = $request->all();
        
        // Solo actualiza la contraseña si se proporciona
        if (!empty($datos['password'])) {
            $datos['password'] = bcrypt($datos['password']);
        } else {
            unset($datos['password']); // Elimina el campo de contraseña si está vacío
        }
    
        $usuario->update($datos);
    
        return response()->json($usuario, 200);
    }

    //   Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::find($id);
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        // Marca como eliminado
        $usuario->update([
            'eliminado' => true
        ]);
    
        return response()->json([
            'message' => 'Usuario eliminado correctamente',
            'success' => true
        ]);
    }
    public function deshabilitarUsuario(Request $request, $id)
    {
        $usuario = User::find($id);
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        // Cambiar el estado del usuario
        $usuario->update([
            'estado' => !$usuario->estado
        ]);
    
        return response()->json([
            'message' => $usuario->estado ? 'Usuario habilitado correctamente' : 'Usuario deshabilitado correctamente',
            'success' => true,
            'estado' => $usuario->estado
        ]);
    }

    // Filtrar usuarios
    public function filtrarUsuarios(Request $request)
    {
        $query = User::where('eliminado', false);
    
        if ($request->nombre) {
            $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
        }
    
        if ($request->rut) {
            $query->where('rut', 'LIKE', '%' . $request->rut . '%');
        }
    
        if ($request->rol) {
            $query->where('rol', $request->rol);
        }
    
        if ($request->estado !== null && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }
    
        $usuarios = $query->get();
    
        // Redirigir a la vista de usuarios con los usuarios filtrados
        return view('usuarios', compact('usuarios'));
    }
}
