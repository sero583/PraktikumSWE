import axios from 'axios';
import { useEffect, useState } from 'react';
import {Link} from 'react-router-dom';
import '../../css/components/CourseCardSmall.css';

export default function CourseCardSmall({course}){
    /*const [courseXp, setCourseXp] = useState();
    const [userXp, setUserXp] = useState();*/
    
    return (
        <div className="smallCard">
            <Link to={"/course/" + course.id}>
                <div>
                    <p>{course.title}</p>
                    <p>{course?.user_xp ? course.user_xp : "null"}/{course?.course_xp ? course.course_xp : "null"} XP</p>
                </div>
            </Link>
        </div>
    );
}