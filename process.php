<?php   

ob_start();

use FormTools\Core;

use FormTools\Forms;

use FormTools\Submissions;

use FormTools\Themes;


require_once(__DIR__ . "/global/library.php");


@include_once(__DIR__ . "/global/api/api.php");



Core::init();

$LANG = Core::$L;






if (empty($_POST)) {

    $page_vars = array("message_type" => "error", "message" => $LANG["processing_no_post_vars"]);

    Themes::displayPage("error.tpl", $page_vars);

    exit;



// check there's a form ID included

} else if (empty($_POST["form_tools_form_id"])) {

    $page_vars = array("message_type" => "error", "message" => $LANG["processing_no_form_id"]);

    Themes::displayPage("error.tpl", $page_vars);

    exit;



// is this an initialization submission?

} else if (isset($_POST["form_tools_initialize_form"])) {

    Forms::initializeForm($_POST);



// otherwise, it's a regular form submission. Process it!

} else {
    Submissions::processFormSubmission($_POST);
    header("Location: index.html");
    exit;
}

header("Location: index.html");
exit;