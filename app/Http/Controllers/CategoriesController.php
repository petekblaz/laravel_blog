<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['show']);
    }

    /**
     * Display category listing
     */
    public function index()
    {
        $categories = Category::withCount('posts')->orderBy('id')->get();

        return view('categories.index')->with(compact('categories'));
    }

    /**
     * Get posts for single category
     */
    public function show(Category $category)
    {
      $posts = $category->posts()->orderBy('id', 'DESC')->paginate(9);
      $category = $category;

      return view('categories.show')->with(compact('posts', 'category'));
    }

    /**
     * Update category data
     */
   public function update(Category $category)
   {
        $this->validate(request(), [
            'category-name' => 'min:2|max:25'
        ]);      

       $category->update([
            'name' => request('category-name'),
        ]);

       session()->flash('success', 'Category name updated successfully');

       return redirect()->back();
   }

   /**
    * Move all posts from category we are deleting, to
    * another category, and then delete the category
    */
   public function destroy($categoryId)
   {
        $category = Category::find($categoryId);    

        $this->validate(request(), [
            'new-category-id' => 'exists:categories,id',
        ]);

        // Updating category_id on posts
        Post::where('category_id', $category->id)->update(['category_id' => request('new-category-id')]);

        $category->delete();

        session()->flash('success', 'Category ' . $category->name . ' successfully deleted, and all of its posts moved');

        return redirect()->back();
   }

    /**
     * Store new category to db
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'unique:categories,name|min:2|max:25',
        ]);

        Category::create(['name' => request('name')]);

        session()->flash('success', 'Category ' . request('name') . ' successfully created.');

        return back();
    }
}
