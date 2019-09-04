<div class="row flex-column flex-hcenter">

    <?php if ($_GET['section'] == 'contact'): ?>
    <?php include('sites/about/contact.php'); ?>

    <?php elseif ($_GET['section'] == 'privacy'): ?>
    <?php include('sites/about/privacy.php'); ?>

    <?php elseif ($_GET['section'] == 'legal'): ?>
    <?php include('sites/about/legal.php'); ?>

    <?php else: ?>
    <?php include('sites/about/contact.php'); ?>
    <?php endif; ?>

</div>