<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitRequest;
use App\Models\Visit;
use App\Models\Visitor;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('visitor');

        $visits = Visit::query()
            ->when($search, function ($query, $search) {
                return $query->whereHas('visitor', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            })
            ->orderBy('created_at', 'desc');

        if (auth()->guest()) {
            $visits = $visits->where('status', 'Confirmado');
        }

        $visits = $visits->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('visits.index', compact('visits'));
    }

    public function show()
    {
        // return view('visits.show');
    }

    public function create()
    {
        $visitors = Visitor::orderBy('name')->get();
        $entities = Visitor::$entities;

        return view('visits.create')->with(compact('visitors', 'entities'));
    }

    public function store(StoreVisitRequest $request)
    {
        $date = $request->get('date');
        $start_hour = $request->get('start_hour');

        $start_date = Carbon::createFromFormat('d/m/Y H:i', $date . ' ' . $start_hour);
        $end_date = $start_date->copy()->addMinutes(30);

        // Save the data
        $visit = Visit::create([
            'subject' => $request->get('subject'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'visitor_id' => $request->get('visitor_id'),
            'user_id' => $request->get('user_id'),
        ]);

        return redirect()->route('visits.index')->with(['status' => "¡La visita fue creada exitosamente!"]);
    }

    public function edit(Visit $visit)
    {
        $entities = Visitor::$entities;
        $visitors = Visitor::orderBy('name')->get();
        $statuses = Visit::$statuses;

        return view('visits.edit', compact('visit', 'statuses', 'visitors', 'entities'));
    }

    public function update(StoreVisitRequest $request, Visit $visit)
    {
        $date = $request->get('date');
        $start_hour = $request->get('start_hour');
        $start_date = Carbon::createFromFormat('d/m/Y H:i', $date . ' ' . $start_hour);
        $end_date = $start_date->copy()->addMinutes(30);

        // Save the data
        $visit->update([
            'subject' => $request->get('subject'),
            'start_date' => $start_date,
            'status' => $request->get('status'),
            'end_date' => $end_date,
            'visitor_id' => $request->get('visitor_id'),
            'user_id' => $request->get('user_id'),
        ]);

        return redirect()->route('visits.index')->with(['status' => "¡La visita fue editada exitosamente!"]);
    }

    public function updateStatus(Request $request): JsonResponse
    {
        try {
            $visit = Visit::findOrFail($request->input('id'));
            // dd($visit);
            $visit->status = $request->input('status');
            $visit->save();

            $v = $visit->visitor;
            // $visitor = Visitor::findOrFail($request->input('id'));
            if($visit->status == "Confirmado") {
                $date = Carbon::parse($visit->start_date)->format('d/m/Y');
                $star = Carbon::parse($visit->start_date)->format('H:i');
                $end = Carbon::parse($visit->end_date)->format('H:i');
                $text = "<b>VISITA CONFIRMADA</b>\n"
                . "<strong>REUNIÓN CON:</strong>\n"
                . "$v->name\n"
                . "<strong>MOTIVO DE LA VISITA:</strong>\n"
                . "$visit->subject\n"
                . "<strong>FECHA:</strong>\n"
                . "$date\n"
                . "<strong>HORA:</strong>\n"
                . "$star - $end\n"
                . "📌";

                // Telegram::sendMessage([
                //     'chat_id' => \env('TELEGRAM_CHANNEL_ID', '-1002021376025'),
                //     'parse_mode' => 'HTML',
                //     'text' => $text
                // ]);
            }

            return response()->json(['message' => 'Reunión '. $visit->status. ': ' . $v->name .' - ' . $visit->subject], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Visit not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating status'], 500);
        }
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('visits.index')->with(['status' => "¡La visita fue eliminada exitosamente!"]);
    }

    public function getVisits(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->get('date'));

        //dump($request->get('date'));
        $startDate = $date->copy()->startOfDay();
        $endDate = $date->copy()->endOfDay();

        $visits = Visit::query()
            // ->leftJoin('vistors', 'visits.visitor_id', '=', 'vistors.id')
            ->whereBetween('start_date', [$startDate, $endDate])
            ->with('visitor')
            ->orderBy('start_date', 'asc')
            ->get();
            // ->get(['start_date', 'subject']);

        return response()->json(['visits' => $visits], 200);

    }

}
