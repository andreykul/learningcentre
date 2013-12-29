<?php

class TaPublicProfileController extends BaseController {

	public function getIndex()
	{
		$ta = Input::get('ta');

		if(! isset($ta))
			return Redirect::to('/');

		$ta = TA::where('name','=',$ta)->first();

		$courses = Course::all();

		$knowledge =array();
		foreach ($courses as $course) {
			$course_knowledge = CourseKnowledge::forCourseAndTA($course->id,$ta->id);
			if ( isset($course_knowledge) )
				$knowledge[$course->id] = $course_knowledge->knowledge;
			else $knowledge[$course->id] = 0;
		}

        return View::make('ta/public/profile')
                    ->with('ta', $ta)
                    ->with('courses', $courses)
					->with('knowledge',$knowledge);
	}
}