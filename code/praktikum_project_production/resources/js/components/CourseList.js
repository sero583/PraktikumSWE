import '../../css/components/CourseList.css';
import CourseCard from './CourseCard';
import { useEffect, useState } from 'react';

export default function CourseList({courses}){
    return (
        <div className="courses">
            {courses.map(course => {
                return <CourseCard key={course.id} course={course} />
            })}
        </div>
    );
}