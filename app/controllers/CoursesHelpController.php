<?php

class CoursesHelpController extends BaseController {

	public function getIndex()
	{
		$course_id = Input::get('course_id');

		$courses_knowledge = CourseKnowledge::where('course_id','=',$course_id)->get();

		$knowledge = array();
		foreach ($courses_knowledge as $course_knowledge)
		{
			$ta = $course_knowledge->TA();
			$knowledge[$ta->name] = $course_knowledge->knowledge;
		}
		
		return json_encode($knowledge);
	}
}