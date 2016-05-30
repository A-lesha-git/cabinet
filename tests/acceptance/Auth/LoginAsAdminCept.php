<?php
//@group auth
//@group Agroup1
//@group Bgroup1
//@group Cgroup1
//@group adminLogin
$I = new AcceptanceTester($scenario);
$I->wantTo('Залогиниться под админом');
$loginPage = new \Page\AuthFunctional\AuthFunctional($I);
$loginPage->login($I->getProperty('admin'),$I->getProperty('psw'));
$I->see('Список организаций','h1');
//проверка что страница со счетами отображается



$I->amOnPage('/logout');
