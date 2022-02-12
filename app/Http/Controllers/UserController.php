<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositorys\UserRepositoryInterface;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Helpers;

    protected $isAdmin;
    protected $isFreelancer;
    protected $isContractor;
    protected $isJournalist;

    public function __construct()
    {
        if (!is_null(Auth::user())) {
            $auth_user = User::find(Auth::user()->id);
            $this->isAdmin = $auth_user->hasRole('Admin');
            $this->isFreelancer = $auth_user->hasRole('Freelancer');
            $this->isContractor = $auth_user->hasRole('Contractor');
            $this->isJournalist = $auth_user->hasRole('Journalist');
        }
    }

    public function index()
    {
        if ($this->isAdmin) {
            $users = User::with('roles')->all();
        } else {
            $users = User::with('roles')->get();
            $nonmembers = $users->reject(function ($user, $key) {
                $isAdmin = $user->hasRole('Admin');
                return $isAdmin;
            })->toArray();

            $users = array_values($nonmembers);
        }

        return response()->json([
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
        if ($this->isFreelancer || $this->isContractor) {
            return response()->json([
                'message' => 'No tienes permiso para este endpoint',
            ], 403);
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'role' => 'required|string'
        ]);

        $roles = ['Freelancer', 'Contractor', 'Journalist'];

        if (in_array(ucfirst($request->role), $roles)) {
            $user_data = $request->toArray();
            $user_data['password'] = Hash::make($user_data['password']);
            $user = User::create($user_data)->assignRole($request->role);
            return response()->json([
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'errors' => [
                    'role' => [
                        'No se encontro un rol válido.'
                    ]
                ],
            ], 422);
        }
    }

    public function currentUser()
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'user' => $user
        ]);
    }
}
