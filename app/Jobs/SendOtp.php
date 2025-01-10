<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendOtp implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $mobile,
        public string $otp
    )
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        PM_OTP(mobile: $this->mobile, otp: $this->otp);
    }
}
