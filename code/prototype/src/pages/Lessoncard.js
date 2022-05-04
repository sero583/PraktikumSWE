import {Link} from 'react-router-dom';
import './styles/Lessoncard.css';

export default function Lessoncard({lesson, course_id}){
    return (
        <div className="lessoncard">
            <Link to={"/course/" + course_id + "/lesson/" + lesson.id}>
                <h1>{lesson.headline}</h1>
                <p>{lesson.xp} XP</p>
            </Link>
        </div>
    );
}