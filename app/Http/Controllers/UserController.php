<?php

namespace App\Http\Controllers;
use App\Project;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProjectRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{
    use RegistersUsers;

    
    public function index()
    {
        if(Auth::user()->role_id == 2) {

            $project = Auth::user()->projects()->get();

            return $project;
        }
        return User::all();
    }

    public function create_user(UserRequest $request)
    {
        if(Auth::user()->role_id == 2) {
            return 'Недостаточно прав!';
        }
        $user = User::create($request->all());
        $user->password = bcrypt($user->password);
        $user->generateToken();
        return response()->json(['data' => $user->toArray()], 201);
    }

    public function create_project(ProjectRequest $request)
    {
        if(Auth::user()->role_id == 2) {
            return 'Недостаточно прав!';
        }
        $project = Project::create($request->all());
        return response()->json(['data' => $project->toArray()], 201);
    }

    public function update_project(ProjectRequest $request,Project $project)
    {
        if(Auth::user()->role_id == 2) {
            return 'Недостаточно прав!';
        }
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function delete_project(Project $project)
    {
        if(Auth::user()->role_id == 2) {
            return 'Недостаточно прав!';
        }
        $project->delete();
        return response()->json(null, 204);
    }



}
