<?php 

require_once 'includes/bootstrap.php';

/**
 * Add the users' form and fields
 */
$app->addForm();

/**
 * Render the homepage
 */
$app->showHome();
include_once '../incs/inc.footer.php';