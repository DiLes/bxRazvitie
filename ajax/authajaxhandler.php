<?php
namespace Diles\Main\Ajax;

use \Diles\Main\Ajax\AbstractAjaxHandler;
use \Bitrix\Main\Context;

class AuthAjaxHandler extends AbstractAjaxHandler
{
	public function __construct()
    {
        parent::__construct();
    }

    /**
     * Проверяем есть в наличие пользователя и отправляем ему СМС
     */
    public function sendConfirmCode()
    {
        global $USER, $DB;
        $phone = $this->post['phone'] ?: false;
        $user = $USER->GetByLogin($phone)->Fetch();
        if(!empty($user)){
            $newPass = $this->generateRand(6);
            $salt = randString(8);
            $password = $salt.md5($salt.$newPass);
            $res = $DB->Query(
                "UPDATE b_user SET
                PASSWORD = '".$password."'
                WHERE LOGIN = '".$phone."'");
        	\Diles\Main\Helper::sendSms($phone, $newPass);
        	$this->setOk('Успешно');
        }else{
        	$this->setError('Пользователь не найден');
        }
    }

    /**
     * Проверка на авторизации
     */
    public function sendConfirmAuth()
    {
    	global $USER;
    	if (!is_object($USER)) $USER = new \CUser;
    	$phone = $this->post['phone'] ?: false;
    	$password = $this->post['password'] ?: false;
    	$arAuthResult = $USER->Login($phone, $password, "Y");
    	$APPLICATION->arAuthResult = $arAuthResult;
    	if(!is_array($arAuthResult)){
    		$this->setOk('Успешно');
    	}else{
    	    $this->setError($user['MESSAGE']);
    	}
    }

    /**
     * Генерируем случайных 6-значных чисел
     */
    public function generateRand($length = 1){
        $chars = '1234567890';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    
    /**
     * Регистрация
     */
    public function sendRegisterFields()
    {
    	global $USER;
    	if (!is_object($USER)) $USER = new \CUser;
    	$phone = $this->post['phone'] ?: false;
    	$name = $this->post['name'] ?: false;
    	
    	$user = $USER->GetByLogin($phone)->Fetch();
        if(!empty($user)){
        	$this->setError('Пользователь с таким номером существует');            
        }else{
        	$password = $this->generateRand(6);
            $ID = $USER->Add([
            	'NAME' => $name,
            	'LOGIN' => $phone,
            	'ACTIVE' => 'Y',
            	'PASSWORD' => $password,
            	'CONFIRM_PASSWORD' => $password,
            	'GROUP_ID' => [\Diles\Main\Config::getParam('users/buyer')]
            ]);
            if (intval($ID) > 0){
            	\Diles\Main\Helper::sendSms($phone, $password);
            	$this->setOk('Успешно');
            }else{
            	\Diles\Main\Helper::logIt(print_r($USER->LAST_ERROR, true));
            	$this->setError('Произошла ошибка при регистрации. Пожалуйста попробуйте еще раз');
            }
        }
    }
}
