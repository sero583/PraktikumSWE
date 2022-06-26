import {Link} from 'react-router-dom';
import '../../css/components/CourseCard.css';

export default function CourseCard({course}){
    return (
        <div className="card">
            <Link to={"/course/" + course.id}>
                <div>
                    <img src={course.thumbnail_path} alt="course_picture"></img>
                    <h1>{course.title}</h1>
                    <progress id="xp_progress" value={course.user_xp} max={course.course_xp}></progress>
                    <label htmlFor='xp_progress'>{course.user_xp}/{course.course_xp}XP</label>
                </div>
            </Link>
        </div>
    );
}