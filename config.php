<?php
declare(strict_types=1);
// Review config db

return [
  'app' => [
    'name' => 'My Blog',
    'debug' => true
  ],
  'database' => [
    'driver' => 'sqlite',
    'dbname' => __DIR__ . '/database/blog.sqlite'
  ]
];

?>