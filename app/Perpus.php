<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Perpus extends Model
{
    protected $fillable = [ 'judul','penerbit','tahun_terbit','pengarang' ];
}
