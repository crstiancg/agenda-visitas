<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('visitor');
        
        $selectedDate = $request->input('date_filter', Carbon::today()->format('Y-m-d')); // Si no se proporciona, usa hoy.
        $startOfDay = Carbon::createFromFormat('Y-m-d', $selectedDate)->startOfDay();
    
        $visits = Visit::query()
            ->when($search, function ($query, $search) {
                return $query->whereHas('visitor', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            })
            ->whereDate('start_date', $selectedDate) 
            ->orderBy('created_at', 'desc');
    
        $visits = $visits->paginate(10);
    
        return view('visita.index', compact('visits'));
    }
}
