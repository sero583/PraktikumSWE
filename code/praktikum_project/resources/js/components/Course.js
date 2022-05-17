import '../../css/components/Course.css';
import Lessoncard from './Lessoncard';
import CourseAdminButtons from './CourseAdminButtons';
import { useParams } from 'react-router-dom';
import { useEffect, useState } from 'react';

export default function Course(){
    const id = useParams().course_id;
    
    //fetching data from server
    const [isLoading, setLoading] = useState(true);
    const [course, setCourse] = useState();
    let uri = '/api/course/' + id;
    useEffect(() => {
        axios.get(uri).then((response) => {
            setCourse(response.data);
            setLoading(false);
        });
    }, []);

    let lessons;
    if(id == 1){
        lessons = [{"id": 1, "course_id": 1, "title": "Name of the first Java Lesson", "description": "Instructions what has to be implemented", "predefined_code": "public class First...", "expected_output":"Hello World", "xp": 20, "next_lesson": 2}, {"id": 2, "course_id": 1, "title": "Name of the second Java Lesson", "description": "Instructions what has to be implemented", "predefined_code": "public class Second...", "expected_output":"Hello World", "xp": 20, "next_lesson": null}];
    }
    if(id == 2){
        lessons = [{"id": 3, "course_id": 2, "title": "Name of the first Python Lesson", "description": "Instructions what has to be implemented", "predefined_code": "print(\"python\")", "expected_output":"python", "xp": 10, "next_lesson": null}]
    }

    if(isLoading){
        return(
            <div className='course'>
                Loading...
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