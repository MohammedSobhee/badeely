<?php
    $remainingDays = $account->remainingDays();
?>

<?php switch($remainingDays):

    case ('unlimited'): ?>
        <span class="m-badge m-badge--success m-badge--wide" style="font-size:15px;">&infin;</span>
    <?php break; ?>

    <?php case ('not_started'): ?>
        <span class="m-badge m-badge--info m-badge--wide"><?php echo app('translator')->getFromJson('dashboard.not_started'); ?></span>
    <?php break; ?>

    <?php case ('over'): ?>
        <span class="m-badge m-badge--danger m-badge--wide"><?php echo app('translator')->getFromJson('dashboard.over'); ?></span>
    <?php break; ?>

    <?php default: ?>
       <span class="m-badge m-badge--success m-badge--wide"><?php echo e($remainingDays); ?></span>

<?php endswitch; ?>
