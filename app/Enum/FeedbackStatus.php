<?php

namespace App\Enum;

enum FeedbackStatus: string
{
    case Waiting = "waiting";
    case Processing = "in progress";
    case Complete = "Completed";
}
