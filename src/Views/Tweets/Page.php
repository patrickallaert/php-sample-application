<?php

namespace Views\Tweets;

use Entity\Tweet;
use Entity\User;

class Page
{
    protected $user;
    protected $tweet;

    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    public function __invoke(): void
    {
        $userId = htmlspecialchars($this->user->id);
        $userName = htmlspecialchars($this->user->name);
        ?>
        <div class="modal fade in" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-backdrop fade in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="media">
                            <a class="media-left" href="/<?= $userId ?>">
                                <img alt="@<?= $userId ?> avatar" class="img-rounded" src="/img/<?= $userId ?>">
                            </a>
                            <div class="media-body">
                                <a href="/<?= $userId ?>"><strong class="fullname"><?= $userName ?></strong></a>
                                <a href="/<?= $userId ?>">@<?= $userId ?></a> <small class="time"><a href="/<?= "$userId/status/" . htmlspecialchars($this->tweet->id) ?>"><?= $this->tweet->ts ?></a></small>
                                <p><?= htmlspecialchars($this->tweet->message) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
