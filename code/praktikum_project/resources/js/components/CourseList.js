import '../../css/components/CourseList.css';
import CourseCard from './CourseCard';
import { useEffect, useState } from 'react';

export default function CourseList({coursetype}){
    const [isLoading, setLoading] = useState(true);
    const [courses, setCourses] = useState();
    let cachedToken = window.localStorage.getItem("token");

    if(coursetype==="recent"){
        useEffect(() => {
            axios.get("api/course/recent", {
                headers: { "Authorization": "Bearer " + cachedToken }
            }).then((response) => {
                setCourses(response.data);
                setLoading(false);
            });
        }, []);
    } else {
        useEffect(() => {
            axios.get("api/course", {
                headers: { "Authorization": "Bearer " + cachedToken }
            }).then((response) => {
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

    if(courses.length == 0){
        return (
            <p>Nothing here yet. Visit your first course for it to appear here.</p>
        );
    }

    return (
        <div className="courses">
            {courses.map(course => {
                return <CourseCard key={course.id} course={course} />
            })}
        </div>
    );
}