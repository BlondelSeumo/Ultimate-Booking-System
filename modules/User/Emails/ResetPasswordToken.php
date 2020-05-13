<?php

    namespace Modules\User\Emails;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class ResetPasswordToken extends Mailable
    {
        use Queueable, SerializesModels;

        public $token;
        const CODE = [
            'buttonReset' => '[button_reset_password]',
        ];

        public function __construct($token)
        {
            $this->token = $token;
        }

        public function build()
        {
            $subject = __('Reset Password');
            if (!empty(setting_item('user_content_email_forget_password'))) {
                $body = $this->replaceContentEmail(setting_item('user_content_email_forget_password'));
            } else {
                $body = $this->defaultBody();
            }
            return $this->subject($subject)->view('User::emails.forgotPassword')->with(['content' => $body]);
        }
        public function replaceContentEmail($content)
        {
            if (!empty($content)) {
                foreach (self::CODE as $item => $value) {
                    if (method_exists($this, $item)) {
                        $replace = $this->$item();
                    } else {
                        $replace = '';
                    }
                    $content = str_replace($value, $replace, $content);
                }
            }
            return $content;
        }


        public function defaultBody()
        {
            $body = '
            <h1>Hello!</h1>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p style="text-align: center">' . $this->buttonReset() . '</p>
            <p>This password reset link expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.
            </p>
            <p>Regards,<br>'.setting_item('site_title').'</p>';
            return $body;
        }

        public function buttonReset()
        {
            $link = route('password.reset',['token'=>$this->token]);
            $button = '<a style="border-radius: 3px;
                color: #fff;
                display: inline-block;
                text-decoration: none;
                background-color: #3490dc;
                border-top: 10px solid #3490dc;
                border-right: 18px solid #3490dc;
                border-bottom: 10px solid #3490dc;
                border-left: 18px solid #3490dc;" href="' . $link . '">Reset Password</a>';
            return $button;
        }
    }
