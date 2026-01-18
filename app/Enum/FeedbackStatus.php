<?php

namespace App\Enum;

enum FeedbackStatus: string
{
    case Waiting = "waiting";
    case Processing = "in_progress";
    case Complete = "completed";
    case Rejected = 'rejected';
}
