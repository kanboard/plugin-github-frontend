<?php

namespace Kanboard\Plugin\GithubFrontend;

use Kanboard\Core\Base;
use Kanboard\Core\ExternalTask\ExternalTaskInterface;
use Kanboard\Core\ExternalTask\ExternalTaskProviderInterface;
use Kanboard\Core\ExternalTask\NotFoundException;

class GithubTaskProvider extends Base implements ExternalTaskProviderInterface
{
    const DEFAULT_API_URL = 'https://api.github.com/';

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

    public function getIcon()
    {
        return '<i class="fa fa-github fa-fw" aria-hidden="true"></i>';
    }

    /**
     * Get label for adding a new task
     *
     * @access public
     * @return string
     */
    public function getMenuAddLabel()
    {
        return t('Add new Github Issue');
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
        $issue = $this->httpClient->getJson($uri, $this->getAuthorizationHeaders());

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
        return sprintf($this->getIssueApiUrl(), $values['organization'], $values['project'], $values['number']);
    }

    /**
     * Get API Base URL
     *
     * @return string
     */
    protected function getBaseApiUrl()
    {
        $customApiUrl = $this->configModel->get('github_frontend_api_url');

        if (! empty($customApiUrl)) {
            if (substr($customApiUrl, -1) !== '/') {
                return $customApiUrl.'/';
            }

            return $customApiUrl;
        }

        return self::DEFAULT_API_URL;
    }

    /**
     * Get Issue URL
     *
     * @return string
     */
    protected function getIssueApiUrl()
    {
        return $this->getBaseApiUrl().'repos/%s/%s/issues/%d';
    }

    /**
     * Get API authorization headers
     *
     * @return array
     */
    protected function getAuthorizationHeaders()
    {
        $apiUsername = $this->configModel->get('github_frontend_api_username');
        $apiToken = $this->configModel->get('github_frontend_api_access_token');

        if (! empty($apiUsername) && ! empty($apiToken)) {
            return array(
                'Authorization: Basic '.base64_encode($apiUsername.':'.$apiToken)
            );
        }

        return array();
    }
}
