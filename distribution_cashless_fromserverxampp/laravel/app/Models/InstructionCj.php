<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionCj extends Model{
  protected $table = 'instruction_cj';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
                        'category',
                        'date',
                        'member_name',
                        'client_id',
                        'time_distribution',
                        'remarks_info',
                        'no_claim',
                        'pic_id',
                        'status',
                        'pic_cj',
                        'remarks_cj',
                        'time_action_cj',
                        'finish_time'
                        ];
}
