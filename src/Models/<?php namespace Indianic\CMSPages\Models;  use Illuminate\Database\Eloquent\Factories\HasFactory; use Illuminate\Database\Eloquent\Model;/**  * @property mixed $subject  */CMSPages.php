<?php
namespace Indianic\CMSPages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $subject
 */
class CMSPage extends Model
{
   use HasFactory;

    protected $table = 'cms_pages';
}

