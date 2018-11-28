<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;
class Newdata extends Model
{
    protected $table = "newdata";
    public $timestamps = false;
    protected $primaryKey = "_id";
    protected $fillable = ['_index', '_type', '_id', '_score', 'server_name', 'remote', 'route', 'route_path', 'request_method', 'user', 'http_args', 'log_id', 'status', 'size', 'referer', 'user_agent', 'datetime', 'sort'];
}
