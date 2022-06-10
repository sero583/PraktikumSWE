import {Link} from 'react-router-dom';
import '../../css/components/Lessoncard.css';
import { useEffect, useState } from 'react';

export default function Lessoncard({lesson}){
    const [finished, setFinished] = useState(false);
    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");

        axios.get("/api/lesson/" + lesson.id + '/finished', {
            headers: { "Authorization": "Bearer " + cachedToken }
          }).then((response) => {
            setFinished(response.data.finished)
        });
    }, []);
    
    return (
        <div className="lessoncard">
            <Link to={"/course/" + lesson.course_id + "/lesson/" + lesson.position}>
                <div>
                    <h1>{lesson.title}</h1>
                    <p>{lesson.xp} XP</p>
                </div>
                {finished ? (<p id='finished'>✓</p>) : ("")}
            </Link>
        </div>
    );
}