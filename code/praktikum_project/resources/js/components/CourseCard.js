import axios from 'axios';
import { useEffect, useState } from 'react';
import {Link} from 'react-router-dom';
import '../../css/components/CourseCard.css';

export default function CourseCard({course}){
    const [courseXp, setCourseXp] = useState();
    const [userXp, setUserXp] = useState();

    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");
        axios.get("/api/course/" + course.id + "/xp", {
            headers: { "Authorization": "Bearer " + cachedToken}
        }).then((response) => {
            setCourseXp(response.data.course_xp);
            setUserXp(response.data.user_xp);
        })
    }, []);
    
    return (
        <div className="card">
            <Link to={"/course/" + course.id}>
                <div>
                    <img src={course.thumbnail_path} alt="course_picture"></img>
                    <h1>{course.title}</h1>
                    <progress id="xp_progress" value={userXp} max={courseXp}></progress>
                    <label htmlFor='xp_progress'>{userXp}/{courseXp}XP</label>
                </div>
            </Link>
        </div>
    );
}