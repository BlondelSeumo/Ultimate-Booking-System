<?php

    namespace Modules\User\Listeners;

    use Illuminate\Support\Facades\Mail;
    use Modules\User\Emails\RegisteredEmail;
    use Modules\User\Events\SendMailUserRegistered;
    use Modules\User\Models\User;

    class SendMailUserRegisteredListen
    {
        /**
         * Create the event listener.
         *
         * @return void
         */
        public $user;

        const CODE = [
            'first_name' => '[first_name]',
            'last_name'  => '[last_name]',
            'name'       => '[name]',
            'email'      => '[email]',
        ];

        public function __construct(User $user)
        {
            $this->user = $user;
            //
        }

        /**
         * Handle the event.
         *
         * @param Event $event
         * @return void
         */
        public function handle(SendMailUserRegistered $event)
        {

            if (!empty(setting_item('enable_mail_user_registered'))) {
                $body = $this->replaceContentEmail($event, setting_item('user_content_email_registered'));
                Mail::to($event->user->email)->send(new RegisteredEmail($event->user, $body, 'customer'));
            }

            if (!empty(setting_item('admin_email') and !empty(setting_item('admin_enable_mail_user_registered')))) {
                $body = $this->replaceContentEmail($event, setting_item('admin_content_email_user_registered'));
                Mail::to(setting_item('admin_email'))->send(new RegisteredEmail($event->user, $body, 'admin'));
            }
        }

        public function replaceContentEmail($event, $content)
        {
            if (!empty($content)) {
                foreach (self::CODE as $item => $value) {
                    $content = str_replace($value, @$event->user->$item, $content);
                }
            }
            return $content;
        }
    }
