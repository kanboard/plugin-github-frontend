<h3><i class="fa fa-github fa-fw"></i><?= t('Github Frontend Plugin') ?></h3>
<div class="panel">
    <?= $this->form->label(t('Github API URL'), 'github_frontend_api_url') ?>
    <?= $this->form->text('github_frontend_api_url', $values) ?>
    <p class="form-help"><?= t('Leave blank to use the default URL.') ?></p>

    <?= $this->form->label(t('Github API Username'), 'github_frontend_api_username') ?>
    <?= $this->form->password('github_frontend_api_username', $values) ?>

    <?= $this->form->label(t('Github API Access Token'), 'github_frontend_api_access_token') ?>
    <?= $this->form->password('github_frontend_api_access_token', $values) ?>
    <p class="form-help"><?= t('Define a token to avoid API rate limit.') ?></p>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>
</div>
