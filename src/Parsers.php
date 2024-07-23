<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $pathToFile): array
{
    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);
    $fileContent = file_get_contents($pathToFile);
    if ($extension === 'json') {
        return json_decode($fileContent, true);
    } elseif ($extension === 'yml' || $extension === 'yaml') {
        return (array) Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
    } else {
        throw new \Exception("Unsupported file format: $extension");
    }
}