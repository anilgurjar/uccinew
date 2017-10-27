<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Survey Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Survey Question Rows'), ['controller' => 'SurveyQuestionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Survey Question Row'), ['controller' => 'SurveyQuestionRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="surveyQuestions index large-9 medium-8 columns content">
    <h3><?= __('Survey Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveyQuestions as $surveyQuestion): ?>
            <tr>
                <td><?= $this->Number->format($surveyQuestion->id) ?></td>
                <td><?= h($surveyQuestion->question) ?></td>
                <td><?= h($surveyQuestion->question_type) ?></td>
                <td><?= h($surveyQuestion->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $surveyQuestion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $surveyQuestion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $surveyQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestion->id)]) ?>
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
