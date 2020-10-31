<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of all contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->user()->id)
                        ->orderBy('updated_at', 'DESC')
                        ->get();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new note.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created note in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'number'  => 'required'
        ]);

        $contact = Contact::create([
            'user_id'   => $request->user()->id,
            'name'      => $request->name,
            'slug'    => str_slug($request->name) . str_random(10),
            'number'    => $request->number
        ]);

        return redirect('contact');
    }

    /**
     * Show the form for editing the specified note.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->name = $request->name;
        $contact->number = $request->number;

        $contact->save();

        return 'Saved!';
    }

    /**
     * Show the form for deleting the specified contact.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect('contact');
    }
}
