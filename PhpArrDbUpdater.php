<?php

// TODO: need to count how many spaces when dealing with arrays

class PhpArrDbUpdater {
  public function update($updatedDb, $path, $isInnerUse = false) {
    if (!$isInnerUse) {
      $newDbContents = '<?php' . "\n";
      $newDbContents .= "\n";
      $newDbContents .= "return [\n";
    }
    foreach ($updatedDb as $key => $value) {
      if ($value === null) {
        $newDbContents .= "  '$key' => null,\n";
      } else if (isNumber($value)) {
        $newDbContents .= "  '$key' => $value,\n";
      } else if (is_string($value)) {
        $newDbContents .= "  '$key' => '$value',\n";
      } else if (is_array($value)) {
        $newDbContents .= "  '$key' => [\n";
        $newDbContents .= $this->update($value, $path, true);
        $newDbContents .= "],\n";
      } else {
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