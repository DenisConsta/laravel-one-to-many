<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $projects = $this->search() ?? Project::orderBy('id', 'desc')->paginate(10);

        $direction = 'desc';
        return view('projects.index', compact('projects', 'direction'));
    }

    public function orderby($column, $direction)
    {
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $projects = $this->search() ?? Project::orderby($column, $direction)->paginate(10);

        return view('projects.index', compact('projects', 'direction'));
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            return Project::where('name', 'like', "%$search%")->paginate(10);
        }
        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        if (array_key_exists('cover_image', $form_data)) {
            $form_data['original_cover_image'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        $form_data['slug'] = Project::generateSlug($form_data['name']);
        $project = Project::create($form_data);

        return redirect()->route('admin.projects.index')->with('success', 'Project ' . '<strong>' . $project->name . '</strong>' . ' added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if (array_key_exists('cover_image', $form_data)) {

            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }

            $form_data['original_cover_image'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        if ($form_data['name'] != $project->title)
            $form_data['slug'] = Project::generateSlug($form_data['name']);
        $project->update($form_data);

        return redirect()->route('admin.projects.index')->with('success', 'Project ' . '<strong>' . $project->name . '</strong>' . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project ' . '<strong>' . $project->name . '</strong>' . ' deleted successfully');
    }
}
