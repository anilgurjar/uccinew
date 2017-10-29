<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $surveyQuestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Survey Question Rows'), ['controller' => 'SurveyQuestionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Survey Question Row'), ['controller' => 'SurveyQuestionRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="surveyQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($surveyQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Survey Question') ?></legend>
        <?php
            echo $this->Form->input('question');
            echo $this->Form->input('question_type');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
