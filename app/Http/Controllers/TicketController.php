<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;




class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $query = Ticket::with(['user', 'assignedTechnician']);
    
        if ($user->role === 'usuario') {
            $query->where('user_id', $user->id);
        }
    
        $tickets = $query->latest()->get();
    
        // Si es admin, también pasamos lista de técnicos
        $technicians = $user->role === 'admin'
            ? User::where('role', 'tecnico')->get(['id', 'name'])
            : [];
    
        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets,
            'technicians' => $technicians,
        ]);
    }

    public function create()
    {
        return Inertia::render('Tickets/Create');
    }

    public function store(Request $request)
    {
        //validar el rol permitido en el backend too
        //if (auth()->user()->role !== 'usuario') {
        //    abort(403);
        //}
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:baja,media,alta',
        ]);

        $data['user_id'] = auth()->id();

        Ticket::create($data);

        return redirect()->route('tickets.index')->with('success', 'Ticket creado correctamente');
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return Inertia::render('Tickets/Edit', ['ticket' => $ticket]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:baja,media,alta',
            'status' => 'required|in:abierto,asignado,resuelto,cerrado',
        ]);

        $ticket->update($data);

        return redirect()->route('tickets.index')->with('success', 'Ticket actualizado.');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket eliminado.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => ['required', 'exists:users,id'],
        ]);
    
        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'asignado',
        ]);
        
    
        return redirect()->back()->with('success', 'Técnico asignado correctamente.');
    }

    public function tecnicoTickets()
    {
        $user = auth()->user();

        $tickets = Ticket::where('assigned_to', $user->id)
            ->with(['user'])
            ->latest()
            ->get();

        return Inertia::render('Tickets/TecnicoIndex', [
            'tickets' => $tickets
        ]);
    }

    
    public function resolve(Ticket $ticket)
    {
        // Verificar si el técnico es el asignado a este ticket
        $user = auth()->user();

        if ($user->id !== $ticket->assigned_to) {
            abort(403, 'No tienes permiso para resolver este ticket.');
        }

        $ticket->status = 'resuelto';
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket marcado como resuelto.');
    }

    public function close(Ticket $ticket)
    {
        $user = auth()->user();

        // Solo el dueño del ticket puede cerrarlo
        if ($ticket->user_id !== $user->id) {
            abort(403, 'No tienes permiso para cerrar este ticket.');
        }

        if ($ticket->status !== 'resuelto') {
            return redirect()->back()->withErrors('El ticket no está en estado resuelto.');
        }

        $ticket->status = 'cerrado';
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket cerrado correctamente.');
    }

    public function dashboard()
    {
        $this->authorize('viewAny', Ticket::class); // Opcional: proteger con policy

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total' => Ticket::count(),
                'abiertos' => Ticket::where('status', 'abierto')->count(),
                'asignados' => Ticket::where('status', 'asignado')->count(),
                'resueltos' => Ticket::where('status', 'resuelto')->count(),
                'cerrados' => Ticket::where('status', 'cerrado')->count(),
                'usuarios' => \App\Models\User::where('role', 'usuario')->count(),
                'tecnicos' => \App\Models\User::where('role', 'tecnico')->count(),
            ]
        ]);
    }    
}
