<?php

namespace Differ\Differ;

function parseJsonFile(string $pathToFile): array
{
    $fileContent = file_get_contents($pathToFile);
    return json_decode($fileContent, true);
}

function convertValueToString($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } else {
        return (string) $value;
    }
}

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $file1 = parseJsonFile($pathToFile1);
    $file2 = parseJsonFile($pathToFile2);

    $allKeys = array_unique(array_merge(array_keys($file1), array_keys($file2)));
    sort($allKeys);
    $diff = [];

    foreach($allKeys as $key) {
        $value1 = $file1[$key] ?? null;
        $value2 = $file2[$key] ?? null;
        $value1 = convertValueToString($value1);
        $value2 = convertValueToString($value2);

        if(!array_key_exists($key, $file2)) {
            $diff[] = "  - $key: $value1";
        } elseif(!array_key_exists($key, $file1)) {
            $diff[] = "  + $key: $value2";
        } elseif($value1 === $value2) {
             $diff[] = "    $key: $value1";
        } else {
            $diff[] = "  - $key: $value1";
            $diff[] = "  + $key: $value2";
        }
    }
    return "{\n" . implode("\n", $diff) . "\n}\n";
}

