<?php
$test = Auth::user()->department_id;
if ($_GET['id'] == "LA UNION") {
  echo '
    [ {"optionValue": 0, "optionDisplay": "'.$test.'"}, {"optionValue":1, "optionDisplay": "Andy"}, {"optionValue":2, "optionDisplay": "Richard"}]
';
} else if ($_GET['id'] == 2) {
  echo <<<HERE_DOC
    [{"optionValue":10, "optionDisplay": "Remy"}, {"optionValue":11, "optionDisplay": "Arif"}, {"optionValue":12, "optionDisplay": "JC"}]
HERE_DOC;
} else if ($_GET['id'] == 3) {
  echo <<<HERE_DOC
    [{"optionValue":20, "optionDisplay": "Aidan"}, {"optionValue":21, "optionDisplay":"Russell"}]
HERE_DOC;
}
?>