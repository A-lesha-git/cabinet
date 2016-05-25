<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */
    const FIXTURE_FILE = 'fixture.php';

    /**
     * Define custom actions here
     */
    public function getProperty($key)
    {
        $dir = dirname(__FILE__).'/../_data/'.static::FIXTURE_FILE;
        if(!file_exists($dir)) {
            throw new \RuntimeException('Could not load fixtures file: '.$dir);
        }

        $config = include $dir;

        if(!isset($config[$key])) {
            throw new \RuntimeException('Property '.$key.' not found in fixtures.');
        }

        return $config[$key];
    }
}
