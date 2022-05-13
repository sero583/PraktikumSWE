import './styles/CourseList.css';
import CourseCard from './CourseCard';

export default function CourseList({coursetype}){
    let courses = [];
    if(coursetype === "recent"){
        //get recent courses from server
        courses = [{id: 1, img: "example.jpg", title: "Java Beginner course"}];
    }
    else{
        //fetch all courses from server
        courses = [{id: 1, img: "example.jpg", title: "Java Beginner course"}, {id: 2, img: "example.jpg", title: "Python Beginner course"}];
    }

    return (
        <div className="courses">
            {courses.map(course => {
                return <CourseCard key={course.id} course={course} />
            })}
        </div>
    );
}