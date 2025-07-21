<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Address;
use App\Jobs\NotifyOrderStatus;
use App\Mail\OrderConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class EmailNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_confirmation_email_is_sent()
    {
        Mail::fake();

        $user = User::factory()->create(['role' => 'customer']);
        $order = Order::factory()->create(['user_id' => $user->id]);

        NotifyOrderStatus::dispatch($order);

        Mail::assertSent(OrderConfirmation::class, function ($mail) use ($order) {
            return $mail->order->id === $order->id && $mail->hasTo($order->user->email);
        });
    }
}
