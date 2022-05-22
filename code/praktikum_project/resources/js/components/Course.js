import '../../css/components/Course.css';
import Lessoncard from './Lessoncard';
import CourseAdminButtons from './CourseAdminButtons';
import { useParams } from 'react-router-dom';
import { useEffect, useState } from 'react';

export default function Course(){
    const id = useParams().course_id;
    
    //fetching data from server
    const [isCourseLoading, setCourseLoading] = useState(true);
    const [course, setCourse] = useState();
    const [isLessonsLoading, setLessonsLoading] = useState(true);
    const [lessons, setLessons] = useState();
    useEffect(() => {
        axios.get('/api/course/' + id).then((response) => {
            setCourse(response.data);
            setCourseLoading(false);
        });
    }, []);
    useEffect(() => {
        axios.get('/api/course/' + id + '/lessons').then((response) => {
            setLessons(response.data);
            setLessonsLoading(false);
        });
    }, []);

    if(isCourseLoading){
        return(
            <div className='course'>
                Loading...
            </div>
        )
    }

    if(isLessonsLoading){
        return(
            <div className='course'>
                <div className='innerCourse'>
                    <CourseAdminButtons />
                    <h1 id="courseHeadline">{course.title}</h1>
                    <p id="courseText">{course.description}</p>
                    <div>
                        Loading...
                    </div>
                </div>
            </div>
        )
    }
    
    return (
        <div className="course">
            <div className='innerCourse'>
                <CourseAdminButtons />
                <h1 id="courseHeadline">{course.title}</h1>
                <p id="courseText">{course.description}</p>
                {lessons.map(lesson => {
                    return <Lessoncard key={lesson.id} lesson={lesson}/>
                })}
            </div>
        </div>
    );
}