<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $titulo = 'Dashboard';
        $totalVentas = Venta::sum('total_venta');
        $cantidadVentas = Venta::count();
        $productosBajosStock = Producto::where('cantidad', '<', 5)->get();
        $ventasRecientes = Venta::orderBy('created_at', 'desc')->take(5)->get();
    
        // Nuevo: Ventas por mes (con meses en español y orden correcto)
        $ventasPorMes = Venta::selectRaw('MONTH(created_at) as numero_mes, SUM(total_venta) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('numero_mes')
            ->orderBy('numero_mes')
            ->get()
            ->keyBy('numero_mes');
    
        // Meses en español y relleno de ceros
        $mesesEs = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    
        $ventasMensuales = [];
        foreach ($mesesEs as $numero => $mes) {
            $ventasMensuales[] = [
                'mes' => $mes,
                'total' => $ventasPorMes->has($numero) ? (float)$ventasPorMes[$numero]->total : 0
            ];
        }        
    
        return view('modules.dashboard.home', compact(
            'titulo', 
            'totalVentas', 
            'cantidadVentas', 
            'productosBajosStock', 
            'ventasRecientes',
            'ventasMensuales'
        ));
    }
}
