<?php

namespace App\Http\Controllers;

use App\DataTables\BlogCommentDataTable;
use App\DataTables\BlogsDataTable;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogMainPage;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    use UploadImageTrait;

    public function mainPage()
    {
        try {
            // Permission check
            $this->authorize('read blog main page');

            // Fetch main page data
            $data = BlogMainPage::first();

            // Return view
            return view('pages.blog.main_page', compact('data'));
        } catch (\Throwable $e) {

            // Log detailed error
            Log::error('Blog Main Page Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with user-friendly error
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while loading the blog main page.');
        }
    }

    public function storeOrUpdate(Request $request)
    {

        // Validation rules
        $rules = [
            'heading' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();

            // Get first entry or create new
            $blog = BlogMainPage::first();

            if (!$blog) {
                // Permission check
                $this->authorize('create blog main page');
                // Create fresh entry
                $blog = new BlogMainPage();
                $blog->created_by = Auth::id(); // set created_by on create
            } else {
                $this->authorize('write blog main page');
                // Update existing entry
                $blog->updated_by = Auth::id(); // set updated_by on update
            }
            // Fill validated data 
            $blog->fill($request->all());


            $blog->save();

            DB::commit();

            return redirect()->back()->with('success', 'Blog details saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            // Log the error
            Log::error('Blog store error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            // Return back with input and show error under the form
            return redirect()->back()
                ->withInput()
                ->withErrors(['general_error' => 'Something went wrong. Please try again or contact support.']);
        }
    }

    public function list(BlogsDataTable $dataTable)
    {
        return $dataTable->render('pages.blog.list');
    }

    public function create()
    {
        $this->authorize('create blogs');

        $categories = Category::where('status', true)->get();

        return view('pages.blog.create', compact('categories'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $file = $request->file('upload');

            // Use trait method
            $filename = $this->uploadImage($file, 'blog/ckeditor');

            if ($filename) {
                $url = asset('storage/blog/ckeditor/' . $filename);

                return response()->json([
                    'uploaded' => 1,
                    'fileName' => $filename,
                    'url' => $url
                ]);
            }
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'File upload failed.']
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create blogs');
        DB::beginTransaction();

        try {

            // Validate data
            $validated = $request->validate([
                'title'            => 'required|string|max:255',
                'slug'             => 'required|string|max:255|unique:blogs,slug',
                'category_id'      => 'required|exists:categories,id',
                'is_active'        => 'nullable|in:0,1',
                'image'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:300',
                'image_alt_text'   => 'nullable|string|max:255',
                'short_description' => 'nullable|string',
                'description'      => 'nullable|string',
                'type'             => 'nullable|string',
                'read_time'        => 'nullable|string',

                'meta_title'       => 'nullable|string|max:255',
                'meta_keywords'    => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ]);

            $validated['slug']       = Str::slug($request->slug);
            $validated['created_by'] = auth()->id();

            // ⬇ IMAGE UPLOAD USING TRAIT
            if ($request->hasFile('image')) {
                $validated['image'] = $this->uploadImage($request->file('image'), 'blog/images');
            }

            Blog::create($validated);

            DB::commit();

            return redirect()
                ->route('admin-blogs.list')
                ->with('success', 'Blog created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Blog Create Error: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            // Permission check
            $this->authorize('write blogs');

            // Fetch blog
            $blog = Blog::find($id);

            if (!$blog) {
                return redirect()
                    ->route('admin-blogs.list')
                    ->with('error', 'Blog not found.');
            }

            // Fetch categories
            $categories = Category::where('status', true)->orderBy('name')->get();

            // Return view
            return view('pages.blog.create', [
                'data' => $blog,
                'categories' => $categories
            ]);
        } catch (\Throwable $e) {

            // Log error
            Log::error('Blog Edit Error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with error message
            return redirect()
                ->route('admin-blogs.list')
                ->with('error', 'Something went wrong while loading the blog.');
        }
    }

    public function update(Request $request, $id)
    {
        // Permission check
        $this->authorize('write blogs');

        $blog = Blog::findOrFail($id);

        DB::beginTransaction();

        try {
            // Validation
            $validated = $request->validate([
                'title'            => 'required|string|max:255',
                'slug'             => "required|string|max:255|unique:blogs,slug,{$blog->id}",
                'category_id'      => 'required|exists:categories,id',
                'is_active'        => 'nullable|in:0,1',
                'image'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:300',
                'image_alt_text'   => 'nullable|string|max:255',
                'short_description' => 'nullable|string',
                'description'      => 'nullable|string',
                'type'             => 'nullable|string',
                'read_time'        => 'nullable|string',

                'meta_title'       => 'nullable|string|max:255',
                'meta_keywords'    => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ]);

            $validated['slug']       = Str::slug($request->slug);
            $validated['updated_by'] = auth()->id();

            // ⬇ UPDATE IMAGE USING TRAIT
            $validated['image'] = $this->updateImage($request, 'image', 'blog/images', $blog->image);

            $blog->update($validated);

            DB::commit();

            return redirect()
                ->route('admin-blogs.list')
                ->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Blog Update Error: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->back()
                ->with('error', 'Something went wrong while updating.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Permission check
            $this->authorize('delete blogs');

            // Fetch blog
            $blog = Blog::find($id);

            if (!$blog) {
                return redirect()
                    ->route('admin-blogs.list')
                    ->with('error', 'Blog not found.');
            }

            // Store deleted_by (who deleted) before soft delete
            $blog->deleted_by = auth()->id();
            $blog->save();

            // Soft delete the blog
            $blog->delete();

            // Redirect with success message
            return redirect()
                ->route('admin-blogs.list')
                ->with('success', 'Blog deleted successfully.');
        } catch (\Throwable $e) {

            // Log detailed error
            Log::error('Blog Delete Error: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with user-friendly message
            return redirect()
                ->route('admin-blogs.list')
                ->with('error', 'Something went wrong while deleting the blog.');
        }
    }

    public function landingPage()
    {
        try {
            // Fetch main page data
            $data = BlogMainPage::first();

            $bioMedicalBlogs = Blog::where('type', 'bio-medical')->where('is_active', 1)->latest()->take(9)->select('id', 'title', 'slug', 'short_description')->get();

            $faqs = getFaqs('blog');

            return view('frontend.pages.blog', compact('data', 'bioMedicalBlogs', 'faqs'));
        } catch (\Throwable $e) {
            Log::error('Blog Landing Page Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while loading the blog page.');
        }
    }

    public function filterBlogs(Request $request)
    {
        $slug = $request->slug;
        $page = $request->page ?? 1;

        $query = Blog::where('is_active', 1);

        if ($slug !== 'all') {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            } else {
                $query->whereRaw('0=1'); // empty collection
            }
        }

        $blogs = $query->latest()->paginate(12, ['*'], 'page', $page);

        return response()->json([
            'html' => view('partials.blog-cards', compact('blogs'))->render(),
            'pagination' => view('vendor.pagination.blogs-pagination', ['paginator' => $blogs])->render()
        ]);
    }

    public function blogDetail($slug)
    {
        try {
            // Main blog with category
            $blog = Blog::with('category')
                ->where('slug', $slug)
                ->where('is_active', 1)
                ->firstOrFail();

            $comments = $blog->comments()
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc') // latest first
                ->take(5)                        // only 5 comments
                ->get();

            // Related Blogs - Only required fields
            $relatedBlogs = collect();

            if ($blog->category_id && $blog->category) {
                $relatedBlogs = Blog::select('id', 'title', 'slug', 'image', 'image_alt_text', 'updated_at') // sirf yehi fields
                    ->where('category_id', $blog->category_id)
                    ->where('id', '!=', $blog->id)
                    ->where('is_active', 1)
                    ->latest('updated_at') // ya 'created_at' jo bhi prefer karo
                    ->take(6)
                    ->get();
            }

            // Fallback: agar related < 4 hain to latest blogs se fill karo (same fields only)
            if ($relatedBlogs->count() < 4) {
                $excludeIds = [$blog->id];
                if ($relatedBlogs->isNotEmpty()) {
                    $excludeIds = array_merge($excludeIds, $relatedBlogs->pluck('id')->toArray());
                }

                $fallbackBlogs = Blog::select('id', 'title', 'slug', 'image', 'image_alt_text', 'updated_at')
                    ->where('is_active', 1)
                    ->whereNotIn('id', $excludeIds)
                    ->latest('updated_at')
                    ->take(6 - $relatedBlogs->count())
                    ->get();

                $relatedBlogs = $relatedBlogs->merge($fallbackBlogs);
            }

            // Fetch all active categories for the sidebar
            $categories = Category::select('id', 'name', 'slug')
                ->where('status', true)  // only active categories
                ->orderBy('name')
                ->get();


            return view('frontend.pages.blogdetail', compact('blog', 'relatedBlogs', 'categories', 'comments'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Throwable $e) {
            Log::error('Blog Detail Error', [
                'slug' => $slug,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Something went wrong while loading the blog.');
        }
    }

    public function blogComment(Request $request, $slug)
    {
        try {
            // ---------------- FIND BLOG ----------------
            $blog = Blog::where('slug', $slug)->firstOrFail();

            // ---------------- VALIDATION ----------------
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'comment' => 'required|string',
                'g-recaptcha-response' => 'required',
            ], [
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

            // ---------------- SAVE COMMENT ----------------
            $comment = BlogComment::create([
                'blog_id'    => $blog->id,
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'comment'    => $validated['comment'],
                'status'     => 'pending',
                'ip_address' => $request->ip(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Comment submitted successfully and is pending approval.',
                'data'    => $comment,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found.',
            ], 404);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Blog Comment Error', [
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
