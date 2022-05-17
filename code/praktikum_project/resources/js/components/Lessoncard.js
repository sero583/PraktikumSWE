import {Link} from 'react-router-dom';
import '../../css/components/Lessoncard.css';

export default function Lessoncard({lesson}){
    const isEditing = false;
    return (
        <div className="lessoncard">
            <input className={isEditing ? "" : "hidden"} type="checkbox"></input>
            <div>
                <Link to={"/course/" + lesson.course_id + "/lesson/" + lesson.id}>
                    <h1>{lesson.title}</h1>
                    <p>{lesson.xp} XP</p>
                </Link>
            </div>
        </div>
    );
}