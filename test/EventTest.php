<?php

/**
 * @see       https://github.com/laminas/laminas-eventmanager for the canonical source repository
 * @copyright https://github.com/laminas/laminas-eventmanager/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-eventmanager/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\EventManager;

use Laminas\EventManager\Event;
use Laminas\EventManager\Exception;
use PHPUnit\Framework\TestCase;

/**
 * @group      Laminas_Stdlib
 */
class EventTest extends TestCase
{

    public function testConstructorWithArguments()
    {
        $name = 'foo';
        $target = 'bar';
        $params = ['test','param'];

        $event = new Event($name, $target, $params);

        $this->assertEquals($name, $event->getName());
        $this->assertEquals($target, $event->getTarget());
        $this->assertEquals($params, $event->getParams());
    }

    public function testSetParamsWithInvalidParameter()
    {
        $event = new Event('foo');
        $this->expectException(Exception\InvalidArgumentException::class);
        $event->setParams('test');
    }

    public function testGetParamReturnsDefault()
    {
        $event = new Event('foo', 'bar', []);
        $default = 1;

        $this->assertEquals($default, $event->getParam('foo', $default));
    }

    public function testGetParamReturnsDefaultForObject()
    {
        $params = new \stdClass();
        $event = new Event('foo', 'bar', $params);
        $default = 1;

        $this->assertEquals($default, $event->getParam('foo', $default));
    }

    public function testGetParamReturnsForObject()
    {
        $key = 'test';
        $value = 'value';
        $params = new \stdClass();
        $params->$key = $value;

        $event = new Event('foo', 'bar', $params);
        $default = 1;

        $this->assertEquals($value, $event->getParam($key));
    }
}
