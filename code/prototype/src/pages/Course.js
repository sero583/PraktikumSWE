import './styles/Course.css';
import Lessoncard from './Lessoncard';
import CourseAdminButtons from './CourseAdminButtons';
import { useParams } from 'react-router-dom';

export default function Course(){
    const id = useParams().course_id;
    
    //fetched from server using course id
    const lessons = [{"id": "1", "headline": "First Java Lesson", "text": "first something", "xp": 20},{"id": "2", "headline": "Second Java Lesson", "text": "second something", "xp": 10}];
    const title = "Testcourse";
    const description = "An empty course for testing purposes";

    return (
        <div className="course">
            <div className='innerCourse'>
                <CourseAdminButtons />
                <h1 id="courseHeadline">{title}</h1>
                <p id="courseText">{description}</p>
                {lessons.map(lesson => {
                    return <Lessoncard key={lesson.id} lesson={lesson} course_id={id}/>
                })}
            </div>
        </div>
    );
}