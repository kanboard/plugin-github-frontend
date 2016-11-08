<?php

namespace Kanboard\Plugin\GithubFrontend;

use Kanboard\Core\Base;
use Kanboard\Core\ExternalTask\ExternalTaskInterface;
use Kanboard\Core\ExternalTask\ExternalTaskProviderInterface;
use Kanboard\Core\ExternalTask\NotFoundException;

class GithubTaskProvider extends Base implements ExternalTaskProviderInterface
{
    const ISSUE_URL = 'https://api.github.com/repos/%s/%s/issues/%d';

    /**
     * Get provider name (visible in the user interface)
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'Github';
    }

    /**
     * Retrieve task from external system or cache
     *
     * @access public
     * @throws \Kanboard\Core\ExternalTask\AccessForbiddenException
     * @throws \Kanboard\Core\ExternalTask\NotFoundException
     * @param  string $uri
     * @return ExternalTaskInterface
     */
    public function fetch($uri)
    {
        $issue = $this->httpClient->getJson($uri);

        if (empty($issue)) {
            throw new NotFoundException(t('Github Issue not found.'));
        }

        return new GithubTask($uri, $issue);
    }

    /**
     * Save external task to another system
     *
     * @param  string $uri
     * @param  array  $formValues
     * @param  array  $formErrors
     * @return bool
     */
    public function save($uri, array $formValues, array &$formErrors)
    {
        return true;
    }

    /**
     * Get task import template name
     *
     * @return string
     */
    public function getImportFormTemplate()
    {
        return 'GithubFrontend:task/import';
    }

    /**
     * Get creation form template
     *
     * @return string
     */
    public function getCreationFormTemplate()
    {
        return 'GithubFrontend:task/creation';
    }

    /**
     * Get modification form template
     *
     * @return string
     */
    public function getModificationFormTemplate()
    {
        return 'GithubFrontend:task/modification';
    }

    /**
     * Get task view template name
     *
     * @return string
     */
    public function getViewTemplate()
    {
        return 'GithubFrontend:task/view';
    }

    /**
     * Build external task URI from the form values
     *
     * @param  array $values
     * @return string
     */
    public function buildTaskUri(array $values)
    {
        return sprintf(self::ISSUE_URL, $values['organization'], $values['project'], $values['number']);
    }
}
