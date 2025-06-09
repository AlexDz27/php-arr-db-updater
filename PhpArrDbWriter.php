<?php

class PhpArrDbWriter {
  public function write($updatedDb, $path, $isInnerUse = false, $spaces = '  ') {
    $newDbContents = '';
    if (!$isInnerUse) {
      $newDbContents = '<?php' . "\n";
      $newDbContents .= "\n";
      $newDbContents .= "return [\n";
    }
    foreach ($updatedDb as $key => $value) {
      if ($value === null) {
        $newDbContents .= "$spaces'$key' => null,\n";
      } else if (is_bool($value)) {
        if ($value === false) {
          $newDbContents .= "$spaces'$key' => false,\n";
        } else if ($value === true) {
          $newDbContents .= "$spaces'$key' => true,\n";
        }
      } else if (isNumber($value)) {
        $newDbContents .= "$spaces'$key' => $value,\n";
      } else if (is_string($value)) {
        $newDbContents .= "$spaces'$key' => '$value',\n";
      } else if (is_array($value)) {
        if (empty($value)) {
          $newDbContents .= "$spaces'$key' => [],\n";
        } else {
          $newDbContents .= "$spaces'$key' => [\n";
          $spaces .= '  ';
          $newDbContents .= $this->update($value, $path, true, $spaces);
          $spaces = substr($spaces, 0, -2);
          $newDbContents .= "$spaces],\n";
        }
      } else {
        // var_dump($value);
        throw new Exception('Undefined type');
      }
    }
    if (!$isInnerUse) {
      $newDbContents .= "];";
    }

    file_put_contents($path, $newDbContents);
    return $newDbContents;
  }
}


function isNumber($value) {
  return is_int($value) || is_float($value);
}