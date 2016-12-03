<?php

namespace Kanboard\Plugin\GithubFrontend;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:layout:css', 'plugins/GithubFrontend/Asset/plugin.css');
        $this->template->hook->attach('template:config:integrations', 'GithubFrontend:config/integration');
        $this->externalTaskManager->register(new GithubTaskProvider($this->container));
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Github Issues Frontend';
    }

    public function getPluginDescription()
    {
        return t('Manage Github Issues with Kanboard');
    }

    public function getPluginAuthor()
    {
        return 'Frédéric Guillot';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-github-frontend';
    }
}
