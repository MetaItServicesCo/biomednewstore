<?php

namespace App\Http\Controllers;

use App\DataTables\FaqsDataTable;
use App\Helpers\PageHelper;
use App\Models\Faq as ModelsFaq;
use App\Models\FaqLandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{

    public function landingPage()
{
    try {
        $data = FaqLandingPage::first();
        $faqs = ModelsFaq::select('question', 'answer')->orderBy('question', 'asc')->get();
        return view('frontend.pages.faqs', compact('data', 'faqs'));
    } catch (\Exception $e) {
        Log::error('Error fetching FAQ landing page for frontend:', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->back()->with('error', 'Unable to load the FAQs page. Please try again later.');
    }
}


    public function mainPage()
    {
        try {
            $data = FaqLandingPage::first();
            return view('pages.faqs.landing-page', compact('data'));
        } catch (\Exception $e) {
            Log::error('Error fetching FAQ landing page for admin:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Optionally, show a friendly error page or message
            return redirect()->back()->with('error', 'Unable to load the FAQ landing page. Please try again later.');
        }
    }


    /**
     * Create or Update FAQ Landing Page
     */
    public function storeOrUpdate(Request $request)
    {
        // Validation rules
        $rules = [
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();

            if ($request->filled('id')) {
                // Update existing record
                $faq = FaqLandingPage::findOrFail($request->id);
                $faq->update(array_merge($validated, [
                    'updated_by' => Auth::id(),
                ]));
                $message = 'FAQ Landing Page updated successfully.';
            } else {
                // Create new record
                $faq = FaqLandingPage::create(array_merge($validated, [
                    'created_by' => Auth::id(),
                ]));
                $message = 'FAQ Landing Page created successfully.';
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log detailed error
            Log::error('Error in storing/updating FAQ Landing Page', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while saving the FAQ Landing Page. Please try again.')
                ->withInput();
        }
    }


    public function index(FaqsDataTable $dataTable)
    {
        $this->authorize('read faq');

        return $dataTable->render('pages.faqs.index');
    }

    // ===========================
    // CREATE FUNCTION
    // ===========================
    public function create()
    {
        $this->authorize('create faq');

        try {
            $pages = PageHelper::labels();
            return view('pages.faqs.create', compact('pages'));
        } catch (\Exception $e) {
            Log::error('FAQ Create Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('admin-faqs.index')
                ->withErrors(['general' => 'Something went wrong while loading the FAQ create page.']);
        }
    }

    // ===========================
    // STORE FUNCTION
    // ===========================
    public function store(Request $request)
    {
        $this->authorize('create faq');

        // Validation rules
        $rules = [
            'page_name' => 'required|string',
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
        ];

        $messages = [
            'page_name.required' => 'Please select a page.',
            'question.required'  => 'The question field is required.',
            'answer.required'    => 'The answer field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Validation failed, return errors
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get validated data
        $validated = $validator->validated();

        try {
            DB::beginTransaction();

            $faq = new ModelsFaq();
            $faq->page_name  = $validated['page_name']; // <-- use validated data
            $faq->question   = $validated['question'];
            $faq->answer     = $validated['answer'];
            $faq->created_by = Auth::id();
            $faq->save();

            DB::commit();

            return redirect()->route('admin-faqs.index')
                ->with('success', 'FAQ created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging 
            Log::error(
                'FAQ Store Error',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'user_id' => Auth::id(),
                    'input' => $request->all(),
                ]
            );

            // Return back with old input and error message
            return back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // ===========================
    // EDIT FUNCTION
    // ===========================
    public function edit($id)
    {
        try {
            $this->authorize('write faq');

            $data = ModelsFaq::findOrFail($id);
            $pages = PageHelper::labels();
            return view('pages.faqs.create', compact('pages', 'data'));
        } catch (\Exception $e) {
            Log::error('FAQ Edit Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'user_id' => auth()->id(),
                'faq_id'  => $id,
            ]);

            return redirect()->route('admin-faqs.index')
                ->withErrors(['general' => 'Something went wrong while loading the FAQ edit page.']);
        }
    }

    // ===========================
    // UPDATE FUNCTION
    // ===========================
    public function update(Request $request, $id)
    {
        $this->authorize('write faq');

        $rules = [
            'page_name' => 'required|string',
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
        ];

        $messages = [
            'page_name.required' => 'Please select a page.',
            'question.required'  => 'The question field is required.',
            'answer.required'    => 'The answer field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            DB::beginTransaction();

            $faq = ModelsFaq::findOrFail($id);
            $faq->page_name  = $validated['page_name'];
            $faq->question   = $validated['question'];
            $faq->answer     = $validated['answer'];
            $faq->updated_by = Auth::id();
            $faq->save();

            DB::commit();

            return redirect()->route('admin-faqs.index')
                ->with('success', 'FAQ updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('FAQ Update Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'user_id' => Auth::id(),
                'faq_id'  => $id,
                'input'   => $request->all(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // ===========================
    // DESTROY FUNCTION (SOFT DELETE)
    // ===========================
    public function destroy($id)
    {
        try {
            $this->authorize('delete faq');

            DB::beginTransaction();

            $faq = ModelsFaq::findOrFail($id);
            $faq->deleted_by = Auth::id();
            $faq->save(); // Save deleted_by before soft delete
            $faq->delete(); // Soft delete

            DB::commit();

            return redirect()->route('admin-faqs.index')
                ->with('success', 'FAQ deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('FAQ Destroy Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'user_id' => Auth::id(),
                'faq_id'  => $id,
            ]);

            return redirect()->route('admin-faqs.index')
                ->withErrors(['general' => 'Something went wrong while deleting the FAQ.']);
        }
    }
}
