<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrivateApplicationTest extends TestCase
{
    /**
     * 所有的公共应用列表测试
     */
    public function testGetAllApplications()
    {
        $this->get('/applications/private', $this->getJwtToken('aixiangfei'))
             ->seeStatusCode(200);

        $applications = json_decode($this->response->getContent());
        $attrs = ['id', 'name', 'url', 'priority'];

        foreach ($applications as $application) {
            foreach ($attrs as $attr) {
                $this->assertObjectHasAttribute($attr, $application);
            }
        }
    }

    /**
     * 增加公共应用测试
     */
    public function testPostApplication()
    {
        $body = [
            "name"      => "财务报销",
            "url"       => "http://10.0.0.3",
            "priority"  => 80
        ];
        $this->post('/applications/private', $body, $this->getJwtToken('aixiangfei'))
             ->seeStatusCode(201);

        $application = json_decode($this->response->getContent());

        $attrs = ['id', 'name', 'url', 'priority'];
        foreach ($attrs as $attr) {
            $this->assertObjectHasAttribute($attr, $application);
        }

        return $application;
    }

    /**
     * 指定的公共应用测试
     * 
     * @depends testPostApplication
     */
    public function testGetOneApplication($data)
    {
        $this->get('/applications/private/' . $data->id, $this->getJwtToken('aixiangfei'))
             ->seeStatusCode(200);

        $application = json_decode($this->response->getContent());

        $attrs = ['id', 'name', 'url', 'priority'];
        foreach ($attrs as $attr) {
            $this->assertObjectHasAttribute($attr, $application);
        }

        return $application;
    }

    /**
     * 修改公共应用测试
     *
     * @depends testGetOneApplication
     */
    public function testPutOneApplication($data)
    {
        $body = [
            "name"      => "财务报销",
            "url"       => "http://10.0.0.3",
            "priority"  => 80
        ];
        $this->put('/applications/private/' . $data->id, $body, $this->getJwtToken('aixiangfei'))
             ->seeStatusCode(200);

        $application = json_decode($this->response->getContent());

        $attrs = ['id', 'name', 'url', 'priority'];
        foreach ($attrs as $attr) {
            $this->assertObjectHasAttribute($attr, $application);
        }

        return $application;
    }

    /**
     * 删除公共应用测试
     *
     * @depends testPutOneApplication
     */
    public function testDeleteOneApplication($data)
    {
        $this->delete('/applications/private/' . $data->id, [], $this->getJwtToken('aixiangfei'))
             ->seeStatusCode(204);
    }
}
