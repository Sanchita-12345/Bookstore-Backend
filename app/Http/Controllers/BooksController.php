<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Books as BooksResource;
use App\Models\Books;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addBooks(Request $request)
    {
        $this->validate($request, [
            'author' => 'required|string|between:3,15',
            'title' => 'required|string|between:3,15',
            'description' => 'required|string|between:3,30',
            'quantity'=> 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    
           ]);
        $book=new Books();
        $book->price=$request->input('price');
        $book->title=$request->input('title');
        $book->quantity=$request->input('quantity');
        $book->author=$request->input('author');
        $book->description=$request->input('description');
        $book->user_id = auth()->id();    
        
        $name = $request->file('image')->getClientOriginalName();
        $path =$request->file('image')->store('/public/images');

        $book->name = $name;
        $book->path = $path;
        
        $book->save();
        return new BooksResource($book);
        // return response()->json(['status','book created successfully']);        // if($request->hasFile('image')){
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = $extension;
        //     // $file->move('public/books/', $filename);
        //     // $book->image = $filename;
        //     $destinationPath = public_path().'/images/' ;
        //     $file->move($destinationPath,$filename);
        //     $book->image = $filename;
        // } else{
        //     return $request;
        //     $book->image = '';
        // }
        // if($request->hasFile('image')){
        //     $file = $request->file('image');
        //     $extension =$file->getClientOriginalExtension();
        //     $filename = time().'.'.$extension;
        //     $file->move('public/books/',$filename);
        //     $book->image = $filename;
        // }
        // $book->save();
        // return new BooksResource($book);
        // return response()->json(['status','book created successfully']);
        // return response()->json([
        //     'message'=>'added the book'
        // ]);
    }
    public function addBooksNew(Request $request){
        $this->validate($request, ['image' => 'required|image']);
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            return response()->json(['status','book created successfully']);
         }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBook($id)
    {
        $book=Books::findOrFail($id);
        if($book->user_id==auth()->id())
            return new BooksResource($book);
        else{
            return response()->json([
                'error' => 'UnAuthorized/invalid id'], 401);
        }
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
        $book = Books::findOrFail($id);
        if($book->user_id==auth()->id()){
            $book->name=$request->input('image');
            $book->price=$request->input('price');
            $book->title=$request->input('title');
            $book->quantity=$request->input('quantity');
            $book->author=$request->input('author');
            $book->description=$request->input('description');
            $book->save();
            return new BooksResource($book);
        }
        else
        {
            return response()->json([
                'error' => ' Book is not available with this id'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBook($id)
    {
        $book = Books::findOrFail($id);
        if($book->user_id==auth()->id()){
            if($book->delete()){
                return response()->json(['message'=>'Deleted the book'],201);
            }
        }
        else{
            return response()->json([
                'error' => 'invalid Book id'], 405);
        }
    }
}
