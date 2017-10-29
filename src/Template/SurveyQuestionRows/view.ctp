<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Survey Question Row'), ['action' => 'edit', $surveyQuestionRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Survey Question Row'), ['action' => 'delete', $surveyQuestionRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestionRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Survey Question Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="surveyQuestionRows view large-9 medium-8 columns content">
    <h3><?= h($surveyQuestionRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Survey Question') ?></th>
            <td><?= $surveyQuestionRow->has('survey_question') ? $this->Html->link($surveyQuestionRow->survey_question->id, ['controller' => 'SurveyQuestions', 'action' => 'view', $surveyQuestionRow->survey_question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Objective') ?></th>
            <td><?= h($surveyQuestionRow->objective) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($surveyQuestionRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($surveyQuestionRow->date) ?></td>
        </tr>
    </table>
</div>
