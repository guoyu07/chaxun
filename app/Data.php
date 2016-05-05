<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Data extends Model
	{
		protected $table = 'data';

		protected $fillable = ['id', 'tid', 'dt1', 'dt2', 'dt3', 'dt4', 'dt5', 'dt6', 'dt7', 'dt8', 'dt9', 'dt10', 'dt11', 'dt12', 'dt13', 'dt14', 'dt15', 'dt16', 'dt17', 'dt18', 'dt19', 'dt20'];


		public function table()
		{
			return $this->belongsTo('App\Table', 'tid', 'id');
		}

	}
