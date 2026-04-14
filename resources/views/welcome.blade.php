<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splitter</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4""></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</head>
<body class="bg-slate-50 font-sans antialiased">

    <nav class="flex items-center justify-between px-8 py-6 bg-white shadow-sm">
        <div class="text-2xl font-bold text-blue-600 tracking-tight">Spli<span class="text-slate-800">ter</span></div>
        <div>
            <a href="/mis-suscripciones" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Ir a mi Panel
            </a>
        </div>
    </nav>

    <header class="max-w-6xl mx-auto px-8 py-20 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-12 md:mb-0">
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Gestionar plataformas con amigos <span class="text-blue-600 text-6xl">ya NO es un drama.</span>
            </h1>
            <p class="text-xl text-slate-600 mb-8 leading-relaxed">
                Controla quién te debe qué, cuándo renovar y divide los gastos de tus suscripciones compartidas de forma automática.
            </p>
            <div class="flex gap-4">
                <a href="/mis-suscripciones" class="px-8 py-4 bg-slate-900 text-white font-semibold rounded-xl hover:scale-105 transition-transform shadow-lg">
                    Empezar ahora
                </a>
            </div>
        </div>
        <div class="md:w-1/2 flex justify-end">
            <div class="bg-white p-6 rounded-2xl shadow-2xl border border-slate-100 rotate-3 hover:rotate-0 transition-all duration-500 w-full max-w-md">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-bold">N</div>
                    <div>
                        <div class="font-bold">Netflix Premium</div>
                        <div class="text-xs text-slate-400">Próximo pago: 12 Abr</div>
                    </div>
                    <div class="ml-auto font-bold text-slate-800">17,99€</div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm p-3 bg-slate-50 rounded-lg">
                        <span>Pepe</span>
                        <span class="text-red-500 font-bold">4,50€ pendiente</span>
                    </div>
                    <div class="flex justify-between text-sm p-3 bg-green-50 rounded-lg">
                        <span>Maria</span>
                        <span class="text-green-600 font-bold font-bold italic">Pagado</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-white py-20 border-t border-slate-100">
        <div class="max-w-6xl mx-auto px-8 grid md:grid-cols-3 gap-12 text-center">
            <div>
                <div class="text-3xl mb-4 text-blue-600 italic font-bold">01</div>
                <h3 class="text-xl font-bold mb-2">Conexión Real</h3>
                <p class="text-slate-500">Modelos Eloquent vinculados para que tus datos tengan sentido.</p>
            </div>
            <div>
                <div class="text-3xl mb-4 text-blue-600 italic font-bold">02</div>
                <h3 class="text-xl font-bold mb-2">Cero Errores N+1</h3>
                <p class="text-slate-500">Consultas optimizadas con Eager Loading para una velocidad extrema.</p>
            </div>
            <div>
                <div class="text-3xl mb-4 text-blue-600 italic font-bold">03</div>
                <h3 class="text-xl font-bold mb-2">Split Automático</h3>
                <p class="text-slate-500">Calcula deudas al instante sin usar una calculadora.</p>
            </div>
        </div>
    </section>

</body>
<footer>
    <div class = "max-w-6xl mx-auto px-8 py-10 border-t border-slate-100">
        <p class="text-center text-sm text-slate-400 py-6">© 2026 Splitter. Desarrollado por Jose Manuel.</p>
</footer>
</html>