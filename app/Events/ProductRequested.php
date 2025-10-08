<?php

namespace App\Events;

use App\Models\ProductRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductRequested implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $request;

    public function __construct(ProductRequest $request)
    {
        $this->request = $request->load('user', 'department', 'product');
    }

    public function broadcastOn(): array
    {
        return [new Channel('requests')];
    }

    public function broadcastAs(): string
    {
        return 'new-request';
    }
}
