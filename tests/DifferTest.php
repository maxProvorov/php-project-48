<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff(): void
    {
        $expected = <<<EOT
{
  - follow: false
    host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}

EOT;
        $file1 = 'tests/fixtures/file1.json';
        $file2 = 'tests/fixtures/file2.json';
        $this->assertEquals($expected, genDiff($file1, $file2));
    }
}
