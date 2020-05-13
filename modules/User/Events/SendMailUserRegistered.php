<?php
namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;

class SendMailUserRegistered
{
    use SerializesModels;
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
