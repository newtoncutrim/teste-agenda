<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Contact();
    }

    public function index()
    {
        $data = $this->model->all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:contacts',
            'address' => 'required|string',
            'telephone' => 'required|string',
        ]);

        $contact = Contact::create($data);

        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = $this->model->find($id);

        if(!$contact){
            return response()->json(['error' => 'contato não existe ']);
        }

        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $contact = $this->model->find($id);


        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:contacts,email,'.$id,
            'address' => 'required|string',
            'telephone' => 'required|string',
        ]);

        $contact->update($data);

        return response()->json($contact, 200);
    }

    public function destroy($id)
    {
        $contact = $this->model->find($id);

        if(!$contact){
            return response()->json(['error' => 'contato não existe ']);
        }
        $contact->delete();

        return response()->json(null, 204);
    }
}
