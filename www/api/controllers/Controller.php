<?php //Application
/**
*
*/
namespace Controllers;

abstract class Controller {
    public function checkRequired ($required, $post) {
        // MAKE SURE EACH REQUIRED FIELDS EXISTS IN $_POST
        return array_filter($required, function ($r) use ($post) {
            return !array_key_exists($r, $post);
        });
    }

    public function filterXSS($data) {
        $currentData = $data;
        if (!isset($currentData)) {
            return -1;
        }
        if (!is_array($currentData)) {
            $currentData = htmlspecialchars($currentData);
        } else {
            foreach ($currentData as &$value) {
                $value = htmlspecialchars($value);
            }
            unset($value);
        }
        return $currentData;
    }
}

?>
