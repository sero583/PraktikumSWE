import { Outlet } from "react-router-dom";
import Header from './Header';
import Footer from './Footer';
import '../../css/components/Layout.css'

export default function Layout(){
    return (
        <div className="layout">
            <div>
                <Header />
                <Outlet />
            </div>
            <Footer />
        </div>
    );
}