<?php

class TaCoursesController extends TaController {

	public function getIndex()
	{
		$courses = Course::all();
		$ta_id = Auth::user()->TA()->id;

		$knowledge =array();
		foreach ($courses as $course) {
			$course_knowledge = CourseKnowledge::forCourseAndTA($course->id,$ta_id);
			if ( isset($course_knowledge) )
				$knowledge[$course->id] = $course_knowledge->knowledge;
			else $knowledge[$course->id] = 0;
		}

		$this->navbar['Profile']['active'] = true;

		return View::make('ta/courses')
				->with('user', $this->user)
                ->with('navbar',$this->navbar)
				->with('courses', $courses)
				->with('knowledge',$knowledge);
	}

	public function postIndex()
	{
		$course_id = Input::get('course_id');
		$ta_id = Auth::user()->TA()->id;
		$knowledge = Input::get('knowledge');

		if (! isset($knowledge) )
			return "false";

		if ( $knowledge < 1 || $knowledge > 5 )
			return "false";

		$course_knowledge = CourseKnowledge::forCourseAndTA($course_id,$ta_id);

		if (isset($course_knowledge))
		{
			$course_knowledge->knowledge = $knowledge;
			$course_knowledge->save();
		}
		else
		{
			CourseKnowledge::create(
				array(
					'course_id'=>$course_id,
					'ta_id' => $ta_id,
					'knowledge' => $knowledge
				)
			);
		}

		return "true";
	}

}