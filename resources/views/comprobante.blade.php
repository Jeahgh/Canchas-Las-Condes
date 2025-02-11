<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Reserva - Las Condes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-8 bg-white my-8 shadow-lg">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="w-20 h-20 bg-[#004b93] flex items-center justify-center rounded-full">
                    <img src="{{ asset('imagenes/logo-las-condes.png') }}" alt="Logo Las Condes" class="w-16 h-16 object-contain">
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-800">Municipalidad de Las Condes</h1>
                    <p class="text-gray-600">Departamento de Deportes</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Comprobante N°</p>
                <p class="text-lg font-semibold">{{ rand(100000, 999999) }}</p>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center mb-8 border-b-2 border-t-2 border-gray-200 py-4">
            <h2 class="text-xl font-bold text-gray-800">COMPROBANTE DE RESERVA</h2>
            <p class="text-gray-600">Complejo Deportivo Municipal</p>
        </div>

        <!-- Details -->
        <div class="mb-8">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Fecha de Reserva</p>
                    <p class="text-lg font-semibold">{{ $fecha }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Hora</p>
                    <p class="text-lg font-semibold">{{ $hora }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Número de Cancha</p>
                    <p class="text-lg font-semibold">{{ $cancha }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Estado</p>
                    <p class="text-lg font-semibold text-green-600">Confirmado</p>
                </div>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
            <div class="flex">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Importante</h3>
                    <p class="text-sm text-yellow-700 mt-1">
                        Es obligatorio presentar carnet de identidad al momento de hacer uso de la instalación.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-sm text-gray-500 border-t border-gray-200 pt-4">
            <p>Av. Apoquindo 3400, Las Condes, Santiago</p>
            <p>Teléfono: (2) 2840 18 00 | www.lascondes.cl</p>
        </div>
    </div>

    <script>
        // Auto-print cuando la página cargue
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>