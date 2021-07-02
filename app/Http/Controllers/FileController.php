<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Resources\Books as BooksResource;
use App\Models\Books;
use App\Models\User;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //

    // public function index()
    // {
    //     $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    //     $images = [];
    //     $files = Storage::disk('s3')->files('file');
    //         foreach ($files as $file) {
    //             $images[] = [
    //                 'name' => str_replace('images/', '', $file),
    //                 'src' => $url . $file
    //             ];
    //         }
 
    //     return view('welcome', compact('images'));
    // }

    public function displayBooks()
    {
        $books=Books::all();
        return User::find($books->user_id=auth()->id())->books; 
    }

    function upload(Request $request){
        $book = new Books();
        $book->price=$request->input('price');
        $book->name=$request->input('name');
        $book->quantity=$request->input('quantity');
        $book->author=$request->input('author');
        $book->description=$request->input('description');
        $book->file=$request->file('file')->store('apiDocs');
        // $path = $request->file('file')->store('apiDocs', 's3');
    //     $image = Image::create([
    //     'filename' => basename($path),
    //     'url' => Storage::disk('s3')->url($path)
    // ]);
        // $book->file=Storage::disk('s3')->url($path);
        $book->user_id = auth()->id();
        $book->save();
        return ["result"=>$book];
        // return [$book];        
    }


    public function updateBook(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        if($book->user_id==auth()->id()){
            $book->price=$request->input('price');
            $book->name=$request->input('name');
            $book->quantity=$request->input('quantity');
            $book->author=$request->input('author');
            $book->description=$request->input('description');
            $book->file=$request->file('file');
            // return[$book];
            $book->save();
            return[$book];
            // return new BooksResource($book);
        }
        else
        {
            return response()->json([
                'error' => ' Book is not available with this id'], 404);
        }
    }

//     public function destroy($image)
//    {
//        Storage::disk('s3')->delete('images/' . $image);

//        return back()->withSuccess('Image was deleted successfully');
//    }
}
