<?php

namespace App\Jobs;

use App\Models\CoinRate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCoinRate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $arr;
    /**
     * Create a new job instance.
     */
    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $arr = $this->arr;
        CoinRate::insert($arr);
    }
}
