<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionClaim extends Model
{
  protected $table = 'action_claim';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
                          'type_action',
                          'date', 
                          'category',
                          'member_name', 
                          'client_id', 
                          'time_distribution', 
                          'time_receive',
                          'remarks_info',
                          'no_claim',
                          'pic_id',
                          'status',
                          'pic_analyst',
                          'finish_time',
                          'action_analyst',
                          'remarks_analyst',
                          'time_action_analyst',
                          'pic_ma',
                          'remarks_ma',
                          'time_action_ma'
                        ];
}
