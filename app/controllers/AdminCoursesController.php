<?php

class AdminCoursesController extends AdminController {

	public function postIndex()
	{
		$course = Input::get('course');
		$course = explode(' ', $course);
		
		if( strlen($course[0]) == 4 && strlen($course[1]) == 4  && is_numeric($course[1]) )
		{
			$prefix = $course[0];
			$number = $course[1];
			$name = trim(implode(' ', array_slice($course, 2)));

			$existing_course = Course::get($prefix,$number);

			if(isset($existing_course))
			{
				Session::flash('course_fail','Course already exists!');
				return Redirect::to('admin/tas');
			}
			else
			{
				Course::create(
					array(
						'prefix' => $prefix,
						'number' => $number,
						'name' => $name
					)
				);

				Session::flash('course_success','Course has been added!');
				return Redirect::to('admin/tas');		
			}

		}
		else
		{
			Session::flash('course_fail','Please provide prefix and number for the course.');
			return Redirect::to('admin/tas');
		}

	}
}