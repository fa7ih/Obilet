import { useState } from 'react';
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import toast, { Toaster } from 'react-hot-toast';

import { Home } from "./pages/Home";
import Sss from "./pages/Sss";
import PnrSorgu from "./pages/PnrSorgula";
import Biletlerim from './pages/Biletlerim';
import OtobusSecenekler from './pages/OtobusSecenekler';

const App = () => {
    const [selectedDate, setSelectedDate] = useState(""); // Örnek olarak seçilen tarih state'i

    const router = createBrowserRouter([
        {
            path: "/home",
            element: <Home />,
        },
        {
            path: "/sss",
            element: <Sss />,
        },
        {
            path: "/pnr-sorgu",
            element: <PnrSorgu />,
        },
        {
            path: "/biletlerim",
            element: <Biletlerim />,
        },
        {
            path: "/seferler/:from_to/:date", // Dinamik yol parametreleri
            element: <OtobusSecenekler />,
        },
    ]);

    return (
        <div className="App">
            <Toaster
                position="top-right"
                toastOptions={{
                    className: '',
                    style: {
                        fontSize: 18,
                        fontWeight: 600,
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center'
                    },
                }}
            />
            <RouterProvider router={router} />
        </div>
    );
}

export default App;
