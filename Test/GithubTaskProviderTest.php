<?php

use Kanboard\Plugin\GithubFrontend\GithubTaskProvider;

require_once 'tests/units/Base.php';

class GithubTaskProviderTest extends Base
{
    public function testGetName()
    {
        $taskProvider = new GithubTaskProvider($this->container);
        $this->assertEquals('Github', $taskProvider->getName());
    }

    public function testFetchIssue()
    {
        $values = array(
            'organization' => 'kanboard',
            'project' => 'kanboard',
            'number' => '1',
        );

        $response = array(
            'number' => 1
        );

        $this->container['httpClient']
            ->expects($this->once())
            ->method('getJson')
            ->with(GithubTaskProvider::DEFAULT_API_URL.'repos/kanboard/kanboard/issues/1')
            ->will($this->returnValue($response));

        $taskProvider = new GithubTaskProvider($this->container);
        $externalTask = $taskProvider->fetch($taskProvider->buildTaskUri($values));

        $this->assertInstanceOf('Kanboard\Plugin\GithubFrontend\GithubTask', $externalTask);
    }

    public function testFetchIssueWithAccessTokenAndCustomUrl()
    {
        $values = array(
            'organization' => 'kanboard',
            'project' => 'kanboard',
            'number' => '1',
        );

        $response = array(
            'issue' => array(
                'number' => 1
            )
        );

        $headers = array(
            'Authorization: Basic '.base64_encode('test:test')
        );

        $this->container['configModel']->save(array(
            'github_frontend_api_url' => 'http://github',
            'github_frontend_api_username' => 'test',
            'github_frontend_api_access_token' => 'test',
        ));

        $this->container['httpClient']
            ->expects($this->once())
            ->method('getJson')
            ->with('http://github/repos/kanboard/kanboard/issues/1', $headers)
            ->will($this->returnValue($response));

        $taskProvider = new GithubTaskProvider($this->container);
        $externalTask = $taskProvider->fetch($taskProvider->buildTaskUri($values));

        $this->assertInstanceOf('Kanboard\Plugin\GithubFrontend\GithubTask', $externalTask);
    }

    public function testFetchIssueNotFound()
    {
        $values = array(
            'organization' => 'kanboard',
            'project' => 'kanboard',
            'number' => '1',
        );

        $this->container['httpClient']
            ->expects($this->once())
            ->method('getJson')
            ->with(GithubTaskProvider::DEFAULT_API_URL.'repos/kanboard/kanboard/issues/1')
            ->will($this->returnValue(array()));

        $this->setExpectedException('Kanboard\Core\ExternalTask\NotFoundException');

        $taskProvider = new GithubTaskProvider($this->container);
        $taskProvider->fetch($taskProvider->buildTaskUri($values));
    }
}
