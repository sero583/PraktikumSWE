import { Outlet } from "react-router-dom";
import Header from './Header';
import Footer from './Footer';
import '../../css/components/Layout.css'

export default function Layout(token) {
    return (
        <div className="layout">
            <div>
                <Header receiveValue={token.receiveValue} />
                <Outlet />
            </div>
            <Footer />
        </div>
    );
}