<?php

namespace Views\Users;

class Listing
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function __invoke(): void
    {
        ?>
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-body">
                    <h1>The newcomers:</h1>
                    <?php
                    /** @var \Entity\User $user */
                    foreach ($this->users as $user) {
                        $userId = htmlspecialchars($user->id);
                        ?>
                        <div class="media">
                            <a class="media-left" href="/<?= $userId ?>">
                                <img alt="@<?= $userId ?> avatar" class="img-rounded" src="/img/<?= $userId ?>">
                            </a>
                            <div class="media-body">
                                <p><a href="/<?= $userId ?>"><strong class="fullname"><?= $user->name ?></strong></a> <a href="/<?= $userId ?>">@<?= $userId ?></a></p>
                                <small>joined <span class="time"><?= $user->joined ?></span></small>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
