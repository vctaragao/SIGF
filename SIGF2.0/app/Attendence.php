<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{

	protected $table = "attendences";

	public function create($data, $class_id){

		$attendence_data = $data['attendence'];

		foreach ($attendence_data as $user_id => $presence) {
			
			$presence = ($presence == "on") ? 1 : 0;



			$attendence = new Attendence;

			$attendence->user_id = $user_id;
			$attendence->presence = $presence;
			$attendence->class_id = $class_id;
			$attendence->save();
		}

		return 1;
	}

	public function updateAttendence($data){

		foreach ($data['attendence'] as $attendence_id => $presence) {
					
			$presence = ($presence == "on") ? 1 : 0;



			$attendence = Attendence::find($attendence_id);

			$attendence->presence = $presence;
			$attendence->save();
		}

		return 1;
	}

	public function deletePresences($class_id){

		$presences = $this->where('class_id', '=', $class_id)->get();

		foreach ($presences as $presence) {
			$presence->delete();
		}

		return 1;
	}
}
