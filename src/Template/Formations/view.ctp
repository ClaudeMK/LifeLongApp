<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Formation $formation
  */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Formation'), ['action' => 'edit', $formation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Formation'), ['action' => 'delete', $formation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formation->id)]) ?> </li>
        <li><?= $this->Html->link(__('Back'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="formations view large-10 medium-9 columns content">
    <h3><?= h($formation->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($formation->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($formation->category->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Frequency') ?></th>
            <td><?= h($formation->frequency->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notification') ?></th>
            <td><?= h($formation->notification->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modality') ?></th>
            <td><?= h($formation->modality->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= h($formation->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration') ?></th>
            <td><?= $this->Number->format($formation->duration) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Position titles') ?></h4>
        <?php if(!empty($formation->positionTitle)): ?>
          <table>
              <tr>
                <th scope="col"><?= __('Title') ?></th>
              </tr>
              <?php foreach ($formation->positionTitle as $positionTitle): ?>
                <tr>
                  <td><?= h($positionTitle->title) ?></td>
                </tr>
              <?php endforeach; ?>
          </table>
        <?php endif; ?>
    </div>
</div>
