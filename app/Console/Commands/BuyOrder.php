<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BuyOrder extends Command
{
    use Traits\OrderValidationTrait, Traits\OrderServiceTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:buy {--userId=} {--productIds=} {--price=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buy Order with selected products';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle(): void
    {
        /** @var int $usertId */
        $userId = $this->option('userId');

        /** @var array */
        $productIds = explode(",", $this->option('productIds'));

        /** @var int */
        $price = (int) $this->option('price');

        if ($this->isValidOrder()) {
            $this->createOrder($userId, $price, $productIds);
        }

    }
}
