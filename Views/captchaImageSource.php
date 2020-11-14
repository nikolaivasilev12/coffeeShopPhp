<?php
namespace Phppot;

use Phppot\Captcha;

session_start();

require_once "./Classes/Captcha.php";
$captcha = new Captcha();

$captcha_code = $captcha->getCaptchaCode(6);

$captcha->putSession('captcha_code', $captcha_code);

$imageData = $captcha->createCaptchaImage($captcha_code);

$captcha->renderCaptchaImage($imageData);

?>