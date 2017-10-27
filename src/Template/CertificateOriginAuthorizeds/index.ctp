<div class="certificateOriginAuthorizeds index large-9 medium-8 columns content">
    <h3><?= __('Certificate Origin Authorizeds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($certificateOriginAuthorizeds as $certificateOriginAuthorized): ?>
            <tr>
                <td><?= $this->Number->format($certificateOriginAuthorized->id) ?></td>
                <td><?= $certificateOriginAuthorized->has('user') ? $this->Html->link($certificateOriginAuthorized->user->member_name, ['controller' => 'Users', 'action' => 'view', $certificateOriginAuthorized->user->id]) : '' ?></td>
                <td><?= $this->Number->format($certificateOriginAuthorized->created_by) ?></td>
                <td><?= h($certificateOriginAuthorized->created_on) ?></td>
                <td><?= $this->Number->format($certificateOriginAuthorized->edited_by) ?></td>
                <td><?= h($certificateOriginAuthorized->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $certificateOriginAuthorized->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $certificateOriginAuthorized->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $certificateOriginAuthorized->id], ['confirm' => __('Are you sure you want to delete # {0}?', $certificateOriginAuthorized->id)]) ?>
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
