<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MessageService implements MessageServiceInterface
{

    public function sendMessage(array $data)
    {
        try {
            // Validate the incoming data
            $validatedData = validator($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string',
            ])->validate();

            // Get the sender (user who sent the message), assuming you're using authentication
            $sender = auth()->user();

            // Create a new message
            Message::create([
                'sender_id' => $sender->id,
                'receiver_id' => $data['owner_id'],
                'property_id' => $data['property_id'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'message' => $validatedData['message'],
            ]);

            // Return a success response
            return true;
        } catch (\Throwable $th) {
            // Handle exceptions and return an error response
            return false;
        }
    }
    public function getMessages(): View
    {
        try {
            $messages = Message::with('sender', 'property')->get();
            return view('seller.messages-list', ['messages' => $messages]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroyMessage($messageId)
    {
        try {
            $deleteMessage = Message::findOrFail($messageId);
            if ($deleteMessage) {
                # code...
                $deleteMessage->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
