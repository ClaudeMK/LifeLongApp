<?php
$loguser = $this->request->session()->read('Auth.User');
//test
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <?php if($loguser['role'] === 'Administrator' || $loguser['role'] === 'Coordinator') { ?>
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <?php } else { ?>
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Users', 'action' => 'login']) ?> </li>
        <?php } ?>
    </ul>
</nav>
<div class="index large-10 medium-9 columns content">

<h1>Contact Us</h1>
<p>For any commentaries, questions or complaints, please feel free to contact us.</p>
 
<?php
echo $this->Form->create($contact);
echo $this->Form->control('Firstname');
echo $this->Form->control('Lastname');
echo $this->Form->control('Email');
echo $this->Form->control('Commentary');

echo captcha_image_html();

echo $this->Form->input('CaptchaCode', [
  'label' => 'Retype the characters from the picture:',
  'maxlength' => '10',
  'style' => 'width: 270px;',
  'id' => 'CaptchaCode'
]);

echo $this->Form->button('Send');
echo $this->Form->end();

?>

</div>

