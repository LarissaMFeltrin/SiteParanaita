<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BenfCruz
 *
 * @property int $id
 * @property string $aLegenda
 * @property string $aPalavraCruz
 * @property string $aPalavraPadrao
 *
 * @package App\Models
 */
class BenfCruz extends Model
{
	protected $table = 'benf_cruz';
	public $timestamps = false;

	protected $fillable = [
		'aLegenda',
		'aPalavraCruz',
		'aPalavraPadrao'
	];
}
