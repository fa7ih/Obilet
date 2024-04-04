import React, { useContext, useState } from 'react';
import { motion, AnimatePresence } from "framer-motion";
import { RxCross2 } from "react-icons/rx";
import { AuthContext } from '../context.jsx';
import toast, { Toaster } from 'react-hot-toast';
import Cookies from 'js-cookie';

export default function Login({ loginButton, setLoginButton, registerButton, setRegisterButton }) {
    const { loginUser } = useContext(AuthContext);
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const handleClickOutside = (e) => {
        if (e.target === e.currentTarget) {
            setLoginButton(!loginButton);
        }
    };

    const handleGoRegister = () => {
        setLoginButton(!loginButton)
        setRegisterButton(!registerButton)
    }

    const handleLogin = async () => {
        try {
            const loadingToast = toast.loading('Giriş Yapılıyor...');
            const data = await loginUser(email, password);
            if (data.success) {
                toast.success('Başarıyla giriş yaptınız!');
                toast.dismiss(loadingToast);
                setEmail("")
                setPassword("")
                // Session Storage kullanarak veri saklama (sadece oturum boyunca saklanır)
                sessionStorage.setItem('KullaniciID', data.KullaniciID);
                sessionStorage.setItem('email', data.email);
                sessionStorage.setItem('role_id', data.role_id);
                sessionStorage.setItem('status', data.status);
                setLoginButton(!loginButton);

            } else {
                toast.error(data.message);
                toast.dismiss(loadingToast);
            }
        } catch (error) {
            toast.error('Sunucuyla iletişim hatası!');
        }
    };

    return (
        <AnimatePresence>
            {loginButton &&
                <motion.div
                    className='fixed inset-0 flex items-center justify-center z-50'
                    initial={{ opacity: 0, backgroundColor: "rgba(0, 0, 0, 0)" }}
                    animate={{ opacity: 1, backgroundColor: "rgba(0, 0, 0, 0.2)" }}
                    exit={{ opacity: 0, backgroundColor: "rgba(0, 0, 0, 0)" }}
                    onClick={handleClickOutside}
                >
                    <div className='relative flex flex-col bg-white rounded-lg shadow-lg transition-all duration-300 w-80 mx-auto'>
                        <div className='flex flex-row justify-between items-center py-4 px-8 font-semibold text-2xl text-center bg-gray-200 rounded-t-lg'>
                            <p>Üye Girişi</p>
                            <button onClick={() => setLoginButton(!loginButton)}>
                                <RxCross2 />
                            </button>
                        </div>
                        <div className="p-6">
                            <input className='border border-gray-300 rounded-md mb-4 py-2 px-4 block w-full' type="text" placeholder="E-posta" value={email} onChange={(e) => setEmail(e.target.value)} />
                            <input className='border border-gray-300 rounded-md mb-6 py-2 px-4 block w-full' type="password" placeholder="Şifre" value={password} onChange={(e) => setPassword(e.target.value)} onKeyDown={(e) => {
                                if (e.key === 'Enter') {
                                    handleLogin(); // Call handleLogin when Enter key is pressed
                                }
                            }} />
                            <button onClick={handleLogin} className='bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md w-full'>Giriş Yap</button>
                            <p className='text-gray-600 text-sm mt-3 text-center'>Hesabınız yok mu? <button onClick={handleGoRegister} className='text-green-600 font-semibold'>Kayıt Ol</button></p>
                        </div>
                    </div>
                </motion.div>}
        </AnimatePresence>
    );
}