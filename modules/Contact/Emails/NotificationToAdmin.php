<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 6/4/19
 * Time: 20:49
 */

namespace Modules\Contact\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Contact\Models\Contact;

class NotificationToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {

        return $this->subject(__('[:site_name] New message',['site_name'=>setting_item('site_title')]))->view('Contact::emails.notification')->with([
            'contact' => $this->contact,
        ]);
    }
}
