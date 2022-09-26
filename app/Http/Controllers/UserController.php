<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request()->query('filter');

        if (!empty($filter)) {
            $users = User::sortable()
                ->withCount(['surveys', 'completedSurveys'])
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%');
        } else {
            $users = User::withCount(['surveys', 'completedSurveys'])
                ->sortable();
        }

        return view(
            'user.index',
            [
                'users' => $users->paginate(10),
                'filter' => $filter,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccount()
    {
        if (request()->route()->getName() == "user.edit_account") {
            $userId = Auth::user()->id;
            $user = User::findOrFail($userId);
        }

        return view(
            'user.edit',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request, User $user)
    {
        if (request()->route()->getName() == "user.update_account") {
            $userId = Auth::user()->id;
            $user = User::findOrFail($userId);
        }

        $validated = request()->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ]);

        $user->update($validated);

        return redirect()->route('home.index')
            ->with('flashMessage', 'Pomyślnie zmodyfikowano profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userName = $user->name;
        $user->delete();

        return redirect()->route('user.index')
            ->with('flashMessage', 'Usunięto użytkownika "' . $userName . '"');
    }
}
