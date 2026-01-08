<?php

namespace App\Http\Controllers;

use App\DataTables\AboutUsCardsDataTable;
use App\Models\AboutCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutCardController extends Controller
{
    public function list(AboutUsCardsDataTable $dataTable)
    {
        try {
            // Render the DataTable view
            return $dataTable->render('pages.about-us.cards.list');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('About Us Cards list error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with a general error message
            return redirect()->back()->withErrors([
                'general_error' => 'Something went wrong while loading the cards list. Please try again.'
            ]);
        }
    }

    public function create()
    {
        try {
            // Return the create card view
            return view('pages.about-us.cards.create');
        } catch (\Exception $e) {
            // Log the error
            Log::error('About Us Card create page error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with a general error message
            return redirect()->back()->withErrors([
                'general_error' => 'Something went wrong while opening the create card page. Please try again.'
            ]);
        }
    }

    /**
     * Store or update About Us Card
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            // Validation
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            if ($id) {
                // Update
                $card = AboutCard::findOrFail($id);
                $card->updated_by = Auth::id();
            } else {
                // Create
                $card = new AboutCard();
                $card->created_by = Auth::id();
            }

            // Fill data
            $card->title = $request->title;
            $card->description = $request->description;
            $card->save();

            DB::commit();

            $message = $id ? 'Card updated successfully.' : 'Card created successfully.';
            return redirect()->route('admin.about-us.cards.list')->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            DB::rollBack();
            return redirect()->back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('About Us Card store/update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong! Please try again.',
            ]);
        }
    }

    /**
     * Optional: separate methods for store and update routes
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    public function edit($id)
    {
        try {
            // Find the card or fail
            $data = AboutCard::findOrFail($id);

            // Return the create/edit view with the card data
            return view('pages.about-us.cards.create', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Card not found
            return redirect()->route('admin.about-us.cards.list')
                ->withErrors(['general_error' => 'Card not found!']);
        } catch (\Exception $e) {
            // Other exceptions
            Log::error('About Us Card edit error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.about-us.cards.list')
                ->withErrors(['general_error' => 'Something went wrong! Please try again.']);
        }
    }


    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }


    public function delete($id)
    {
        try {
            $card = AboutCard::findOrFail($id);
            $card->delete();

            return redirect()->route('admin.about-us.cards.list')
                ->with('success', 'Card deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Card not found
            return redirect()->route('admin.about-us.cards.list')
                ->withErrors(['general_error' => 'Card not found!']);
        } catch (\Exception $e) {
            // Log any other error
            Log::error('About Us Card delete error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.about-us.cards.list')
                ->withErrors(['general_error' => 'Something went wrong! Please try again.']);
        }
    }
}
