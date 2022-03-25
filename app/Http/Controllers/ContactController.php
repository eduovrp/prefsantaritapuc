<?php

namespace App\Http\Controllers;

use App\Mail\sendMailContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $contact = Contact::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'subject' => trim($request->subject),
            'message' => $request->message
        ]);

        Mail::to('tecnologia@santaritadoeste.sp.gov.br')->send(new sendMailContact($contact));

        return redirect()->route('contact.index')->with('status', 'Mensagem enviada com sucesso, em breve retornaremos o contato.');
    }

    public function list()
    {
        dd(\App\Models\Contact::all());
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view ('contact.list', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::where('id', $id)->first();

        $contact->destroy($id);
    }

}
