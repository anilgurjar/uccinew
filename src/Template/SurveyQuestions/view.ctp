<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Survey Question'), ['action' => 'edit', $surveyQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Survey Question'), ['action' => 'delete', $surveyQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Survey Question Rows'), ['controller' => 'SurveyQuestionRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question Row'), ['controller' => 'SurveyQuestionRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="surveyQuestions view large-9 medium-8 columns content">
    <h3><?= h($surveyQuestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= h($surveyQuestion->question) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Type') ?></th>
            <td><?= h($surveyQuestion->question_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($surveyQuestion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($surveyQuestion->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Survey Question Rows') ?></h4>
        <?php if (!empty($surveyQuestion->survey_question_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Survey Question Id') ?></th>
                <th scope="col"><?= __('Objective') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($surveyQuestion->survey_question_rows as $surveyQuestionRows): ?>
            <tr>
                <td><?= h($surveyQuestionRows->id) ?></td>
                <td><?= h($surveyQuestionRows->survey_question_id) ?></td>
                <td><?= h($surveyQuestionRows->objective) ?></td>
                <td><?= h($surveyQuestionRows->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SurveyQuestionRows', 'action' => 'view', $surveyQuestionRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SurveyQuestionRows', 'action' => 'edit', $surveyQuestionRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SurveyQuestionRows', 'action' => 'delete', $surveyQuestionRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestionRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
