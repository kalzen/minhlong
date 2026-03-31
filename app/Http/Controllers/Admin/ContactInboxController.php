<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactInboxController extends Controller
{
    public function index(Request $request): Response
    {
        $contacts = Contact::query()
            ->when($request->string('status')->toString(), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return Inertia::render('admin/Contacts/Index', [
            'contacts' => $contacts,
            'filters' => [
                'status' => $request->string('status')->toString() ?: null,
            ],
        ]);
    }

    public function show(Contact $contact): Response
    {
        return Inertia::render('admin/Contacts/Show', [
            'contact' => $contact,
        ]);
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,processing,done'],
        ]);

        $contact->update($data);

        return redirect()->route('admin.contacts.show', $contact)->with('success', 'Status updated.');
    }
}
