<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
  
class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Post::all();
        return Inertia::render('Posts/Index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Show the form for editing a new resource.
     *
     * @return Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', ['post' => $post]);
    }
  
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validateWithBag('createPost');
  
        Post::create($request->all());
  
        return redirect('posts')
                    ->with('message', 'Post Created Successfully.');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validateWithBag('updatePost');
  
        if ($request->has('id')) {
            Post::find($request->input('id'))->update($request->all());
            return redirect('posts')
                    ->with('message', 'Post Updated Successfully.');
        }
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Post::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}