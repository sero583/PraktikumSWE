import CourseList from './CourseList';
import CourseListAdminButtons from './CourseListAdminButtons';
import '../../css/components/Home.css'

export default function Home(){
    return (
        <div className='home'>
            <div className='innerHome'>
                <h1>Recent courses</h1>
                <CourseList coursetype={"recent"}/>
                <h1>All courses</h1>
                <CourseListAdminButtons />
                <CourseList coursetype={"all"}/>
            </div>
        </div>
    );
}