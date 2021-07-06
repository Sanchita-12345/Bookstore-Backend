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
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayBooks()
    {
        $books=Books::all();
        return User::find($books->user_id=auth()->id())->books; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displayParticularBook($id)
    {
        $book = Books::findOrFail($id);
        if($book->user_id == auth()->id())
            return new BooksResource($book);
        else{
            return response()->json(['error' => 'Invalid Book id'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function upload(Request $request){
        $book = new Books();
        $book->price=$request->input('price');
        $book->name=$request->input('name');
        $book->quantity=$request->input('quantity');
        $book->author=$request->input('author');
        $book->description=$request->input('description');
        $book->file=$request->file('file')->store('apiDocs');
        $book->user_id = auth()->id();
        $book->save();
        return ["result"=>$book];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Request $request, $id)
    {
        $book=Books::findorFail($id);
        if($book->user_id==auth()->id()){
            $book=Books::where('id',$id)
            ->update(array('name'=>$request->input('name'),
                            'price'=>$request->input('price'),
                            'author'=>$request->input('author'),
                            'quantity'=>$request->input('quantity'),
                            'description'=>$request->input('description')
            ));
        return['update book successfully'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBook($id){
        $book = Books::findOrFail($id);
        if($book->user_id==auth()->id()){
            if($book->delete()){
                return response()->json(['message'=>'Deleted book successfully'],201);
            }
        }
        else{
            return response()->json([
                'error' => 'Invalid Book id'], 405);
        }
    }
}
