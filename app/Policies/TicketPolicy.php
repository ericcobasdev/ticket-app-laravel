<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * El admin puede ver todos los tickets (por ejemplo, en el dashboard).
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * El usuario puede ver su ticket; el técnico puede ver si le fue asignado.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->user_id || $user->id === $ticket->assigned_to || $user->role === 'admin';
    }

    /**
     * Solo el usuario puede crear tickets.
     */
    public function create(User $user): bool
    {
        return $user->role === 'usuario';
    }

    /**
     * Solo el usuario que creó el ticket puede actualizarlo.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->user_id;
    }

    /**
     * Solo el usuario que creó el ticket puede eliminarlo.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->user_id;
    }

    /**
     * El técnico asignado puede marcar como resuelto.
     */
    public function resolve(User $user, Ticket $ticket): bool
    {
        return $user->role === 'tecnico' && $user->id === $ticket->assigned_to;
    }

    /**
     * El usuario puede cerrar un ticket si ya fue resuelto.
     */
    public function close(User $user, Ticket $ticket): bool
    {
        return $user->role === 'usuario' && $user->id === $ticket->user_id && $ticket->status === 'resuelto';
    }
}

