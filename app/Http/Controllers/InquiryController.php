<?php

namespace App\Http\Controllers;

use App\DataTables\BuyProductFormDataTable;
use App\DataTables\ConsultancyFormDataTable;
use App\DataTables\ContactUsInquiryFormDataTable;
use App\DataTables\ServiceRequestDataTable;
use App\Models\BuyProductForm;
use App\Models\Category;
use App\Models\ConsultancyForm;
use App\Models\ContactUsFormInquiry;
use App\Models\Product;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class InquiryController extends Controller
{
    // ===========================
    // Contact Us
    // ===========================
    public function contactFormData(ContactUsInquiryFormDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.contact_us.inquiry_form_list');
        } catch (\Throwable $e) {

            Log::error('Contact Inquiry DataTable Load Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Unable to load contact inquiries at the moment.');
        }
    }
    public function contactUsForm(Request $request)
    {
        try {
            // ---------------- VALIDATION ----------------
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'state'   => 'required|exists:states,id',
                'city'    => 'nullable|string|max:255',
                'service' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'g-recaptcha-response' => 'required',
            ], [
                'service.required' => 'Please select at least one service.',
                'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            ]);

            // ---------------- VERIFY reCAPTCHA ----------------
            $response = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha.secret'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            $responseBody = $response->json();

            if (!($responseBody['success'] ?? false)) {
                throw ValidationException::withMessages([
                    'g-recaptcha-response' => ['reCAPTCHA verification failed. Please try again.'],
                ]);
            }

            DB::beginTransaction();

            ContactUsFormInquiry::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'state_id' => $validated['state'],
                'city_id'  => $validated['city'] ?? null,
                'service'  => $validated['service'],
                'message'  => $validated['message'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your request has been received. Our team will contact you soon.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Inquiry Form Error', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function contactFormdestroy(int $id)
    {
        try {
            DB::beginTransaction();

            $inquiry = ContactUsFormInquiry::findOrFail($id);
            $inquiry->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Data not found.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Contact Delete Failed', [
                'inquiry_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // ===========================
    // Service Request
    // ===========================
    public function serviceRequestData(ServiceRequestDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.biomed_services.servies_request_form_list');
        } catch (\Throwable $e) {

            Log::error('Contact Inquiry DataTable Load Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Unable to load contact inquiries at the moment.');
        }
    }


    public function serviceRequest(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:50',
            'company'           => 'nullable|string|max:255',
            'service'           => 'required|string|max:255',
            'categories'        => 'nullable|array',
            'categories.*'      => 'string|max:255',
            'message'           => 'required|string|max:2000',
            'preferred_contact' => 'required|in:email,phone',
            'g-recaptcha-response' => 'required',
        ], [
            'service.required' => 'Please select a service.',
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
        ]);

        // Verify Google reCAPTCHA
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ])->json();

        if (!($recaptcha['success'] ?? false)) {
            return response()->json([
                'success' => false,
                'errors'  => ['g-recaptcha-response' => ['Captcha verification failed.']],
            ], 422);
        }

        DB::beginTransaction();

        try {
            // ---------------- Convert slugs to IDs ----------------
            $categoryIds = [];
            if (!empty($validated['categories'])) {
                $categoryIds = Category::whereIn('slug', $validated['categories'])
                    ->pluck('id')
                    ->toArray();
            }

            ServiceRequest::create([
                'name'              => $validated['name'],
                'email'             => $validated['email'],
                'phone'             => $validated['phone'] ?? null,
                'company'           => $validated['company'] ?? null,
                'service'           => $validated['service'],
                'categories'        => $categoryIds, // JSON of IDs
                'message'           => $validated['message'] ?? null,
                'preferred_contact' => $validated['preferred_contact'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you! We will get back to you shortly.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Service Request Error: ' . $e->getMessage(), ['request' => $request->all()]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function serviceRequestdestroy(int $id)
    {
        try {
            DB::beginTransaction();

            $data = ServiceRequest::findOrFail($id);
            $data->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Data not found.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Services Delete Failed', [
                'service_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // ===========================
    // Consultancy
    // ===========================
    public function consultancyForm(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'organization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'help' => 'nullable|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
        ]);

        // Verify Google reCAPTCHA manually
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ])->json();

        if (!($recaptcha['success'] ?? false)) {
            return response()->json([
                'success' => false,
                'errors' => ['g-recaptcha-response' => ['Captcha verification failed.']],
            ], 422);
        }

        // 3️⃣ DB Transaction with try-catch
        DB::beginTransaction();

        try {
            ConsultancyForm::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'organization' => $validated['organization'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'help' => $validated['help'] ?? null,
                'message' => $validated['message'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you! We will get back to you shortly.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Consultancy Form Submission Error: ' . $e->getMessage(), ['request' => $request->all()]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function consultancyList(ConsultancyFormDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.consultancy.list');
        } catch (\Throwable $e) {

            Log::error('consultancy DataTable Load Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Unable to load consultancy at the moment.');
        }
    }

    public function consultancydestroy(int $id)
    {
        try {
            DB::beginTransaction();

            $data = ConsultancyForm::findOrFail($id);
            $data->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Data not found.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('consultancy Delete Failed', [
                'consultancy_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }


    // ===========================
    // Buy Product Form
    // ===========================

    public function buyProductForm(Request $request)
    {
        DB::beginTransaction();

        try {

            // ================= VALIDATION =================
            $validated = $request->validate([
                'product_slug' => 'required|exists:products,slug',
                'name'         => 'required|string|max:255',
                'email'        => 'required|email|max:255',
                'state'        => 'required|exists:states,id',
                'city'         => 'nullable|exists:cities,id',
                'message'      => 'required|string',
                'g-recaptcha-response' => 'required',
            ], [
                'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            ]);

            // ================= RECAPTCHA VERIFY =================
            $recaptchaResponse = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha.secret'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            $recaptcha = $recaptchaResponse->json();

            if (!($recaptcha['success'] ?? false)) {
                return response()->json([
                    'errors' => [
                        'g-recaptcha-response' => ['Captcha verification failed.']
                    ]
                ], 422);
            }

            // ================= PRODUCT FIND =================
            $product = Product::where('slug', $validated['product_slug'])->first();

            if (!$product) {
                return response()->json([
                    'errors' => [
                        'product_slug' => ['Invalid product selected.']
                    ]
                ], 422);
            }

            // ================= SAVE DATA =================
            BuyProductForm::create([
                'product_id' => $product->id,
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'state_id'   => $validated['state'],
                'city_id'    => $validated['city'] ?? null,
                'message'    => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Your request has been submitted successfully. We will contact you shortly.'
            ], 200);
        } catch (\Throwable $e) {

            DB::rollBack();

            // ================= ERROR LOG =================
            Log::error('Buy Product Form Submission Failed', [
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'input'   => $request->except(['_token', 'g-recaptcha-response']),
            ]);

            return response()->json([
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function productFormList(BuyProductFormDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.buy_product.form_list');
        } catch (\Throwable $e) {

            Log::error('Buy Product Form DataTable Load Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Unable to load buy product forms at the moment.');
        }
    }

    public function productFormDestroy(int $id)
    {
        try {
            DB::beginTransaction();

            $data = BuyProductForm::findOrFail($id);
            $data->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Data not found.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('product inquiry Delete Failed', [
                'product_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // ===========================
    // Get A Quote Form
    // ===========================


    public function getAQuote(Request $request)
    {
        try {
            // ---------------- VALIDATION ----------------
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'state'   => 'required|exists:states,id',
                'city'    => 'nullable|string|max:255',
                'phone'   => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'g-recaptcha-response' => 'required',
            ], [
                'service.required' => 'Please select at least one service.',
                'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            ]);

            // ---------------- VERIFY reCAPTCHA ----------------
            $response = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha.secret'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]
            );

            $responseBody = $response->json();

            if (!($responseBody['success'] ?? false)) {
                throw ValidationException::withMessages([
                    'g-recaptcha-response' => ['reCAPTCHA verification failed. Please try again.'],
                ]);
            }

            DB::beginTransaction();

            ContactUsFormInquiry::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'state_id' => $validated['state'],
                'city_id'  => $validated['city'] ?? null,
                'phone'    => $validated['phone'  ],
                'message'  => $validated['message'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your request has been received. Our team will contact you soon.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Inquiry Form Error', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
