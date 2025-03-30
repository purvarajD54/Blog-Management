<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardReviewerController extends Controller
{
    public function adminDashboard()
{
    $posts = Post::with('user')->get(); 
    return view('dashboardreviewer', compact('posts'));
}
}
