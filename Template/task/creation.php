<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Github Issue #%d', $external_task->getIssueNumber()) ?></h2>
</div>

<div class="form-columns">
    <div class="form-column">
        <?= $this->task->selectTitle($values, $errors) ?>
        <?= $this->task->selectDescription($values, $errors) ?>
        <?= $this->task->selectTags($project, $values['tags']) ?>

        <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>

    <div class="form-column">
        <?= $this->form->hidden('project_id', $values) ?>
        <?= $this->task->selectColor($values) ?>
        <?= $this->task->selectAssignee($users_list, $values, $errors) ?>
        <?= $this->task->selectCategory($categories_list, $values, $errors) ?>
        <?= $this->task->selectSwimlane($swimlanes_list, $values, $errors) ?>
        <?= $this->task->selectColumn($columns_list, $values, $errors) ?>
        <?= $this->task->selectPriority($project, $values) ?>
        <?= $this->task->selectScore($values, $errors) ?>
        <?= $this->task->selectReference($values, $errors) ?>

        <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>

    <div class="form-column">
        <?= $this->task->selectTimeEstimated($values, $errors) ?>
        <?= $this->task->selectTimeSpent($values, $errors) ?>
        <?= $this->task->selectStartDate($values, $errors) ?>
        <?= $this->task->selectDueDate($values, $errors) ?>

        <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
    </div>
</div>
