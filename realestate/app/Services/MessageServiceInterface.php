<?php

namespace App\Services;

use Illuminate\View\View;

interface MessageServiceInterface
{
    public function sendMessage(array $data);
    public function getMessages(): View;
    public function destroyMessage($messageId);
}
