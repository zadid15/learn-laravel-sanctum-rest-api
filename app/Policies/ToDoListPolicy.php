<?php

namespace App\Policies;

use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToDoListPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ToDoList $toDoList): Response
    {
        return $user->id === $toDoList->user_id
            ? Response::allow()
            : Response::deny("You do not own this to-do list, can't view.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ToDoList $toDoList): Response
    {
        return $user->id === $toDoList->user_id
            ? Response::allow()
            : Response::deny("You do not own this to-do list, can't update.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ToDoList $toDoList): Response
    {
        return $user->id === $toDoList->user_id
            ? Response::allow()
            : Response::deny("You do not own this to-do list, can't delete.");
    }
}
