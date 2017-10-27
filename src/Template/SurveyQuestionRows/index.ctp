<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Survey Question Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="surveyQuestionRows index large-9 medium-8 columns content">
    <h3><?= __('Survey Question Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('survey_question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('objective') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveyQuestionRows as $surveyQuestionRow): ?>
            <tr>
                <td><?= $this->Number->format($surveyQuestionRow->id) ?></td>
                <td><?= $surveyQuestionRow->has('survey_question') ? $this->Html->link($surveyQuestionRow->survey_question->id, ['controller' => 'SurveyQuestions', 'action' => 'view', $surveyQuestionRow->survey_question->id]) : '' ?></td>
                <td><?= h($surveyQuestionRow->objective) ?></td>
                <td><?= h($surveyQuestionRow->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $surveyQuestionRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $surveyQuestionRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $surveyQuestionRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestionRow->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
