<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $projects = Project::all();
        // return view('admin.projects.index', compact('projects'));
        if($request->has('term')) {
            $term = $request->get('term');
            $projects = Project::where('title', 'LIKE', "%$term%")->paginate(10)->withQueryString();
        } else {
            $projects = Project::paginate(10);
        }
        
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::all();
        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());

        // dd($data);

        if(Arr::exists($data, 'link')) {
            $path = Storage::put('uploads/projects', $data['link']);
            $data['link'] = $path;
        }

        $project = new Project;

        $project->fill($data);
        $project->save();
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
       return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();   
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {   
        $data = $this->validation($request->all());

            if(Arr::exists($data, 'link')) {
            $path = Storage::put('uploads/projects', $data['link']);
            $data['link'] = $path;
        }
        
        $project->update($data);
        return to_route('admin.projects.show', $project);
        // ->with('message_content', "Project $project->id modificato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($data) 
    {
        $validator = Validator::make(
            $data,
            [
            'title' => 'required|string|max:100',
            'link' => 'nullable|image|mimes:jpg,png,jpeg',
            'date' => 'required|string',
            'description' => 'nullable|string',
            'type_id' => 'nullable|exists:types,id'
        ],
        [
            'title.required' => 'il titolo è obbligatorio',
            'title.string' => 'il titolo deve essere una stringa',
            'title.max' => 'il titolo deve avere al massimo 100 catteri',

            'link.image' => 'il link all\' immagine è obbligatorio',
            'link.mimes' => 'le estensioni accettate sono: jpg, png, jpeg',

            'date.required' => 'la data è obbligatoria',
            'date.string' => 'la data deve essere in formato data',

            'description.string' => 'la descrizione deve essere una stringa',

            'type_id.exists' => 'l\' ID della tipologia non è valido'


        ])->validate();

        return $validator;
    }
}