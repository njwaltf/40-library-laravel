<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count the number of users where role is admin
        $adminCount = User::where('role', 'admin')->count();

        return view('dashboard.admin.admin-dashboard', [
            'title' => 'Dashboard',
            'adminCount' => $adminCount, // Pass the admin count to the view
        ]);
    }
}
