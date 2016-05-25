<?php
namespace Page\AuthFunctional;

class AuthFunctional
{
    // include url of current page
    public static $URL = '/login';
    public static $REGISTRATION = '/registration';
    public static $usernameField = '#j_username';
    public static $userpasswordField = '#j_password';
    public static $loginBtn = 'input[type=submit]';
    //элементы формы регистрации
    public static $usernameFieldRegister = '#r_username';
    public static $useremailFieldRegister = '#r_email';
    public static $userphoneFieldRegister = '#r_phone';
    public static $usersiteFieldRegister = '#r_site';
    public static $userpromoFieldRegister = '#r_promocode';
    public static $btnRegister = 'Зарегистрироваться';
    //элементы формы подтверждения регистрации
    public static $usersmsFieldConfirmRegistration = '#j_code';
    //раскрывающееся меню пользователя
    public static $userActionMenu = 'user-actions-menu';
    public static $selectMenu750 = '//option[@value=750]';
    //часть уник. ключа для почты и моб. тел.
    public static $KEY_EMAIL = 'NtCnJdJtVsk@';
    public static $KEY_SITE = 'TESThajksdxbndps';
    public static $KEY_PHONE = '000';
    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */

    /**
     * @var \Codeception\Actor
     */
    protected $tester;

    public function __construct(\Codeception\Actor $I)
    {
        $this->tester = $I;
    }
    //метод логинит
    public function login($name, $password)
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        //$I->see('Рады видеть, что вы с нам','h2');
        $I->fillField(self::$usernameField, $name);
        $I->fillField(self::$userpasswordField, $password);
        $I->click(self::$loginBtn);
        return $this;
    }
    //метод разлогинивает
    public function logout(){
        $I = $this->tester;
        $I->amOnPage('/logout');
        $I->see('Рады видеть, что вы с нам','h2');
        return $this;
    }
    //подтверждение регистрации по sms tokenу
    public function confirmRegistration($token){
        $I = $this->tester;

        $I->fillField(self::$usersmsFieldConfirmRegistration, $token);
        $I->click('ЗАРЕГИСТРИРОВАТЬСЯ');
        return $this;
    }
    // процесс заполнения формы и клик зарегить
    public function regisration($user)
    {
        $I = $this->tester;
        $I->amOnPage(self::$REGISTRATION);
        $I->see('Начните пользоваться сервисом уже сейчас','h2');
        $I->fillField(self::$usernameFieldRegister,$user->getName());
        $I->fillField(self::$useremailFieldRegister,$user->getEmail());
        $I->fillField(self::$usersiteFieldRegister,$user->getSite());
        $I->fillField(self::$userphoneFieldRegister,$user->getPhone());
        $I->fillField(self::$userpromoFieldRegister,$user->getPromo());
        $I->click(self::$btnRegister);
        return $this;
    }
    // метод пытается зарегить невалидн. поль-ля
    public function regisrationNegative($user){
        $I = $this->tester;
        $I->amOnPage(self::$REGISTRATION);
        $I->fillField(self::$usernameFieldRegister,$user->getName());
        $I->fillField(self::$useremailFieldRegister,$user->getEmail());
        $I->fillField(self::$userphoneFieldRegister,$user->getPhone());
        $I->fillField(self::$usersiteFieldRegister,$user->getSite());
        return $this;
    }

    //метод генерирует валидные данные для нового акаунта
    public function generateAccount($user){

        $name = 'Test '. self::generateRndSymbols('eng','7');
        $email = self::generateEmail('eng', '5');
        $phone = self::generatePhone();
        $site = self::generateSite('eng', '7');
        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setSite($site);

        return $user;
    }

    public function generateSite($type, $length){
        $site = self::$KEY_SITE.self::generateRndSymbols($type,7);
        $site = $site.self::generateCountry($type);
        return $site;
    }

    public function generateEmail($symbType, $length){
        $email = self::$KEY_EMAIL;
        $email = $email . self::generateRndSymbols($symbType, $length);
        $email = $email.self::generateCountry('eng');

        return $email;
    }

    public function generateCountry($type){
        if($type=='eng'){
            $arrCountries = array('.com', '.ua' , '.uk', '.ua', '.net', '.org' );
        }else if($type=='ru'){
            $arrCountries= array('.рф' );
        }else{
            $arrCountries = array('.com', '.ua' , '.uk', '.ua', '.net', '.org' );
        }
        return $arrCountries[rand(0, count($arrCountries)-1)];
    }

    public function generateRndSymbols($type, $length){

        $arrSymbols =[
            [
                'eng'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'ru'=>'абвгдеёжзиклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ',
                'numeric' => "1234567890"
            ]
        ];
        $str ='';
        switch($type){
            case 'eng':
                for($i=0;$i<$length; $i++) {
                    $str = $str.self::generateString($arrSymbols[0]['eng']);
                }
            break;
            
            case 'ru':
                for($i=0;$i<$length; $i++) {
                    $str = $str.self::generateString($arrSymbols[0]['ru']);
                }
            break;
            
            case 'numeric':
                for($i=0; $i<$length; $i++) {
                    $str = $str.self::generateString($arrSymbols[0]['numeric']);
                }
            break;

        }
        
        return $str;
    }
    public  function generateString($symbolsStr){
        if($symbolsStr=='1234567890'){

            $str = rand(0,8);
        }else {
            $arr = str_split($symbolsStr);
            $numOfSymbols = count($arr);
            $str = $arr[rand(0, $numOfSymbols-1)];
        }
        return $str;
    }
    public function generatePhone(){
        $phone = self::$KEY_PHONE;
        $phone = $phone . self::generateRndSymbols('numeric', '7');

        return $phone;
    }
    public static function route($param)
    {

        return static::$URL.$param;
    }

    public function writeToFile($user){
        $fp=fopen("tests/_data/accountsToDelete.txt", "a");

        fwrite($fp, $user->getEmail(). ';'.$user->getToken(). ';' . $user->getPhone(). $user->getSite()."\r\n");

        fclose($fp);
    }

}
