<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendPass implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $mobile,
        public string $user_name,
        public string $pass
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        PM_PASS(mobile: $this->mobile, user_name: $this->user_name, pass: $this->pass);
    }
}
