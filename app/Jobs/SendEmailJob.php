<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mData)
    {
        $this->mData = $mData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mData = $this->mData;
        Mail::send(
            'mail.newadv', ["mData" => $mData], function ($message) use ($mData) {
            $message->to(env('APP_ADMIN_EMAIL'));
            $message->subject('Добавлено новое объявление');
        }
        );
    }
}
