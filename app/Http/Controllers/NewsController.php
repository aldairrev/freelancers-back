<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected $isAdmin;
    protected $isFreelancer;
    protected $isContractor;
    protected $isJournalist;

    public function __construct()
    {
        $auth_user = User::find(Auth::user()->id);
        $this->isAdmin = $auth_user->hasRole('Admin');
        $this->isFreelancer = $auth_user->hasRole('Freelancer');
        $this->isContractor = $auth_user->hasRole('Contractor');
        $this->isJournalist = $auth_user->hasRole('Journalist');
    }

    public function index()
    {
        $news = News::all();
        return response()->json([
            'news' => $news
        ]);
    }
}
