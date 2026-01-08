<?php

namespace App\Http\Controllers;

use App\DataTables\BlogCommentDataTable;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogCommentController extends Controller
{
    public function blogComment(Request $request, $slug)
    {
        try {
            // Get the blog by slug
            $blog = Blog::where('slug', $slug)->firstOrFail();

            // Validate input
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'comment' => 'required|string',
            ]);

            DB::beginTransaction();

            // Create new comment
            $comment = BlogComment::create([
                'blog_id'    => $blog->id,
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'comment'    => $validated['comment'],
                'status'     => 'pending', // default status
                'ip_address' => $request->ip(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Comment submitted successfully and is pending approval.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors
            return response()->json([
                'success' => false,
                'errors'  => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Blog not found
            return response()->json([
                'success' => false,
                'message' => 'Blog not found.'
            ], 404);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error submitting blog comment:', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString(),
            ]);

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function commentList(BlogCommentDataTable $dataTable)
    {
        return $dataTable->render('pages.blog.blog-comments-list');
    }

    public function commentEdit($id)
    {
        try {
            // Fetch the blog comment by ID along with its related blog
            $data = BlogComment::with('blog')->findOrFail($id);

            // Return the edit view with the comment data
            return view('pages.blog.blog-comments-edit', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If comment not found, redirect back with an error
            return redirect()->route('admin-blogs-comment.list')
                ->with('error', 'Blog comment not found.');
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error fetching blog comment for edit:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin-blogs-comment.list')
                ->with('error', 'Unable to load blog comment. Please try again later.');
        }
    }


    public function commentUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        DB::beginTransaction();

        try {
            if ($request->id) {
                // Update
                $comment = BlogComment::findOrFail($request->id);
                $comment->updated_by = Auth::id();
            } else {
                // Create
                $comment = new BlogComment();
                $comment->created_by = Auth::id();
            }

            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->status = $request->status;
            $comment->comment = $request->comment;

            $comment->save();

            DB::commit();

            $message = $request->id ? 'Blog comment updated successfully.' : 'Blog comment created successfully.';

            return redirect()->route('admin-blogs-comment.list')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error in storeOrUpdate BlogComment: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function commentDestroy($id)
    {
        DB::beginTransaction();

        try {
            $comment = BlogComment::findOrFail($id);
            $comment->delete(); // Soft delete if model uses SoftDeletes

            DB::commit();

            return redirect()->route('admin-blogs-comment.list')
                ->with('success', 'Blog comment deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();

            return redirect()->route('admin-blogs-comment.list')
                ->with('error', 'Comment not found.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error deleting BlogComment: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin-blogs-comment.list')
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
