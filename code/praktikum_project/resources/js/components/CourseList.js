import '../../css/components/CourseList.css';
import CourseCard from './CourseCard';
import { useEffect, useState } from 'react';

export default function CourseList({coursetype}){
    const [isLoading, setLoading] = useState(true);
    const [courses, setCourses] = useState();
    if(coursetype === "recent"){
        let uri = 'api/course/recent';
        useEffect(() => {
            axios.get(uri).then((response) => {
                setCourses(response.data);
                setLoading(false);
            });
        }, []);
    }
    else{
        let uri = 'api/course';
        useEffect(() => {
            axios.get(uri).then((response) => {
                setCourses(response.data);
                setLoading(false);
            });
        }, []);
    }

    if(isLoading){
        return (
            <div className='courses'>
                Loading...
            </div>
        )
    }

    return (
        <div className="courses">
            {courses.map(course => {
                return <CourseCard key={course.id} course={course} />
            })}
        </div>
    );
}