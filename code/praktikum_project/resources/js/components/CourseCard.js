import {Link} from 'react-router-dom';
import '../../css/components/CourseCard.css';

export default function CourseCard({course}){
    return (
        <div className="card">
            <Link to={"/course/" + course.id}>
                <div>
                    <img src={course.img} alt="course_picture"></img>
                    <h1>{course.title}</h1>
                </div>
            </Link>
        </div>
    );
}