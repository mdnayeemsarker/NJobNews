<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    function index()
    {
        return view('admin.upload_files.index');
    }
    function delete(Request $request)
    {
        $id = $request->id;
        if (delete_file($id)) {
            return response()->json(['status'=> true, 'message' => 'Uploaded File Deleted successfully.']);
        }else {
            return response()->json(['status'=> false, 'message' => 'Uploaded File not Deleted successfully.']);
        }
    }
    function indexFetch(Request $request)
    {
        $per_page = get_setting('upload_pagination') ?? 12;
        $search = $request->query('search', '');
        $uploads = Upload::latest()->where('original_name', 'LIKE', "%$search%")->paginate($per_page);
        $uploads->getCollection()->transform(function ($upload) {
            return [
                'id' => $upload->id,
                'u_id' => $upload->u_id,
                'type' => $upload->type,
                'file_path' => $upload->file_path,
                'file_type' => $upload->file_type,
                'mime_type' => $upload->mime_type,
                'original_name' => $upload->original_name,
                'extension' => $upload->extension,
                'is_your' => !$upload->is_public,
                'is_public' => $upload->is_public,
                'file_url' => get_file_url($upload->id),
                'uploaded_at' => $upload->created_at->format('d-m-Y H:i:s'),
            ];
        });
        return response()->json($uploads);
    }
    public function getUploads(Request $request)
    {
        $perPage = 12;
        $search = $request->query('search', '');
        $files = Upload::latest()->where('original_name', 'LIKE', "%$search%")
            ->paginate($perPage);

        // Transform the files for the response
        $files->transform(function ($file) {
            return [
                'id' => $file->id,
                'file_name' => $file->original_name,
                'url' => get_file_url($file->id),
            ];
        });

        return response()->json($files);
    }
    public function ajaxStore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx',
        ]);

        $uploadFile = upload_file($request->file('file'), 'All Uploads', true);
        $upload = Upload::find($uploadFile);

        return response()->json([
            'success' => true,
            'file' => [
                'id' => $upload->id,
                'file_name' => $upload->original_name,
                'url' => get_file_url($uploadFile),
            ]
        ], 200);
    }
}
