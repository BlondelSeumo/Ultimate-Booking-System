<?php
namespace App\Helpers;
use Illuminate\Support\HtmlString;

class ReCaptchaEngine
{
    protected static $version = "v2";
    protected static $api_key;
    protected static $api_secret;
    protected static $is_init;
    protected static $actions = [];
    protected static $is_enable = false;

    public static function scripts()
    {
        if (!self::isEnable() OR empty(static::$actions))
            return false;
        ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php e(self::$api_key) ?>&onload=BravoReCaptchaCallBack" async defer></script>
        <script>

            window.BravoReCaptcha = {
                is_loaded : false,
                actions: <?php echo json_encode(static::$actions) ?>,
                widgetIds : {},
                sitekey:'<?php echo e(self::$api_key) ?>',
                callback: function () {
                    this.is_loaded = true;

                    for (var k in this.actions) {
                        var id = grecaptcha.render(this.actions[k],{
                            sitekey:this.sitekey,
                            callback:this.validateCallback
                        });
                        this.widgetIds[k] = id;
                    }
                },
                reset(action) {
                    grecaptcha.reset(this.widgetIds[action]);
                },
                getToken(action) {
                    grecaptcha.getResponse(this.widgetIds[action])
                },
                validateCallback(){

                }
            }

            function BravoReCaptchaCallBack(){
                BravoReCaptcha.callback();
            }
        </script>
        <?php
    }

    public static function captcha($action = 'default')
    {
        if (!self::isEnable())
            return false;
        static::$actions[$action] = $action . '_' . uniqid();
        return new HtmlString('<div class="bravo-recaptcha" id="'.e(static::$actions[$action]).'"></div>');
    }

    public static function isEnable()
    {
        self::maybeInit();
        if (!self::$api_key or !self::$api_secret or !self::$is_enable)
            return false;
        return true;
    }

    public static function maybeInit()
    {
        if (self::$is_init)
            return;
        self::$api_key = setting_item('recaptcha_api_key');
        self::$api_secret = setting_item('recaptcha_api_secret');
        self::$is_enable = setting_item('recaptcha_enable');
        self::$is_init = true;
    }

    public static function verify($response)
    {
        if (!self::isEnable())
            return true;
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret'   => self::$api_secret,
            'response' => $response
        ];
        $query = http_build_query($data);
        $options = [
            'http' => [
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($query) . "\r\n" . "User-Agent:MyAgent/1.0\r\n",
                'method'  => 'POST',
                'content' => $query
            ]
        ];
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captchaVerify = json_decode($verify, true);
        if ($captchaVerify['success'] == true) {
            return true;
        }
        return false;
    }
}
