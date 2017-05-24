<?php

namespace Views;

class Layout
{
    protected $title;
    protected $body;
    protected $homeActive;

    public function __construct(string $title, callable $body, bool $homeActive = false)
    {
        $this->title = $title;
        $this->body = $body;
        $this->homeActive = $homeActive;
    }

    public function __invoke()
    {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet prefetch" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/twitter.css">

  <title><?= htmlspecialchars($this->title) ?></title>
</head>
<body>

<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-collapse navbar-collapse-1 collapse" aria-expanded="true">
            <ul class="nav navbar-nav">
                <li<?php if ($this->homeActive) echo ' class="active"' ?>>
                    <a href="/"><span class="glyphicon glyphicon-home"></span> Home</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <?= ($this->body)(); ?>
    </div>
</div>
</body>
</html>
<?php
    }
}
