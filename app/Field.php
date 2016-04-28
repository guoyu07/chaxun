<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Field extends Model
	{
		protected $table = 'fields';

		protected $fillable = ['id', 'tid', 'name', 'orderno', 'input', 'isshow'];


		public function table()
		{
			return $this->belongsTo('App\Table', 'tid', 'id');
		}
	}