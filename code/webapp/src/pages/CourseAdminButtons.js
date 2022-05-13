import './styles/CourseAdminButtons.css';
import { useNavigate } from 'react-router-dom';

export default function CourseAdminButtons(){
    let headline;
    let text;

    function editCourse(){
        document.getElementById("cancelEditCourse").classList.remove("hidden");
        document.getElementById("saveCourse").classList.remove("hidden");
        document.getElementById("addLesson").classList.remove("hidden");
        document.getElementById("deleteCourse").classList.remove("hidden");
        document.getElementById("editCourse").classList.add("hidden");
        
        headline = document.getElementById("courseHeadline").textContent;
        text = document.getElementById("courseText").textContent;

        document.getElementById("courseHeadline").contentEditable = "true";
        document.getElementById("courseText").contentEditable = "true";
    }

    function cancelEditCourse(){
        document.getElementById("cancelEditCourse").classList.add("hidden");
        document.getElementById("saveCourse").classList.add("hidden");
        document.getElementById("addLesson").classList.add("hidden");
        document.getElementById("deleteCourse").classList.add("hidden");
        document.getElementById("editCourse").classList.remove("hidden");

        document.getElementById("courseHeadline").textContent = headline;
        text = document.getElementById("courseText").textContent = text;

        document.getElementById("courseHeadline").contentEditable = "false";
        document.getElementById("courseText").contentEditable = "false";
    }

    function saveCourse(){
        document.getElementById("cancelEditCourse").classList.add("hidden");
        document.getElementById("saveCourse").classList.add("hidden");
        document.getElementById("addLesson").classList.add("hidden");
        document.getElementById("deleteCourse").classList.add("hidden");
        document.getElementById("editCourse").classList.remove("hidden");

        document.getElementById("courseHeadline").contentEditable = "false";
        document.getElementById("courseText").contentEditable = "false";
    }

    function addLesson(){

    }

    const navigate = useNavigate();
    function deleteCourse(){
        //send delete request to server
        navigate("/home");
    }
    
    return (
        <div className='courseadmin'>
            <button id="editCourse" onClick={editCourse}>Edit</button>
            <button id="cancelEditCourse" className='hidden' onClick={cancelEditCourse}>Discard Changes</button>
            <button id="saveCourse" className='hidden' onClick={saveCourse}>Save Changes</button>
            <button id="addLesson" className='hidden' onClick={addLesson}>Add Lesson</button>
            <button id="deleteCourse" className='hidden' onClick={deleteCourse}>Delete Course</button>
        </div>
    );
}