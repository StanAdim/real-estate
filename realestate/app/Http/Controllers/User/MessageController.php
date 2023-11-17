<?php

namespace App\Http\Controllers\User;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MessageServiceInterface;

class MessageController extends Controller
{
    protected $messageService;
    public function __construct(MessageServiceInterface $messageService)
    {
        $this->middleware('auth')->only('store');
        $this->messageService = $messageService;
    }

    public function sendMessage(Request $request)
    {
        // Your logic to send the message goes here
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->messageService->getMessages();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Call the service to send the message
        if ($this->messageService->sendMessage($data)) {
            return redirect()->back()->with('success', 'Message Sent Successfully');
        } else {
            return redirect()->back()->with('error', 'Message Sending Failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $messageId)
    {
        $this->messageService->destroyMessage($messageId);

        return redirect()->route('seller.delete.message')->with('success', 'Message Deleted Successfully');
    }
}
