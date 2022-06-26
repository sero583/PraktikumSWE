import {Link} from 'react-router-dom';
import '../../css/components/Lessoncard.css';

export default function Lessoncard({lesson}) {
    return (
        <div className="lessoncard">
            <Link to={"/course/" + lesson.course_id + "/lesson/" + lesson.position}>
                <div>
                    <h1>{lesson.title}</h1>
                    <p>{lesson.xp} XP</p>
                </div>
                {lesson.finished ? (<p id='finished'>✓</p>) : ("")}
            </Link>
        </div>
    );
}