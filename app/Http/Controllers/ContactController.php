<?php

    namespace App\Http\Controllers;

    use App\Models\Contact;
    use http\Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index')->with(['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                                                'first_name' => 'required|max:50',
                                                'last_name' => 'required|max:50',
                                                'email' => 'required|email|unique:contacts,email|max:100',
                                                'mobile' => 'required|max:20',
                                                'date_of_birth' => 'required|date',
                                                'user_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                                            ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('user_image')) {
                $image = $request->file('user_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $filename);
                $validatedData['user_image'] = $filename;
            }

            $contact = Contact::create($validatedData);

            DB::commit();

            return response()->json(['message' => 'Contact created successfully', 'data' => $contact]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Failed to create contact', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit')->with(['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {


        $validatedData = $request->validate([
                                                'first_name' => 'required|string|max:50',
                                                'last_name' => 'required|string|max:50',
                                                'email' => 'required|email|max:100',
                                                'mobile' => 'required|string|max:50',
                                                'date_of_birth' => 'required|date',
                                     //           'user_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                                            ]);


        if ($request->hasFile('user_image')) {
//          // delete previous image
            if ($contact->user_image != null) {
                Storage::delete('public/images/' . $contact->user_image);
            }

            $image = $request->file('user_image');
            $filename = $contact->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            $validatedData['user_image'] = $filename;
        }

        $contact->update($validatedData);


        return response()->json(['message' => 'Contact updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }
}
