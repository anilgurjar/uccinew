<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $surveyQuestionRow->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestionRow->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Survey Question Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="surveyQuestionRows form large-9 medium-8 columns content">
    <?= $this->Form->create($surveyQuestionRow) ?>
    <fieldset>
        <legend><?= __('Edit Survey Question Row') ?></legend>
        <?php
            echo $this->Form->input('survey_question_id', ['options' => $surveyQuestions]);
            echo $this->Form->input('objective');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
