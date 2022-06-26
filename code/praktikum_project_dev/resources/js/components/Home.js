import { useEffect, useState } from 'react';
import CourseList from './CourseList';
import CourseListAdminButtons from './CourseListAdminButtons';
import '../../css/components/Home.css'

export default function Home(){
    const [coursesData, setCoursesData] = useState(null);

    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");

        axios.get("api/course", {
            headers: { "Authorization": "Bearer " + cachedToken }
        }).then((response) => {
            setCoursesData(response.data);
        });
    }, []);
    
    return (
        <div className='home'>
            <div className='innerHome'>
                <h1>Recent courses</h1>
                {coursesData?.recent_courses ? (coursesData.recent_courses.length>0 ? <CourseList courses={coursesData.recent_courses}/> : <p>Nothing here yet. Visit your first course for it to appear here.</p>) : <div className='courses'>Loading...</div>}
                <h1>All courses</h1>
                {/*<CourseListAdminButtons /> a removed feature*/}
                {coursesData?.courses ? (coursesData.courses.length>0 ? <CourseList courses={coursesData.courses}/> : <p>Nothing here yet. Stay tuned for the upcoming first course release!</p>) : <div className='courses'>Loading...</div>}
            </div>
        </div>
    );
}