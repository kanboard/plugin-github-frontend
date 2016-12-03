Github Frontend
===============

[![Build Status](https://travis-ci.org/kanboard/plugin-github-frontend.svg?branch=master)](https://travis-ci.org/kanboard/plugin-github-frontend)

Manage Github Issues with Kanboard.

- Import any Github issues in Kanboard
- Manage Github issues like any Kanboard tasks
- Load Github issue information into Kanboard user interface
- Compatible with Github Enterprise

Author
------

- Frederic Guillot
- License MIT

Requirements
------------

- Kanboard >= 1.0.35

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/GithubFrontend`
3. Clone this repository into the folder `plugins/GithubFrontend`

Note: Plugin folder is case-sensitive.

Documentation
-------------

### Select the Github task provider

![github_frontend1](https://cloud.githubusercontent.com/assets/323546/20085430/dd09b27a-a536-11e6-8280-aa668f28af0e.png)

To import a new Github Issue, you have to select the external task provider first.
When you create a new task, on the right, select the external provider.

### Provide the information to load the issue

![github_frontend2](https://cloud.githubusercontent.com/assets/323546/20085431/dd0a5694-a536-11e6-9893-d135c3489cd4.png)

To import a Github Issue, the project owner (organization), the project name and the issue number are required.

### Edit the task

![github_frontend3](https://cloud.githubusercontent.com/assets/323546/20085432/dd0b38f2-a536-11e6-8ee5-e083854c1d01.png)

By default, the plugin will populate the form with the Issue information.

### Visualize issue information directly in Kanboard

![github_frontend4](https://cloud.githubusercontent.com/assets/323546/20085429/dd09a21c-a536-11e6-91e6-a11780782001.png)

When you are going on the task view page, Kanboard will load asynchronously the Github Issue into the Kanboard user interface.
