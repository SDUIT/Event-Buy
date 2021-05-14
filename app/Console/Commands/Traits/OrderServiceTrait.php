<?php

namespace App\Console\Commands\Traits;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait OrderServiceTrait
{
    /**
     * @param int $userId
     * @param int $price
     * @param array $productIds
     */
    public function createOrder(int $userId, int $price, array $productIds)
    {
        try {
            $order = Order::Create([
                'price'   => $price,
                'user_id' => $userId
            ]);

            foreach ($productIds as $productId) {
                OrderItem::Create([
                    'order_id'   => $order->id,
                    'product_id' => $productId
                ]);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            exit();
        }

        $message = "Order with product ids " .
            implode(" ", $productIds) . " and price of " . $price . " Succesfully created" .
            " OrderId = " . $order->id;

        $this->sendNotification($userId, $message);
    }

    public function sendNotification(int $userId, string $message)
    {
        $user = User::find($userId);

        // Here we can get notification type from our config file and send notification.
        $this->sendSms($user->phone, $message);
        $this->sendEmail($user->email, $message);
    }

    public function sendEmail($email, $message)
    {
        // Here we can config email notification
        echo 'Email service:';
        echo PHP_EOL;
        echo '--' . PHP_EOL;
        echo 'send email to ' . $email . ' with message = ' . $message . PHP_EOL;
        echo '--' . PHP_EOL;
        echo PHP_EOL;
    }

    public function sendSms($phone, $message)
    {
        // Here we can config sms notification
        echo 'SMS service:';
        echo PHP_EOL;
        echo '--' . PHP_EOL;
        echo 'send sms to ' . $phone . ' with message = ' . $message . PHP_EOL;
        echo '--' . PHP_EOL;
        echo PHP_EOL;
    }
}
