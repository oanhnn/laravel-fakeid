<?php

namespace Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\FakeId\Contracts\ShouldFakeId;
use Laravel\FakeId\RoutesWithFakeId;

/**
 * Class Post
 *
 * Stub class for test trait RoutesWithFakeId
 *
 * @package     Tests\Stubs
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Post extends Model implements ShouldFakeId
{
    use RoutesWithFakeId;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];
}
