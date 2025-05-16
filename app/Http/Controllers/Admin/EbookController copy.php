<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    public function index()
    {
        // $ebooks = Ebook::all();
        $ebooks = Ebook::paginate(10);
        return view('admin.ebooks.index', compact('ebooks'));
    }

    public function create()
    {
        return view('admin.ebooks.add-edit', ['ebook' => new Ebook()]);
    }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $validated = $request->validate([
    //         'ebook_name' => 'required|string',
    //         'ebook_ver' => 'required|in:1.0,2.0,3.0,4.0,5.0',
    //         'status' => 'required|in:on,off',
    //         'ebook_file' => 'required|mimes:pdf|max:2048',
    //     ]);

    //     if ($request->hasFile('ebook_file')) {
    //         $fileName = time() . '.' . $request->ebook_file->extension();
    //         $request->ebook_file->move(public_path('uploads/ebooks'), $fileName);
    //         $validated['ebook_file'] = 'uploads/ebooks/' . $fileName;
    //     }

    //     if ($request->hasFile('ebook_cover')) {
    //         $cover = $request->file('ebook_cover');
    //         $coverName = time() . '_' . $cover->getClientOriginalName();
    //         $cover->move(public_path('uploads/ebook_covers'), $coverName);
    //         $data['ebook_cover'] = 'uploads/ebook_covers/' . $coverName;
    //     }

    //     Ebook::create($validated);
    //     return redirect()->route('admin.ebooks.index')->with('success', 'Ebook added successfully.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ebook_name' => 'required|string',
            'ebook_ver' => 'required|in:1.0,2.0,3.0,4.0,5.0',
            'status' => 'required|in:on,off',
            'ebook_file' => 'required|mimes:pdf|max:2048',
            'ebook_cover' => 'nullable|image|max:2048',
        ]);

        // Store PDF securely
        if ($request->hasFile('ebook_file')) {
            $filePath = $request->file('ebook_file')->store('ebooks', 'private');
            $validated['ebook_file'] = $filePath;
        }

        // Store Cover Image in public (optional)
        if ($request->hasFile('ebook_cover')) {
            $cover = $request->file('ebook_cover');
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('uploads/ebook_covers'), $coverName);
            $validated['ebook_cover'] = 'uploads/ebook_covers/' . $coverName;
        }

        Ebook::create($validated);
        return redirect()->route('admin.ebooks.index')->with('success', 'Ebook added successfully.');
    }

    public function edit(Ebook $ebook)
    {
        return view('admin.ebooks.add-edit', compact('ebook'));
    }

    // public function update(Request $request, Ebook $ebook)
    // {
    //     $validated = $request->validate([
    //         'ebook_name' => 'required|string',
    //         'ebook_ver' => 'required|in:1.0,2.0,3.0,4.0,5.0',
    //         'status' => 'required|in:on,off',
    //         'ebook_file' => 'nullable|mimes:pdf|max:2048',
    //     ]);

    //     if ($request->hasFile('ebook_file')) {
    //         $fileName = time() . '.' . $request->ebook_file->extension();
    //         $request->ebook_file->move(public_path('uploads/ebooks'), $fileName);
    //         $validated['ebook_file'] = 'uploads/ebooks/' . $fileName;
    //     }

    //     if ($request->hasFile('ebook_cover')) {
    //         $cover = $request->file('ebook_cover');
    //         $coverName = time() . '_' . $cover->getClientOriginalName();
    //         $cover->move(public_path('uploads/ebook_covers'), $coverName);
    //         $data['ebook_cover'] = 'uploads/ebook_covers/' . $coverName;
    //     }

    //     $ebook->update($validated);
    //     return redirect()->route('admin.ebooks.index')->with('success', 'Ebook updated successfully.');
    // }

    public function update(Request $request, Ebook $ebook)
    {
        $validated = $request->validate([
            'ebook_name' => 'required|string',
            'ebook_ver' => 'required|in:1.0,2.0,3.0,4.0,5.0',
            'status' => 'required|in:on,off',
            'ebook_file' => 'nullable|mimes:pdf|max:2048',
            'ebook_cover' => 'nullable|image|max:2048',
        ]);

        // Update PDF if uploaded
        if ($request->hasFile('ebook_file')) {
            $filePath = $request->file('ebook_file')->store('ebooks', 'private');
            $validated['ebook_file'] = $filePath;
        }

        // Update cover image if uploaded
        if ($request->hasFile('ebook_cover')) {
            $cover = $request->file('ebook_cover');
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('uploads/ebook_covers'), $coverName);
            $validated['ebook_cover'] = 'uploads/ebook_covers/' . $coverName;
        }

        $ebook->update($validated);
        return redirect()->route('admin.ebooks.index')->with('success', 'Ebook updated successfully.');
    }

    public function destroy(Ebook $ebook)
    {
        try {
            // Delete PDF file from private storage
            if ($ebook->ebook_file && Storage::disk('private')->exists($ebook->ebook_file)) {
                Storage::disk('private')->delete($ebook->ebook_file);
            }

            // Delete cover image from public storage
            if ($ebook->ebook_cover && file_exists(public_path($ebook->ebook_cover))) {
                unlink(public_path($ebook->ebook_cover));
            }

            $ebook->delete();

            return redirect()->route('admin.ebooks.index')->with('success', 'Ebook deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.ebooks.index')->with('error', 'Error deleting ebook: ' . $e->getMessage());
        }
    }

    // public function view(Ebook $ebook)
    // {
    //     // Check user permission here (optional)
    //     // if (!auth()->user()->can('view_ebook')) {
    //     //     abort(403, 'Unauthorized');
    //     // }

    //     return view('admin.ebooks.view', compact('ebook'));
    // }

    public function view(Ebook $ebook)
    {
        try {
            $path = storage_path("app/private/{$ebook->ebook_file}");
            if (!file_exists($path)) {
                return redirect()->route('admin.ebooks.index')->with('error', 'The PDF file for this ebook could not be found.');
            }
            
            return view('admin.ebooks.view', compact('ebook'));
        } catch (\Exception $e) {
            return redirect()->route('admin.ebooks.index')->with('error', 'Error loading the ebook: ' . $e->getMessage());
        }
    }
    // public function securePdf(Ebook $ebook)
    // {
    //     // You can check user permission here if needed
    //     if (!auth()->check()) {
    //         abort(403, 'Unauthorized');
    //     }

    //     $path = storage_path("app/private/{$ebook->ebook_file}");

    //     if (!file_exists($path)) {
    //         abort(404);
    //     }

    //     return response()->file($path, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="' . basename($ebook->ebook_file) . '"',
    //         'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
    //     ]);
    // }

    public function securePdf(Ebook $ebook)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $path = storage_path("app/private/{$ebook->ebook_file}"); // Remove 'private/' since it's already in the path

        if (!file_exists($path)) {
            abort(404);
        }

    // Disable PDF download and printing in browser
    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . basename($ebook->ebook_file) . '"',
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'X-Robots-Tag' => 'noindex, nofollow',
        'Content-Security-Policy' => "frame-ancestors 'self'",
    ]);
    
    }

}
