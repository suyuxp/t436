<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * 所有的应用列表测试
     */
    public function testGetAppApplications()
    {
        $this->get('/applications')
             ->seeStatusCode(200);

        $applications = json_decode($this->response->getContent());
        $this->assertObjectHasAttribute('private', $applications);
        $this->assertObjectHasAttribute('public', $applications);

        $attrs = ['id', 'name', 'url', 'priority'];

        foreach ($applications->private as $application) {
            foreach ($attrs as $attr) {
                $this->assertObjectHasAttribute($attr, $application);
            }
        }

        foreach ($applications->public as $application) {
            foreach ($attrs as $attr) {
                $this->assertObjectHasAttribute($attr, $application);
            }
        }
    }
}
