import './styles/CourseListAdminButtons.css';

export default function CourseListAdminButtons(){
    function addCourse(){

    }
    
    return (
        <div className='courselistadmin'>
            <button id="addCourses" onClick={addCourse}>Add</button>
        </div>
    );
}