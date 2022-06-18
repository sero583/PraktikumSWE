import axios from 'axios';
import { useEffect, useState } from 'react';
import {Link} from 'react-router-dom';
import '../../css/components/CourseCardSmall.css';

export default function CourseCardSmall({course}){
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
        <div className="smallCard">
            <Link to={"/course/" + course.id}>
                <div>
                    <p>{course.title}</p>
                    <p>{userXp}/{courseXp}XP</p>
                </div>
            </Link>
        </div>
    );
}