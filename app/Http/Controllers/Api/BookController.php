<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;

class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->sendResponse($books->toArray(), 'Books read successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'details' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('error Validation', $validator->errors());
        }
        $book = Book::create($data);
        return $this->sendResponse($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return $this->sendError('Book Not found');
        }

        return $this->sendResponse($book, 'book found');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'details' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('error Validation', $validator->errors());
        }

        $oldBook = Book::find($id);
        if (is_null($oldBook)) {
            return $this->sendError('error Validation', $validator->errors());
        }
        $oldBook->name = $data['name'];
        $oldBook->details = $data['details'];
        $oldBook->save();
        return $this->sendResponse($oldBook, 'Operation successfully passed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return $this->sendError('Book not found');
        }

        $book->delete();
        return $this->sendResponse($book, 'Book deleted successfully');
    }
}
