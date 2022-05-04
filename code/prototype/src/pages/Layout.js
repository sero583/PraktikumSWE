import { Outlet } from "react-router-dom";
import Header from './Header';
import Footer from './Footer';
import './styles/Layout.css'

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