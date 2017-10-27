<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Certificate Origin Authorized'), ['action' => 'edit', $certificateOriginAuthorized->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Certificate Origin Authorized'), ['action' => 'delete', $certificateOriginAuthorized->id], ['confirm' => __('Are you sure you want to delete # {0}?', $certificateOriginAuthorized->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Certificate Origin Authorizeds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Certificate Origin Authorized'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="certificateOriginAuthorizeds view large-9 medium-8 columns content">
    <h3><?= h($certificateOriginAuthorized->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $certificateOriginAuthorized->has('user') ? $this->Html->link($certificateOriginAuthorized->user->member_name, ['controller' => 'Users', 'action' => 'view', $certificateOriginAuthorized->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($certificateOriginAuthorized->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($certificateOriginAuthorized->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($certificateOriginAuthorized->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($certificateOriginAuthorized->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($certificateOriginAuthorized->edited_on) ?></td>
        </tr>
    </table>
</div>
