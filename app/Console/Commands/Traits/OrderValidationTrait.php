<?php

namespace App\Console\Commands\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\User;

trait OrderValidationTrait
{
    /**
     * @throws \Throwable
     */
    public function isValidOrder()
    {
        /** @var int $usertId */
        $userId = $this->option('userId');

        /** @var array */
        $productIds = explode(",", $this->option('productIds'));

        /** @var int */
        $price = (int) $this->option('price');

        return $this->isValidUserId($userId) &&
               $this->isValidPrice($price) &&
               $this->isValidProductIds($productIds, $price);
    }

    /**
     * @param int $userId
     *
     * @throws \Throwable
     */
    public function isValidUserId(int $userId)
    {
        if (!$userId) {
            $this->error('Plese give user id of current order');
            exit();
        }

        $user = User::find($userId);
        if (!$user) {
            $this->error('We dont have user with id ' . $userId);
            exit();
        }

        return true;
    }

    /**
     * @param array $productIds
     * @param int $price
     *
     * @throws \Throwable
     */
    public function isValidProductIds(array $productIds, int $price)
    {
        if (!$productIds || empty($productIds)) {
            $this->error('Plese give product ids of current order.');
            exit();
        }

        $totalPrice = 0;
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $totalPrice += $product->price;
            } else {
                $this->error('Product id ' . $productId . ' does not exist');
                exit();
            }
        }

        if ($totalPrice !== $price) {
            $this->error('Sum of product price is not equeal to total price');
            exit();
        }

        return true;
    }

    /**
     * @param int $price
     *
     * @throws \Throwable
     */
    public function isValidPrice(int $price)
    {
        if (!$price) {
            $this->error('Plese give price of order.');
            exit();
        }

        return true;
    }
}
