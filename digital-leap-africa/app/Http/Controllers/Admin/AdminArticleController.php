<?php
// app/Http/Controllers/Admin/AdminArticleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    // Add other resource methods (create, store, show, edit, update, destroy) as needed
}