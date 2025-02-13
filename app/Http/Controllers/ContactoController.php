<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;


class ContactoController extends Controller
{



    public function index(){
        return view('contacto');
    }

    private $tiposSolicitud = [
        'consulta' => 1,
        'problema' => 2,
        'sugerencia' => 3,
        'reclamo' => 4
    ];

    public function store(Request $request){
        $request->validate([
            'tipo_solicitud' => 'required',
            'mensaje' => 'required'
        ]);

        // Convertimos el texto a número usando el mapeo
        $tipoSolicitudNumero = $this->tiposSolicitud[$request->tipo_solicitud];

        Contacto::create([
            'id_usuario' => auth()->id(),
            'tipo_solicitud' => $tipoSolicitudNumero, // Usamos el número en lugar del texto
            'mensaje' => $request->mensaje,
            'estado' => 1
        ]);

        return redirect()->back()
            ->with('success', 'Mensaje enviado correctamente');
    }
}
