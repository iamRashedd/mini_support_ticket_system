<?php
class Ticket{
    public $id;
    public $title;
    public $description;
    public $status;
    public $user_id;
    public $department_id;
    public $created_at;

    public const STATUS_OPEN = 'open';
}
