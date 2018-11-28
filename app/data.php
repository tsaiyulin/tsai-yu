<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;
class Data extends Model
{
    protected $table = "data";
    public $timestamps = false;
    protected $primaryKey = "_id";
    protected $fillable = ['_index', '_type', '_id', '_score', 'server_name', 'remote', 'route', 'route_path', 'request_method', 'user', 'http_args', 'log_id', 'status', 'size', 'referer', 'user_agent', 'datetime', 'sort'];
}
