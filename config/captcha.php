<?php if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options

return [
  // Captcha configuration for example page
  'ExampleCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'ImageWidth' => 150,
    'ImageHeight' => 50,
  ],

];