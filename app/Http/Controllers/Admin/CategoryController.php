<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Category;

class CategoryController extends Controller {

    protected $fields = [
        'slug' => '',
        'title' => '',
        'description' => '',
        'parent_id' => 0,
    ];

    public function __construct(Request $request) {
        $this->middleware('permission:manage-category')->only(['edit', 'destroy']);
        App::setLocale(session('lang','en'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        App::setLocale(session('lang','en'));                
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $options = $this->getCategoriesTreeOptions();
        $data['options'] = $options;

        $data['options'] = $options;
        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request) {
        $category = new Category();
        foreach (array_keys($this->fields) as $field) {
            $category->$field = $request->get($field);
        }

        $category->save();
        return redirect('/admin/category')->withSuccess("The category '{$category->title}' was created.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        App::setLocale(session('lang','en'));                
        $category = Category::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $category->$field);
        }
        $options = $this->getCategoriesTreeOptions($id);
        $data['options'] = $options;
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id) {
        $category = Category::findOrFail($id);
        foreach (array_keys($this->fields) as $field) {
            $category->$field = (string) $request->get($field);
        }
        $category->save();
        return redirect("/admin/category/$id/edit")->withSuccess("Changes saved.");
    }

    public function getCategoriesTreeOptions($id = 0) {
        $nodes = Category::get()->toTree();

        $options = '';

        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$options, $id) {
            foreach ($categories as $category) {
                $checked = ($id == $category->id) ? ' selected ' : '';
                $options .= PHP_EOL . "<option  value='{$category->id}' {$checked}>" . $prefix . ' ' . $category->title . '</option>';
                $traverse($category->children, $prefix . '-');
            }
        };

        $traverse($nodes);
        return $options;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request) {
        $full = $request->input('full');

        $category = Category::findOrFail($id);
        // if there is no parent - full removing
        if ($full OR ! $category->parent_id) {
            $category->delete();
        } else {
            $parent = Category::findOrFail($category->parent_id);
            $descendants = $category->descendants;
            foreach ($descendants as $descendant) {
                $parent->appendNode($descendant);
            }
            $category->delete();
        }

        return redirect('/admin/category')->withSuccess("The '$category->title' has been deleted.");
    }

}
