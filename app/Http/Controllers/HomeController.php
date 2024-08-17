<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $categories= Category::all();

        $query = Product::query();

        // Apply filters based on the request
        if ($request->has('category') && $request->category != 'All') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%{$searchTerm}%");
        }

        $data = [
            'product' => $query->get(),
            'categories' => $categories
        ];

        return view('frontend/home', $data);
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('frontend.show', compact('product'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the product is not found
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
    }
        

    public function sendEmailManually()
    {
        $recipient = 'vprabhu1771@gmail.com'; // Replace with actual recipient's email
        $subject = 'Custom Subject';
        $body = 'This is the body of the email. You can include HTML here if needed.';

        Mail::raw($body, function(Message $message) use ($recipient, $subject) {
            $message->to($recipient);
            $message->subject($subject);
            // You can add attachments or other options here if needed
        });

        return "Email sent successfully!";
    }
}