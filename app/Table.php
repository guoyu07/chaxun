<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Table extends Model
	{
		protected $table = 'tables';

		protected $fillable = ['id', 'title', 'uid', 'start_time', 'end_time', 'status', 'fieldstatus', 'note'];

		/**
		 * 获取对应的用户
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function user()
		{
			return $this->belongsTo('App\User', 'uid', 'id');
		}


		public function fields()
		{
			return $this->hasMany('App\Field','tid','id');
		}
	}
