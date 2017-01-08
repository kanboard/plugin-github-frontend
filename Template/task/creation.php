<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Github Issue #%d', $external_task->getIssueNumber()) ?></h2>
</div>

<?= $this->form->hidden('project_id', $values) ?>

<div class="task-form-container">
    <div class="task-form-main-column">
        <?= $this->task->renderTitleField($values, $errors) ?>
        <?= $this->task->renderDescriptionField($values, $errors) ?>
        <?= $this->task->renderTagField($project) ?>

        <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>

    <div class="task-form-secondary-column">
        <?= $this->task->renderColorField($values) ?>
        <?= $this->task->renderAssigneeField($users_list, $values, $errors) ?>
        <?= $this->task->renderCategoryField($categories_list, $values, $errors) ?>
        <?= $this->task->renderSwimlaneField($swimlanes_list, $values, $errors) ?>
        <?= $this->task->renderColumnField($columns_list, $values, $errors) ?>
        <?= $this->task->renderPriorityField($project, $values) ?>

        <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>

    <div class="task-form-secondary-column">
        <?= $this->task->renderDueDateField($values, $errors) ?>
        <?= $this->task->renderStartDateField($values, $errors) ?>
        <?= $this->task->renderTimeEstimatedField($values, $errors) ?>
        <?= $this->task->renderTimeSpentField($values, $errors) ?>
        <?= $this->task->renderScoreField($values, $errors) ?>
        <?= $this->task->renderReferenceField($values, $errors) ?>

        <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>
</div>
