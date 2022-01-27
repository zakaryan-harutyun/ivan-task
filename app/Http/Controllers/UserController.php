<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $clients = Client::select('id','name','email','user_id')->with('manager')->paginate(10);

        return view('index', compact('clients'));
    }

    public function search(Request $request){

        $clients = Client::query();
        $search = $request->search;

        if($search){
            $clients
                ->with('manager')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhereHas('manager', function($query) use ($search)
                {
                    $query->where('name', 'LIKE', '%'.$search.'%');
                });
        }

        $clients = $clients->paginate(10);


        return view('index', compact('clients'));
    }

    public function edit($id){

        $user = Client::findOrFail($id);

        return view('edit', compact('user'));
    }

    public function update($id, Request $request){

             $this->validate($request, [
                  'name' => 'required',
                  'email' => 'required|email',
              ]);

             Client::findOrFail($id)->update([
                 'name' => $request->name,
                 'email' => $request->email
             ]);

             return redirect()->route('index');
    }

    public function delete($id){

        Client::findOrFail($id)->delete();

        return redirect()->route('index');
    }
}
