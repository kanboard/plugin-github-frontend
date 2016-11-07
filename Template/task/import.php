<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Github Issue') ?><?= $this->task->getNewTaskDropdown($project['id'], $values['swimlane_id'], $values['column_id']) ?></h2>
</div>

<?= $this->form->label(t('Github Organization'), 'organization') ?>
<?= $this->form->text('organization', $values, array(), array('required')) ?>

<?= $this->form->label(t('Github Project'), 'project') ?>
<?= $this->form->text('project', $values, array(), array('required')) ?>

<?= $this->form->label(t('Issue ID'), 'number') ?>
<?= $this->form->text('number', $values, array(), array('required')) ?>
