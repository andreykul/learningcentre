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
				Session::flash('course_fail','Course already exists!');
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
			}

		}
		else Session::flash('course_fail','Please provide prefix and number for the course.');
			

		return Redirect::to('admin/tas');
	}

	public function deleteIndex()
	{
		$course_id = Input::get('course_id');

		$course = Course::find($course_id);

		if(isset($course))
		{
			$course->delete();
			Session::flash('course_success','Course has been removed!');
		}
		else Session::flash('course_fail','Course not found!');

		return Redirect::to('admin/tas');
	}
}