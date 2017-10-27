<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Industrial Department'), ['action' => 'edit', $industrialDepartment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Industrial Department'), ['action' => 'delete', $industrialDepartment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $industrialDepartment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Industrial Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Industrial Department'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="industrialDepartments view large-9 medium-8 columns content">
    <h3><?= h($industrialDepartment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department Name') ?></th>
            <td><?= h($industrialDepartment->department_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($industrialDepartment->id) ?></td>
        </tr>
    </table>
</div>
