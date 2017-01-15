<?php

//by jean gomes



require_once('includes/core.php');




function userOnly()
{
    if (! isLogged())
    {
        global $conn;
        $conn->close();
        exit("Please log in to continue!");
    }
}

$t = (! isset($_POST['t'])) ? "" : $_POST['t'];

$data = array(
    'status' => 417
);


if (empty($t))
{
	exit('a');
}

include('requests/' . $t . '.php');



















?>