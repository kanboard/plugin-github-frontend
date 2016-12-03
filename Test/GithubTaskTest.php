<?php

use Kanboard\Plugin\GithubFrontend\GithubTask;

require_once 'tests/units/Base.php';

class GithubTaskTest extends Base
{
    public function testTask()
    {
        $payload = array(
            'title' => 'test',
            'number' => 123,
            'body' => 'something',
            'labels' => array(
                array(
                    "id" => 76969655,
                    "url" => "https://api.github.com/repos/kanboard/kanboard/labels/question",
                    "name" => "question",
                    "color" => "cc317c",
                    "default" => true,
                ),
            ),
            'assignees' => array(
                array(
                    "login" => "fguillot",
                    "id" => 323546,
                )
            )
        );

        $externalTask = new GithubTask('url', $payload);
        $this->assertEquals('url', $externalTask->getUri());
        $this->assertEquals(123, $externalTask->getIssueNumber());
        $this->assertEquals('question', $externalTask->getIssue()->labels[0]['name']);
        $this->assertEquals(array('question'), $externalTask->getLabels());
        $this->assertEquals(array('fguillot'), $externalTask->getAssignees());

        $this->assertEquals(
            array('title' => 'test', 'reference' => 123, 'description' => 'something', 'tags' => array('question')),
            $externalTask->getFormValues()
        );
    }
}
