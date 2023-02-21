<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Display the listing of the contacts.
     */
    public function index() : Response
    {
        return Inertia::render('Contacts', [
            'contacts' => Contact::query()->paginate(15),
        ]);
    }
}
