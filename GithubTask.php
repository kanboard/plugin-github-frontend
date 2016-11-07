<?php

namespace Kanboard\Plugin\GithubFrontend;

use Kanboard\Core\ExternalTask\ExternalTaskInterface;
use stdClass;

/**
 * Class GithubTask
 *
 * @package Kanboard\Plugin\GithubFrontend
 * @author  Frederic Guillot
 */
class GithubTask implements ExternalTaskInterface
{
    /**
     * @var array
     */
    private $issue;

    /**
     * @var string
     */
    private $uri;

    /**
     * GithubTask constructor.
     *
     * @param string $uri
     * @param array  $issue
     */
    public function __construct($uri, array $issue)
    {
        $this->uri = $uri;
        $this->issue = $issue;
    }

    /**
     * Get Issue
     *
     * @return stdClass
     */
    public function getIssue()
    {
        return (object) $this->issue;
    }

    /**
     * Get Issue Number
     *
     * @return int
     */
    public function getIssueNumber()
    {
        return $this->issue['number'];
    }

    /**
     * Get issue labels
     *
     * @return array
     */
    public function getLabels()
    {
        return array_column($this->issue['labels'], 'name');
    }

    /**
     * Get issue assignees
     *
     * @return array
     */
    public function getAssignees()
    {
        return array_column($this->issue['assignees'], 'login');
    }

    /**
     * Return Uniform Resource Identifier for the task
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Return a dict to populate the task form
     *
     * @return array
     */
    public function getFormValues()
    {
        return array(
            'title' => $this->issue['title'],
            'reference' => $this->issue['number'],
            'description' => $this->issue['body'],
            'tags' => $this->getLabels(),
        );
    }
}
