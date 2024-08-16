<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);
            $user = User::where('email',$request->email)->first();
            if(! $user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' =>['the provided credentials are incorrect.'],
                ]);
            }
            return $user->createToken($request->device_name)->plainTextToken;
        }
        catch(ValidationException $e){
            return response()->json(['error' => $e->validator->errors()], 200);
        }
        catch(Exception $e){
            return response()->json(['error' => $e->validator->errors()], 200);
        }
        
    }
    public function logout(Request $request)
    {
        try{
            $user = $request->user();
            $user->tokens()->delete();
            return 'Token are deleted';
        }catch(ValidationException $e){
            return response()->json(['error'=>$e->validator->errors()], 200);
        }
    }
    public function register(Request $request)
    {
        try{
            $request->validate([
                'name'=> 'required|string|max:255',
                'email'=> 'required|email|unique:users,email',
                'password'=> 'required',
                'device_name'=> 'required|string',
            ]);
            $user = User::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);

            $recipient = $user->email; // Replace with actual recipient's email
            $subject = 'Custom Subject';
            $body = 'This is the body of the email. You can include HTML here if needed.';

            Mail::raw($body, function(Message $message) use ($recipient, $subject) {
                $message->to($recipient);
                $message->subject($subject);
                // You can add attachments or other options here if needed
            });
            
            return response()->json(['message'=>'User registered successfully','user'=>$user], 201);
        }catch(ValidationEception $e){
            return response()->json(['error' => $e->validate->errors()], 200);
        }
    }
    public function getUser(Request $request)
    {
        $user = $request->user();
        $user->photo_path =url('/storage/' .$user->photo_path);
        return $user;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function updateProfile(Request $request)
    {
        try{
            $user = $request->user();

            $request->validate([
                'name' => 'sometimes|string|max:255',
                'email'=> 'sometimes|email|unique:user,email,' .$user->id,
                'password'=>'nullable|string|min:6',
                'device_name'=>'required|string',
            ]);

            $data =[];
            if($request->filled('name')){
                $data['name'] = $request->input('name');
            }
            if($request->filled('email')){
                $data['email'] = $request->input('email');
            }
            if($request->filled('password')){
                $data['password'] = Hash::make($request->input('password'));
            }
            $user->update($data);
            return response()->json(['message'=>'profile updated successfully','user' =>$user]);
        }catch(ValidationException $e){
            return response()->json(['error'=>$e->validator->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}