import '../../css/components/LessonAdminButtons.css';
import { useNavigate } from 'react-router-dom';

export default function LessonAdminButtons({lesson}){
    let headline;
    let text;
    
    function editLesson(){
        document.getElementById("cancelEditLesson").classList.remove("hidden");
        document.getElementById("saveLesson").classList.remove("hidden");
        document.getElementById("deleteLesson").classList.remove("hidden");
        document.getElementById("editLesson").classList.add("hidden");

        headline = document.getElementById("lessonHeadline").textContent;
        text = document.getElementById("lessonText").textContent;
        
        document.getElementById("input").value = lesson.predefined_code;
        document.getElementById("output").value = lesson.expected_output;
        document.getElementById("output").readOnly = false;
        document.getElementById("lessonHeadline").contentEditable = "true";
        document.getElementById("lessonText").contentEditable = "true";
    }

    function cancelEdit(){
        document.getElementById("cancelEditLesson").classList.add("hidden");
        document.getElementById("saveLesson").classList.add("hidden");
        document.getElementById("deleteLesson").classList.add("hidden");
        document.getElementById("editLesson").classList.remove("hidden");

        document.getElementById("input").value = "";
        document.getElementById("output").value = "";
        document.getElementById("output").readOnly = true;
        document.getElementById("lessonHeadline").contentEditable = "false";
        document.getElementById("lessonText").contentEditable = "false";

        document.getElementById("lessonHeadline").textContent = headline;
        document.getElementById("lessonText").textContent = text;
    }

    function saveLesson(){
        document.getElementById("cancelEditLesson").classList.add("hidden");
        document.getElementById("saveLesson").classList.add("hidden");
        document.getElementById("deleteLesson").classList.add("hidden");
        document.getElementById("editLesson").classList.remove("hidden");

        document.getElementById("input").value = "";
        document.getElementById("output").value = "";
        document.getElementById("output").readOnly = true;
        document.getElementById("lessonHeadline").contentEditable = "false";
        document.getElementById("lessonText").contentEditable = "false";

        //TODO send new content to server
    }

    const navigate = useNavigate();
    function deleteLesson(){
        //TODO send delete request to server
        navigate("/course/" + lesson.course_id);
    }
    
    return (
        <div className='lessonadmin'>
            <button id="editLesson" onClick={editLesson}>Edit</button>
            <button id="cancelEditLesson" className="hidden" onClick={cancelEdit}>Discard Changes</button>
            <button id="saveLesson" className="hidden" onClick={saveLesson}>Save Changes</button>
            <button id="deleteLesson" className="hidden" onClick={deleteLesson}>Delete Lesson</button>
        </div>
    );
}